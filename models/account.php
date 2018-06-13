<?php
function getArticle($articleId)
{

    $db = dbConnect();

    $query = $db->prepare('
      SELECT article.*, GROUP_CONCAT(category.name SEPARATOR " / ") AS categories
      FROM article  JOIN article_category ON article.id = article_category.article_id
      JOIN category ON article_category.category_id = category.id
      WHERE article.id = ? AND article.is_published = 1
      ');
    $query->execute(array($articleId));


    return $query->fetch();

}

function getRegister($registerEmail)
{
    $db=dbConnect();
    $query = $db->prepare('SELECT email FROM user WHERE email = ?');
    $query->execute(array($registerEmail));

}




if(isset($_POST['register'])){




    $userAlreadyExists = $query->fetch();

    if($userAlreadyExists){
        $registerMessage = "Adresse email déjà enregistrée";
    }
    elseif(empty($_POST['firstname']) OR empty($_POST['password']) OR empty($_POST['email'])){
        $registerMessage = "Merci de remplir tous les champs obligatoires (*)";
    }
    elseif($_POST['password'] != $_POST['password_confirm']) {
        $registerMessage = "Les mots de passe ne sont pas identiques";
    }
    else {


        $query = $db->prepare('INSERT INTO user (firstname,lastname,email,password) VALUES (?, ?, ?, ?)');
        $newUser = $query->execute(
            [
                $_POST['firstname'],
                $_POST['lastname'],
                $_POST['email'],
                hash('md5', $_POST['password']),

            ]
        );


        $_SESSION['is_admin'] = 0;
        $_SESSION['user'] = $_POST['firstname'];
    }
}

if(isset($_SESSION['user'])){
    header('location:index.php?page=prices');
    exit;
}

?>
?>