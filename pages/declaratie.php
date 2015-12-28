<?php
if (isset($_SESSION['ID'])) {
?>
<?php
$proj_ops = '';
$kost_ops = '';

//get projecten
$query = "SELECT * FROM projecten";
$stmt = $db->prepare($query);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
foreach($result as $row) {
	$proj_ops .= "<option value='" . $row['P_ID'] . "'>" . $row['Naam'] . "</option>";
}

//get kosten
$query = "SELECT * FROM kosten";
$stmt = $db->prepare($query);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
foreach($result as $row) {
	$kost_ops .= "<option value='" . $row['kostencode'] . "'>" . $row['omschrijving'] . "</option>";
}
?>
<h1><?php echo($page); ?> pagina</h1>
<form method="POST" enctype="multipart/form-data" name="declaratieform" 
	style="display: flex;
  flex-direction: column;
  justify-content: flex-start;
  align-items: stretch;"
>
 <input type="hidden" value="<?php  echo $_SESSION['ID']; ?>" name="C_ID"/>
	<select name="project"autofocus>
		<?php echo($proj_ops); ?>
	</select></br>
	<select name="kosten">
		<?php echo($kost_ops); ?>
	</select></br>
	<!-- 	<input name="datum" type="date" value="<?php echo date("Y-m-d H:i:s"); ?>" placeholder="<?php echo date("Y-m-d H:i:s"); ?>"/> -->	
	<input name="datum" type="date" value="<?php echo date("Y-m-d"); ?>" placeholder="<?php echo date("Y-m-d"); ?>"/></br>
	<input name="tijd" type="time" format="hh:mm:ss" placeholder="<?php echo date("H:i:s"); ?>"/></br>
	<input name="bedrag" type="number"/></br>
	<input type="submit"/>
</form>
<?php  

if(isset($_POST)) {
	$error = "";
	$c_ID = $_POST['C_ID'];
	$p_ID = $_POST['project'];
	$kostencode = $_POST['kosten'];
	$datum = $_POST['datum'] . " " . $_POST['tijd'];
	$bedrag = $_POST['bedrag'];
	try {
		// $query = "INSERT INTO declaraties (C_ID, P_ID, Kostencode, Bedrag) VALUES (:c_ID, :p_ID, :kostencode, :bedrag)";
		$query = "INSERT INTO declaraties (C_ID, P_ID, Kostencode, Datum, Bedrag) VALUES (:c_ID, :p_ID, :kostencode, :datum, :bedrag)";
		$stmt = $db->prepare($query);
		// $stmt->execute(array(':c_ID'=>$c_ID,':p_ID'=>$p_ID,':kostencode'=>$kostencode,':bedrag'=>$bedrag));
		$stmt->execute(array(':c_ID'=>$c_ID,':p_ID'=>$p_ID,':kostencode'=>$kostencode,':datum'=>$datum,':bedrag'=>$bedrag));
	}
	catch(PDOException $e) {
		echo $e->getMessage();
	}
}

?>
<?php 
}
else {
?>
<h1 style="align-self">U heeft geen toegang tot deze pagina!</h1>
<?php
}
?>