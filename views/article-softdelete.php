<?php require('views/layouts/header.php') ?>
<?= isset($_SESSION['___FLASH___']['home_message']) ? '<div class="alert alert-danger" role="alert"> ' . $_SESSION['___FLASH___']['home_message'] . ' </div>' : '' ?>
<div class="row mb-2 d-flex">
    <?php
        foreach ($articles as $article):
        if (!is_null($article->deleted_at)):
        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9\-]+/', '-', $article->title)));
    ?>

    <div class="row no-gutters border w-100 rounded overflow-hidden  mb-4 shadow-sm h-md-250 position-relative">

        <div class="col p-4 d-flex flex-column position-static">
            <h3 class="mb-0"><?= $article->title ?></h3>


            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link" href="<?= BASE_URL ?>/article/<?= $article->id ?>/hard_destroy">Supprimer définitivement</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= BASE_URL ?>/article/<?= $article->id ?>/restore">Restaurer</a>
                </li>
            </ul>
        </div>
    </div>
    <?php
        endif;
    endforeach;
    ?>
</div>

<?php require('views/layouts/footer.php') ?>
