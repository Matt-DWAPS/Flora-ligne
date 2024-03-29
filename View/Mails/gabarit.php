<!DOCTYPE html>
<html>
<head>
    <base href="<?= $webRoot ?>">
    <meta charset="utf-8" content="text/html">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?= $title ?></title>
</head>
<body style="margin:0px; padding:0px; -webkit-text-size-adjust:none;">
<table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:rgb(42, 55, 78)">
    <tbody>
    <tr>
        <td align="center" bgcolor="#2A374E">
            <table cellpadding="0" cellspacing="0" border="0">
                <tbody>
                <tr>
                    <td class="w640" width="640" height="10"></td>
                </tr>
                <tr>
                    <td class="w640" width="640" height="10"></td>
                </tr>


                <!-- entete -->
                <tr class="pagetoplogo">
                    <td class="w640" width="640">
                        <table class="w640" width="640" cellpadding="0" cellspacing="0" border="0" bgcolor="#F2F0F0">
                            <tbody>
                            <tr>

                                <td class="w580" width="580" valign="middle" align="left">
                                    <div class="heading">
                                        <?php $image = 'http://www.' . $_SERVER['SERVER_NAME'] . DIRECTORY_SEPARATOR . 'public/img/mail-img/header.jpg'; ?>
                                        <img width="100%" src="<?= $image; ?>">
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>

                <!-- separateur horizontal -->
                <tr>
                    <td class="w640" width="640" height="1" bgcolor="#d7d6d6"></td>
                </tr>

                <!-- contenu -->
                <tr class="content">
                    <td class="w640" class="w640" width="640" bgcolor="#ffffff">
                        <table class="w640" width="640" cellpadding="0" cellspacing="0" border="0">
                            <tbody>
                            <tr>
                                <td class="w30" width="30"></td>
                                <td class="w580" width="580">
                                    <!-- une zone de contenu -->
                                    <table class="w580" width="580" cellpadding="0" cellspacing="0" border="0">
                                        <tbody>
                                        <tr>
                                            <td class="w580" width="580">
                                                <h2 style="color:#0E7693; font-size:22px; padding-top:12px;"><?= $title ?></h2>
                                                <div align="left" class="article-content">
                                                    <?= $content ?>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="w580" width="580" height="1" bgcolor="#c7c5c5"></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <!-- fin zone -->
                                </td>
                                <td class="w30" class="w30" width="30"></td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>

                <!--  separateur horizontal de 15px de  haut-->
                <tr>
                    <td class="w640" width="640" height="15" bgcolor="#ffffff"></td>
                </tr>

                <!-- pied de page -->
                <tr class="pagebottom">
                    <td class="w640" width="640">
                        <table class="w640" width="640" cellpadding="0" cellspacing="0" border="0" bgcolor="#c7c7c7">
                            <tbody>
                            <tr>
                                <td colspan="5" height="10"></td>
                            </tr>
                            <tr>
                                <td class="w30" width="30"></td>
                                <td class="w580" width="580" valign="top">
                                    <p align="right" class="pagebottom-content-left">
                                        <a style="color:#255D5C;" href="http://flora-ligne.webagency-matt.com/"><span
                                                    style="color:#255D5C;">Flora-ligne</span></a>
                                    </p>
                                </td>

                                <td class="w30" width="30"></td>
                            </tr>
                            <tr>
                                <td colspan="5" height="10"></td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td class="w640" width="640" height="60"></td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    </tbody>
</table>
</body>
</html>
