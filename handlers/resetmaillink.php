<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
/*
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$mail = new PHPMailer;
$mail->isMail();
$mail->isHTML(true);

# session_start();
$mail->setFrom('info@e-goldconsortium.com', 'venormall');
$mail->addAddress($_SESSION['email'], 'Venormall User');
$mail->Subject = "RESET LINK SENT";
$mail->Body = '
    <style>
      .header {
        font-family: Lucida Handwriting;
        font-weight: bold;
        align-items: center;
        justify-content: center;
        position: relative;
        background-color: rgb(253, 253, 253);
        border-bottom: 2px solid blue;
        display: flex;
        padding: 5px;
        font-size: 18px;
        height: 60px;
      }
      .header .link {
        position: absolute;
        font-size: 12px;
        right: 1%;
        top: 10%;
        opacity: 0.5;
        font-weight: 500;
      }
      .link a {
        text-decoration: none;
        color: black;
      }
      .link a:hover {
        text-decoration: underline;
      }
      .link-preview .img-box {
        margin-top: 50px;
      }
      img {
        width: 200px;
      }
      .username {
        font-size: 16px;
        margin: 0;
      }
      .verify p {
        text-transform: capitalize;
        font-size: 13px;
        margin-top: 8px;
        opacity: 0.7;
      }
      .subscribe {
        background-color: blue;
        color: white;
        padding: 10px 18px;
        border: none;
        border-radius: 5px;
        font-size: 12px;
        cursor: pointer;
        border: 1px solid blue;
        transition: all 0.15s ease-in-out;
        font-weight: bold;
      }
      .subscribe:hover {
        background-color: white;
        color: blue;
      }
      .icons {
        width: 150px;
      }
      .support-link p{
        margin: 0;
        margin-bottom: 3px;
      }
      .support-link p a{
        color: black;
      }
      .header .link {
        position: absolute;
        font-size: 10px;
        right: 1%;
        top: 10%;
        opacity: 0.5;
        font-weight: 500;
      }
    </style>
  </head>
  <body style="margin: 0;
        padding: 0;
        box-sizing: border-box;
        background-color: #0D0E52;">
    <div style="margin-right: auto;
        margin-left: auto;
        background-color: rgb(250, 250, 250);
        font-family: Arial, Helvetica, sans-serif;">
      <div class="header">
        <!--<div class="brand">venormall</div>-->
      </div>
      <div style="display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;">
        <div class="link-preview">
          <!--<div class="img-box">
            <img src="https://venormall.com/venormall.jpg" alt="tickmark" class="tickmark" />
          </div>-->
          <div style="text-align: center;">
            <h1 class="username">Your Reset Link is</h1>
            <h3 style="margin:auto;margin-top:50px;text-align: center;"> https://venormall.com/reset?reset='.$_SESSION['reset'].'</h3>
            <h4>
                For security reasons and in line with our verification protocols, 
                please ensure that the Reset email received is verified on the same device the reset mail was delivered to. 
                This step is crucial in maintaining the integrity of the verification process and ensuring the security of your account.
            </h4>
          </div>
        </div>
        <!--<button class="subscribe">SUBSCRIBE</button>-->
      </div>
      <div style="border-top: 1px solid rgb(216, 216, 216);
        margin-top: 20px;
        background-color: whitesmoke;
        padding: 10px;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;">
        <div class="footer-links">
          <ul style="display: flex;
        list-style-type: none;
        font-size: 13px;
        text-transform: capitalize;
        opacity: 0.8;">
            <li style="padding: 0 5px 0 5px;
        text-decoration: none;
        display: inline;"><a href="https://venormall.com" style="color: black;
        text-decoration: none;">View website</a></li>
            <li style="padding: 0 5px 0 5px;
        text-decoration: none;
        display: inline;"><a href="https://venormall.com/policy" style="color: black;
        text-decoration: none;">Privacy policy</a></li>
        <li style="padding: 0 5px 0 5px;
        text-decoration: none;
        display: inline;"><a href="https://venormall.com/referral" style="color: black;
        text-decoration: none;">Referral Bonus</a></li>
          </ul>
        </div>
      </div>
      
      <div style="border-top: 1px solid rgb(216, 216, 216);
        margin-top: 20px;
        background-color: whitesmoke;
        padding: 10px;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;">
        <div style="font-size: 14px;
            text-align: center;">
          <p>If you have any questions, Please contact us <a href="#">support@venormall.com</a>.</p>
        </div>
      </div>
    </div>
  </body>
</html>
';
            
            if (!$mail->send()) {
                //echo 'Message could not be sent.';
                //echo 'Mailer Error: ' . $mail->ErrorInfo;
            } else {}
*/

require_once ('../vendor/autoload.php'); // if you use Composer
//require_once('ultramsg.class.php'); // if you download ultramsg.class.php

$ultramsg_token="xj2mrzv2rpek300f"; // Ultramsg.com token
$instance_id="instance68439"; // Ultramsg.com instance id
$client = new UltraMsg\WhatsAppApi($ultramsg_token,$instance_id);

$to="$_SESSION[phone]";
$body="https://venormall.com/reset?reset=$_SESSION[reset]
    For security reasons and in line with our verification protocols, 
    please ensure that the Reset email received is verified on the same device the reset mail was delivered to. 
    This step is crucial in maintaining the integrity of the verification process and ensuring the security of your account."; 
$api=$client->sendChatMessage($to,$body);
//print_r($api);