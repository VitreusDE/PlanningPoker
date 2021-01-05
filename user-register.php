<?php include('header.php'); ?>
<div class="container">
	<form method="POST" class="mt-5 mx-auto w-md-50" action="<?php echo $_SERVER['PHP_SELF']; ?>" autocomplete="off">
		<?php $user->display_info(); ?>
		<?php $user->display_errors(); ?>
		<div class="form-group">
			<label for="email">E-mail:</label>
			<input class="form-control" type="email" id="email" name="email" placeholder="email" />
		</div>
		<div class="form-group">
			<label for="username">Username:</label>
			<input class="form-control" type="text" id="username" name="username" placeholder="username" />
		</div>
		<div class="form-group">
			<label for="password">Password:</label>
			<input class="form-control" type="password" id="password" name="password" placeholder="password" />
		</div>
		<div class="form-group">
			<label for="confirm">Repeat password:</label>
			<input class="form-control" type="password" id="confirm" name="confirm" placeholder="repeat password" />
		</div>
		<input class="btn btn-primary w-100" id="button-register" type="submit" name="register" value="Register">
	</form>
</div>

<?php include('footer.php'); ?>
