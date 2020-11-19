<?php
require_once('config/functions.php');

$articles = getArticles();
?>

<!DOCTYPE html>
<html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
    <title>Mon blog</title>
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script> -->
 </head>

 <body>
    <div class="container-fluid">
    <h1>Mon blog</h1>

    <?php foreach($articles as $article): ?>
      <h2><?= $article->titre ?></h2>
      <time><?= $article->date ?></time>
      <br />
      <br />
      <a href ="article.php?id=<?= $article->id ?>" class="btn btn-primary">Lire la suite</a>

    <?php endforeach; ?>
    </div>
 </body>
</html>
