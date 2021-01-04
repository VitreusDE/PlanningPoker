<?php

class Game{

	private $db;
  private $task_description;
  private $game_id;
	private $user1;
  private $user2;
  private $user3;
  private $user4;
  private $card1;
  private $card2;
  private $card3;
  private $card4;


	// Create a new Game object

	public function __construct($db) {


		$this->db = $db;
		if (isset($_GET['game_id'])) {
				$row = $this->get_game($this->db->real_escape_string($_GET['game_id']));
				$this->task_description = $row->task_description;
				$this->game_id = $row->id;
				$this->user1 = $row->user1;
				$this->user2 = $row->user2;
				$this->user3 = $row->user3;
				$this->user4 = $row->user4;
				$this->card1 = $row->card1;
				$this->card2 = $row->card2;
				$this->card3 = $row->card3;
				$this->card4 = $row->card4;
		}


		if (isset($_POST['start-btn'])) {
			$this->start_game();

		}
		return $this;
	}
	// Get Task descripton

	public function get_task_description() { return $this->task_description; }

	// get game id
	public function get_game_id() { return $this->game_id; }
 	// get user 1
	public function get_user1() { return $this->user1; }
	// get user 2
 	public function get_user2() { return $this->user2; }
	// get user 3
 	public function get_user3() { return $this->user3; }
	// get user 4
 	public function get_user4() { return $this->user4; }

	// get card 1
 	public function get_card1() { return $this->card1; }
	// get card 2
 	public function get_card2() { return $this->card2; }
	// get card 3
 	public function get_card3() { return $this->card3; }
	// get card 4
 	public function get_card4() { return $this->card4; }

	// make start new game
  public function start_game() {
		$this->task_description =  $this->db->real_escape_string($_POST['descripton']);
		$invited = explode(",", $this->db->real_escape_string($_POST['invited']));
		$this->user1 = $invited[0];
		$this->user2 = $invited[1];
		$this->user3 = $invited[2];
		$this->user4 = $invited[3];
		$this->create_game();
  }
	// Register a new user

	public function create_game() {
				$query  = 'INSERT INTO games (task_description, user1, user2, user3, user4, card1, card2, card3, card4) '
						. 'VALUES ("' . $this->task_description  . '", "' . $this->user1 . '", "' . $this->user2 . '", "' . $this->user3 .'", "' . $this->user4 .'", "' . -1 .'", "' . -1 .'", "' . -1 .'", "' . -1 . '")';

				if ($this->db->query($query)) {
					$this->game_id = $this->db->insert_id;
					header('Location: play-game.php?game_id=' .$this->game_id );
					exit();
				}
	}
	public function get_game($game_id) {
		$query  = 'SELECT * FROM games '
				. 'WHERE id = "' . $game_id . '"';

		return ($this->db->query($query)->fetch_object());
  }

	public function set_card($card, $user_id){
		if ($this->user1 == $user_id){
			$this->card1 = $card;
		}
		elseif ($this->user2 == $user_id){
			$this->card2 = $card;
		}
		elseif ($this->user3 == $user_id){
			$this->card3 = $card;
		}
		elseif ($this->user4 == $user_id){
			$this->card4 = $card;
		}
		$query  = 'UPDATE games SET card1 = "'. $this->card1 .'", card2 = "' .$this->card2. '", card3 = "' .$this->card3. '", card4 = "' .$this->card4. '" WHERE id = "' .$this->game_id. '"';
		$this->db->query($query);
	}

	public function send_invitations($user_id){
		$query = 'SELECT * FROM GAMES WHERE user1="' .$user_id. '" '
							. 'OR user2="' .$user_id. '" '
							. 'OR user3="' .$user_id. '" '
							. 'OR user4="' .$user_id. '" ';

		$invitations = ($this->db->query($query)->fetch_all(MYSQLI_ASSOC));
		$content = "";
		foreach ($invitations as $row){
				$content .= '<a class="card-btn btn btn-success mt-2 w-100" href="play-game.php?game_id=' . $row['id'] .'">' . $row['task_description'] . '</a>';
		}
		return  $content;
	}
}
?>
