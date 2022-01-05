<?php echo view('mails/mail_open') ?>

<table align="center" cellpadding="0" cellspacing="0" height="100%" width="100%">
    <tbody>
    <tr>
        <td align="center" bgcolor="#ffffff" class="" valign="top" width="100%">
            <center class="">
                <table cellpadding="0" cellspacing="0" class="w320" style="margin: 0 auto;" width="600">
                    <tbody>
                    <tr>
                        <td align="center" class="" valign="top">
                            <table cellpadding="0" cellspacing="0" style="margin: 0 auto;" width="100%">
                                <tbody>
                                <tr>
                                    <td class="" style="font-size: 30px; text-align:center;"></td>
                                </tr>
                                </tbody>
                            </table>
                            <table cellpadding="0" cellspacing="0" class="" style="margin: 0 auto;    background: #9053c7;
    background: -webkit-linear-gradient(-135deg, #c850c0, #4158d0);
    background: -o-linear-gradient(-135deg, #c850c0, #4158d0);
    background: -moz-linear-gradient(-135deg, #c850c0, #4158d0);
    background: linear-gradient(-135deg, #c850c0, #4158d0);" width="100%">
                                <tbody class="">
                                <tr class="">
                                    <td class=""><br>
                                        <img alt="robot picture" class="" height=auto
                                             src="https://cdn.discordapp.com/attachments/912646044934864926/913010553860022302/texte.png"
                                             width="380">
                                        <br><br><br><br></td>
                                </tr>
                                <tr class="">
                                    <td class="headline"><?= $titre?></td>
                                </tr>
                                <tr>
                                    <td>
                                        <center class="">
                                            <table cellpadding="0" cellspacing="0" class="" style="margin: 0 auto;"
                                                   width="75%">
                                                <tbody class="">
                                                <tr class="">
                                                    <td class="" style="color:#A0D8F4;"><br>
                                                        <?= $soustitre?>
                                                        <br>
                                                        <br></td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </center>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="">
                                        <div class=""><!--[if mso]>
                                            <v:roundrect xmlns:v="urn:schemas-microsoft-com:vml"
                                                         xmlns:w="urn:schemas-microsoft-com:office:word" href="http://"
                                                         style="height:50px;v-text-anchor:middle;width:300px;"
                                                         arcsize="8%" stroke="f" fillcolor="#178f8f">
                                                <w:anchorlock></w:anchorlock>
                                                <center>
                                            <![endif]-->
                                            <a class="" data-click-track-id="6155" href="<?php echo base_url('/account/')?>"
                                            style="background-color:#73BD4D;border-radius:15px;color:#ffffff;display:inline-block;font-family:Helvetica,
                                            Arial,
                                            sans-serif;font-size:18px;font-weight:normal;line-height:50px;text-align:center;text-decoration:none;width:350px;-webkit-text-size-adjust:none;"><b>Je Me Connecte</b></a>
                                            <!--[if mso]>
                                            </center>
                                            </v:roundrect>
                                            <![endif]--></div>
                                        <br>
                                        <br>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
<?php echo view('mails/mail_close') ?>