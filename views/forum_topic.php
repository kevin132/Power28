<?php
if (isset($_GET['categorie']) AND !empty($_GET['categorie'])) {
    $get_categorie = htmlspecialchars($_GET['categorie']);
    $categories = array();
    $req_categories = $db->query('SELECT * FROM f_categories');
    while ($c = $req_categories->fetch()) {
        array_push($categories, array($c['id'], url_custom_encode($c['nom'])));
    }
    foreach ($categories as $cat) {
        if (in_array($get_categorie, $cat)) {
            $id_categorie = intval($cat[0]);
        }
    }
    if ($id_categorie) {
        if (isset($_GET['souscategorie']) AND !empty($_GET['souscategorie'])) {
            $get_souscategorie = htmlspecialchars($_GET['souscategorie']);
            $souscategories = array();
            $req_souscategories = $db->prepare('SELECT * FROM f_souscategories WHERE id_categorie = ?');
            $req_souscategories->execute(array($id_categorie));
            while ($c = $req_souscategories->fetch()) {
                array_push($souscategories, array($c['id'], url_custom_encode($c['nom'])));
            }
            foreach ($souscategories as $cat) {
                if (in_array($get_souscategorie, $cat)) {
                    $id_souscategorie = intval($cat[0]);
                }
            }
        }
        $req = 'SELECT * FROM f_topics
            LEFT JOIN f_topics_categories ON f_topics.id = f_topics_categories.id_topics
            LEFT JOIN f_categories ON f_topics_categories.id_categorie = f_categories.id
            LEFT JOIN f_souscategories ON f_topics_categories.id_souscategorie = f_souscategories.id
          ';

        if (@$id_souscategorie) {

            $exec_array = array($id_categorie, $id_souscategorie);
        } else {
            $exec_array = array($id_categorie);
        }

        $req .= " ORDER BY f_topics.id DESC";

        $topics = $db->prepare($req);
        $topics->execute($exec_array);

    } else {
        die('Erreur: Catégorie introuvable...');
    }
} else {
    die('Erreur: Aucune catégorie sélectionnée...');
}
?>

<table class="forum">
     <tr class="header">
          <th class="main">Sujet</th>
          <th class="sub-info w10">Messages</th>

          <th class="sub-info w20">Création</th>
     </tr>

    <?php if (!empty($topics)):

        while ($t = $topics->fetch()):
            ?>
             <tr>
                  <td class="main">
                       <h4><a href=""><?= $t['sujet'] ?></a></h4>
                  </td>
                  <td class="sub-info"><?= $t['contenu'] ?></td>

                  <td class="sub-info"><?= $t['date_heure_creation'] ?></td>
             </tr>
        <?php endwhile; ?>

    <?php endif;


    ?>

</table>
