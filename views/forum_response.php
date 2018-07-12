<?php


if (isset($_POST['responseSubmit'])) {
    $query = $db->prepare('INSERT INTO forum_response (answers) VALUES (?)');
    $query->execute(
        [
            $_POST['answers'],

        ]
    );
}

$query2 = $db->query('SELECT * FROM forum_response');


?>
<section id="forum_response">
     <div class="container">
          <div class="response_content">
              <?php while ($a = $query2->fetch()): ?>
                   <h3> <?= $a['answers'] ?></h3>
              <?php endwhile; ?>
          </div>

          <form method="POST" action="index.php?page=forum_response">
               <div class="form-group">
                    <label for="exampleFormControlInput1">Reponse</label>
                    <input type="text" class="form-control" name="answers" id="responseMessage"
                    >
               </div>

               <a href="">
                    <button name="responseSubmit" id="responseSubmit" class="info-btn-one">Poster</button>
               </a>
          </form>
     </div>

</section>