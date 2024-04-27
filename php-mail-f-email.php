<?php
$to = "email@website.com";
$subject = "Requested Pay Slips Attached";
$message = "<html><body><br><br>";
// $message .= "Dear [NAME],<br>";
// $message .= "<br>";
// $message .= "I hope this email finds you well. We have received your request for BLA BLA BLA.<br>";
$message .= "</body></html>";

$from = "abc@xyz.com";
$headers = "From: $from\r\n";
$headers .= "Sender: $from\r\n";
$headers .= "MIME-Version: 1.0" . "\r\n";
// for normal html email
// $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

// for sending attachment
$headers .= "Content-Type: multipart/mixed; boundary=\"boundary\"\r\n";

// Content-Type: application/pdf; for PDF
// Content-Type: image/; for IMG,JPG,PNG


// Define the boundary for the multipart message
$boundary = "--boundary";

// Create the attachment part
/////////////////SINGLE ATTACHMENT/////////////////
$attachment = chunk_split(base64_encode(file_get_contents("https://xyz.com/link/1.jpg")));
$message = "--boundary\r\n";
$message .= "Content-Type: image/; name=\"1.jpg\"\r\n";
$message .= "Content-Disposition: attachment; filename=\"1.jpg\"\r\n";
$message .= "Content-Transfer-Encoding: base64\r\n\r\n";
$message .= $attachment . "\r\n";
$message .= "--boundary--\r\n";
//////////////////////////////////////////////////////

/////////////////MULTIPAL ATTACHMENT/////////////////////
// Array of attachment file paths
// $attachments = [
//     "https://xyz.com/link/1.jpg",
//     "https://xyz.com/link/2.jpg",
//     "https://xyz.com/link/3.jpg",
// ];

// Add each attachment to the message
// foreach ($attachments as $attachmentPath) {
//     $attachment = chunk_split(base64_encode(file_get_contents($attachmentPath)));

//     $message .= "--boundary\r\n";
//     $message .= "Content-Type: image/; name=\"" . basename($attachmentPath) . "\"\r\n";
//     $message .= "Content-Disposition: attachment; filename=\"" . basename($attachmentPath) . "\"\r\n";
//     $message .= "Content-Transfer-Encoding: base64\r\n\r\n";
//     $message .= $attachment . "\r\n";
// }
//////////////////////////////////////////////////////////////

// Send email
if (mail($to, $subject, $message, $headers)) {
    echo "Email sent successfully.";
} else {
    echo "Email sending failed.";
}
