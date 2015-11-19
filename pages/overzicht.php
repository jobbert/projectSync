
<?php 
// if(!isset($_SESSION['ADMIN'])) {
// 	try {
// 		/////test voor het gegenereerde tabel
// 		// $table = "<table>";
// 		/////
// 		$C_ID = $_SESSION['ID'];
// 		$declaratiesQuery = 
// 			"SELECT consultants.C_ID, consultants.Naam 
// 				FROM consultants 
// 				INNER JOIN declaraties 
// 				ON consultants.C_ID = declaraties.C_ID 
// 				GROUP BY consultants.C_ID
// 				HAVING C_ID = :C_ID;";
// 		$stmt = $db->prepare($declaratiesQuery);
// 		$stmt->execute(array(':C_ID' => $C_ID));
// 		$consResult = $stmt->fetchAll(PDO::FETCH_ASSOC);
	
// 		foreach ($consResult as $consRow) {
// 			/////test voor het gegenereerde tabel
// 			// echo ("<tr>");
// 			/////

// 			/////test voor het gegenereerde tabel
// 			// echo ("<tr><td>".$consRow['C_ID']."</td><td>".$consRow['Naam']"</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>");
// 			/////
// 			echo($consRow['C_ID'] . "|" . $consRow['Naam']);echo "</br>";
// 			$rowC_ID = json_decode($consRow['C_ID']);
// 			$projectenQuery = 
// 			"SELECT declaraties.P_ID, projecten.naam, C_ID
// 				FROM declaraties
// 				INNER JOIN projecten
// 				ON declaraties.P_ID = projecten.P_ID
// 				GROUP BY declaraties.P_ID
// 				HAVING C_ID = :rowC_ID;";
// 			$stmt = $db->prepare($projectenQuery);
// 			$stmt->execute(array(':rowC_ID' => $rowC_ID));
// 			$projResult = $stmt->fetchAll(PDO::FETCH_ASSOC);
// 			/////test voor het gegenereerde tabel
// 			// echo ("<td>".$consRow['C_ID']."</td><td>".$consRow['Naam']"</td>");
// 			/////
// 			foreach ($projResult as $projRow) {
// 				/////test voor het gegenereerde tabel
// 				// echo ("<tr><td></td><td></td><td>".$projRow['P_ID']."</td><td>".$projRow['naam']."</td><td></td><td></td><td></td><td></td></tr>");
// 				/////

// 				echo(" | |" . $projRow['P_ID'] . "|" . $projRow['naam']);echo "</br>";
// 				// echo(var_dump($projRow));echo "</br>";
// 				$rowP_ID = json_decode($projRow['P_ID']);
// 				// echo($rowP_ID);echo "</br>";
// 				// echo(json_encode($projRow['P_ID']));echo "</br>";
// 				$kostenQuery = 
// 				"SELECT declaraties.Kostencode, kosten.omschrijving, declaraties.Datum, declaraties.Bedrag, declaraties.P_ID 
// 					FROM kosten
// 					INNER JOIN declaraties
// 					ON declaraties.Kostencode = kosten.kostencode
// 					WHERE P_ID = :rowP_ID;";
// 				$stmt = $db->prepare($kostenQuery);
// 				$stmt->bindParam(':rowP_ID', $rowP_ID, PDO::PARAM_INT);
//     $stmt -> execute(); 
// 				// $stmt->execute(array(':rowP_ID', $rowP_ID));
// 				$kostResult = $stmt->fetchAll(PDO::FETCH_ASSOC);
// 				$subtotaal = 0;
// 				/////test voor het gegenereerde tabel
// 				// echo ("<td>".$projRow['P_ID']."</td><td>".$projRow['naam']."</td><td>".$kostRow['Kostencode']."</td><td>".$kostRow['omschrijving']."</td><td>".$kostRow['Datum']."</td><td>".$kostRow['Bedrag']."</td>");
// 				/////
// 				foreach ($kostResult as $kostRow) {
// 					/////test voor het gegenereerde tabel
// 					// echo ("<tr><td></td><td></td><td></td><td></td><td>".$kostRow['Kostencode']."</td><td>".$kostRow['omschrijving']."</td><td>".$kostRow['Datum']."</td><td>".$kostRow['Bedrag']."</td></tr>");
// 					/////

// 					$subtotaal += json_decode($kostRow['Bedrag']);
// 					// echo(var_dump($kostRow));echo "</br>";
// 					echo(" | |" . " | |" . $kostRow['Kostencode'] . "|" . $kostRow['omschrijving'] . "|" . $kostRow['Datum'] . "|" . $kostRow['Bedrag']);echo "</br>";
// 				}
// 				// echo("<tr><td>".$subtotaal."</td></tr>")
// 				echo "<h4>Subtotaal = <span>";echo($subtotaal);echo "</span></h4></br>";
// 				// echo "---</br>";
// 				$totaal += $subtotaal;
// 			}
// 			// echo("<tr><td>".$totaal."</td></tr>")
// 			echo "<h4>Totaal = <span>";echo($totaal);echo "</span></h4>";
// 			// echo($totaal);echo "</br>";
// 			// echo "------</br>";
// 			/////test voor het gegenereerde tabel
// 			// echo ("</tr>");
// 			/////
// 		}
// 		// echo "end</br>";
// 	/////test voor het gegenereerde tabel
// 	// $table .= "</table>"
// 	// echo($table);
// 	/////
// 	} catch(PDOException $e) {
// 		echo $e->getMessage();
// 	}
// }
?>












 <?php

if(isset($_SESSION['ADMIN'])) {

		// $lastRow = array();
		// $html_table = '<table>';
		// to generate a simple table but with all the duplicates
		// $html_table = '<table>'; 
		// foreach( $result as $row ) {
	 //  $html_table .= '<tr>';
	 //  foreach( $row as $col ) {
	 //   $html_table .= '<td>' .$col. '</td>';
	 //  }
	 //  $html_table .= '</tr>';
	 // }
		// $html_table .= '</table>';
		// echo($html_table);

	try {
		$C_ID = $_SESSION['ID'];
		// $query = "SELECT consultants.C_ID, consultants.Naam, projecten.P_ID, projecten.naam, kosten.kostencode, kosten.omschrijving, declaraties.Datum, declaraties.Bedrag FROM projecten INNER JOIN (kosten INNER JOIN (consultants INNER JOIN declaraties ON consultants.C_ID = declaraties.C_ID) ON kosten.kostencode = declaraties.Kostencode) ON projecten.P_ID = declaraties.P_ID GROUP BY consultants.C_ID, GROUP BY projecten.P_ID, GROUP BY kosten.kostencode;";
		$query = 
		"SELECT declaraties.C_ID, consultants.Naam, declaraties.P_ID, projecten.naam, declaraties.kostencode, omschrijving, Datum, Bedrag
		FROM declaraties
		RIGHT JOIN kosten 
		ON kosten.kostencode = declaraties.Kostencode
		RIGHT JOIN consultants 
		ON consultants.C_ID = declaraties.C_ID
		RIGHT JOIN projecten
		ON projecten.P_ID = declaraties.P_ID
		GROUP BY declaraties.C_ID, declaraties.P_ID, declaraties.Kostencode
		-- HAVING declaraties.C_ID = :C_ID;";
		$stmt = $db->prepare($query);
		$stmt->execute();
		// $stmt->execute(array(':C_ID' => $C_ID));
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$row['Bedrag'] = json_decode($row['Bedrag']) * json_decode($row['subtotaal']);
		// echo($row['subtotaal']);
		$html_table = '<table>';
		$lastRow = array();
		foreach( $result as $row) {
		// echo(var_dump($row));
			$html_table .= '<tr>';
  	foreach ($row as $col) {
  		// if(!($row['C_ID'] === $lastRow['C_ID'])) {
 			if (in_array($col, $lastRow)){
			  $html_table .=  "<td></td>";
		  } else {
		  	// echo "niet in de array $lastRow";
			  $html_table .=  "<td>".$col."</td>";
		  }
  		// $html_table .=  "<td>".$col."</td>";
  	}
  	$subtotaal += $row['Bedrag'];
	  $lastRow = $row;
			$html_table .= '</tr>';
			$html_table .= '<tr><td>Subtotaal:</td><td>' . $subtotaal . '</td></tr>';			
	 }
	 $totaal += $subtotaal;
		$html_table .= '<tr><td>Totaal:</td><td>' . $totaal . '</td></tr>';			
		$html_table .= '</table>';
		echo($html_table);
  	// echo(var_dump($row));echo "</br>";
		// 	$html_table = "<table>";
  // 	$html_table .= '<tr>';
  // 	for ($i = 0; $i < count($row); $i++){
	 // 		foreach( $row as $col) {
		// 		 foreach ($lastRow as $lastrowCol) {
	 // 			// echo($lastrowCol);echo "</br>";
		// 	  	if ($lastrowCol == $col){
		// 	  			$html_table .= "<td></td>";
		// 	  	}
		// 	  	else{
		// 					$html_table .= '<td>' .$col. '</td>';
		// 	  	}
	 // 			}
		// 	 }
	 //  // echo($lastRow);
	 //  $lastRow = $row[$i];
	 //  }
	 //  $html_table .= '</tr>';
		// };
		// $html_table .= '</table>';
		// echo($html_table);
	}
	catch(PDOException $e) {
		echo $e->getMessage();
	}
}  









// if(isset($_SESSION['ADMIN'])) {
// 	$query1 = 'kosten per project van per consultant';
// 	$query2 = 'kosten per consultant van per project';
// 	$query = $query1;
// 	echo 'accessed by admin';
// }  
 ?>
<!-- <h1 style="text-align:center;"><?php //echo($page); ?> pagina</h1> -->
<!-- <p>Welkom <?php //echo($_SESSION['NAAM']); ?></p> -->








