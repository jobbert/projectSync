<form name="forgotForm" method="POST" enctype="multipart/form-data" >
	<input placeholder="email" class="email" type="email" name="email" autofocus>
	<input name="submit" value="true" type="hidden">
	<input id="submit" value="send Email" type="submit">
</form>
<?php
if(isset($_POST)) {
	$email = $_POST['email'];
	try{
		$sql = "SELECT * FROM consultants WHERE Email = ?";
		$stmt = $db->prepare($sql);
		$stmt->execute(array($email));
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		if($result) {	
			$hash = $result['Wachtwoord'];
			$password = password_verify($password, $hash);
			$email = $_POST['email'];
			echo($hash);echo "<br>";
			echo(var_dump(password_get_info($hash)));echo "<br>";
			echo($password);echo "<br>";
			echo($email);echo "<br>";
		} 
	}
	catch(PDOException $e) {
		echo $e->getMessage();
	}
}
?>