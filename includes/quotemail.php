<?php

	include('../config/config.php');

	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
	$telephone = $_POST['telephone'];
	$reason = $_POST['reason'];
	$link = $_POST['link'];

	$email = $_POST['email'];
	$confirmemail = $_POST['confirmemail'];

	$message = $_POST['message'];

	$email_from = ENQUIRY_EMAIL;
	$email_subject = "New Enquiry submission";
	$email_body = "You have received a new message from the user $firstname $lastname sent from $link.\n".
                            "Here is the message:\n $message\n \n";

	$to = ENQUIRY_EMAIL;
	$headers = "From: $email \r\n";
	$headers .= "Reply-To: $email \r\n";

	$email_body .= "Email From: " . $email_from . "\n";
	$email_body .= $reason . "\n";
	$email_body .= "Body: " . $email_body . "\n";
	$email_body .= $headers . "\n";

	mail($to,$email_subject,$email_body,$headers);

	header("Location:" . $link);

?>