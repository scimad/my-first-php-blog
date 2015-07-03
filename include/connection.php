<?php
	$dsn='mysql:host=localhost;dbname=madLife';
	$dbUser='root';
	$dbPass='secret';
	$conn=$e=NULL;

	$query='SELECT * FROM personalinfo';

	function createConnection($dsn,$dbUser,$dbPass){
		try {
			$conn=new PDO($dsn,$dbUser,$dbPass);	
			$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
			return $conn;
		} catch (PDOException $e) {
			print_r($e->getMessage());
			die();
		}
	}

?>