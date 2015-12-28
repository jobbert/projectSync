<?php
  echo(var_dump($_POST));
  $check = 1;
  $uncheck = 0;
  if(isset($_POST['check']) && $_POST['check'] === "0"){
   echo "Unchecked";
   $sql_uncheck = "UPDATE `declaraties` SET `Done` = :Done where `C_ID` = :empcode AND `P_ID` = :projectid'";
   $stmt = $db->prepare($sql_uncheck);
   $stmt->execute(array(':Done' => $uncheck, ':empcode' => $POST['C_ID'], ':projectid' => $POST['P_ID']));
  }
  elseif(isset($_POST['check']) && $_POST['check'] === "1"){
   echo "Checked";
   $sql_check = "UPDATE `declaraties` SET `Done` = :Done where `C_ID` = :empcode AND `P_ID` = :projectid'";
   $stmt = $db->prepare($sql_check);
   $stmt->execute(array(':Done' => $check, ':empcode' => $POST['C_ID'], ':projectid' => $POST['P_ID']));
  }
?>