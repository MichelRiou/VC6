<?php
include("controller\connect.inc.php");
if ((filter_input(INPUT_POST, 'flag') != null) and ( filter_input(INPUT_POST, 'flag') == "ok")) {

    $result = $db->prepare('SELECT * FROM membres WHERE EMAIL = :QN1');
    $result->execute(array(':QN1' => filter_input(INPUT_POST, 'email')));
    $nb = $result->Rowcount(); /* Rowcount A VOIR */
    if ($nb == 0) {
        $result6 = $db->prepare('INSERT INTO membres (nom,prenom,politesse,adresse1, adresse2,code_postal,ville,taille,email,date_creation,sms) VALUES (:QN1,:QN2,:QN3,:QN4,:QN5,:QN6,:QN7,:QN8,:QN9,NOW(),:QN10) ');
        $result6->execute(array(':QN1' => filter_input(INPUT_POST, 'nom',FILTER_SANITIZE_STRING), ':QN2' => filter_input(INPUT_POST, 'prenom',FILTER_SANITIZE_STRING), ':QN3' => filter_input(INPUT_POST, 'pol',FILTER_SANITIZE_STRING), ':QN4' => filter_input(INPUT_POST, 'ad1',FILTER_SANITIZE_STRING), ':QN5' => filter_input(INPUT_POST, 'ad2',FILTER_SANITIZE_STRING), ':QN6' => filter_input(INPUT_POST, 'pos',FILTER_SANITIZE_STRING), ':QN7' => filter_input(INPUT_POST, 'ville',FILTER_SANITIZE_STRING), ':QN8' => filter_input(INPUT_POST, 'taille',FILTER_SANITIZE_STRING), ':QN9' => filter_input(INPUT_POST, 'email'), ':QN10' => filter_input(INPUT_POST, 'sms')));
        echo '<body bgcolor="#800080" text=black><br><br><div  style="width:70%; margin-left: auto; margin-right: auto;text-align: center ; font-size: 2em; font-family: calibri,Verdana, sans-serif; background-color :#E3E3E3">';
        echo "<br><br><br>MERCI DE VOTRE VISITE<BR>UN E-MAIL DE CONFIRMATION<BR>VA VOUS ETRE ENVOYE.";
        echo "<br><br><br><br></div><div align=\"center\"><br><font color=\"#C0C0C0\"><font size=\"4\"><b>VENTESCLERY.FR - Batiment STOCKVET Zone artisanale Allée de la marchanderie<br>45370 Cléry saint-andré Tel:02.38.45.79.15</b></font></font></div></body>";
        $contenu = "Votre inscription à été validée. Nous espérons vous voir lors de notre prochaine vente à Cléry Saint-André.\n\nCordialement.";
        $contenu = nl2br($contenu);
        $message = "<HTML>\n";
        $message .= "<HEAD>\n";
        $message .= "<META NAME\"GENERATOR\" Content=\"Microsoft DHTML Editing Control\">\n";
        $message .= "<TITLE></TITLE>\n";
        $message .= "</HEAD>\n";
        $message .= "<BODY><FONT face=Arial><FONT color=blue>";
        $message .= "<P><div align=\"center\"><STRONG><FONT size=5>Bonjour,</FONT></STRONG></div></P><div align=\"center\"><FONT color=blue><FONT face=\"Arial, Helvetica\" size\"2\">\n";
        $message .= $contenu;
        $message .= "</div></FONT></P>\n";
        $message .= "</BODY>\n";
        $message .= "</HTML>\n";
        $entetes = "From: \"ventesclery.fr\" <newsletter@gerard-pasquier.fr>\n";
        $entetes .= "X-Sender: <newsletter@gerard-pasquier.fr>\n";
        $entetes .= "X-Mailer: PHP\n";
        $entetes .= "X-Priority: 1\n";
        $entetes .= "Return-path: <newsletter@gerard-pasquier.fr>\n";
        $entetes .= "Content-Type: text/html; charset=utf-8\n";
        mail(filter_input(INPUT_POST, 'email'), "INSCRIPTION A VENTESCLERY.FR", $message, $entetes);

        exit;
    } else {
        echo '<body bgcolor="#800080" text=black><br><br><div  style="width:70%; margin-left: auto; margin-right: auto;text-align: center ; font-size: 2em; font-family: calibri,Verdana, sans-serif; background-color :#E3E3E3">';
        echo "<br><br>CET EMAIL EST DEJA PRESENT !!<BR>EMAIL   :" . filter_input(INPUT_POST, 'email') . "<BR><br>A BIENTOT";
        echo "<br><br><br><br></div><div align=\"center\"><br><font color=\"#C0C0C0\"><font size=\"4\"><b>VENTESCLERY.FR - Batiment STOCKVET Zone artisanale Allée de la marchanderie<br>45370 Cléry saint-andré Tel:02.38.45.79.15</b></font></font></div></body>";
        mail("m.riou@mdaparis.fr", "DOUBLON", "email =" . filter_input(INPUT_POST, 'email') . "nom =" . filter_input(INPUT_POST, 'nom') . "prenom =" . filter_input(INPUT_POST, 'prenom'), "From: m.riou@mdaparis.fr");
        exit;
    }
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
    "http://www.w3.org/TR/html4/loose.dtd">
<html lang="fr">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="Generator" content="FreshHTML v1.00" />
        <meta name="description" content="Site de ventes privées prêt à porter féminin à CLERY SAINT-ANDRE 45370, près d'ORLEANS">
        <meta name="keywords" content="braderie, vêtements discount, clery saint-andré, gerard pasquier , soldes, magasins d'usine, vente privée, ventesclery" />
        <meta name="robots" content="index, follow, all" />
        <link rel="stylesheet" type="text/css" href="style.css" />
        <title>ventesclery-Vente privée à CLERY SAINT-ANDRE</title>
        <script type="text/javascript" language="javascript" src="javascript.js"></script>

        <script>
            (function (i, s, o, g, r, a, m) {
                i['GoogleAnalyticsObject'] = r;
                i[r] = i[r] || function () {
                    (i[r].q = i[r].q || []).push(arguments)
                }, i[r].l = 1 * new Date();
                a = s.createElement(o),
                        m = s.getElementsByTagName(o)[0];
                a.async = 1;
                a.src = g;
                m.parentNode.insertBefore(a, m)
            })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');

            ga('create', 'UA-90181171-1', 'auto');
            ga('send', 'pageview');

        </script>
    </head>
    <body bgcolor="#800080">
        <div align="center" style="background-color:#800080;font-family: calibri, 'Arial Black',  Verdana, sans-serif ">
            <div style="color:#C0C0C0">  <br></div>


            <form name="form2" action="inscription2.php" method="post" autocomplete="off" onSubmit="return verif_form2()">
                <table class="listing" style="width:70%">
                    <caption style="background-color:#809FAA">CREATION</caption>
                    <tr><th class="TD0"></th><th class="TD0"><input type="hidden" name="flag" value="ok"></th></tr>   
                    <tr class="TD0"><td class="TD0">ID</td><td class="TD0">NOUVEAU</td></tr>
                    <tr class="TD0"><td class="TD0">POLITESSE</td><td class="TD0"><span><input type="radio" name="pol" value="Mme" checked="checked">Mme</span>
                            <span><input type="radio" name="pol" value="Mle" >Mle</span>
                            <span><input type="radio" name="pol" value="Mr" >Mr</span>
                        </td></tr>
                    <tr class="TD0"><td class="TD0">NOM</td><td class="TD0"><input class="text" type="text" size="50" maxlength="50" style="width:300px" id="nom" name="nom" ></td></tr>
                    <tr class="TD0"><td class="TD0">PRENOM</td><td class="TD0"><input class="text" type="text" size="50" maxlength="50" style="width:300px" id="prenom" name="prenom" ></td></tr>
                    <tr class="TD0"><td class="TD0">ADRESSE</td><td class="TD0"><input class="text" type="text" size="50" maxlength="50" style="width:300px" id="ad1" name="ad1" ></td></tr>
                    <tr class="TD0"><td class="TD0">ADRESSE - SUITE -</td><td class="TD0"><input class="text" type="text" size="30" maxlength="50" style="width:300px" id="ad2" name="ad2" ></td></tr>
                    <tr class="TD0"><td class="TD0">CODE POSTAL</td><td class="TD0"><input class="text" type="text" size="5" maxlength="5" style="width:300px" id="pos" name="pos" ></td></tr>
                    <tr class="TD0"><td class="TD0">VILLE</td><td class="TD0"><input class="text" type="text" size="30" maxlength="30" style="width:300px" id="ville" name="ville" ></td></tr>
                    <tr class="TD0"><td class="TD0">TAILLE</td><td class="TD0"><input class="text" type="text" size="5" maxlength="5" style="width:300px" id="taille" name="taille" ></td></tr>
                    <tr class="TD0"><td class="TD0">E-MAIL</td><td class="TD0"><input class="text" type="text" style="width:300px" id="email" name="email" ></td></tr>
                    <tr class="TD0"><td class="TD0">SMS</td><td class="TD0"><input class="text" type="text" placeholder="ex: 0612345678" style="width:300px" id="sms" name="sms" ></td></tr>
                    <tr class="TD0"><td class="TD0"></td><td class="TD0"><input class="bouton1" type="submit" value="VALIDER"></td></tr>
                    <tr><td colspan="2"><div id='message' ></div></td></tr>
                </table>    
            </form>
            <br><br>
            <div align="center" style="background-color:#800080; font-family: calibri, 'Arial Black',  Verdana, sans-serif; color:#C0C0C0;font-size=4"><br>VENTESCLERY.FR - Batiment STOCKVET - Zone artisanale - Allée de la marchanderie<br>45370 Cléry saint-andré Tel:02.38.45.79.15</div>
        </div>
        <div><A HREF="/VC6/maj_membres.php" target=_blank>.</A></div> 
    </body>
</html>