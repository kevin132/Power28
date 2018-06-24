<?php
/**
 * Created by PhpStorm.
 * User: Skelev
 * Date: 17/06/2018
 * Time: 00:47
 */


$query = $db->prepare('SELECT * FROM user WHERE id = ?');
$query->execute(array($_SESSION['user_id']));
$user = $query->fetch();
if (isset($_POST['update'])) {
    $query = $db->prepare('SELECT email FROM user WHERE email = ?');
    $query->execute(array($_POST['email']));
    $emailAlreadyExists = $query->fetch();
    if ($emailAlreadyExists && $emailAlreadyExists['email'] != $user['email']) {
        $updateMessage = "Adresse email déjà utilisée";
    } elseif (empty($_POST['firstname']) OR empty($_POST['email'])) {
        $updateMessage = "Merci de remplir tous les champs obligatoires (*)";
    }
    elseif (!empty($_POST['password']) AND ($_POST['password'] != $_POST['password_confirm'])) {
        $updateMessage = "Les mots de passe ne sont pas identiques";
    } else {
        $queryString = 'UPDATE user SET firstname = :firstname, email = :email';
        $queryParameters = ['firstname' => $_POST['firstname'], 'email' => $_POST['email'], 'id' => $_SESSION['user_id']];

        if (!empty($_POST['password'])) {
            $queryString .= ', password = :password ';
            $queryParameters['password'] = hash('md5', $_POST['password']);
        }
        $queryString .= 'WHERE id = :id';
        $query = $db->prepare($queryString);
        $result = $query->execute($queryParameters);

        if ($result) {
            $_SESSION['user'] = $_POST['firstname'];
            $updateMessage = "Informations mises à jour avec succès !";
            $query = $db->prepare('SELECT * FROM user WHERE id = ?');
            $query->execute(array($_SESSION['user_id']));
            $user = $query->fetch();
        } else {
            $updateMessage = "Erreur";
        }


        if (isset($_SESSION['user'])) {
            header('location:index.php?page=prices');
            exit;
        }
    }


}
?>
<main>
     <div class="container-fluid">
               <main class="col-9">

                    <form action="index.php?page=user-profile.php" method="post" class="p-4 row flex-column">

                         <h4 class="pb-4 col-sm-8 offset-sm-2">Mise à jour des informations utilisateur</h4>

                        <?php if (isset($updateMessage)): ?>
                             <div class="text-danger col-sm-8 offset-sm-2 mb-4"><?php echo $updateMessage; ?></div>
                        <?php endif; ?>

                         <div class="form-group col-sm-8 offset-sm-2">
                              <label for="firstname">Prénom <b class="text-danger">*</b></label>
                              <input class="form-control" value="<?= $user['firstname'] ?>" type="text"
                                     placeholder="Prénom" name="firstname" id="firstname"/>
                         </div>
                         <div class="form-group col-sm-8 offset-sm-2">
                              <label for="email">Email <b class="text-danger">*</b></label>
                              <input class="form-control" value="<?= $user['email'] ?>" type="email"
                                     placeholder="Email" name="email" id="email"/>
                         </div>
                         <div class="form-group col-sm-8 offset-sm-2">
                              <label for="password">Mot de passe (uniquement si vous souhaitez modifier votre mot de
                                   passe actuel)</label>
                              <input class="form-control" value="" type="password" placeholder="Mot de passe"
                                     name="password" id="password"/>
                         </div>
                         <div class="form-group col-sm-8 offset-sm-2">
                              <label for="password_confirm">Confirmation du mot de passe (uniquement si vous souhaitez
                                   modifier votre mot de passe actuel)</label>
                              <input class="form-control" value="" type="password"
                                     placeholder="Confirmation du mot de passe" name="password_confirm"
                                     id="password_confirm"/>
                         </div>

                         <div class="text-right col-sm-8 offset-sm-2">
                              <p class="text-danger">* champs requis</p>
                              <input class="btn btn-success" type="submit" name="update" value="Valider"/>
                         </div>

                    </form>
               </main>
          </div>
     </div>
</main>