<?php
	/////////////////////////////////////////////////////////
	////////////////////start swiftMailer////////////////////
	// Swift Mailer Library
	require_once 'vendor/swiftmailer/swiftmailer/lib/swift_required.php';
	//variables
	$naam = $result['Naam'];
	$email = $result['Email'];
	try {

		// Create the mail transport configuration
		$transport = Swift_SmtpTransport::newInstance('ssl://smtp.gmail.com', 465)
			->setUsername('jobpeters6@gmail.com')
			->setPassword('pine//apple')
		;

		// Mailer
		try {
	  $mailer = Swift_Mailer::newInstance($transport);
		} 
		catch(Swift_TransportException $exception) {
   var_dump($exception);
		}
		// Create a message
		$mail = "<h1>Hallo, ".$naam.".</h1><br>"; // Mail body
		$mail .= "<p>Uw nieuwe wachtwoord is: ".$password.".</p><br>"; // Mail body
		$mail .= "<a href='localhost/ao/projectSync/index.php?page=inloggen&p=" . $password ."&e=" . $email ."'>klik hier om direct in te loggen</a><br>"; // create custom link in Mail body

		$body = '<html><body>' . $mail . '</body></html>';
		$message = Swift_Message::newInstance('wachtwoord aanvraag projectsync.')
	  ->setFrom(array('jobpeters6@gmail.com' => 'Job Peters')) // Your mail
	  ->setTo(array($email => $naam)) // Their mail
	  ->setBody($body, 'text/html') // Mail body
  ;

		// Send the message
		if (!$mailer->send($message,$failures)) {
		  echo "Failures:";
		  print_r($failures);
		} elseif ($result) {
				echo "<script>alert('email is sent!');</script>";
		};
		////////////////////end swiftMailer////////////////////	
		///////////////////////////////////////////////////////

		///////////////////////////////////////////////////////////
		////////////////////start sendmail(old)////////////////////
		// $naam = $result['Naam'];
		// $email = $result['Email'];
		// $to = $email;

		// $subject = "Uw wachtwoord";

		// $header = "MIME-Version: 1.0" . "\r\n";
		// $header .= "Content-Type: text/html; charset=iso-8859-1\r\n";
		// $header .= "From: jobpeters6@gmail.com\r\n";

		// $txt = "Geachte " . $naam . ".";
		// $txt .= "<br>";
		// $txt .= "<a href='http://localhost/AO/projectsync?page=inloggen&p=" . $password ."'>Log nu in</a><br>";
		// // Send
		// $send = mail($to,$subject,$txt,$header);
		// if ($send){
		// 	echo "<br>succes";
		// 	echo "<br>de mail is verstuurd.";
		// }
		
		// else if (!$send){ 
		// 	echo "<br>false<br>";
		// 	echo "<br>de mail is niet verstuurd.";
		// }
		////////////////////end sendmail(old)////////////////////
		/////////////////////////////////////////////////////////
	}
	catch(PDOException $e) {
		echo $e->getMessage();
	}
?>


