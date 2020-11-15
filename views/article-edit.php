<?php require('views/layouts/header.php') ?>


<h1>Modification de l'article :</h1>
<form action="<?= BASE_URL ?>/article/<?= $article->id ?>/update/" method="POST">
    <div class="form-group">
        <?= isset($_SESSION['___FLASH___']['errors']) ? '<div class="alert alert-danger" role="alert"> ' . $_SESSION['___FLASH___']['errors'] . ' </div>' : '' ?>
        <label for="exampleInputEmail1">Titre</label>
        <input type="text" class="form-control" id="title" aria-describedby="emailHelp" name="title" placeholder="Titre de l'article" value="<?= $article->title ?? '' ?>">
    </div>
    <div class="form-group">
        <?= isset($_SESSION['___FLASH___']['errors']) ? '<div class="alert alert-danger" role="alert"> ' . $_SESSION['___FLASH___']['errors'] . ' </div>' : '' ?>
        <label for="exampleInputPassword1">Contenu</label>
        <textarea class="form-control" id="text" name="text" rows="12" placeholder="Contenu de l'article"><?= $article->text ?? '' ?></textarea>
    </div>
    <button type="submit" class="btn btn-success">Modifier</button>
</form>


<?php require('views/layouts/footer.php'); ?>
