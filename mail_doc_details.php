<?php

session_start();

require "PHPMailer/src/PHPMailer.php";
require "PHPMailer/src/SMTP.php";
require "PHPMailer/src/Exception.php";
require "db_config.php";
// include "class.smtp.php";
$doctor_id = $_GET['doc_id'];
$dept_id = $_GET['dept_id'];

$login_query = "SELECT * FROM doctor_login
                WHERE doctor_id='$doctor_id'";
$row1 = mysqli_query($conn,$login_query);
$login_row = mysqli_fetch_assoc($row1);
$doc_mail = $login_row['doctor_email'];
$doc_name = $login_row['doctor_name'];
$doc_password = $login_row['doctor_pswrd'];

$visit_query = "SELECT * FROM doc_dep
                WHERE doc_id='$doctor_id'";
$row2 = mysqli_query($conn,$visit_query);
$visit_row = mysqli_fetch_assoc($row2);
$visit = $visit_row['visit'];
$floor = $visit_row['floor'];

$mail = new PHPMailer\PHPMailer\PHPMailer();
$mail->isSMTP();                                          
$mail->Host = "smtp.gmail.com";                    
$mail->SMTPAuth   = true;                                   
$mail->Username   = 'carevista7@gmail.com';                    
$mail->Password   = 'CareVista@2022';                             
$mail->SMTPSecure = 'tls';   
$mail->Port       = 587;    

    //Recipients
    $mail->setFrom('carevista7@gmail.com', 'CareVista Superspeciality Hospital');
    $mail->addAddress($doc_mail, $doc_name);     //Add a recipient
    $mail->addReplyTo('no-reply@gmail.com', 'No-reply');
    $mail->addCC('ghoshrajashree358@gmail.com');
    $mail->addBCC('ghoshrajashree358@gmail.com');

    //Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->CharSet = 'UTF-8';
    $mail->Subject = 'Login Credentials | CareVista Superspeciality Hospital';
    $mail->Body    = '<b>Welcome To CareVista Superspeciality Hospital</b><br>
                      Please find your login credentials below.<br><br>
                      <b>Mail: </b>'.$doc_mail.'<br>
                      <b>Password: </b>'.$doc_password.'<br>
                      <b>Visit: </b> Rs. '.$visit.'<br>
                      <b>Floor: </b>'.$floor;
    $mail->SMTPOptions = array(
                        'ssl' => array(
                            'verify_peer' => false,
                            'verify_peer_name' => false,
                            'allow_self_signed' => true
                        )
                   );
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    // if(!$mail->send()) {
    //     echo 'Message could not be sent.';
    //     echo 'Mailer Error: ' . $mail->ErrorInfo.'<br>';
    // } else {
    //     echo 'Message has been sent';
    // }
    if($mail->send()){
        $_SESSION['status'] = "SUCCESSFUL";
        $_SESSION['status_code'] = "success";
        $_SESSION['status_text'] = "Mail Sent to Dr. ".$doc_name;
        header('Location:add_view_update_dctr_details.php');
    
    }
    else{
        $_SESSION['status'] = "FAILED";
        $_SESSION['status_code'] = "error";
        $_SESSION['status_text'] = "Mail not sent to Dr. ".$doc_name;
        header('Location:add_view_update_dctr_details.php');
    }
?>