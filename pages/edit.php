<?php
$page = $_POST['page'];
$action = $_POST['action'];
$key = $_POST['key'];

// echo(var_dump($_POST));
// echo($action);echo "<br>";
// echo($page);echo "<br>";

// echo(var_dump($_POST));

// echo(var_dump($_POST));echo "</br>";
	// if (isset($action)) {
	// 		if (isset($page)) {
	// 		echo "<script>alert('".$action.": ".$page."');</script>";
	// 	}
	// 	echo "<script>alert('".$page.": ".$key."');</script>";
	// }	



	if ($action === "edit") {
		//editting kosten
		if ($page === "kosten") {
			$formRows[0] = "<tr><td><input type='hidden' name='key' value='".$_POST['key']."'></tr></td>";
			$formRows[1] = "<tr><td><input type='text' name='omschrijving' value='".$_POST['omschrijving']."'></tr></td>";
			$formVars[0] = $_POST['key'];
			$formVars[1] = $_POST['omschrijving'];
		}
		//editting projecten
		if ($page === "projecten") {
			$formRows[0] = "<tr><td><input type='hidden' name='key' value='".$_POST['key']."'></tr></td>";
			$formRows[1] = "<tr><td><input type='text' name='naam' value='".$_POST['naam']."'></tr></td>";
			$formVars[0] = $_POST['key'];
			$formVars[1] = $_POST['naam'];
		}
		//editting consultants
		if ($page === "consultants") {
			$formRows[0] = "<tr><td><input type='hidden' name='key' value='".$_POST['key']."'></tr></td>";
			$formRows[1] = "<tr><td><input type='text' name='naam' value='".$_POST['naam']."'></tr></td>";
			$formRows[2] = "<tr><td><input type='text' name='adres' value='".$_POST['adres']."'></tr></td>";
			$formRows[3] = "<tr><td><input type='email' name='email' value='".$_POST['email']."'></tr></td>";
			$formVars[0] = $_POST['key'];
			$formVars[1] = $_POST['naam'];
			$formVars[3] = $_POST['adres'];
			$formVars[4] = $_POST['email'];
		}
	}
	elseif ($action === "delete") {
		//deletting kosten
		if ($page === "kosten") {
			try {
				$sql = "DELETE FROM kosten WHERE kostencode =  :key";
				$stmt = $db->prepare($sql);
				$result = $stmt->execute(array(':key' => $_POST['key']));
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
		//deletting projecten
		if ($page === "projecten") {
			try {
				$sql = "DELETE FROM projecten WHERE P_ID =  :key";
				$stmt = $db->prepare($sql);
				$result = $stmt->execute(array(':key' => $_POST['key']));
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
		//deletting consultants
		if ($page === "consultants") {
			try {
				$sql = "DELETE FROM consultants WHERE C_ID =  :key";
				$stmt = $db->prepare($sql);
				$result = $stmt->execute(array(':key' => $_POST['key']));
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
	}
	elseif ($action === "add") {
		//adding new kosten
		if ($page === "kosten") {
			$formRows[0] = "<tr><td><input type='text' name='omschrijving' value='' placeholder='omschrijving'></tr></td>";
			$formVars[0] = $_POST['omschrijving'];
		}
		if ($page === "projecten") {

			$formRows[0] = "<tr><td><input type='text' name='naam' value='' placeholder='naam'></tr></td>";
			$formVars[0] = $_POST['naam'];
		}
		if ($page === "consultants") {
			$formRows[0] = "<tr><td><input type='text' name='naam' value='' placeholder='naam'></tr></td>";
			$formRows[1] = "<tr><td><input type='text' name='adres' value='' placeholder='adres'></tr></td>";
			$formRows[2] = "<tr><td><input type='email' name='email' value='' placeholder='email'></tr></td>";
			$formVars[0] = $_POST['naam'];
			$formVars[1] = $_POST['adres'];
			$formVars[2] = $_POST['email'];
			// // echo(var_dump($formRows));
			// // echo(var_dump($formVars));			
			// if(isset($_POST['submit'])) {
			// 	echo(var_dump($_POST));
			// }
		}
	}

	if (isset($formRows)) {
		$form = "<form method='POST' action='index.php?page=formHandler' enctype='multipart/form-data'>";
		$form .= "<table>";
		foreach ($formRows as $formRow) {
			$form .= $formRow;
		}
		$form .= "<tr><td><input name='page' type='hidden' value='".$page."'></tr></td>";
		$form .= "<tr><td><input name='action' type='hidden' value='".$action."'></tr></td>";
		$form .= "<tr><td><input name='submit' type='submit' value='submit'></tr></td>";
		$form .= "</table>";
		$form .= "</form>";
		echo($form);
	}
	?>