<?php require('views/layouts/header.php') ?>

<form action="<?= BASE_URL ?>/article/store" method="POST">
    <div class="form-group">
        <?= isset($errors['title']) ? '<div class="alert alert-danger" role="alert"> ' . $errors["title"] . ' </div>' : '' ?>
        <label for="exampleInputEmail1">Titre</label>
        <input type="text" class="form-control" id="title" aria-describedby="emailHelp" name="title" placeholder="Titre de l'article" value="<?= $data['title'] ?? '' ?>">
    </div>
    <div class="form-group">
        <?= isset($errors['text']) ? '<div class="alert alert-danger" role="alert"> ' . $errors["text"] . ' </div>' : '' ?>
        <label for="exampleInputPassword1">Contenu</label>
        <textarea class="form-control" id="text" name="text" rows="12" placeholder="Contenu de l'article"><?= $data['text'] ?? '' ?></textarea>
    </div>
    <button type="submit" class="btn btn-success">Créer</button>
</form>


<?php require('views/layouts/footer.php') ?>
