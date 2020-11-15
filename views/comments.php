<?php
    require('views/layouts/header.php');
    $stylizer = new Stylizer();
?>
<main role="main" class="<div class=" row mb-2 d-flex">

    <?php
        foreach ($comments as $comment):
    ?>

    <div class="row no-gutters border w-100 rounded overflow-hidden  mb-4 shadow-sm h-md-250 position-relative">

        <div class="col p-4 d-flex flex-column position-static">
            <h3 class="mb-0"><?= $comment->author ?></h3>
            <p class="mb-auto"><?= $stylizer->Markdownify($comment->text) ?></p>
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link" href="<?= BASE_URL ?>/article/comment/<?= $comment->id ?>/delete">Supprimer définitivement</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= BASE_URL ?>/article/comment/<?= $comment->id ?>/validate">Valider</a>
                </li>
            </ul>
        </div>
    </div>
    <?php
        endforeach;
    ?>
</main>

<?php require('views/layouts/footer.php') ?>
