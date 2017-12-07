<html>
<head>
<title>ThaiCreate.Com PHP Sending Email</title>
</head>
<body>
<?php

	require_once("../vendor/mimemail_php/mimemail.inc.php");

	$mail = new MIMEMAIL("HTML"); // HTML Format

	$mail->senderName = "Peerada Kapsri";
	$mail->senderMail = "peerada.kpps@gmail.com";
	$mail->cc = "Peerada Kapsri<peerada.kpps@gmail.com>";
	$mail->bcc = "peerada.kpps@gmail.com";

	$mail->subject = "Test Send Mail";

	$mail->body = "My Body & <b>My Description</b>"; // OR: $mail->body = "path_to_file/filename";

	$mail->create();
	//*** To ***//
	$mail->send("5506021623122@fitm.kmutnb.ac.th");
	$mail->send("peerada.kpps@gmail.com");
	echo "Email Sending.";
?>
</body>
</html>