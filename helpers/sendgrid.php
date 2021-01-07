<?php
require '../vendor/autoload.php';

use SendGrid\Mail\Mail;

	$email = new Mail();
	$email->setFrom("komal.gupta102@gmail.com", "Example User");
	$email->setSubject("Sending with Twilio SendGrid is Fun");
	$email->addTo("komal.gupta102@gmail.com", "Example User");
	$email->addContent("text/plain", "and easy to do anywhere, even with PHP");
	$email->addContent(
	    "text/html", "<strong>and easy to do anywhere, even with PHP</strong>"
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