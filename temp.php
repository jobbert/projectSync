<?php  
$query = 
		"SELECT consultants.C_ID, consultants.Naam, projecten.P_ID, projecten.naam, kosten.kostencode, kosten.omschrijving, declaraties.Datum, declaraties.Bedrag 
		FROM consultants INNER JOIN declaraties ON consultants.C_ID = declaraties.C_ID) ON kosten.kostencode = declaraties.Kostencode)  
		GROUP BY consultants.C_ID;";
		$stmt = $db->prepare($query);
		$stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		foreach ($result as $row) {
			echo(var_dump($row))
		}
?>