<?php include('header.php');
if ($user->is_logged() == false){
	header("Location: login.php");
	die();
}
if (isset($_GET['card'])){
    $card =  $_GET['card'];
    $cur_user = $user->get_user_id();
    $game->set_card($card, $cur_user);
}
?>
<div class="container">
		<div class="description text-center mt-3">
				<h3>Task description:</h3>
				<?php echo $game->get_task_description(); ?>
		</div>
		<div class="mt-3 w-md-50 mx-auto">
      <div class="row justify-content-between">
        <div class="box col-md-5 mt-2 p-2">
          <h5><?php echo $user->get_user_name_by_id($game->get_user1()); ?></h5>
          <h5><?php if ($game->get_card1() != -1) echo $game->get_card1(); ?></h5>
        </div>
        <div class="box col-md-5 mt-2 p-2">
          <h5><?php echo $user->get_user_name_by_id($game->get_user2()); ?></h5>
          <h5><?php if ($game->get_card2() != -1) echo $game->get_card2(); ?></h5>
        </div>
        <div class="box col-md-5 mt-2 p-2">
          <h5><?php echo $user->get_user_name_by_id($game->get_user3()); ?></h5>
          <h5><?php if ($game->get_card3() != -1) echo $game->get_card3(); ?></h5>
        </div>
        <div class="box col-md-5 mt-2 p-2">
          <h5><?php echo $user->get_user_name_by_id($game->get_user4()); ?></h5>
          <h5><?php if ($game->get_card4() != -1) echo $game->get_card4(); ?></h5>
        </div>
      </div>
    </div>
</div>

<?php include('footer.php');
