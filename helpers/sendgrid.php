<?php
require '../vendor/autoload.php';

use SendGrid\Mail\Mail;

	$email = new Mail();
	$email->setFrom("komal.gupta102@gmail.com", "Komal Gupta");
	$email->setSubject("Registration successfull");
	$email->addTo("komal.gupta102@gmail.com", $_POST['name']);
	$email->addContent(
	    "text/html", "<strong>Login Details are:</strong><br/>Email: ".$_POST['email']."<br/>Password: ".$_POST['password']
	);
	$sendgrid = new \SendGrid(getenv('SENDGRID_API_KEY'));
	try {
	    $response = $sendgrid->send($email);
	    print $response->statusCode() . "\n";
	    print_r($response->headers());
	    print $response->body() . "\n";
	} catch (Exception $e) {
	    echo 'Caught exception: '.  $e->getMessage(). "\n";
	}
}