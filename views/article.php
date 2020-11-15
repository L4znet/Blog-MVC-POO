<?php
    require('views/layouts/header.php');
    $stylizer = new Stylizer();
?>
<main role="main">
    <div class=" row mb-2 d-flex">
        <?= isset($errors['text']) ? '<div class="alert alert-danger" role="alert"> ' . $errors["text"] . ' </div>' : '' ?>
        <div class="row">
            <div class="col-md-12 blog-main">
                <div class="blog-post">
                    <h2 class="blog-post-title"><?= $article->title ?></h2>
                    <!--  <p class="blog-post-meta">January 1, 2014 by <a href="#">Mark</a></p> !-->
                    <div class="blog-post">
                        <?= $stylizer->Markdownify(nl2br($article->text)) ?>
                    </div>
                </div>
                <form action="<?= BASE_URL ?>/article/<?= $article->id ?>/comment/store" method="POST">
                    <h2>Réagir</h2>
                    <div class="form-group">
                        <?= isset($errors[0]) ? '<div class="alert alert-danger" role="alert"> ' . $errors[0] . ' </div>' : '' ?>
                        <label for="author">Auteur</label>
                        <input type="text" class="form-control" id="author" aria-describedby="emailHelp" name="author" placeholder="Auteur" value="">
                    </div>
                    <div class="form-group">
                        <?= isset($errors[1]) ? '<div class="alert alert-danger" role="alert"> ' . $errors[1] . ' </div>' : '' ?>
                        <label for="text">Commentaire</label>
                        <textarea class="form-control" id="text" name="text" rows="5" placeholder="Commentaire"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Commenter</button>
                </form>
                <?php
                foreach ($comments as $comment):
               
            ?>
                <div class="row no-gutters border w-100 rounded overflow-hidden  mb-4 shadow-sm h-md-250 position-relative">
                    <div class="col p-4 d-flex flex-column position-static">
                        <h3 class="mb-0"><?= $comment->author ?></h3>
                        <p class="mb-auto"><?= $stylizer->Markdownify($comment->text) ?></p>
                        <ul class="nav">
                            <li class="nav-item">
                                <a class="nav-link" href="<?= BASE_URL ?>/article/<?= $article->id ?>/comment/<?= $comment->id ?>/delete">Supprimer</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?= BASE_URL ?>/article/<?= $article->id ?>/comment/<?= $comment->id ?>/edit">Modifier</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <?php
                endforeach;
            ?>
            </div>
</main>

<?php require('views/layouts/footer.php') ?>
