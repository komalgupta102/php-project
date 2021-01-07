<?php
require '../vendor/autoload.php';

use SendGrid\Mail\Mail;

	$email = new Mail();
	$email->setFrom("komal.gupta102@gmail.com", "Komal Gupta");
	$email->setSubject("Registration successfull");
	$email->addTo("komal.gupta102@gmail.com", $_GET['name']);
	$email->addContent(
	    "text/html", "<strong>Login Details are:</strong><br/>Email: ".$_GET['email']."<br/>Password: ".$_GET['password']
	);
	$sendgrid = new \SendGrid('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');
	try {
	    $response = $sendgrid->send($email);
	    print $response->statusCode() . "\n";
	    print_r($response->headers());
	    print $response->body() . "\n";
	} catch (Exception $e) {
	    echo 'Caught exception: '.  $e->getMessage(). "\n";
	}
}