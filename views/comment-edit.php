<?php require('views/layouts/header.php') ?>

<h1>Modification du commentaire :</h1>
<form action="<?= BASE_URL ?>/article/<?= $comment->article_id ?>/comment/<?= $comment->id ?>/update" method="POST">

    <div class="form-group">
        <?= isset($errors['author']) ? '<div class="alert alert-danger" role="alert"> ' . $errors["author"] . ' </div>' : '' ?>
        <label for="author">Auteur</label>
        <input type="text" class="form-control" id="author" aria-describedby="emailHelp" name="author" placeholder="Auteur" value="<?= $comment->author ?? '' ?>">
    </div>
    <div class="form-group">
        <?= isset($errors['text']) ? '<div class="alert alert-danger" role="alert"> ' . $errors["text"] . ' </div>' : '' ?>
        <label for="text">Commentaire</label>
        <textarea class="form-control" id="text" name="text" rows="5" placeholder="Commentaire"><?= $comment->text ?? '' ?></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Commenter</button>
</form>


<?php require('views/layouts/footer.php') ?>
