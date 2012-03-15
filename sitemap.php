<?
/* Make sure this require() points to config.php. */
require('./inc/config.php');

$title="Sitemap";

include(ROOT.'/inc/header.php');

$projects = new Project;
$projects = $projects->find();
?>

<div class="sitemap">

  <h2>Sitemap</h2>

  <div>
    <h3>Pages</h3>
    <ul>
      <li><a href="./about.php">About Us</a></li>
      <li><a href="./contact.php">Contact Us</a></li>
      <li><a href="./employment.php">Employment</a></li>
      <li><a href="./kirby.php">Kirby Building Systems</a></li>
      <li><a href="./projects.php">Projects</a></li>
      <li><a href="./quote.php">Quote</a></li>
      <li><a href="./services.php">Services</a></li>
      <li><a href="./testimonials.php">Testimonials</a></li>
    </ul>
  </div>
  
  <div>
    <h3>Construction Type</h3>
    <ul>
      <li><a href="./commercial.php">Commercial</a></li>
      <li><a href="./healthcare.php">Healthcare</a></li>
      <li><a href="./industrial.php">Industrial</a></li>
      <li><a href="./pre_engineered.php">Pre-Engineered</a></li>
    </ul>
  </div>
  
  <div>
    <h3>Projects</h3>
    <ul>
      <?php foreach ($projects as $project) { ?>
        <li><a href="project.php?id=<?=$project->id?>"><?=$project->title?></a></li>
      <?php } ?>
    </ul>
  </div>

  <div>
    <h3>Forms</h3>
    <ul>
      <li><a href="./contact.php">Contact Us</a></li>
      <li><a href="./employment.php">Employment</a></li>
      <li><a href="./quote.php">Quote</a></li>
    </ul>
  </div>
</div>

<?
include(ROOT.'/inc/footer.php');
?>