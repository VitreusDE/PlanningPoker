<?php include('header.php');
if ($user->is_logged() == false){
	header("Location: login.php");
	die();
}
?>

<div class="container">

  <section class="make-game py-5">
    <form class="mx-auto w-md-50" action="" method="POST">
      <h3>Create game:</h3>
      <label for="">Taske description:</label>
      <textarea class="form-control mb-3" name="descripton"></textarea>
      <label for="">Invite users:</label>
      <div class="users mb-3">
        <?php
          $users = $user->get_users();
          foreach ($users as $row){
						if ($row['id'] == $user->get_user_id()) {continue;}
            echo '<div class="user py-2 mx-1">
                      <a class="btn btn-warning w-100 user-btn" data-value="'. $row['id'] .'" href="#">' . $row['user'] .'</a>
                  </div>';
          }
        ?>
      </div>
      <input id="invited" type="text" name="invited" value="<?php echo $user->get_user_id(); ?>" style="display: none;">
      <input name="start-btn" type="submit" class="btn btn-success w-100 mt-3" value="Start game" placeholder="Start game" />
    </form>
  </section>
  <section class="invitations py-5">
    <div class="w-md-50 mx-auto">
      <h3>Invitations:</h3>
			<?php echo $game->send_invitations($user->get_user_id()); ?>
    </div>
  </section>
</div>

<script src="js/invite-users.js" charset="utf-8"></script>

<?php include('footer.php'); ?>
