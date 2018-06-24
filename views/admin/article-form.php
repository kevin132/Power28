<?php

require_once '../tools/common.php';


//Si $_POST['save'] existe, cela signifie que c'est un ajout d'article
if (isset($_POST['save'])) {

    $query = $db->prepare('INSERT INTO screen (title,content, created_at) VALUES (?, ?,NOW())');
    $newArticle = $query->execute(
        [
            $_POST['title'],

            $_POST['content']

        ]
    );

    //on récupère l'id du dernier enregistrement en base de données (ici l'article inséré ci-dessus)
    $lastInsertedArticleId = $db->lastInsertId();

    foreach ($_POST['categories'] as $category_id) {
        $query = $db->prepare('INSERT INTO article_category (article_id, category_id) VALUES (?, ?)');
        $newArticle = $query->execute([
            $lastInsertedArticleId,
            $category_id,
        ]);
    }

    //redirection après enregistrement
    //si $newArticle alors l'enregistrement a fonctionné
    if ($newArticle) {

        //upload de l'image si image envoyée via le formulaire
        if (!empty($_FILES['image']['name'])) {

            //tableau des extentions que l'on accepte d'uploader
            $allowed_extensions = array('jpg', 'jpeg', 'gif', 'png');
            //extension dufichier envoyé via le formulaire
            $my_file_extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);

            //si l'extension du fichier envoyé est présente dans le tableau des extensions acceptées
            if (in_array($my_file_extension, $allowed_extensions)) {

                //je génrère une chaîne de caractères aléatoires qui servira de nom de fichier
                //le but étant de ne pas écraser un éventuel fichier ayant le même nom déjà sur le serveur
                $new_file_name = $_FILES['image']['name'];

                //destination du fichier sur le serveur (chemin + nom complet avec extension)
                $destination = '../img/article/' . $new_file_name;

                //déplacement du fichier à partir du dossier temporaire du serveur vers sa destination
                $result = move_uploaded_file($_FILES['image']['tmp_name'], $destination);

                //mise à jour de l'article enregistré ci-dessus avec le nom du fichier image qui lui sera associé
                $query = $db->prepare('UPDATE screen SET
					image = :image
					WHERE id = :id'
                );

                $resultUpdateImage = $query->execute(
                    [
                        'image' => $new_file_name,
                        'id' => $lastInsertedArticleId
                    ]
                );
            }
        }

        //redirection après enregistrement
        header('location:../index.php');
        exit;
    } else { //si pas $newArticle => enregistrement échoué => générer un message pour l'administrateur à afficher plus bas
        $message = "Impossible d'enregistrer le nouvel article...";
    }
}


//Si $_POST['update'] existe, cela signifie que c'est une mise à jour d'article
if (isset($_POST['update'])) {

    $query = $db->prepare('UPDATE screen SET
		title = :title
		WHERE id = :id'
    );

    //mise à jour avec les données du formulaire
    $resultArticle = $query->execute([
        'title' => $_POST['title'],
        'id' => $_POST['id'],
    ]);

    $query = $db->prepare('DELETE FROM article_category WHERE article_id = ?');
    $result = $query->execute([
        $_POST['id']
    ]);

    foreach ($_POST['categories'] as $category_id) {
        $query = $db->prepare('INSERT INTO article_category (article_id, category_id) VALUES (?, ?)');
        $newArticle = $query->execute([
            $_POST['id'],
            $category_id,
        ]);
    }

    //si enregistrement ok

}

//si on modifie un article, on doit séléctionner l'article en question (id envoyé dans URL) pour pré-remplir le formulaire plus bas
if (isset($_GET['article_id']) && isset($_GET['action']) && $_GET['action'] == 'edit') {

    $query = $db->prepare('SELECT * FROM screen WHERE id = ?');
    $query->execute(array($_GET['article_id']));
    //$article contiendra les informations de l'article dont l'id a été envoyé en paramètre d'URL
    $article = $query->fetch();

    $query = $db->prepare('SELECT category_id FROM article_category WHERE article_id = ?');
    $query->execute(array($_GET['article_id']));

    $articleCategories = $query->fetchAll();

    //selection des images liées à l'article
    $query = $db->prepare('SELECT * FROM screen WHERE article_id = ? ORDER BY id DESC');
    $query->execute(array($_GET['article_id']));
    $articleImages = $query->fetchAll();

}

//si une image a été soumise
if (isset($_POST['add_image'])) {

    $query = $db->prepare('INSERT INTO image (caption, article_id) VALUES (?, ?)');
    $newImage = $query->execute([
        $_POST['caption'],
        $_POST['article_id']
    ]);

    //on récupère l'ID de l'image que l'on vient d'enregistrer en BDD
    $lastInsertedImageId = $db->lastInsertId();

    //si enregistrement ok
    if ($newImage) {
        if (isset($_FILES['image'])) {

            $allowed_extensions = array('jpg', 'jpeg', 'gif', 'png');
            $my_file_extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);

            if (in_array($my_file_extension, $allowed_extensions)) {

                $new_file_name = md5(rand());
                $destination = '../img/article/' . $new_file_name . '.' . $my_file_extension;
                $result = move_uploaded_file($_FILES['image']['tmp_name'], $destination);

                //mise à jour de l'image enregistrée avec le nom de fichier généré
                $query = $db->prepare('UPDATE image SET
					name = :name
					WHERE id = :id'
                );
                $resultUpdateImage = $query->execute([
                    'name' => $new_file_name . '.' . $my_file_extension,
                    'id' => $lastInsertedImageId
                ]);
            }
        }

        $imgMessage = "Image ajoutée avec succès !";
    }
}
//suppression d'une image
if (isset($_POST['delete_image'])) {
    $query = $db->prepare('SELECT name FROM image WHERE id = ?');
    $query->execute([$_POST['img_id']]);
    $ImgToUnlink = $query->fetch();

    unlink('../img/article/' . $ImgToUnlink['name']);

    $queryDelete = $db->prepare('DELETE FROM image WHERE id=?');
    $queryDelete->execute([$_POST['img_id']]);

    $imgMessage = "Image Supprimée avec succès !";
}

?>

<!DOCTYPE html>
<html>
<head>

     <title>Administration des articles - Mon premier blog !</title>

    <?php require 'partials/head_assets.php'; ?>

</head>
<body class="index-body">
<div class="container-fluid">

    <?php require 'partials/header.php'; ?>

     <div class="row my-3 index-content">


          <section class="col-9">
               <header class="pb-3">
                    <!-- Si $article existe, on affiche "Modifier" SINON on affiche "Ajouter" -->
                    <h4><?php if (isset($article)): ?>Modifier<?php else: ?>Ajouter<?php endif; ?> un article</h4>
               </header>

               <ul class="nav nav-tabs justify-content-center nav-fill" role="tablist">
                    <li class="nav-item">
                         <a class="nav-link <?php if (isset($_POST['save']) || isset($_POST['update']) || (!isset($_POST['add_image']) && !isset($_POST['delete_image']))): ?>active<?php endif; ?>"
                            data-toggle="tab" href="#infos" role="tab">Infos</a>
                    </li>
                   <?php if (isset($article)): ?>
                        <li class="nav-item">
                             <a class="nav-link <?php if (isset($_POST['add_image']) || isset($_POST['delete_image'])): ?>active<?php endif; ?>"
                                data-toggle="tab" href="#images" role="tab">Images</a>
                        </li>
                   <?php endif; ?>
               </ul>

               <div class="tab-content">
                    <div class="tab-pane container-fluid <?php if (isset($_POST['save']) || isset($_POST['update']) || (!isset($_POST['add_image']) && !isset($_POST['delete_image']))): ?>active<?php endif; ?>"
                         id="infos" role="tabpanel">

                        <?php if (isset($message)): //si un message a été généré plus haut, l'afficher ?>
                             <div class="bg-danger text-white">
                                 <?php echo $message; ?>
                             </div>
                        <?php endif; ?>

                         <!-- Si $article existe, chaque champ du formulaire sera pré-remplit avec les informations de l'article -->
                         <form action="article-form.php" method="post" enctype="multipart/form-data">

                              <div class="form-group">
                                   <label for="title">Titre :</label>
                                   <input class="form-control"
                                          <?php if (isset($article)): ?>value="<?php echo htmlentities($article['title']); ?>"<?php endif; ?>
                                          type="text" placeholder="Titre" name="title" id="title"/>
                              </div>

                              <div class="form-group">
                                   <label for="content">Contenu :</label>
                                   <textarea class="form-control" name="content" id="content" placeholder="Contenu"><?php if(isset($article)): ?><?php echo htmlentities($article['content']); ?><?php endif; ?></textarea>
                              </div>
                              <div class="form-group">
                                   <label for="image">Image :</label>
                                   <input class="form-control" type="file" name="image" id="image"/>
                                  <?php if (isset($article) && $article['image']): ?>
                                       <img class="img-fluid py-4" src="../img/article/<?php echo $article['image']; ?>"
                                            alt=""/>
                                       <input type="hidden" name="current-image"
                                              value="<?php echo $article['image']; ?>"/>
                                  <?php endif; ?>
                              </div>

                              <div class="form-group">
                                   <label for="categories"> Catégorie </label>
                                   <select class="form-control" name="categories[]" id="categories" multiple="multiple">
                                       <?php
                                       $queryCategory = $db->query('SELECT * FROM category');
                                       $categories = $queryCategory->fetchAll();
                                       ?>
                                       <?php foreach ($categories as $key => $category) : ?>

                                           <?php
                                           $selected = '';

                                           foreach ($articleCategories as $articleCategorie) {
                                               if ($category['id'] == $articleCategorie['category_id']) {
                                                   $selected = 'selected="selected"';
                                               }
                                           }
                                           ?>
                                            <option value="<?php echo $category['id']; ?>" <?php echo $selected; ?>> <?php echo $category['name']; ?> </option>
                                       <?php endforeach; ?>

                                   </select>
                              </div>


                              <div class="text-right">
                                   <!-- Si $article existe, on affiche un lien de mise à jour -->
                                  <?php if (isset($article)): ?>
                                       <input class="btn btn-success" type="submit" name="update"
                                              value="Mettre à jour"/>
                                       <!-- Sinon on afficher un lien d'enregistrement d'un nouvel article -->
                                  <?php else: ?>
                                       <input class="btn btn-success" type="submit" name="save" value="Enregistrer"/>
                                  <?php endif; ?>
                              </div>

                              <!-- Si $article existe, on ajoute un champ caché contenant l'id de l'article à modifier pour la requête UPDATE -->
                             <?php if (isset($article)): ?>
                                  <input type="hidden" name="id" value="<?php echo $article['id']; ?>"/>
                             <?php endif; ?>

                         </form>
                    </div>
                   <?php if (isset($article)): ?>
                        <div class="tab-pane container-fluid <?php if (isset($_POST['add_image']) || isset($_POST['delete_image'])): ?>active<?php endif; ?>"
                             id="images" role="tabpanel">


                            <?php if (isset($imgMessage)): //si un message a été généré plus haut, l'afficher ?>
                                 <div class="bg-success text-white p-2 my-4">
                                     <?php echo $imgMessage; ?>
                                 </div>
                            <?php endif; ?>

                             <h5 class="mt-4"><?php if (isset($image)): ?>Modifier<?php else: ?>Ajouter<?php endif; ?>
                                  une image :</h5>

                             <form action="article-form.php?article_id=<?php echo $article['id']; ?>&action=edit"
                                   method="post" enctype="multipart/form-data">
                                  <div class="form-group">
                                       <label for="caption">Légende :</label>
                                       <input class="form-control" type="text" placeholder="Légende" name="caption"
                                              id="caption"/>
                                  </div>
                                  <div class="form-group">
                                       <label for="image">Fichier :</label>
                                       <input class="form-control" type="file" name="image" id="image"/>
                                  </div>

                                  <input type="hidden" name="article_id" value="<?php echo $article['id']; ?>"/>

                                  <div class="text-right">
                                       <input class="btn btn-success" type="submit" name="add_image"
                                              value="Enregistrer"/>
                                  </div>
                             </form>

                             <div class="row">
                                  <h5 class="col-12 pb-4">Liste des images :</h5>
                                 <?php foreach ($articleImages as $image): ?>
                                      <form action="article-form.php?article_id=<?php echo $article['id']; ?>&action=edit"
                                            method="post" class="col-4 my-3">
                                           <img src="../img/article/<?php echo $image['name']; ?>" alt=""
                                                class="img-fluid"/>
                                           <p class="my-2"><?php echo $image['caption']; ?></p>
                                           <input type="hidden" name="img_id" value="<?php echo $image['id']; ?>"/>
                                           <div class="text-right"><input class="btn btn-danger" type="submit"
                                                                          name="delete_image" value="Supprimer"/></div>
                                      </form>
                                 <?php endforeach; ?>
                             </div>
                        </div>
                   <?php endif; ?>
               </div>
          </section>
     </div>
</div>
</body>
</html>