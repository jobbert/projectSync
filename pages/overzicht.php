
<?php 
if(!isset($_SESSION['ADMIN'])) {
	try {
		$C_ID = $_SESSION['ID'];
		$declaratiesQuery = 
			"SELECT consultants.C_ID, consultants.Naam 
				FROM consultants 
				INNER JOIN declaraties 
				ON consultants.C_ID = declaraties.C_ID 
				GROUP BY consultants.C_ID
				HAVING C_ID = :C_ID;";
		$stmt = $db->prepare($declaratiesQuery);
		$stmt->execute(array(':C_ID' => $C_ID));
		$consResult = $stmt->fetchAll(PDO::FETCH_ASSOC);
		foreach ($consResult as $consRow) {
			echo($consRow['C_ID'] . "|" . $consRow['Naam']);echo "</br>";
			$rowC_ID = json_decode($consRow['C_ID']);
			$projectenQuery = 
			"SELECT declaraties.P_ID, projecten.naam, C_ID
				FROM declaraties
				INNER JOIN projecten
				ON declaraties.P_ID = projecten.P_ID
				GROUP BY declaraties.P_ID
				HAVING C_ID = :rowC_ID;";
			$stmt = $db->prepare($projectenQuery);
			$stmt->execute(array(':rowC_ID' => $rowC_ID));
			$projResult = $stmt->fetchAll(PDO::FETCH_ASSOC);
			foreach ($projResult as $projRow) {
				echo(" | |" . $projRow['P_ID'] . "|" . $projRow['naam']);echo "</br>";
				// echo(var_dump($projRow));echo "</br>";
				$rowP_ID = json_decode($projRow['P_ID']);
				echo($rowP_ID);echo "</br>";
				echo(json_encode($projRow['P_ID']));echo "</br>";
				$kostenQuery = 
				"SELECT declaraties.Kostencode, kosten.omschrijving, declaraties.Datum, declaraties.Bedrag, declaraties.P_ID 
					FROM kosten
					INNER JOIN declaraties
					ON declaraties.Kostencode = kosten.kostencode
					WHERE P_ID = :rowP_ID;";
				$stmt = $db->prepare($kostenQuery);
				$stmt->bindParam(':rowP_ID', $rowP_ID, PDO::PARAM_INT);
    $stmt -> execute(); 
				// $stmt->execute(array(':rowP_ID', $rowP_ID));
				$kostResult = $stmt->fetchAll(PDO::FETCH_ASSOC);
				foreach ($kostResult as $kostRow) {
					$subtotaal .= json_decode($kostRow['Bedrag']);
					echo("sub: " . $subtotaal);echo "</br>";
					echo(var_dump($kostRow));echo "</br>";
					// echo(" | |" . $kostRow['Kostencode'] . "|" . $kostRow['omschrijving'] . "|" . $kostRow['Datum'] . "|" . $kostRow['Bedrag']);echo "</br>";
				}
				echo($subtotaal);echo "</br>";
				echo "---</br>";
				$totaal .= $subtotaal;
			}
			echo($totaal);echo "</br>";
			echo "------</br>";
		}
		echo "end</br>";
	} catch(PDOException $e) {
		echo $e->getMessage();
	}
}
?>















 <?php

// if(!isset($_SESSION['ADMIN'])) {
// 	$query = 'kosten per project van deze consultant';
// 	echo 'accessed by consultant';echo "</br>";
// 	try {
// 		$C_ID = $_SESSION['ID'];
// 		// $query = "SELECT consultants.C_ID, consultants.Naam, projecten.P_ID, projecten.naam, kosten.kostencode, kosten.omschrijving, declaraties.Datum, declaraties.Bedrag FROM projecten INNER JOIN (kosten INNER JOIN (consultants INNER JOIN declaraties ON consultants.C_ID = declaraties.C_ID) ON kosten.kostencode = declaraties.Kostencode) ON projecten.P_ID = declaraties.P_ID GROUP BY consultants.C_ID, GROUP BY projecten.P_ID, GROUP BY kosten.kostencode;";
// 		$query = 
// 		"SELECT consultants.C_ID, consultants.Naam, projecten.P_ID, projecten.naam, kosten.kostencode, kosten.omschrijving, declaraties.Datum, declaraties.Bedrag 
// 		FROM projecten INNER JOIN (kosten INNER JOIN (consultants INNER JOIN declaraties ON consultants.C_ID = declaraties.C_ID) ON kosten.kostencode = declaraties.Kostencode) ON projecten.P_ID = declaraties.P_ID  
// 		GROUP BY consultants.C_ID, projecten.P_ID, kosten.kostencode
// 		ORDER BY consultants.C_ID, projecten.P_ID, kosten.kostencode;";
// 		$stmt = $db->prepare($query);
// 		$stmt->execute();
// 		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

// 		// $lastRow = array();
// 		// $html_table = '<table>';
// 		// to generate a simple table but with all the duplicates
// 		$html_table = '<table>'; 
// 		foreach( $result as $row ) {
// 	  $html_table .= '<tr>';
// 	  foreach( $row as $col ) {
// 	   $html_table .= '<td>' .$col. '</td>';
// 	  }
// 	  $html_table .= '</tr>';
// 	 }
// 		$html_table .= '</table>';
// 		// echo($html_table);
// 		// $sql = "SELECT P_ID FROM `declaraties` WHERE `C_ID` = :C_ID";

// 		// $stmt = $db->prepare($sql);
// 		// $stmt->execute(array(':C_ID'=> $C_ID));
// 		// // $stmt->execute(array(':C_ID'=> $C_ID, ':C_ID'=> $C_ID, ':C_ID'=> $C_ID));
// 		// $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
// 		// foreach ($res as $row) {
// 		// 	echo($row['P_ID']);echo "</br>";
// 		// 	$projCol = $row['P_ID'];
// 		// 	foreach ($projCol as $projColRow) {

// 		// 		$sql = "SELECT Kostencode FROM `declaraties` WHERE `P_ID` = :P_ID";

// 		// 		$stmt = $db->prepare($sql);
// 		// 		$stmt->execute(array(':P_ID'=> $projColRow));
// 		// 		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
// 		// 		echo($result);
// 		// 	}
// 		// }
// 		// // foreach( $stmt->fetchAll(PDO::FETCH_ASSOC) as $firstRow) {
// 		// 	// echo(var_dump($firstRow));echo "</br>";
// 		// 	$P_ID = $firstRow['P_ID'];
// 		// 	$sql = "SELECT `Kostencode` , `Datum` , `Bedrag` FROM `declaraties` WHERE `C_ID` = :C_ID AND `P_ID` = :P_ID ";

// 		// 	$stmt = $db->prepare($sql);
// 		// 	$stmt->execute(array(':C_ID'=> $C_ID, ':P_ID'=> $P_ID));
// 		// 	foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $secondRow) {
// 		// 		// echo(var_dump($secondRow['C_ID']));echo "</br>";
// 		// 		echo(var_dump($secondRow));echo "</br>";
// 		// 	}
// 		// }




// 		$html_table .= '<table>';
// 		$lastRow = '';
// 		$html_table .= '<tr>';
// 		foreach( $result as $row) {
// 			// echo("row: "c);echo "</br>"
// 	  // echo(var_dump($row));echo "</br>";
// 	  for ($i = 0; $i < count($row); $i++){
// 		  if ($lastRow[$i] = $row[$i]){
// 		  	$html_table .=  "<td></td>";
// 		  } else {
// 		  	foreach ($row as $col) {
// 			  	$html_table .=  "<td>".$col."</td>";
// 		  	}
// 		  }
// 		 }
// 		 $lastRow = $row;
// 		}
// 		$html_table .= '</tr>';
// 		$html_table .= '</table>';
// 		echo($html_table);
//   	// echo(var_dump($row));echo "</br>";
//   	// $html_table .= '<tr>';
//   	// for ($i = 0; $i < count($row); $i++){
// 	 		// foreach( $row as $col) {
// 				//  foreach ($lastRow as $lastrowCol) {
// 	 		// 	// echo($lastrowCol);echo "</br>";
// 			 //  	if ($lastrowCol == $col){
// 			 //  			$html_table .= "<td></td>";
// 			 //  	}
// 			 //  	else{
// 				// 			$html_table .= '<td>' .$col. '</td>';
// 			 //  	}
// 	 		// 	}
// 			 // }
// 	  // echo($lastRow);
// 	  // $lastRow = $row[$i];
// 	  // }
// 	  // $html_table .= '</tr>';
// 		// };
// 		// $html_table .= '</table>';
// 		// echo($html_table);


// 		// $declaratiesResult = $stmt->fetchAll(PDO::FETCH_ASSOC);
// 		// echo(var_dump($declaratiesResult)['P_ID']);echo "</br>";
// 		// foreach ($declaratiesResult as $key) {
// 		// 	// echo "ja. " . $key['P_ID'];echo "</br>";
// 		// 	$P_ID = $key['P_ID'];
// 		// 	$sql = "SELECT * FROM `declaraties` WHERE `C_ID` = :C_ID";

// 		// 	$stmt = $db->prepare($sql);
// 		// 	$stmt->execute(array(':C_ID'=> $C_ID));

// 		// 	$declaratiesResult2 = $stmt->fetchAll(PDO::FETCH_ASSOC);
// 		// 	echo(var_dump($declaratiesResult2[0]['Kostencode']));
// 		// 	foreach ($declaratiesResult2 as $key) {
// 		// 		// echo(var_dump($key['Kostencode']));
// 		// 	}
// 		// 	// echo var_dump($key);echo "</br>";
// 		// }
// 		// $declaratiesResult = $declaratiesResult[0];
// 		// echo($declaratiesResult['P_ID']);echo "</br>";
// 		// $declaratiesResultP_ID = $declaratiesResult['P_ID'];
// 		// $declaratiesResultKostencode = $declaratiesResult['Kostencode'];
// 		// echo($declaratiesResultP_ID);
// 		// echo($declaratiesResultKostencode);

// 		// echo($declaratiesResult['P_ID']);
// 		//

// 		// //
// 		// $C_ID = $_SESSION['ID'];
// 		// $sql = "SELECT * FROM `declaraties` WHERE `C_ID` = :C_ID";

// 		// $stmt = $db->prepare($sql);
// 		// $stmt->execute(array(':C_ID'=> $C_ID));
// 		// $declaratiesResult = $stmt->fetchAll(PDO::FETCH_ASSOC);
// 		// //

// 		// //
// 		// $C_ID = $_SESSION['ID'];
// 		// $sql = "SELECT * FROM `declaraties` WHERE `C_ID` = :C_ID";

// 		// $stmt = $db->prepare($sql);
// 		// $stmt->execute(array(':C_ID'=> $C_ID));
// 		// $declaratiesResult = $stmt->fetchAll(PDO::FETCH_ASSOC);
// 		// //

// 		// foreach ($declaratiesResultP_ID as $consRow) {
// 		// 	echo("shit");
// 		// 	// echo $consRow['P_ID'];
// 		// 	// foreach ($declaratiesResult['P_ID'] as $key) {
// 		// 	// 	# code...
// 		// 	// }
// 		// }
// 	}
// 	catch(PDOException $e) {
// 		echo $e->getMessage();
// 	}
// }  









// if(isset($_SESSION['ADMIN'])) {
// 	$query1 = 'kosten per project van per consultant';
// 	$query2 = 'kosten per consultant van per project';
// 	$query = $query1;
// 	echo 'accessed by admin';
// }  
 ?>
<!-- <h1 style="text-align:center;"><?php //echo($page); ?> pagina</h1> -->
<!-- <p>Welkom <?php //echo($_SESSION['NAAM']); ?></p> -->








