<?php
require 'vendor/autoload.php'; // If you're using Composer (recommended)
$email = new \SendGrid\Mail\Mail();
$email->setFrom("johnsmith@gmail.com", "Example User");
$email->setSubject("Sending with SendGrid is Fun");
$email->addTo("johnsmith@gmail.com", "Example User");
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
    echo 'Caught exception: '. $e->getMessage() ."\n";
}