<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require './vendor/phpmailer/phpmailer/src/Exception.php';
require './vendor/phpmailer/phpmailer/src/PHPMailer.php';
require './vendor/phpmailer/phpmailer/src/SMTP.php';



//location of html
$template_file="./template.html";
//customer template
$template_customer="./templatecustomer.html";

$fname=isset($_POST['fname']) ? $_POST['fname'] : null;


$lname=isset($_POST['lname']) ? $_POST['lname'] : null;

$phoneNumber=isset($_POST['phoneNumber']) ? $_POST['phoneNumber'] : null;

$emaill=isset($_POST['emaill']) ? $_POST['emaill'] : null;
$adresiniz=isset($_POST['adresiniz']) ? $_POST['adresiniz'] : null;
$note=isset($_POST['note']) ? $_POST['note'] : null;
$flname=isset($_POST['flname']) ? $_POST['flname'] : null;

$tckimlik=isset($_POST['tckimlik']) ? $_POST['tckimlik'] : null;

$peaddress=isset($_POST['peaddress']) ? $_POST['peaddress'] : null;

$coname=isset($_POST['coname']) ? $_POST['coname'] : null;
$covet=isset($_POST['covet']) ? $_POST['covet'] : null;

$covetno=isset($_POST['covetno']) ? $_POST['covetno'] : null;

$coaddress=isset($_POST['coaddress']) ? $_POST['coaddress'] : null;

$card=isset($_POST['card']) ? $_POST['card'] : null;

//$attachment =isset ($POST['attachment']) ? $_POST['attachment'] : null;


if (!$emaill) {
    echo "Email gereklidir";

}
 elseif(!$peaddress){
    echo "Adres giriniz";
}

else{

$mail = new PHPMailer(true);
$mailcust = new PHPMailer(true);

try{

    $mail->SMTPDebug = 2;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.yandex.com.tr';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'webmaster@hibritcard.com';                     //SMTP username
    $mail->Password   = 'rqlykvuspowucgbv';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    $mail->charset="UTF-8";
    $mail->setlanguage('tr');





    //Recipients
    $mail->setFrom('webmaster@hibritcard.com', 'HibritCard Siparis Formu');
    $mail->addAddress('sales@hibritcard.com');     //Add a recipient
    $mail->addReplyTo($emaill, "Hibritcard" );
    //$mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');


    // customer part

    $mailcust->SMTPDebug = 2;                      //Enable verbose debug output
    $mailcust->isSMTP();                                            //Send using SMTP
    $mailcust->Host       = 'smtp.yandex.com.tr';                     //Set the SMTP server to send through
    $mailcust->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mailcust->Username   = 'webmaster@hibritcard.com';                     //SMTP username
    $mailcust->Password   = 'rqlykvuspowucgbv';                               //SMTP password
    $mailcust->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mailcust->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    $mailcust->charset="UTF-8";
    $mailcust->setlanguage('tr');

     //Recipients customer
     $mailcust->setFrom('webmaster@hibritcard.com', 'HibritCard Siparis Formu');
     $mailcust->addAddress($emaill);     //Add a recipient
     $mailcust->addReplyTo('sales@hibritcard.com', "Hibritcard");
     //$mail->addCC('cc@example.com');
     //$mail->addBCC('bcc@example.com');

   //variables of changes all this staff
//associate array here
$spaw_var =array(
    "{fname}"=>$fname,
    "{lname}"=> $lname,
    "{phoneNumber}"=> $phoneNumber,
    "{emaill}"=> $emaill,
    "{adresiniz}"=>$adresiniz,
    "{card}"=> $card,
    "{note}"=> $note,
    "{flname}"=> $flname,
    "{tckimlik}"=>$tckimlik,
    "{peadres}"=> $peaddress,
    "{coname}"=> $coname,
    "{covet}"=> $covet,
    "{covetno}"=> $covetno,
    "{coaddress}"=> $coaddress
 );

 //changes all the customer items

 $swap_varu =array(
    "{fname}"=>$fname,
    "{lname}"=> $lname,
    "{emaill}"=> $emaill,
    "{adresiniz}"=>$adresiniz,
    "{card}"=> $card
 );


        if(isset($_FILES['attachment']['name'] ) && $_FILES['attachment']['name'] != "" ){
            $mail -> addAttachment($_FILES['attachment']['tmp_name'], $_FILES['attachment']['name']);
        }

        //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = "$fname - Ön Talep Formu Dolduruldu.";


    //customer part

    $mailcust->isHTML(true);                                  //Set email format to HTML
    $mailcust->Subject = "$fname - Ön Talep Formu Dolduruldu.";

    if(file_exists($template_file))
          $mail->Body = file_get_contents($template_file);
    else
        die("Template bulunamadı");

    //customer template

    if(file_exists($template_customer)){
          $mailcust ->Body = file_get_contents($template_customer);
    }
    else{
        die("Template customer bulunamadı");
    }


//display the swap part for the user
foreach(array_keys($spaw_var) as $key){

    if(strlen($key) > 2 && trim($key) != "")
    $mail->Body=str_replace($key,$spaw_var[$key], $mail->Body);

}

//arrow control part

foreach(array_keys($swap_varu) as $key){
    if(strlen($key) > 2 && trim($key) != "");
    $mailcust->Body=str_replace($key,$swap_varu[$key], $mailcust->Body);

}



$mail->send();
$mailcust->send();
echo "Başarıyla Gönderildi";
}
catch(Exception $e){
    echo $e-> errorMessage();
}

}

?>