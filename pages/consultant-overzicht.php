<?php
$searchcode = 'consultant_kosten_consultant';
if($searchcode == 'consultant_kosten_consultant') {
 $C_ID = json_decode($_SESSION['ID']);
 echo "<div class='CSSTableGenerator'>";
 echo "<table>";
 echo "<tr><td>Cons-ID</td><td>Consultant</td><td>Project-ID</td><td>Projectnaam</td><td>Kostencode</td><td>Omschrijving</td><td>Datum</td><td>Bedrag</td><td>Afgehandeld</td></tr>";

 $q1 = 'SELECT distinct C_ID, Naam from `consultants` where C_ID = ?';
 $stmt = $db->prepare($q1);
 $stmt->execute(array($C_ID));
 $res1 = $stmt->fetchAll(PDO::FETCH_ASSOC);
 foreach($res1 as $row1) {
  $ConsID = $row1['C_ID'];
  $naam = $row1['Naam'];
 }

 echo "<tr><td>" . $ConsID . "</td><td>" . $naam ."</td>";
 $q2 = 'SELECT distinct P_ID from `declaraties` where C_ID = :C_ID';
 $stmt = $db->prepare($q2);
 $stmt->execute(array(':C_ID' => $ConsID));
 $res2 = $stmt->fetchAll();

 $counter = 0;
 $totaal = 0;
 foreach($res2 as $row2) {
  $subtotaal = 0;


  $projectID = $row2['P_ID'];
  $teller = 0;
  if($counter == "0") {
   echo "<td>" . $projectID . "</td>";
   ++$counter;
  }

  else {
   echo "<tr><td></td><td></td><td>" . $projectID . "</td>";
   ++$counter;
  }
  $q3 = 'SELECT Naam from `projecten` where P_ID = ?';
  $stmt = $db->prepare($q3);
  $stmt->execute(array($projectID));
  $res3 = $stmt->fetch(PDO::FETCH_ASSOC);

  foreach($res3 as $row3) {
   $projectnaam = $row3;

   echo "<td>" . $projectnaam . "</td>";
  }


  $q4 = 'SELECT Kostencode, Datum, Bedrag, Done from `declaraties` where C_ID = :empcode AND P_ID = :projectid';
  $stmt = $db->prepare($q4);
  $stmt->execute(array(':empcode' => $ConsID, ':projectid' => $projectID));
  $res4 = $stmt->fetchAll(PDO::FETCH_ASSOC);
  $check = 0;
  foreach($res4 as $row4) {
    $check = json_decode($row4['Done']);

    $kostenID = $row4['Kostencode'];
    $datum = $row4['Datum'];
    $bedrag = $row4['Bedrag'];
    if($check === 1){
      $done = "<img src='img/true.png' height='16px'/>";
    }
    else{
      $done = "<img src='img/false.png' height='16px'/>";
    }

   echo "<td>" . $kostenID . "</td>";

   $q5 = 'SELECT omschrijving from `kosten` where kostencode = :kosten';
   $stmt = $db->prepare($q5);
   $stmt->execute(array(':kosten' => $kostenID));
   $res5 = $stmt->fetch(PDO::FETCH_ASSOC);

   $sql = "SELECT count(*) FROM `declaraties` WHERE C_ID = :C_ID AND P_ID = :P_ID"; 
   $result = $db->prepare($sql); 
   $result->execute(array(':C_ID' => $ConsID, ':P_ID' => $projectID)); 
   $number_of_rows = $result->fetch();
   foreach($res5 as $row5) {
    $kostenomschrijving = $row5;

    if($teller < $number_of_rows[0]) {
     $teller++;
     $subtotaal += $bedrag;
     $bedrag = number_format($bedrag,2,",","."); 

     echo "<td>" . $kostenomschrijving . "</td>";
     echo "<td>" . $datum . "</td>";
     echo "<td>€" . $bedrag . "</td>";
      echo "<td>" . $done ."</td>";// hier komt dus het afgehandeld symbool
     echo "<tr><td></td><td></td><td></td><td></td>";
    }
    if($teller == $number_of_rows[0]) {
     $totaal += $subtotaal;
     $subtotaal = number_format($subtotaal,2,",",".");
     $totaal = number_format($totaal,2,",",".");  

     echo "<td></td><td></td><td></td><td></td></tr>";
     echo "<tr><td></td><td></td><td></td><td></td><td>Subtotaal</td><td></td><td></td><td>€" . $subtotaal . "</td>";
     echo "<tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>";
    }
   }
  }
 }
 echo "<tr><td></td><td></td><td></td><td></td><td>Totaal</td><td></td><td></td><td>€" . $totaal . "</td></tr></table>";
}
?>