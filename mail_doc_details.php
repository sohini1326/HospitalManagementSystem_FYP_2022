<?php

session_start();

require "PHPMailer/src/PHPMailer.php";
require "PHPMailer/src/SMTP.php";
require "PHPMailer/src/Exception.php";
require "db_config.php";

$doctor_id = $_GET['doc_id'];
$dept_id = $_GET['dept_id'];

$login_query = "SELECT * FROM doctor_login
                WHERE doctor_id='$doctor_id'";
$row1 = mysqli_query($conn,$login_query);
$login_row = mysqli_fetch_assoc($row1);

$visit_query = "SELECT * FROM doc_dep
                WHERE doc_id='$doctor_id'";
$row2 = mysqli_query($conn,$visit_query);
$visit_row = mysqli_fetch_assoc($row2);

$schedule_query = "SELECT * FROM doc_day_time
                           WHERE doc_id='$doctor_id'";
$row3 = mysqli_query($conn,$schedule_query);
$schedule_row = mysqli_fetch_assoc($row3);


    $mail = new PHPMailer\PHPMailer\PHPMailer(true);
    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'carevista7@gmail.com';                     //SMTP username
    $mail->Password   = 'carevista@123';                               //SMTP password
    $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
    $mail->Port       = 587;                                  //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('carevista7@gmail.com', 'CareVista Superspeciality Hospital');
    $mail->addAddress($login_row['doctor_email'], $login_row['doctor_name']);     //Add a recipient
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
                      <b>Mail: </b>'.$login_row['doctor_email'].'<br>
                      <b>Password: </b>'.$login_row['doctor_pswrd'].'<br>
                      <b>Visit: </b> Rs. '.$visit_row['visit'].'<br>
                      <b>Floor: </b>'.$visit_row['floor'].'<br><br>
                      Please find below your Weekly Schedule <br><br>
                      <table style="border: 1px solid white; border-collapse: collapse; width:40%;">
                                    <thead>
                                        <tr>
                                            <th scope="col" style="border: 1px solid white; border-collapse: collapse; background-color:#000000; color:white;">DAY</th>
                                            <th scope="col" style="border: 1px solid white; border-collapse: collapse; background-color:#000000; color:white;">TIMING</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td style="border: 1px solid white; border-collapse: collapse; background-color: #CEE3E9; text-align: center;">'.$schedule_row['day1'].'</td>
                                            <td style="border: 1px solid white; border-collapse: collapse; background-color: #CEE3E9; text-align: center;">'.$schedule_row['time1'].'</td>
                                        </tr>
                                        <tr>
                                            <td style="border: 1px solid white; border-collapse: collapse; background-color: #CEE3E9;text-align: center;">'.$schedule_row['day2'].'</td>
                                            <td style="border: 1px solid white; border-collapse: collapse; background-color: #CEE3E9;text-align: center;">'.$schedule_row['time2'].'</td>
                                        </tr>
                                        <tr>
                                            <td style="border: 1px solid white; border-collapse: collapse; background-color: #CEE3E9;text-align: center;">'.$schedule_row['day3'].'</td>
                                            <td style="border: 1px solid white; border-collapse: collapse; background-color: #CEE3E9;text-align: center;">'.$schedule_row['time3'].'</td>
                                        </tr>
                                        
                                    </tbody>
                                </table>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    if($mail->send()){
        $_SESSION['status'] = "SUCCESSFUL";
        $_SESSION['status_code'] = "success";
        $_SESSION['status_text'] = "Mail Sent to Dr. ".$login_row['doctor_name'];
        header('Location:add_view_update_dctr_details.php');
    
    }
    else{
        $_SESSION['status'] = "FAILED";
        $_SESSION['status_code'] = "error";
        $_SESSION['status_text'] = "Mail not sent to Dr. ".$login_row['doctor_name'];
        header('Location:add_view_update_dctr_details.php');
    }
?>