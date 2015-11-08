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
		 <td><?php echo $row['C_ID']; ?></td>
		 <td><?php echo $row['Naam']; ?></td>
		 <td><?php echo $row['Adres']; ?></td>
		 <td><?php echo $row['Email']; ?></td>
		 <td><img height="16px" src="img/edit.png"></td>
		 <td>
			 <form method="POST" enctype="multipart/form-data" action="pages/delete.php">
			 		<?php echo "<input name='C_ID' type='hidden' value='" . $C_ID . "'/>"?>
			 		<input type="submit" name="submit"/>
					 <img height="16px" src="img/delete.png">
			 </form>
	 	</td>
		</tr>
		<?php endforeach;?>
	</tbody>
	<tfoot>
		<tr>
			<td colspan="4" style="text-align:center;">
				<!-- add</br> -->
				<img height="16px" src="img/add.png">
			</td>
		</tr>
	</tfoot>
</table>
<script>
	// <?php 
	// if(isset($_P))
	// 	$sql = "DELETE FROM consultants WHERE C_ID =  :C_ID";
	// 	$stmt = $pdo->prepare($sql);
	// 	$stmt->bindParam(':C_ID', $C_ID, PDO::PARAM_INT);   
	// 	$stmt->execute();
	// ?>
</script>
