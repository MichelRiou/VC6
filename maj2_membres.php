<script type="text/javascript">
    function getRadio() {
        var radioValue = '';
        for (i = 0; i < document.form2.civility.length; i++) {
            if (document.form2.civility[i].checked) {
                radioValue = document.form2.civility[i].value;
            }
        }
        return radioValue;
    }
    function ctrlAddCustomer() {
        msg = '';
        document.getElementById("lastname").style.backgroundColor = "white";
        document.getElementById("firstname").style.backgroundColor = "white";
        document.getElementById("zipcode").style.backgroundColor = "white";
        document.getElementById("email").style.backgroundColor = "white";
        document.getElementById("sms").style.backgroundColor = "white";
        document.getElementById("address1").style.backgroundColor = "white";
        document.getElementById("city").style.backgroundColor = "white";
        if (document.getElementById("lastname").value.trim().length < 1)
        {
            document.getElementById("lastname").style.backgroundColor = "orange";
            document.getElementById("lastname").focus();
            msg += 'Le nom est obligatoire.<br>';
        }
        if (document.getElementById("firstname").value.trim().length < 1)
        {
            document.getElementById("firstname").style.backgroundColor = "orange";
            document.getElementById("firstname").focus();
            msg += 'Le prénom est obligatoire.<br>';
        }
        if ((document.getElementById("sus")== null) || (!document.getElementById("sus").checked)){
        if (document.getElementById("address1").value.length > 0
                || document.getElementById("address2").value.length > 0
                || document.getElementById("city").value.length > 0
                || document.getElementById("zipcode").value.length > 0)
        {
            if (!checkAddress()) {
                document.getElementById("address1").style.backgroundColor = "orange";
                document.getElementById("city").style.backgroundColor = "orange";
                document.getElementById("zipcode").style.backgroundColor = "orange";
                document.getElementById("address1").focus();
                msg += 'L\'adresse n\'est pas valide.<br>';
            }
        }
        if ((document.getElementById("email").value.length > 0) && (!checkMail()))
        {
            document.getElementById("email").style.backgroundColor = "orange";
            document.getElementById("email").focus();
            msg += 'L\'email n\'est pas valable.<br>';
        }
        if ((document.getElementById("sms").value.length > 0) && (!checkSms()))
        {
            document.getElementById("sms").style.backgroundColor = "orange";
            document.getElementById("sms").focus();
            msg += 'Le numéro de téléphone est incorrect.<br>';
        }
        if (!checkMail()) {
            document.getElementById("email").style.backgroundColor = "orange";
            document.getElementById("email").focus();
            msg += 'Vous devez saisir obligatoirement votre email.';
        }
         }
        // Monitoring des erreurs
        console.log(msg);
        document.getElementById("addMessage").innerHTML = msg;
        $result = (msg != "" ? false : true);
        return $result;
    }
    </script>
<?php
include("controller\connect.inc.php");
if (isset($_GET['id']) and isset($_GET['type'])) {
    try {
        $result5 = $db->prepare('SELECT * FROM customers WHERE customer_id = :QN1 ');
        $result5->execute(array(':QN1' => intval($_GET['id']))); /* close cursor a faire */
        $data5 = $result5->fetch();
    } catch (PDOException $e) {
        die('ERREUR SQL: ' . $e->getMessage() . '<BR>' . 'MSG:' . $e->getcode()) . '<BR>';
    }
}
?>
<!<DOCTYPE html>
    <html lang="fr">
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

            <link rel="stylesheet" type="text/css" href="../style.css" />
            <title>MISE A JOUR FICHIER MAILING</title>
            <script type="text/javascript" language="javascript" src="../common.js"></script>
        </head>
        <body>
            <form name="form4" action="maj3_membres.php" autocomplete="off" method="post" onSubmit="return ctrlAddCustomer()">
                <center>
                    <table class="listing" style="width:50%">
                        <caption style="background-color:#FFFFAA">MISE A JOUR</caption>
                        <tr><th class="TD0"><input type="hidden" name="type" value="<?php echo($_GET['type']) ?>"></th><th class="TD0"><input type="hidden" name="id" value="<?php echo($data5['customer_id']) ?>"></th></tr>   
                        <tr class="TD0"><td class="TD0">ID</td><td class="TD0"><?php echo ($data5['customer_id']) ?></td></tr>
                        <tr class="TD0"><td class="TD0">POLITESSE</td><td class="TD0"><span><input type="radio" name="pol" value="Mme" <?php
                                    if (($data5['customer_civility'] <> "MLLE") or ( $data5['customer_civility'] <> "MR")) {
                                        echo ('checked="checked"');
                                    }
                                    ?> >Mme</span>
                                <span><input type="radio" name="pol" value="Mle" <?php
                                    if ($data5['customer_civility'] == "MLLE") {
                                        echo ('checked="checked"');
                                    }
                                    ?>>Mle</span>
                                <span><input type="radio" name="pol" value="Mr" <?php
                                    if ($data5['customer_civility'] == "MR") {
                                        echo ('checked="checked"');
                                    }
                                    ?>>Mr</span>

                            </td></tr>
                        <tr class="TD0"><td class="TD0">NOM</td><td class="TD0" ><input class="text" type="text" size="50" maxlength="50" id="lastname" name="nom" value="<?php echo ($data5['customer_lastname']) ?>"></td></tr>
                        <tr class="TD0"><td class="TD0">PRENOM</td><td class="TD0"><input class="text" type="text" size="50" maxlength="50" id="firstname" name="prenom" value="<?php echo ($data5['customer_firstname']) ?>"></td></tr>
                        <tr class="TD0"><td class="TD0">ADRESSE</td><td class="TD0"><input class="text" type="text" size="50" maxlength="50" id="address1" name="ad1" value="<?php echo ($data5['customer_address1']) ?>"></td></tr>
                        <tr class="TD0"><td class="TD0"></td><td class="TD0"><input class="text" type="text" size="50" maxlength="50" id="address2" name="ad2" value="<?php echo ($data5['customer_address2']) ?>"></td></tr>
                        <tr class="TD0"><td class="TD0">CODE POSTAL</td><td class="TD0"><input class="text" type="text" size="5" maxlength="5" id="zipcode" name="pos" value="<?php echo ($data5['customer_zipcode']) ?>"></td></tr>
                        <tr class="TD0"><td class="TD0">VILLE</td><td class="TD0"><input class="text" type="text" size="30" maxlength="30" id="city" name="ville" value="<?php echo ($data5['customer_country']) ?>"></td></tr>
                        <tr class="TD0"><td class="TD0">TAILLE</td><td class="TD0"><input class="text" type="text" size="5" maxlength="5" id="size" name="taille" value="<?php echo ($data5['customer_size']) ?>"></td></tr>
                        <tr class="TD0"><td class="TD0">E-MAIL</td><td class="TD0"><input class="text" type="text" id="email" name="email" value="<?php echo ($data5['customer_email']) ?>"></td></tr>
                        <tr class="TD0"><td class="TD0">SMS</td><td class="TD0"><input class="text" type="text" id="sms" maxlength="10" name="sms" value="<?php echo ($data5['customer_sms']) ?>"></td></tr>

                        <tr class="TD0"><td class="TD0">SUSPENSION</td><td class="TD0"><span><input type="radio" name="sus" value=1 id="sus"<?php
                                    if ($data5['customer_suppression_flag'] <> 0) {
                                        echo ('checked="checked"');
                                    }
                                    ?> >OUI</span>
                                <span><input type="radio" name="sus" value=0 <?php
                                    if ($data5['customer_suppression_flag'] == 0) {
                                        echo ('checked="checked"');
                                    }
                                    ?>>NON</span>
                            </td></tr>
                        <tr class="TD0"><td class="TD0"></td><td class="TD0"><input class="bouton1" type="submit" value="VALIDER"></td></tr>
                        <tr><td colspan="2"><div id='addMessage' ></div></td></tr>
                    </table>
                </center>
            </form>

        </body>
    </html>