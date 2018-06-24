<?php
if (isset($_GET['section'])) {
    $section = htmlspecialchars($_GET['section']);
} else {
    $section = "";
}
if (isset($_POST['recup_submit'], $_POST['recup_mail'])) {
    if (!empty($_POST['recup_mail'])) {
        $recup_mail = htmlspecialchars($_POST['recup_mail']);
        if (filter_var($recup_mail, FILTER_VALIDATE_EMAIL)) {
            $mailexist = $db->prepare('SELECT * FROM user WHERE Email = ?');
            $mailexist->execute(array($recup_mail));
            $mailexist_count = $mailexist->rowCount();
            if ($mailexist_count == 1) {
                $pseudo = $mailexist->fetch();
                $pseudo = $pseudo['firstname'];
                $_SESSION['recup_mail'] = $recup_mail;
                $recup_code = "";
                for ($i = 0; $i < 8; $i++) {
                    $recup_code .= mt_rand(0, 9);
                }
                $mail_recup_exist = $db->prepare('SELECT id FROM recuperation WHERE mail = ?');
                $mail_recup_exist->execute(array($recup_mail));
                $mail_recup_exist = $mail_recup_exist->rowCount();
                if ($mail_recup_exist == 1) {
                    $recup_insert = $db->prepare('UPDATE recuperation SET code = ? WHERE mail = ?');
                    $recup_insert->execute(array($recup_code, $recup_mail));
                } else {
                    $recup_insert = $db->prepare('INSERT INTO recuperation(mail,code,confirm) VALUES (?, ?, "0")');
                    $recup_insert->execute(array($recup_mail, $recup_code));
                }
                $header = "MIME-Version: 1.0\r\n";
                $header .= 'From:"Power28@software.com"<Power28@software.com>' . "\n";
                $header .= 'Content-Type:text/html; charset="utf-8"' . "\n";
                $header .= 'Content-Transfer-Encoding: 8bit';
                $message = '
                <html>
                <head>
                <title>Récupération de mot de passe - Power28</title>
                <meta charset="utf-8" />
                </head>
                <body>
                <font color="#303030";>
                <div align="center">
                <table width="600px">
                <tr>
                <td>
                <div align="center">Bonjour <b>' . $pseudo . '</b>,</div>
                Voici votre code de récupération: <b>' . $recup_code . '</b>
                A bientôt sur <a href="#">Power28</a> !
                </td>
                </tr>
                <tr>
                <td align="center">
                <font size="2">
                Ceci est un email automatique, merci de ne pas y répondre.
                </font>
                </td>
                </tr>
                </table>
                </div>
                </font>
                </body>
                </html>
                ';
                mail($recup_mail, "Récupération de mot de passe - Power28", $message, $header);
                header('Location:index.php?page=forgot-password&section=code');
            } else {
                $error = "Cette adresse mail n'est pas enregistrée";
            }
        } else {
            $error = "Adresse mail invalide";
        }
    } else {
        $error = "Veuillez entrer votre adresse mail";
    }
}
if (isset($_POST['verif_submit'], $_POST['verif_code'])) {
    if (!empty($_POST['verif_code'])) {
        $verif_code = htmlspecialchars($_POST['verif_code']);
        $verif_req = $db->prepare('SELECT id FROM recuperation WHERE mail = ? AND code = ?');
        $verif_req->execute(array($_SESSION['recup_mail'], $verif_code));
        $verif_req = $verif_req->rowCount();
        if ($verif_req == 1) {
            $up_req = $db->prepare('UPDATE recuperation SET confirm = 1 WHERE mail = ?');
            $up_req->execute(array($_SESSION['recup_mail']));
            header('Location:index.php?page=forgot-password&section=changemdp');
        } else {
            $error = "Code invalide";
        }
    } else {
        $error = "Veuillez entrer votre code de confirmation";
    }
}
if (isset($_POST['change_submit'])) {
    if (isset($_POST['change_mdp'], $_POST['change_mdpc'])) {
        $verif_confirme = $db->prepare('SELECT confirm FROM recuperation WHERE mail = ?');
        $verif_confirme->execute(array($_SESSION['recup_mail']));
        $verif_confirme = $verif_confirme->fetch();
        $verif_confirme = $verif_confirme['confirm'];
        if ($verif_confirme == 1) {
            $mdp = htmlspecialchars($_POST['change_mdp']);
            $mdpc = htmlspecialchars($_POST['change_mdpc']);
            if (!empty($mdp) AND !empty($mdpc)) {
                if ($mdp == $mdpc) {
                    $mdp = hash('md5', $mdp);
                    $ins_mdp = $db->prepare('UPDATE user SET Password = ? WHERE Email = ?');
                    $ins_mdp->execute(array($mdp, $_SESSION['recup_mail']));
                    $del_req = $db->prepare('DELETE FROM recuperation WHERE mail = ?');
                    $del_req->execute(array($_SESSION['recup_mail']));
                    header('Location:index.php');
                } else {
                    $error = "Vos mots de passes ne correspondent pas";
                }
            } else {
                $error = "Veuillez remplir tous les champs";
            }
        } else {
            $error = "Veuillez valider votre mail grâce au code de vérification qui vous a été envoyé par mail";
        }
    } else {
        $error = "Veuillez remplir tous les champs";
    }
}
?>

<?php if ($section == 'code') { ?>

     Un code de vérification vous a été envoyé par mail: <?= $_SESSION['recup_mail'] ?>
     <br/><br/>
     <div class="form-forgot text-center">
          <h4 class="title-element text-center mb-4">Récupération de mot de passe</h4>
          <form method="post">
               <input type="text" placeholder="Code de vérification" name="verif_code"/><br/><br/>
               <input type="submit" value="Valider" name="verif_submit"/>
          </form>
     </div>
<?php } elseif ($section == "changemdp") { ?>
     Nouveau mot de passe pour <?= $_SESSION['recup_mail'] ?>
     <div class="form-forgot text-center">
          <h4 class="title-element text-center mb-4 ">Récupération de mot de passe</h4>
          <form method="post">
               <input type="password" placeholder="Nouveau mot de passe" name="change_mdp"/><br/><br/>
               <input type="password" placeholder="Confirmation du mot de passe" name="change_mdpc"/><br/><br/>
               <input type="submit" value="Valider" name="change_submit"/>
          </form>
     </div>
<?php } else { ?>
     <div class="form-forgot text-center">
          <h4 class="title-element text-center mb-4">Récupération de mot de passe</h4>
          <form method="post">
               <input type="email" placeholder="Votre adresse mail" name="recup_mail"/><br/><br/>
               <input type="submit" value="Valider" name="recup_submit"/>
          </form>
     </div>
<?php } ?>
<?php if (isset($error)) {
    echo '<span class="text-center" style="color:red">' . $error . '</span>';

} else {
    echo "";
} ?>