<?php

class User{

	private $db;
	private $user_id;
	private $username;
	private $email;
	private $is_logged = false;
	private $msg = array();
	private $error = array();

	// Create a new user object

	public function __construct($db) {

		session_start();

		$this->db = $db;

		$this->update_messages();

		if (isset($_GET['logout'])) {

			$this->logout();

		} elseif (isset($_COOKIE['username']) || (!empty($_SESSION['username']) && $_SESSION['is_logged']))  {

			$this->is_logged = true;
			$this->username = $_SESSION['username'];
			$this->user_id = $_SESSION['user_id'];
			$this->email = $_SESSION['email'];

			if (isset($_POST['register'])) {

				$this->register();

			}

		} elseif (isset($_POST['login'])) {

			$this->login();

		} elseif (isset($_POST['register'])) {

			$this->register();

		} else if (!$this->db_exists()) $this->create_db();

		return $this;
	}

	// Get username

	public function get_username() { return $this->username; }

	// Get user id

	public function get_user_id() { return $this->user_id; }

	// Get email

	public function get_email() { return $this->email; }

	// Check if the user is logged

	public function is_logged() { return $this->is_logged; }

	// Get info messages

	public function get_info() { return $this->msg; }

	// Get errors

	public function get_error() { return $this->error; }

	// Copy error & info messages from $_SESSION to the user object

	private function update_messages() {
		if (isset($_SESSION['msg']) && $_SESSION['msg'] != '') {
			$this->msg = array_merge($this->msg, $_SESSION['msg']);
			$_SESSION['msg'] = '';
		}
		if (isset($_SESSION['error']) && $_SESSION['error'] != '') {
			$this->error = array_merge($this->error, $_SESSION['error']);
			$_SESSION['error'] = '';
		}
	}

	// Login

	public function login() {

		if (!empty($_POST['username']) && !empty($_POST['password'])) {

			$this->username = $this->db->real_escape_string($_POST['username']);
			$this->password = sha1($this->db->real_escape_string($_POST['password']));

			if ($row = $this->verify_password()) {

				session_regenerate_id(true);
				$_SESSION['id'] = session_id();
				$_SESSION['username'] = $this->username;
				$_SESSION['user_id'] = $row->id;

				$_SESSION['email'] = $row->email;
				$_SESSION['is_logged'] = true;
				$this->is_logged = true;
				// Set a cookie that expires in one week
				if (isset($_POST['remember']))
					setcookie('username', $this->username, time() + 604800);

				header('Location: index.php');
				exit();

			} else $this->error[] = 'Wrong user or password.';

		} elseif (empty($_POST['username'])) {

			$this->error[] = 'Username field was empty.';

		} elseif (empty($_POST['password'])) {

			$this->error[] = 'Password field was empty.';
		}

	}

	// Check if username and password match

	private function verify_password() {

		$query  = 'SELECT * FROM users '
				. 'WHERE user = "' . $this->username . '" '
				. 'AND password = "' . $this->password . '"';

		return ($this->db->query($query)->fetch_object());

	}

	// Logout function

	public function logout() {

		session_unset();
		session_destroy();
		$this->is_logged = false;
		setcookie('username', '', time()-3600);
		header('Location: index.php');
		exit();

	}

	// Register a new user

	public function register() {

		if (!empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['confirm'])) {

			if ($_POST['password'] == $_POST['confirm']) {

				$first_user = $this->empty_db();
				$username = $this->db->real_escape_string($_POST['username']);
				$password = sha1($this->db->real_escape_string($_POST['password']));
				$email = $this->db->real_escape_string($_POST['email']);

				$query  = 'INSERT INTO users (user, password, email) '
						. 'VALUES ("' . $username . '", "' . $password . '", "' . $email . '")';

				if ($this->db->query($query)) {

					if ($first_user) {
						session_regenerate_id(true);
						$_SESSION['id'] = session_id();
						$_SESSION['username'] = $username;
						$_SESSION['email'] = $email;
						$_SESSION['is_logged'] = true;
						$this->is_logged = true;
					} else {
						$this->msg[] = 'User created.';
						$_SESSION['msg'] = $this->msg;
					}
					// To avoid resending the form on refreshing
					header('Location: ' . $_SERVER['REQUEST_URI']);
					exit();

				} else $this->error[] = 'Username already exists.';

			} else $this->error[] = 'Passwords don\'t match.';

		} elseif (empty($_POST['username'])) {

			$this->error[] = 'Username field was empty.';

		} elseif (empty($_POST['password'])) {

			$this->error[] = 'Password field was empty.';

		} elseif (empty($_POST['confirm'])) {

			$this->error[] = 'You need to confirm the password.';
		}

	}

	// Get username by id

	public function get_user_name_by_id($user_id) {
		$query = 'SELECT * FROM users WHERE id = "' . $user_id . '"';
		$result = $this->db->query($query);
		$row = mysqli_fetch_row($result);
		return $row[1];

	}
	// Get all the existing users

	public function get_users() {

		$query = 'SELECT * FROM users';

		return ($this->db->query($query)->fetch_all(MYSQLI_ASSOC));
	}

	// Print info messages in screen

	public function display_info() {
		foreach ($this->msg as $msg) {
			echo '<p class="msg">' . $msg . '</p>';
		}
	}

	// Print errors in screen

	public function display_errors() {
		foreach ($this->error as $error) {
			echo '<p class="error">' . $error . '</p>';
		}
	}

	// Check if the users db has been created

	public function db_exists() {
		return ($this->db->query('SELECT 1 FROM users'));
	}

	// Check if the users db has any users

	public function empty_db() {
		$query = 'SELECT * FROM users';
		$result = $this->db->query($query);
		return ($result->num_rows === 0);
	}

	// Create a new db to start with

	private function create_db() {

		$query 	= 'CREATE TABLE users ('
				. 'user VARCHAR(75) NOT NULL, '
				. 'password VARCHAR(75) NOT NULL, '
				. 'email VARCHAR(150) NULL, '
				. 'PRIMARY KEY (user) '
				. ') ENGINE=MyISAM COLLATE=utf8_general_ci';

		return ($this->db->query($query));

	}



}

?>
