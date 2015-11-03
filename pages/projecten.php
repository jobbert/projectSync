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
		$stmt = $db->prepare("SELECT * FROM projecten");
		$stmt->execute();
		foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) : 
		?>
		<tr>
		 <td><?php echo $row['P_ID']; ?></td>
		 <td><?php echo $row['Naam']; ?></td>
		 <td><img height="16px" src="img/edit.png"></td>
		 <td><img height="16px" src="img/delete.png"></td>
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