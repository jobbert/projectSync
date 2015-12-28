<?PHP 
if(isset($_SESSION['ADMIN'])){
?>
<style type="text/css">
	th{
		padding: 8px;
	}
	td{
		padding: 8px;
	}
</style>
<table>
	<thead>
		<th colspan="4">
			Kosten
		</th>
		<tr>
		 <th>Consultant ID</th>
		 <th>Project ID</th>
		 <th>Datum</th>
		 <th>Bedrag</th>
		 <th>Afhandelen</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$stmt = $db->prepare("SELECT * FROM declaraties");
		$stmt->execute();
		foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) : 
		?>
		<?php
	  echo(var_dump($_POST));
	  $check = 1;
	  $uncheck = 0;
	  $C_ID = $POST['C_ID'];
			$P_ID = $POST['P_ID'];
	  if(isset($_POST['check']) && $_POST['check'] === "0"){
	   echo "Unchecked";
	   $sql = "UPDATE `declaraties` SET `Done` = :Done where `C_ID` = :empcode AND `P_ID` = :projectid'";
	   $stmt = $db->prepare($sql_uncheck);
	   $stmt->execute(array(':Done' => $uncheck, ':empcode' => $C_ID, ':projectid' => $P_ID));
	   echo($sql);
	  }
	  elseif(isset($_POST['check']) && $_POST['check'] === "1"){
	   echo "Checked";
	   $sql_check = "UPDATE `declaraties` SET `Done` = :Done where `C_ID` = :empcode AND `P_ID` = :projectid'";
	   $stmt = $db->prepare($sql_check);
	   $stmt->execute(array(':Done' => $check, ':empcode' => $C_ID, ':projectid' => $P_ID));
	  }
		?>
		<tr>
			<form method="POST" enctype="multipart/form-data">
			 <td><input name="action" value="afhandelen" type="hidden"><input type="hidden" value="<?PHP echo htmlspecialchars($row['C_ID']); ?>" name="C_ID"/><?php echo $row['C_ID']; ?></td>
			 <td><input type="hidden" value="<?PHP echo htmlspecialchars($row['P_ID']); ?>" name="P_ID"/><?php echo $row['P_ID']; ?></td>
			 <td><?php echo $row['Datum']; ?></td>
				<td><?php echo $row['Bedrag']; ?></td>
				<?php
    $check = json_decode($row['Done']);
				if ($check === 1) {
					echo "<td><button name='check' value='0' type='submit' style='border: none; background: none;'><img src='img/true.png' height='16px' alt='checked'/></button></td>";
				} else {
					echo "<td><button name='check' value='1' type='submit' style='border: none; background: none;'><img src='img/false.png' height='16px' alt='unchecked'/></button></td>";
				}
				?>
		 </form>
		</tr>
		<?php endforeach;?>
	</tbody>
</table>
<?php 
}
else {
?>
<h1 style="align-self">U heeft geen toegang tot deze pagina!</h1>
<?php
}
?>