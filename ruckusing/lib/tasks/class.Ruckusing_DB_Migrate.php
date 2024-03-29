<?php

/*
	This is the primary work-horse method, it runs all migrations available,
	up to the current version.
*/

require_once RUCKUSING_BASE . '/lib/classes/task/class.Ruckusing_iTask.php';
require_once RUCKUSING_BASE . '/config/config.inc.php';
require_once RUCKUSING_BASE . '/lib/classes/Ruckusing_exceptions.php';
require_once RUCKUSING_BASE . '/lib/classes/util/class.Ruckusing_MigratorUtil.php';
require_once RUCKUSING_BASE . '/lib/classes/class.Ruckusing_BaseMigration.php';

class Ruckusing_DB_Migrate implements Ruckusing_iTask {
	
	private $adapter = null;
	private $migrator_util = null;
	private $task_args = array(); 
	private $regexp = '/^(\d+)\_/';
	
	function __construct($adapter) {
		$this->adapter = $adapter;
    $this->migrator_util = new Ruckusing_MigratorUtil($this->adapter);
	}
	
	/* Primary task entry point */
	public function execute($args) {
	  $output = "";
	  if(!$this->adapter->supports_migrations()) {
	   die("This database does not support migrations.");
    }
		$this->task_args = $args;
		date_default_timezone_set('America/New_York');
		echo "Started: " . date('Y-m-d g:ia T') . "\n\n";		
		echo "[db:migrate]: \n";
		try {
  	  // Check that the schema_version table exists, and if not, automatically create it
  	  $this->verify_environment();

			$target_version = null;
			//did the user specify a version?
			if(array_key_exists('VERSION', $this->task_args)) {
			  $target_version = $this->task_args['VERSION'];
			}
			//determine our direction and target version
			$current_version = $this->migrator_util->get_max_version();
			if(is_null($target_version)) {
			  $this->migrate_up($target_version);
		  }elseif($current_version > $target_version) {
			  $this->migrate_down($target_version);
	    } else {
	      $this->migrate_up($target_version);			  
      }
			if(!empty($output)) {
			  echo $output . "\n\n";
		  }
		}catch(Ruckusing_MissingSchemaInfoTableException $ex) {
			echo "\tSchema info table does not exist. I tried creating it but failed. Check permissions.";
		}catch(Ruckusing_MissingMigrationDirException $ex) {
			echo "\tMigration directory does not exist: " . RUCKUSING_MIGRATION_DIR;
		}catch(Ruckusing_Exception $ex) {
			die("\n\n" . $ex->getMessage() . "\n\n");
		}	
		echo "\n\nFinished: " . date('Y-m-d g:ia T') . "\n\n";			
	}

	private function migrate_up($destination) {
		try {
		  echo "\tMigrating UP";
			if(!is_null($destination)) {
			   echo " to: {$destination}\n";				
		  } else {
		    echo ":\n";
		  }
		  $migrations = $this->migrator_util->get_runnable_migrations(RUCKUSING_MIGRATION_DIR, 'up', $destination);			
			if(count($migrations) == 0) {
				return "\nNo relevant migrations to run. Exiting...\n";
			}
			$result = $this->run_migrations($migrations, 'up', $destination);
		}catch(Exception $ex) {
			throw $ex;
		}		
	}//migrate_up

	private function migrate_down($destination) {
		try {
		  echo "\tMigrating DOWN";
			if(!is_null($destination)) {
			   echo " to: {$destination}\n";				
		  } else {
		    echo ":\n";
		  }
			$migrations = $this->migrator_util->get_runnable_migrations(RUCKUSING_MIGRATION_DIR, 'down', $destination);
			$result = $this->run_migrations($migrations, 'down', $destination);
			if(count($migrations) == 0) {
				return "\nNo relevant migrations to run. Exiting...\n";
			}
		}catch(Exception $ex) {
			throw $ex;
		}
	}//migrate_down
	
	private function run_migrations($migrations, $target_method, $destination) {
		$last_version = -1;
		foreach($migrations as $file) {
			$full_path = RUCKUSING_MIGRATION_DIR . '/' . $file['file'];
			if(is_file($full_path) && is_readable($full_path) ) {
				require_once $full_path;
				$klass = Ruckusing_NamingUtil::class_from_migration_file($file['file']);
				$obj = new $klass();
				$refl = new ReflectionObject($obj);
				if($refl->hasMethod($target_method)) {
					$obj->set_adapter($this->adapter);
					$start = $this->start_timer();
					try {
						//start transaction
						$this->adapter->start_transaction();
						$result =  $obj->$target_method();
						//successfully ran migration, update our version and commit
						$this->migrator_util->resolve_current_version($file['version'], $target_method);										
						$this->adapter->commit_transaction();
					}catch(Exception $e) {
						$this->adapter->rollback_transaction();
						//wrap the caught exception in our own
						$ex = new Exception(sprintf("%s - %s", $file['class'], $e->getMessage()));
						throw $ex;
					}
					$end = $this->end_timer();
					$diff = $this->diff_timer($start, $end);
					printf("========= %s ======== (%.2f)\n", $file['class'], $diff);
					$last_version = $file['version'];
					$exec = true;
				} else {
					trigger_error("ERROR: {$klass} does not have a '{$target_method}' method defined!");
				}			
			}//is_file			
		}//foreach
		//update the schema info
		$result = array('last_version' => $last_version);
		return $result;
	}//run_migrations
	
	private function start_timer() {
		return microtime(true);
	}

	private function end_timer() {
		return microtime(true);
	}
	
	private function diff_timer($s, $e) {
		return $e - $s;
	}
	
	private function verify_environment() {
	  if(!$this->adapter->table_exists(RUCKUSING_TS_SCHEMA_TBL_NAME) ) {
			echo "\n\tSchema version table does not exist. Auto-creating.";
	    $this->auto_create_schema_info_table();
    }	 
  }
	
	private function auto_create_schema_info_table() {
	  try {
  		echo sprintf("\n\tCreating schema version table: %s", RUCKUSING_TS_SCHEMA_TBL_NAME . "\n\n");
  		$this->adapter->create_schema_version_table();
  		return true;
		}catch(Exception $e) {
		  die("\nError auto-creating 'schema_info' table: " . $e->getMessage() . "\n\n");
	  }
	}
	
	
}//class

?>