<?php 

session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require "vendor/autoload.php";




if($_POST["name"]  && $_POST["email"] && $_POST["subject"] && $_POST["message"] ){
    
    // bunlar dolu ise mail gönderme işlemi gerçekleştir...
    
    $mail = new PHPMailer(true) ;
    
    
    try{
        //Server Ayari
        
        $mail->SMTPDebug = 2;
        $mail->isSMTP();
        $mail->Host ="ssl://smtp.gmail.com";
        $mail->SMTPAuth = true;
        $mail->Username = "eypyatcilik@gmail.com";
        $mail->Password = "eypyatcilik123.";
        $mail->CharSet = "utf8";
        $mail->SMTPSecure = "tls";
        $mail->Port = 465;
        
        
        //Alici ayari 
        $mail->setFrom($_POST["email"], $_POST["name"]);
        $mail->addAddress("eypyatcilik@gmail.com" ,$_POST["email"]);
        
        
        
        //Gonderi ayarlari
        
        $mail->isHTML();
        $mail->Subject = $_POST["subject"];
        $mail->Body = $_POST["message"];
        
        
        
        
        if($mail->send()){
            
            $alert = array (
                "message" => "Mesajınız gönderilmiştir.",
                "type"    => "success"
            );
            
        }else {
             $alert = array (
                "message" => "Gönderme hatası , yeniden deneyiniz.",
                "type"    => "danger"
            );
        }
        
 
        
        
        
    } catch(Exception $e) {
       
        
          $alert = array (
                "message" => $e->getMessage(),
                "type"    => "danger"
            );
    }
    
    
    
}
else{
    
    $alert = array (
    
        "message" => "Lütfen tüm alanları doldurunuz!",
        "type"    => "danger"
    );
    
}

    $_SESSION["alert"] = $alert ;
    
    header("location:index.php");

?>