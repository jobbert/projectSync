<form name="forgotForm" method="POST" enctype="multipart/form-data" >
	<input placeholder="email" class="email" type="email" name="email" autofocus>
	<input name="submit" value="true" type="hidden">
	<input id="submit" value="send Email" type="submit">
</form>
<?php
if(isset($_POST['submit'])) {
	$email = $_POST['email'];
	try{
		$sql = "SELECT C_ID, Naam, Adres, Email FROM consultants WHERE Email = :email";
		$stmt = $db->prepare($sql);
		$stmt->execute(array('email' => $email));
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		if($result) {
			try {	
				function randomPassword( $length = 8 ) {
	    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
	    $pass = array(); //remember to declare $pass as an array
	    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
	    for ($i = 0; $i < 8; $i++) {
	        $n = rand(0, $alphaLength);
	        $pass[] = $alphabet[$n];
	    }
	    return implode($pass); //turn the array into a string
				}
				$password = randomPassword(8);
				$hashedPw = password_hash($password, PASSWORD_BCRYPT);
				$ID = $result['C_ID'];
				$sql = "UPDATE consultants 
					SET Wachtwoord = :newPassword
					WHERE C_ID = :ID";
				$stmt = $db->prepare($sql);
				$passChanged =	$stmt->execute(array('newPassword' => $hashedPw, 'ID' => $ID));
				if($passChanged) {
					// echo($ID);echo "<br>";
					// echo($result['Naam']);echo "<br>";
					// echo($result['Adres']);echo "<br>";
					// echo($result['Email']);echo "<br>";
					// echo($password);echo "<br>";
					// echo($hashedPw);echo "<br>";
					// echo var_dump((password_verify($password, $hashedPw)));echo "<br>";
					/////////sendmail//////////
					include ('mailer.php');////
					///////////////////////////
				}
			}
			catch(PDOException $e) {
				echo $e->getMessage();
			}
		}
		else {
			echo "<script>alert('uw email adres is niet gevonden in onze database');</script>";
		} 
	}
	catch(PDOException $e) {
		echo $e->getMessage();
	}
}
?>