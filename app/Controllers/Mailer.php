<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Mailer extends Controller
{
    public function bienvenue($mail, $pseudo)
    {
        $message = '
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head><meta content="text/html; charset=utf-8" http-equiv="Content-Type"><meta content="width=device-width, initial-scale=1" name="viewport">
<title>Li Logement Welcome Email</title>
<style>
  @import url(https://fonts.googleapis.com/css?family=Droid+Sans);

  img {
    max-width: 600px;
    outline: none;
    text-decoration: none;
    -ms-interpolation-mode: bicubic;
  }

  a {
    text-decoration: none;
    border: 0;
    outline: none;
    color: #bbbbbb;
  }

  a img {
    border: none;
  }

  td, h1, h2, h3  {
    font-family: Helvetica, Arial, sans-serif;
    font-weight: 400;
  }

  td {
    text-align: center;
  }

  body {
    -webkit-font-smoothing:antialiased;
    -webkit-text-size-adjust:none;
    width: 100%;
    height: 100%;
    color: #37302d;
    background: #ffffff;
    font-size: 16px;
  }

   table {
    border-collapse: collapse !important;
  }

  .headline {
    color: #ffffff;
    font-size: 36px;
  }

 .force-full-width {
  width: 100% !important;
 }

  </style>
  <style media="screen" type="text/css">
      @media screen {
        td, h1, h2, h3 {
          font-family: "Droid Sans", "Helvetica Neue", "Arial", "sans-serif" !important;
        }
      }
  </style>
  <style media="only screen and (max-width: 480px)" type="text/css">
    @media only screen and (max-width: 480px) {

      table[class="w320"] {
        width: 320px !important;
      }
    }
  </style>
  </head>
  <body bgcolor="#ffffff" class="body" style="padding:0; margin:0; display:block; background:#ffffff; -webkit-text-size-adjust:none">
<table align="center" cellpadding="0" cellspacing="0" height="100%" width="100%">
<tbody><tr>
<td align="center" bgcolor="#ffffff" class="" valign="top" width="100%">
<center class=""><table cellpadding="0" cellspacing="0" class="w320" style="margin: 0 auto;" width="600">
<tbody><tr>
<td align="center" class="" valign="top"><table cellpadding="0" cellspacing="0" style="margin: 0 auto;" width="100%">
<tbody><tr>
<td class="" style="font-size: 30px; text-align:center;"></td>
</tr>
</tbody></table>
<table cellpadding="0" cellspacing="0" class="" style="margin: 0 auto;    background: #9053c7;
    background: -webkit-linear-gradient(-135deg, #c850c0, #4158d0);
    background: -o-linear-gradient(-135deg, #c850c0, #4158d0);
    background: -moz-linear-gradient(-135deg, #c850c0, #4158d0);
    background: linear-gradient(-135deg, #c850c0, #4158d0);" width="100%">
<tbody class=""><tr class="">
<td class=""><br>
<img alt="robot picture" class="" height=auto src="https://cdn.discordapp.com/attachments/912646044934864926/913010553860022302/texte.png" width="380">
<br><br><br><br></td>
</tr>
<tr class=""><td class="headline">Bienvenue à toi '.$pseudo.', sur Li Logement</td></tr>
<tr>
<td>
<center class=""><table cellpadding="0" cellspacing="0" class="" style="margin: 0 auto;" width="75%"><tbody class=""><tr class="">
<td class="" style="color:#A0D8F4;"><br>
Li Site de Logement Lider dans tout l"univers
                            <br>
<br>
<img alt="robot picture" class="" height="175" src="https://cdn.discordapp.com/attachments/912646044934864926/913010553633534002/logo-PHP.png" width="175">
<br>
<br></td>
</tr>
</tbody></table></center>
</td>
</tr>
<tr>
<td class="">
<div class=""><!--[if mso]>
                        <v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" href="http://" style="height:50px;v-text-anchor:middle;width:300px;" arcsize="8%" stroke="f" fillcolor="#178f8f">
                          <w:anchorlock></w:anchorlock>
                          <center>
                        <![endif]-->
<a class="" data-click-track-id="6155" href="' . base_url("/login") . '" style="background-color:#73BD4D;border-radius:15px;color:#ffffff;display:inline-block;font-family:Helvetica, Arial, sans-serif;font-size:18px;font-weight:normal;line-height:50px;text-align:center;text-decoration:none;width:350px;-webkit-text-size-adjust:none;"><b>Je me Connecte</b></a>
<!--[if mso]>
                          </center>
                        </v:roundrect>
                      <![endif]--></div>
<br>
<br>
</td>
</tr>
</tbody></table>
<table bgcolor="#414141" cellpadding="0" cellspacing="0" class="force-full-width" style="margin: 0 auto;">
<tbody><tr class=""><td class="" style="background-color:#414141;"></td></tr>
<tr>
<td class="" style="color:#bbbbbb; font-size:12px;"></td>
</tr>
<tr>
<td class="" style="color:#bbbbbb; font-size:12px;"><br>
<br>
<a class="" data-click-track-id="6245" href="https://github.com">Github du Projet</a> 
&nbsp; • &nbsp; 
<a class="" data-click-track-id="285" href"https://univ-amu.fr/">Site de AMU</a>
<br>
<br>
© 2022 <span class="" style="font-weight:bold;">Li </span><span class="" style="font-weight:lighter;">Logement</span>
<br>
<br></td>
</tr>
</tbody></table></td>
</tr>
</tbody></table></center>
</td>
</tr>
</tbody></table>
</body></html>';
        $email = \Config\Services::email();
        $email->setFrom('li.logement.fr@gmail.com', 'Li Logement');
        $email->setTo($mail);
        $email->setSubject('Bienvenue sur Li Logement');
        $email->setMessage($message);//your message here

        //$email->setCC('another@emailHere');//CC
        //$email->setBCC('thirdEmail@emialHere');// and BCC
        //$filename = '/img/yourPhoto.jpg'; //you can use the App patch
        //$email->attach($filename);

        $email->send();
        $email->printDebugger(['headers']);
    }
}