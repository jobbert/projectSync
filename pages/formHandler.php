<?php
if(isset($_POST['submit'])) {
	$action = $_POST['action'];
	$page = $_POST['page'];
	if(isset($action) && $action === 'edit') {
		//editting consultants
		if(isset($page) && $page === 'consultants') {
			$key = $_POST['key'];
			$naam = $_POST['naam'];
			$adres = $_POST['adres'];
			$email = $_POST['email'];
			try{
				$sql = "UPDATE consultants 
				SET Naam = :naam, Adres = :adres, Email = :email 
				WHERE C_ID = :key";

				$stmt = $db->prepare($sql);
				$result = $stmt->execute(array('naam' => $naam, 'adres' => $adres, 'email' => $email, 'key' => $key));
				if ( $result ){
					echo "<script>alert('Thank you. You have been registered');location.href='index.php?page=consultants';</script>";
				} else {
					echo "<script>alert('Sorry, there has been a problem registering.');</script>";
				}
			}
			catch(PDOException $e) {
				echo $e->getMessage();
			}
		}
		//editting kosten
		if(isset($page) && $page === 'kosten') {
			$key = $_POST['key'];
			$omschrijving = $_POST['omschrijving'];
			try{
				$sql = "UPDATE kosten 
				SET omschrijving = :omschrijving
				WHERE kostencode = :key";

				$stmt = $db->prepare($sql);
				$result = $stmt->execute(array('omschrijving' => $omschrijving, 'key' => $key));
				if ( $result ){
					echo "<script>alert('Thank you. You have been registered');location.href='index.php?page=kosten';</script>";
				} else {
					echo "<script>alert('Sorry, there has been a problem registering.');</script>";
				}
			}
			catch(PDOException $e) {
				echo $e->getMessage();
			}
		}
		//editting projecten
		if(isset($page) && $page === 'projecten') {
			$key = $_POST['key'];
			$naam = $_POST['naam'];
			try{
				$sql = "UPDATE projecten 
				SET naam = :naam
				WHERE P_ID = :key";

				$stmt = $db->prepare($sql);
				$result = $stmt->execute(array('naam' => $naam, 'key' => $key));
				if ( $result ){
					echo "<script>alert('Thank you. You have been registered');location.href='index.php?page=projecten';</script>";
				} else {
					echo "<script>alert('Sorry, there has been a problem registering.');</script>";
				}
			}
			catch(PDOException $e) {
				echo $e->getMessage();
			}
		}
	}
	if(isset($action) && $action ==='add') {
		//adding new kosten
		if(isset($page) && $page === 'kosten') {
			$omschrijving = $_POST['omschrijving'];
			try{
				$sql = "INSERT INTO kosten(omschrijving) VALUES (:omschrijving)";

				$stmt = $db->prepare($sql);
				$result = $stmt->execute(array('omschrijving' => $omschrijving));
				if ( $result ){
					echo "<script>alert('Succes');location.href='index.php?page=kosten';</script>";
				} else {
					echo "<script>alert('Sorry, there has been a problem.');</script>";
				}
			}
			catch(PDOException $e) {
				echo $e->getMessage();
			}
		}
		//adding new projecten
		if(isset($page) && $page === 'projecten') {
			$naam = $_POST['naam'];
			try{
				$sql = "INSERT INTO projecten(Naam) VALUES (:naam)";

				$stmt = $db->prepare($sql);
				$result = $stmt->execute(array('naam' => $naam));
				if ( $result ){
					echo "<script>alert('Succes');location.href='index.php?page=projecten';</script>";
				} else {
					echo "<script>alert('Sorry, there has been a problem.');</script>";
				}
			}
			catch(PDOException $e) {
				echo $e->getMessage();
			}
		}
		//adding new consultants
		if(isset($page) && $page === 'consultants') {
			$naam = $_POST['naam'];
			$adres = $_POST['adres'];
			$email = $_POST['email'];
			try{
				$sql = "INSERT INTO consultants(Naam, Adres, Email) VALUES (:naam, :adres ,:email)";

				$stmt = $db->prepare($sql);
				$result = $stmt->execute(array('naam' => $naam, 'adres' => $adres, 'email' => $email));
				if ( $result ){
					echo "<script>alert('Succes');location.href='index.php?page=consultants';</script>";
				} else {
					echo "<script>alert('Sorry, there has been a problem.');</script>";
				}
			}
			catch(PDOException $e) {
				echo $e->getMessage();
			}
		}
	}
}