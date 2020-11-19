<?php
if(!isset($_GET['id']) OR !is_numeric($_GET['id']))
header('Location: index.php');
else
{
    extract($_GET);
    $id = strip_tags($id);

    require_once('config/functions.php');

    if(!empty($_POST))
    {
        extract($_POST);
        $errors = array();

        $auteur = strip_tags($auteur);
        $comment = strip_tags($comment);

        if(empty($auteur))
          array_push($errors, 'Entrez un pseudo');

          if(empty($comment))
          array_push($errors, 'Entrez un commentaire');

          if(count($errors) == 0)
          {
              $comment = addComment($id, $auteur, $comment);

              $success = 'Votre commentaire a été publié';

              unset($auteur);
              unset($comment);
          }
    }

    $article = getArticle($id);
    $comments = getComments($id);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <title><?= $article->titre ?></title>
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="https://kit.fontawesome.com/a076d05399.js"></script> -->
</head>

<body>
    <a href="index.php">Retour aux articles</a>

    <div class="container-fluid">
        <h1><?= $article->titre ?></h1>
        <time><?= $article->date ?></time>
        <p><?= $article->contenue ?></p>
        <hr />

        <?php
    if(isset($success))
       echo $success;

    if(!empty($errors)):?>

        <?php foreach($errors as $error): ?>
              <div class="row">
                 <div class="col-md-6">
                     <div class="alert alert-danger"><?= $error ?></div>
                 </div>
              </div>
        <?php endforeach; ?>
        <?php endif; ?>
        
        <div class="row">
            <div class="col-md-6">
              <form action="article.php?id=<?= $article->id ?>" methode="post">
                  <p><label for="auteur">Pseudo :</label></br>
                  <input type="text" name="auteur" id="auteur" value="<?php if(isset($auteur)) echo $auteur ?>" class="form-control" />
                  </p>
                  <p><label for="comment">Commentaire :</label><br />
                  <textarea name="comment" id="comment" cols="30"
                    rows="5" class="form-control"><?php if(isset($comment)) echo $comment ?></textarea>
                  </p>
                  <button type="submit" class="btn btn-success">Envoyer</button>
              </form>
            </div>
        </div> 

        

        <h2>Commentaires :</h2>

        <?php foreach($comments as $com): ?>
        <h3><?= $com->auteur ?></h3>
        <time><?= $com->date ?></time>
        <p><?= $com->comment ?></p>
        <?php endforeach; ?>
    </div>
</body>

</html>