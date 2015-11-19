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
		 <th>code</th>
		 <th>omschrijving</th>
		 <th>edit</th>
		 <th>delete</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$stmt = $db->prepare("SELECT * FROM kosten");
		$stmt->execute();
		foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) : 
		?>
		<tr>
			<form method="POST" action="index.php?page=edit" enctype="multipart/form-data">
			 <td><input type="hidden" name="page" value="kosten"/><input type="hidden" value="<?PHP echo htmlspecialchars($row['kostencode']); ?>" name="key"/><?php echo $row['kostencode']; ?></td>
			 <td><input type="hidden" value="<?PHP echo htmlspecialchars($row['omschrijving']); ?>" name="omschrijving"/><?php echo $row['omschrijving']; ?></td>
			 <td><button name="action" value="edit" type="submit" style="border: none; background: none;"><img height="16px" src="img/edit.png" alt="edit"></button></td>
			 <td><button name="action" value="delete" type="submit" style="border: none; background: none;"><img height="16px" src="img/delete.png" alt="edit"></button></td>
		 </form>
		</tr>
		<?php endforeach;?>
	</tbody>
	<tfoot>
		<tr>
			<form method="POST" action="index.php?page=edit" enctype="multipart/form-data">
				<td colspan="2" style="text-align:center;">
					<input type="hidden" name="page" value="kosten"/>
					<button name="action" value="add" type="submit" style="border: none; background: none;">
						<img height="16px" src="img/add.png" alt="edit">
					</button>
				</td>
			</form>
		</tr>
	</tfoot>
</table>
<?php 
// 	if (isset($_POST['edit'])) {
// 		echo "<script>alert('editing: ".$_POST['kostencode']."');</script>";
// 	}elseif (isset($_POST['delete'])) {
// 		echo "<script>alert('deleting: ".$_POST['kostencode']."');</script>";
// 	}elseif (isset($_POST['add'])) {
// 		echo "<script>alert('adding');</script>";
// 	}
?>