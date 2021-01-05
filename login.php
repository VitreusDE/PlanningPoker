<?php include('header.php'); ?>
<div class="container">
		<form class="mt-5 mx-auto w-md-50" id="login" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
			<?php $user->display_errors(); ?>
			<div class="form-group">
				<label for="username">Username:</label>
				<input class="form-control" type="text" id="username" name="username" placeholder="user" />
			</div>
			<div class="form-group">
				<label for="password">Password:</label>
				<input class="form-control" type="password" id="password" name="password" placeholder="password" />
			</div>
			<input class="btn btn-primary w-100" id="button-login" type="submit" name="login" value="Log in">
			<a class="btn btn-secondary w-100 mt-2" href="user-register.php">Sing up</a>
		</form>

</div>
<?php include('footer.php'); ?>
