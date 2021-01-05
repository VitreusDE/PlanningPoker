<?php include('header.php');
if ($user->is_logged() == false){
	header("Location: login.php");
	die();
}
?>
<div class="container">
		<div class="description text-center mt-3">
				<h3>Task description:</h3>
				<?php echo $game->get_task_description(); ?>
		</div>
		<div class="cards mt-3 w-md-50 mx-auto">
			<h3 class="text-center">Play your card</h3>
			 <a class="card-btn btn btn-warning mt-2 w-100" href="<?php echo 'game-results.php?game_id=' . $game->get_game_id() . '&card=0' ?>">0</a>
			 <a class="card-btn btn btn-warning mt-2 w-100" href="<?php echo 'game-results.php?game_id=' . $game->get_game_id() . '&card=1' ?>">1</a>
			 <a class="card-btn btn btn-warning mt-2 w-100" href="<?php echo 'game-results.php?game_id=' . $game->get_game_id() . '&card=2' ?>">2</a>
			 <a class="card-btn btn btn-warning mt-2 w-100" href="<?php echo 'game-results.php?game_id=' . $game->get_game_id() . '&card=3' ?>">3</a>
			 <a class="card-btn btn btn-warning mt-2 w-100" href="<?php echo 'game-results.php?game_id=' . $game->get_game_id() . '&card=5' ?>">5</a>
			 <a class="card-btn btn btn-warning mt-2 w-100" href="<?php echo 'game-results.php?game_id=' . $game->get_game_id() . '&card=8' ?>">8</a>
			 <a class="card-btn btn btn-warning mt-2 w-100" href="<?php echo 'game-results.php?game_id=' . $game->get_game_id() . '&card=13' ?>">13</a>
			 <a class="card-btn btn btn-warning mt-2 w-100" href="<?php echo 'game-results.php?game_id=' . $game->get_game_id() . '&card=21' ?>">21</a>
			 <a class="card-btn btn btn-warning mt-2 w-100" href="<?php echo 'game-results.php?game_id=' . $game->get_game_id() . '&card=34' ?>">34</a>
			 <a class="card-btn btn btn-warning mt-2 w-100" href="<?php echo 'game-results.php?game_id=' . $game->get_game_id() . '&card=55' ?>">55</a>
			 <a class="card-btn btn btn-warning mt-2 w-100" href="<?php echo 'game-results.php?game_id=' . $game->get_game_id() . '&card=89' ?>">89</a>
		</div>
</div>

<?php include('footer.php');
