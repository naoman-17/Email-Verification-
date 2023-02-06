<?php
    include("connection.php");

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    function sendmail($vemail,$vcode)
    {
        require ('PHPMailer/Exception.php');
        require ('PHPMailer/PHPMailer.php');
        require ('PHPMailer/SMTP.php');

        $mail = new PHPMailer(true);
        try {                            
            $mail->isSMTP();                                           
            $mail->Host       = 'smtp.gmail.com';                     
            $mail->SMTPAuth   = true;                                   
            $mail->Username   = 'naomanali17@gmail.com';     //your email                
            $mail->Password   = 'iwrztxjyswqpwbdj';          //here first on the 2fa then make n password for the other app just bellow the option in 2fa in gmail.                     
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            
            $mail->Port       = 465;                                    
        
            //Recipients
            $mail->setFrom('xyz@gmail.com', 'FITNAOMAN');
            $mail->addAddress($vemail);               
            
            $mail->isHTML(true);                                  
            $mail->Subject = 'Email Verification';
            $mail->Body    = "DEMO VERIFICATION <br>
            click the link bellow to verifiy the email
            <a href='http://localhost/emailverification/php/verify.php?vemail=$vemail&vcode=$vcode'>VERIFY</a> ";
        
            $mail->send();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }


    $email=$_GET['email'];
    $vc=bin2hex(random_bytes(20));

    $query="insert into verified (email,verifyc,status) values('$email','$vc','0')";
    $data=mysqli_query($conn,$query,);

    if($data && sendmail($email,$vc))
    {
        $alert=
            "<script>
                alert('Verify your email from your mail box :-)');
                window.location.href='../login.html';
            </script>";
        echo $alert;
    }
?>
