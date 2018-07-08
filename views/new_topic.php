<?php
/* Traitement du formulaire de création de Topic */
if(isset($_SESSION['user'])) {
    if(isset($_POST['tsubmit'])) {
        if(isset($_POST['tsujet'],$_POST['tcontenu'])) {
            $sujet = htmlspecialchars($_POST['tsujet']);
            $contenu = htmlspecialchars($_POST['tcontenu']);
            if(!empty($sujet) AND !empty($contenu)) {
                if(strlen($sujet)  <= 70) {
                    if(isset($_POST['tmail'])) {
                        $notif_mail = 1;
                    } else {
                        $notif_mail = 0;
                    }
                    $ins = $db->prepare('INSERT INTO f_topics (id_createur, sujet, contenu, notif_createur, date_heure_creation) VALUES(?,?,?,?,NOW())');
                    $ins->execute(array($_SESSION['user'],$sujet,$contenu,$notif_mail));
                } else {
                    $terror = "Votre sujet ne peut pas dépasser 70 caractères";
                }
            } else {
                $terror = "Veuillez compléter tous les champs";
            }
        }
    }
} else {
    $terror = "Veuillez vous connecter pour poster un nouveau topic";
}
?>
<form method="POST">
    <table>
        <tr>
            <th colspan="2">Nouveau Topic</th>
        </tr>
        <tr>
            <td>Sujet</td>
            <td><input type="text" name="tsujet" size="70" maxlength="70" /></td>
        </tr>
        <tr>
            <td>Catégorie</td>
            <td>
                <select>
                    <option>Catégorie 1</option>
                    <option>Catégorie 2</option>
                    <option>Catégorie 3</option>
                    <option>Catégorie 1</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>Sous-Catégorie</td>
            <td>
                <select>
                    <option>Sous-Catégorie 1</option>
                    <option>Sous-Catégorie 2</option>
                    <option>Sous-Catégorie 3</option>
                    <option>Sous-Catégorie 1</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>Message</td>
            <td><textarea name="tcontenu"></textarea></td>
        </tr>
        <tr>
            <td>Me notifier des réponses par mail</td>
            <td><input type="checkbox" name="tmail" /></td>
        </tr>
        <tr>
             <td colspan="2"><a href=""><button type="submit" class="info-btn-one" name="tsubmit" >Poster le Topic</button></a></td>
        </tr>
        <?php if(isset($terror)):?>
            <tr>
                <td colspan="2"><?= $terror ?></td>
            </tr>


        <?php endif; ?>
    </table>
</form>