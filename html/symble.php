<?php 

	require_once("../includes/helpers.php");

	$db = connect_db('mysql:host=localhost;dbname=symble', 'jharvard', 'crimson');
	
	if (isset($_POST['guess']) && isset($_POST['noun'])) {

		$guess = htmlspecialchars($_POST['guess']);
		$noun = htmlspecialchars($_POST['noun']);

		header("Content-type: application/json");

		//class for score, rank(?), etc.
		class Response {
			//calculated score 
			public $score;
		}

		//find how many 

		$query = $db->query("SELECT name, tries FROM guesses WHERE name='$guess' AND noun='$noun'");

		if ($query->rowCount() > 1) {

			foreach ($query as $row) {
				//get # tries for particular guess
				$nounTries = $row['tries'];
			}

			$db->query("UPDATE guesses SET tries = tries + 1 WHERE name='$guess' AND noun='$noun'");

			$totalTries = $db->query("SELECT SUM(tries) FROM guesses WHERE noun='$noun'");

			//score determined by amount of 
			$score = (($nounTries + 1)/$totalTries) * 100;


		}

		else {

			$db->query("INSERT INTO guesses (name, noun) VALUES ('$name', '$noun')");
		} 

	}	

 ?>