<?php
/**
 * require all composer dependencies; requiring the autoload file loads all composer packages at once
 * while this is convenient, this may load too much if your composer configuration grows to many classes
 * if this is a concern, load "/vendor/swiftmailer/autoload.php" instead to load just SwiftMailer
 **/



/*
 * function to send email
 *
 * @throws RuntimeException if unable to send email
 */

function sendEmail ($receiverEmail, $firstName, $lastName, $subject, $message) {

	try {
		// create Swift message
		$swiftMessage = Swift_Message::newInstance();

		// attach the sender to the message
		// this takes the form of an associative array where the Email is the key for the real name
		$swiftMessage->setFrom(["el41net@el41net.com" => "Time Crunch"]);

		/**
		 * attach the recipients to the message
		 * notice this an array that can include or omit the the recipient's real name
		 * use the recipients' real name where possible; this reduces the probability of the Email being marked as spam
		 **/
		$recipients = [$receiverEmail => $firstName . " " . $lastName,
			"mjzibert2@gmail.com" => "Merri Zibert",
			"abroadhurst@cnm.edu" => "Alicia Broadhurst",
			"kmcgaughey@cnm.edu" => "Kate McGaughey",
			"agraham14@cnm.edu" => "Arlene Graham"];


		$swiftMessage->setTo($recipients);

		// attach the subject line to the message
		$swiftMessage->setSubject($subject);

		/**
		 * attach the actual message to the message
		 * here, we set two versions of the message: the HTML formatted message and a special filter_var()ed
		 * version of the message that generates a plain text version of the HTML content
		 * notice one tactic used is to display the entire $confirmLink to plain text; this lets users
		 * who aren't viewing HTML content in Emails still access your links
		 **/
		$confirmLink = "https://" . $_SERVER["SERVER_NAME"] . "/important-link/confirm.php?confirmationCode=abc123";

		$swiftMessage->setBody($message, "text/html");
		$swiftMessage->addPart(html_entity_decode(filter_var($message, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES)), "text/plain");

		/**
		 * send the Email via SMTP; the SMTP server here is configured to relay everything upstream via CNM
		 * this default may or may not be available on all web hosts; consult their documentation/support for details
		 * SwiftMailer supports many different transport methods; SMTP was chosen because it's the most compatible and has the best error handling
		 * @see http://swiftmailer.org/docs/sending.html Sending Messages - Documentation - SwitftMailer
		 **/
		$smtp = Swift_SmtpTransport::newInstance("localhost", 25);
		$mailer = Swift_Mailer::newInstance($smtp);
		$numSent = $mailer->send($swiftMessage);

		/**
		 * the send method returns the number of recipients that accepted the Email
		 * so, if the number attempted is not the number accepted, this is an Exception
		 **/
		if($numSent !== count($recipients)) {
			throw(new RuntimeException("unable to send email"));
		} else {
			return ("Email sent.");
		}
	} catch(Exception $exception) {
		throw ($exception);
	}
}
