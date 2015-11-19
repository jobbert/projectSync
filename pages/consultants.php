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
			Projecten
		</th>
		<tr>
		 <th>ID</th>
		 <th>omschrijving</th>
		 <th>adres</th>
		 <th>email</th>
		 <th>edit</th>
		 <th>delete</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$stmt = $db->prepare("SELECT * FROM consultants");
		$stmt->execute();
		foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) : 
			$C_ID = $row['C_ID'];
			$_SESSION['temp_ID'] = $C_ID; 
		?>
		<tr>
			<form method="POST" action="index.php?page=edit" enctype="multipart/form-data">
			 <td><input type="hidden" name="page" value="consultants"/><input type="hidden" value="<?PHP echo htmlspecialchars($row['C_ID']); ?>" name="key"/><?php echo $row['C_ID']; ?></td>
			 <td><input type="hidden" value="<?PHP echo htmlspecialchars($row['Naam']); ?>" name="naam"/><?php echo $row['Naam']; ?></td>
			 <td><input type="hidden" value="<?PHP echo htmlspecialchars($row['Adres']); ?>" name="adres"/><?php echo $row['Adres']; ?></td>
			 <td><input type="hidden" value="<?PHP echo htmlspecialchars($row['Email']); ?>" name="email"/><?php echo $row['Email']; ?></td>
			 <td><button name="action" value="edit" type="submit" style="border: none; background: none;"><img height="16px" src="img/edit.png" alt="edit"></button></td>
			 <td><button name="action" value="delete" type="submit" style="border: none; background: none;"><img height="16px" src="img/delete.png" alt="edit"></button></td>
		 </form>
		</tr>
		<?php endforeach;?>
	</tbody>
	<tfoot>
		<tr>
			<form method="POST" action="index.php?page=edit" enctype="multipart/form-data">
				<td colspan="4" style="text-align:center;">
					<input type="hidden" name="page" value="consultants"/>
					<button name="action" value="add" type="submit" style="border: none; background: none;">
						<img height="16px" src="img/add.png" alt="edit">
					</button>
				</td>
			</form>
		</tr>
	</tfoot>
</table>
<?php 
	// if (isset($_POST['edit'])) {
	// 	echo "<script>alert('editing: ".$_POST['C_ID']."');</script>";
	// }elseif (isset($_POST['delete'])) {
	// 	echo "<script>alert('deleting: ".$_POST['C_ID']."');</script>";
	// }
?>