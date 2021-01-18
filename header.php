<?php

require_once('config/db.php');
require_once('classes/user.php');
require_once('classes/game.php');

$db = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
if ($db->connect_errno) {
	echo 'Database connection problem: ' . $db->connect_errno;
	exit();
}

$user = new User($db);
$game = new Game($db);


?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
		<!-- Main CSS -->
		<link rel="stylesheet" href="css/main.css">

    <title>Hello, world!</title>
  </head>
  <body>
		<?php
		if ($user->is_logged()){
		?>
		<div class="container">

		<div class="row mt-2">
			<div class=col-6>
				<h5 class="">Welcome <?php echo $user->get_username();?></h5>
			</div>
			<div class="col-6 text-right">
				<a href="?logout">Logout</a>
			</div>
		</div>

	</div>
	<?php }?>
