<div class="content">
	<div id="registerBox">
		<div id="header">
			<p>registreer</p>
		</div>
		<form name="registerForm" method="POST" enctype="multipart/form-data" >
			<!-- <input placeholder="Uw consultant code" class="C_ID" type="text" name="C_ID"> -->
			<input placeholder="naam" class="naam" type="text" name="naam" autofocus>
			<input placeholder="adres" class="adres" type="text" name="adres">
			<input placeholder="email" class="email" type="email" name="email">
			<input placeholder="password" class="password" type="password" name="password">
			<input name="submit" value="true" type="hidden">
			<input id="submit" value="Registreer" type="submit">
		</form>
	</div>
</div>
<?php
	if(isset($_POST['submit'])) {
		$error = "";
		// $C_ID = $_POST['C_ID'];
		$naam = $_POST['naam'];
		$adres = $_POST['adres'];
		$email = $_POST['email'];
		$password = password_hash($_POST['password'], PASSWORD_BCRYPT);
		// if(strlen($C_ID) < 1) {
		// 	$error .= "U heeft geen cosultant code ingevuld.<br>";
		// } 
		if(strlen($naam) < 1) {
			$error .= "U heeft geen naam ingevuld.<br>";
		} 
		if(strlen($email) < 1) {
			$error .= "U heeft geen email ingevuld.<br>";
		}  
		if(strlen($adres) < 1) {
			$error .= "U heeft geen adres ingevuld.<br>";
		} 
		if(strlen($password) < 1) {
			$error .= "U heeft geen password ingevuld.<br>";
		}
		echo $error;
		if(!$error) {
			try{
				$sql = "SELECT * FROM `consultants` WHERE `Naam` = :naam AND `Adres` = :adres AND `Email` = :email";

				$stmt = $db->prepare($sql);
				$stmt->execute(array(':naam'=> $naam, ':adres' => $adres, ':email' => $email));

				// // get total matches //
				// $total = $stmt->rowCount();
				// echo "{$total}</br>";

				// // get all matches //
				// while ($row = $stmt->fetchObject()) {
	   //  echo "<ul>";

	   //  echo "<li>{$row->C_ID}</li>";
	   //  echo "<li>{$row->Naam}</li>";
	   //  echo "<li>{$row->Adres}</li>";
	   //  echo "<li>{$row->Email}</li>";

	   //  echo "</ul>";
				// }

				$result = $stmt->fetchObject();

				if($result) {		
					// echo(var_dump($result) . "</br>");
					$C_ID = $result->C_ID;
					echo($C_ID);
					try{
						$sql = "UPDATE consultants SET Wachtwoord = :password WHERE C_ID = :id";
						// $sql = "INSERT INTO consultants (Wachtwoord) WHERE C_ID = :id values (:password)";
						$stmt = $db->prepare($sql);
						$result = $stmt->execute(array('password' => $password, ':id' => $C_ID));
						if ( $result ){
							echo var_dump($result);
							echo "<script>alert('Thank you. You have been registered');location.href='index.php';</script>";

						} else {
							echo "<script>alert('Sorry, there has been a problem registering.');</script>";
						}
					}
					catch(PDOException $e) {
						echo $e->getMessage();
					}
				}
			}					
			catch(PDOException $e) {
				echo $e->getMessage();
			}
		}
	}
?>