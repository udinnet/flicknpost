<?php
require_once ("phpmailer/class.phpmailer.php");
require_once ("phpmailer/class.smtp.php");

function send_mail($message="",$subject="",$to="",$toname="")
{
//Essential attribs
    $fromname = "Flick & Post";
    $from = "info@fnp.com";
    /*$to = "udithabnd@dr.com";
    $toname= "Uditha Wijerathna";
    $message = "This is a test mail to Uditha";
    $subject = "Happy birthday Uditha ".  strftime("%T",  time());*/

    /*$header = "From: {$from}\n";
    $header .= "Reply-To: {$from}\n";
    $header .= "X-Mailer: PHP/".  phpversion()."\n";
    $header .= "Content-Type: text/plain; charset=iso-8859-1";*/

    $mail = new PHPMailer();
    $mail->FromName = $fromname;
    $mail->From = $from;
    $mail->AddAddress($to, $toname);
    $mail->Subject = $subject;
    $mail->Body = $message;

    $mail->IsSMTP();
    $mail->Host = "smtp.gmail.com";
    $mail->Port = 465;
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = 'ssl';
    $mail->SMTPDebug = 0;
    $mail->Username = "postmaster.fnp@gmail.com";
    $mail->Password = "flick&post";


    $result = $mail->Send()?true:false;
    return $result;
}
?>
