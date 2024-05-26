<?php
$to = "recipient@example.com";
$subject = "Subject of the Email";

$from = "sender@example.com";
$headers = "From: $from\r\n";
$headers .= "Reply-To: $from\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: multipart/mixed; boundary=\"boundary\"\r\n";

$boundary = "--boundary";

// Email Body
$message = "$boundary\r\n";
$message .= "Content-Type: text/html; charset=UTF-8\r\n";
$message .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
$message .= "<html><body>";
$message .= "Dear [Recipient Name],<br><br>";
$message .= "I hope this email finds you well.<br><br>";
$message .= "Attached to this email, please find the [Attachment Description].<br><br>";
$message .= "If you have any questions or require further assistance, please feel free to reach out.<br><br>";
$message .= "Thank you for your attention.<br><br>";
$message .= "Best regards,<br><br>";
$message .= "[Your Company Name]<br>";
$message .= "</body></html>\r\n";
$message .= "$boundary\r\n";

// Attachment
$file_path = "path/to/your/file.pdf";
$file_content = file_get_contents($file_path);
$file_content = chunk_split(base64_encode($file_content));

$message .= "Content-Type: application/pdf; name=\"file.pdf\"\r\n";
$message .= "Content-Disposition: attachment; filename=\"file.pdf\"\r\n";
$message .= "Content-Transfer-Encoding: base64\r\n\r\n";
$message .= $file_content . "\r\n";
$message .= "--boundary--\r\n";

// Send email
if (mail($to, $subject, $message, $headers)) {
    echo "Email sent successfully.";
} else {
    echo "Email sending failed.";
}
?>
