<?php

/*
if(!isset($_SESSION['is_admin']) OR $_SESSION['is_admin'] == 0){
	header('location:../admin.php');
	exit;
}
*/
//supprimer la catégorie dont l'ID est envoyé en paramètre URL
if (isset($_GET['faq_id']) && isset($_GET['action']) && $_GET['action'] == 'delete') {

    $query = $db->prepare('DELETE FROM faq WHERE id = ?');
    $result = $query->execute(
        [
            $_GET['faq_id']
        ]
    );
    //générer un message à afficher plus bas pour l'administrateur
    if ($result) {
        $message = "Suppression efféctuée.";
    } else {
        $message = "Impossible de supprimer la séléction.";
    }
}

//séléctionner toutes les catégories pour affichage de la liste
$query = $db->prepare('SELECT * FROM faq');
$query->execute();
$faq = $query->fetchAll();
?>
<section class="col-9">
     <header class="pb-4 d-flex justify-content-between">
          <h4>Liste des catégories</h4>
          <a class="btn btn-primary" href="../index.php?page=admin-faq-form">Ajouter une catégorie</a>
     </header>

    <?php if (isset($message)): //si un message a été généré plus haut, l'afficher ?>
         <div class="bg-success text-white p-2 mb-4">
             <?php echo $message; ?>
         </div>
    <?php endif; ?>

     <table class="table table-striped">
          <thead>
          <tr>
               <th>#</th>
               <th>questions</th>
               <th>réponses</th>
               <th>Action</th>
          </tr>
          </thead>
          <tbody>

          <?php if ($faq): ?>
              <?php foreach ($faq as $f): ?>

                    <tr>
                         <!-- htmlentities sert à écrire les balises html sans les interpréter -->
                         <th><?php echo htmlentities($f['id']); ?></th>
                         <td><?php echo htmlentities($f['answers']); ?></td>
                         <td><?php echo htmlentities($f['questions']); ?></td>
                         <td>
                              <a href="faq-form.php?category_id=<?php echo $faq['faq_id']; ?>&action=edit"
                                 class="btn btn-warning">Modifier</a>
                              <a onclick="return confirm('Are you sure?')"
                                 href="faq-list.php?faq_id=<?php echo $f['id']; ?>&action=delete"
                                 class="btn btn-danger">Supprimer</a>
                         </td>
                    </tr>

              <?php endforeach; ?>
          <?php else: ?>
               Aucune catégorie enregistré.
          <?php endif; ?>

          </tbody>
     </table>

</section>

