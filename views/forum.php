<?php

if (isset($_POST['forum_save'])) {
    $query = $db->prepare('INSERT INTO forum (subject,message,date) VALUES (?, ?,NOW())');
    $newSubject = $query->execute(
        [
            $_POST['subject'],
            $_POST['message'],

        ]
    );
}
$query2 = $db->query('SELECT * FROM forum ORDER BY id asc ');
$forumPost = $query2->fetchAll();

?>

<section id="forum">
     <h3 class="text-center pb-2">Bienvenue dans l'espace de discussion de Power28</h3>
     <h4 class="text-center"> Partagez votre expérience , Améliorez le logiciel , Signalez les bugs</h4>


</section>
<section id="forum-post">
     <div class="container">

          <div class="forum_bar">
               <table>

                    <td class="forum_bar_title">Sujet</td>
                    <td class="forum_bar_title">Message</td>
                    <td class="forum_bar_title">Date de creation</td>

               </table>
          </div>
          <table>
               <div class="forum-block ">
                   <?php foreach ($forumPost as $p): ?>
                        <tr class="form-table">
                             <td class="form-list text-center">
                                  <div><b><?= $p['subject'] ?></b></div>
                             </td>
                             <td class="form-list">
                                  <div><?= $p['message'] ?></div>
                             </td>

                             <td class="form-list">
                                  <div class="row"><?= $p['date'] ?></div>
                             </td>
                        </tr>
                   <?php endforeach; ?>
               </div>
          </table>
     </div>
</section>

<p class="text-center pt-4">
     <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample"
             aria-expanded="false" aria-controls="collapseExample">
          > Nouveau sujet de discussion
     </button>
</p>
<div class="collapse" id="collapseExample">
     <div class="container">
          <div class="card card-body">
               <form method="POST" action="index.php?page=forum">
                    <div class="form-group">
                         <label for="exampleFormControlInput1">Sujet</label>
                         <input type="text" class="form-control" name="subject" id="subject"
                                placeholder="Comment fonctionne Power 28 ?">
                    </div>

                    <div class="form-group">
                         <label for="exampleFormControlTextarea1">Message</label>
                         <textarea class="form-control" name="message" id="forum-subject" rows="3"></textarea>
                    </div>
                    <a href="">
                         <button name="forum_save" class="info-btn-one">Poster</button>
                    </a>
               </form>
          </div>
     </div>
</div>