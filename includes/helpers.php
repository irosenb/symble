<?php

/**
 * Renders template.
 *
 * @param array $data
 */
function render($template, $data = array()) //renders template page. from one of the lectures.
{
    $path = __DIR__ . '/../templates/' . $template . '.php';
    if (file_exists($path))
    {
        extract($data);
        require($path);
    }
}

function redirect($page) { //redirecting to home page function, with input of page. Used in one of the lectures.
	$host = $_SERVER["HTTP_HOST"]; 
	$path = rtrim(dirname($_SERVER["PHP_SELF"]), "/\\");
	header("Location: http://$host$path/$page.php");
	exit;
}

function price ($handle) {
	$row = fgetcsv($handle);
	fclose($handle);
	return $row[1];

}

function connect_db($db, $name, $password) {
	
	try //connect to database
	{
		$dbh = new PDO($db, $name, $password);
	}
	catch (PDOException $e) 
	{
		echo "Connection failure: " . $e->getmessage();
	}

	return $dbh;
}

?>
