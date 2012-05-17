<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<meta name="keywords" content="<?php echo($keywords);?>" />
<meta name="description" content="<?php echo($description);?>" />

<title>Champion Builders, Inc. | <?php echo($title);?></title>

<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon" />

<link href="css/default.css" rel="stylesheet" type="text/css" />
<link href='http://fonts.googleapis.com/css?family=Metrophobic' rel='stylesheet' type='text/css' />
<link href='http://fonts.googleapis.com/css?family=Open Sans' rel='stylesheet' type='text/css' />
<link href='http://fonts.googleapis.com/css?family=Crillee' rel='stylesheet' type='text/css' />

<script type="text/javascript" src="js/jquery.cycle.lite.js"></script>
<script type="text/javascript" src="js/contactform.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
<script type="text/javascript" src="http://cloud.github.com/downloads/malsup/cycle/jquery.cycle.all.latest.js"></script>

<script type="text/javascript">
$(document).ready(function() {
    $('.slideshow').cycle({
		fx: 'fade',
		timeout: 10000,
		delay: -20000
	});
});
</script>

</head>

<body>

<div class="container <?php echo($bg);?>">
<div class="header">
<a href="index.php" title="Champion Builders, Inc."><img src="images/champion-logo2.png" class="logo" title="Champion Builders, Inc. - Kingston, PA" alt=""/></a>
<div class="slogan">

General Contracting &bull; Construction Management Services<br />
<small>Proudly Serving Northeastern Pennsylvania since 1986</small>

</div>
</div>
<div class="nav">
<ul>
<li style="width: 90px;"><a <?php if ($title=="(570) 283-2529 | Kingston, PA") echo "id=\"currentpage\""; ?> href="index.php" title="Home">Home</a></li>
<li style="width: 95px;"><a <?php if ($title=="About Us") echo "id=\"currentpage\""; ?> href="about.php" title="Home">About Us</a></li>
<li style="width: 90px;"><a <?php if ($title=="Projects") echo "id=\"currentpage\""; ?> href="projects.php" title="Projects">Projects</a></li>
<li style="width: 140px;"><a <?php if ($title=="Pre-Engineered") echo "id=\"currentpage\""; ?> href="pre-engineered.php" title="Pre-Engineered">Pre-Engineered</a></li>
<li style="width: 115px;"><a <?php if ($title=="Healthcare") echo "id=\"currentpage\""; ?> href="healthcare.php" title="Healthcare">Healthcare</a></li>
<li style="width: 115px;"><a <?php if ($title=="Industrial") echo "id=\"currentpage\""; ?> href="industrial.php" title="Industrial">Industrial</a></li>
<li style="width: 105px;"><a <?php if ($title=="Commercial") echo "id=\"currentpage\""; ?>  href="commercial.php" title="Commercial">Commercial</a></li>
<li style="width: 110px;"><a <?php if ($title=="Employment") echo "id=\"currentpage\""; ?> href="employment.php" title="Employment">Employment</a></li>
<li style="width: 100px; background: none;"><a <?php if ($title=="Contact Us") echo "id=\"currentpage\""; ?> href="contact.php" title="Contact Us">Contact Us</a></li>
</ul>
</div>
