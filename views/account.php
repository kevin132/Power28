<?php

//En cas d'enregistrement
if(isset($_POST['register'])){

    //un enregistrement utilisateur ne pourra se faire que sous certaines conditions

    //en premier lieu, vérifier que l'adresse email renseignée n'est pas déjà utilisée
  $query = $db->prepare('SELECT email FROM user WHERE email = ?');
  $query->execute(array($_POST['email']));

    //$userAlreadyExists vaudra false si l'email n'a pas été trouvé, ou un tableau contenant le résultat dans le cas contraire
  $userAlreadyExists = $query->fetch();

    //on teste donc $userAlreadyExists. Si différent de false, l'adresse a été trouvée en base de données
  if($userAlreadyExists){
    $registerMessage = "Adresse email déjà enregistrée";
  }
  elseif(empty($_POST['firstname']) OR empty($_POST['password']) OR empty($_POST['email'])){
        //ici on test si les champs obligatoires ont été remplis
    $registerMessage = "Merci de remplir tous les champs obligatoires (*)";
  }
  elseif($_POST['password'] != $_POST['password_confirm']) {
        //ici on teste si les mots de passe renseignés sont identiques
    $registerMessage = "Les mots de passe ne sont pas identiques";
  }
  else {

        //si tout les tests ci-dessus sont passés avec succès, on peut enregistrer l'utilisateur
        //le champ is_admin étant par défaut à 0 dans la base de données, inutile de le renseigner dans la requête
    $query = $db->prepare('INSERT INTO user (firstname,lastname,email,password) VALUES (?, ?, ?, ?)');
    $newUser = $query->execute(
      [
        $_POST['firstname'],
        $_POST['lastname'],
        $_POST['email'],
        hash('md5', $_POST['password']),

      ]
    );

        //une fois l'utilisateur enregistré, on le connecte en créant sa session
        $_SESSION['is_admin'] = 0; //PAS ADMIN !
        $_SESSION['user'] = $_POST['firstname'];
      }
    }

//si l'utilisateur a une session (il est connécté), on le redirige ailleurs
    if(isset($_SESSION['user'])){
      header('location:index.php?index.php');
      exit;
    }

    ?>

    <section id="account-content">

     <div class="container text-center">
      <img src="assets/image/logo.png" alt="">
      <form action="index.php?page=account"  method="POST" id="account-form">

       <input type="text" class="account-input" id="fname" name="firstname" placeholder="Nom">

       <input type="text" id="lname" class="account-input" name="lastname" placeholder="Nom de l'entreprise">

       <input type="text" id="email" class="account-input" name="email" placeholder="E-mail">

       <input type="password" id="password" class="account-input" name="password" placeholder="Mot de Passe">

       <input type="password" id="confirm-password" class="account-input" name="password_confirm"
       placeholder="Confirmation de mot de passe">

       <input type="submit" value="Submit" name="register">
     </form>
   </div>
 </section>

