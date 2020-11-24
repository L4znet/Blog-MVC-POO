<!doctype html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
        <meta name="generator" content="Jekyll v4.1.1">
        <title><?= $this->page_title ?></title>

        <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/blog/">

        <!-- Bootstrap core CSS -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.3/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

        <!-- Favicons -->
        <link rel="apple-touch-icon" href="/docs/4.5/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
        <link rel="icon" href="/docs/4.5/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
        <link rel="icon" href="/docs/4.5/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
        <link rel="manifest" href="/docs/4.5/assets/img/favicons/manifest.json">
        <link rel="mask-icon" href="/docs/4.5/assets/img/favicons/safari-pinned-tab.svg" color="#563d7c">
        <link rel="icon" href="/docs/4.5/assets/img/favicons/favicon.ico">
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css' />
        <meta name="msapplication-config" content="/docs/4.5/assets/img/favicons/browserconfig.xml">
        <meta name="theme-color" content="#563d7c">
        <!-- Custom styles for this template -->
        <link href="https://fonts.googleapis.com/css?family=Playfair+Display:700,900" rel="stylesheet">
        <!-- Custom styles for this template -->
        <link href="/blog_mvc/public/css/blog.css" rel="stylesheet">
    </head>

    <body>
        <div class="container">
            <header class="blog-header py-3">
                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <a class="navbar-brand" href="<?= BASE_URL ?>">Medium</a>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item active">
                                <a class="nav-link" href="<?= BASE_URL ?>"> Home <span class="sr-only">(current)</span></a>
                            </li>
                            <?php
                                if (isset($_SESSION['auth']['auth']) && $_SESSION['auth']['auth']) {
                                    echo '<li class="nav-item">
                                <a class="nav-link" href="' .  BASE_URL . '/article/deleted">Article supprimé</a>
                            </li>';
                                    echo '<li class="nav-item">
                                <a class="nav-link" href="' .  BASE_URL . '/article/comments">Commentaires</a>
                            </li>';
                                    echo '<li class="nav-item">
                                <a class="nav-link" href="' .  BASE_URL . '/article/create">Poster un article</a>
                            </li>';
                                    echo '<li class="nav-item">
                                <a class="nav-link" href="' .  BASE_URL . '/users/manage">Utilisateurs</a>
                            </li>';
                                    echo '<li class="nav-item">
                                <a class="nav-link" href="'. BASE_URL .'/users/logout">Déconnexion</a>
                            </li>';
                                } else {
                                    echo '<li class="nav-item">
                                <a class="nav-link" href="'. BASE_URL .'/users/connect">Connexion</a>
                            </li>';
                                }

                            ?>
                        </ul>

                        <!--
                            Pour intégrer un système de recherche
                            <form class="form-inline my-2 my-lg-0">
                            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                        </form>
                         !-->
                    </div>
                </nav>
            </header>

            <?= isset($message) ? '<div class="alert alert-success" role="alert"> ' . $message . ' </div>' : '' ?>
            <!--    <div class="nav-scroller py-1 mb-2"> <nav class="nav d-flex justify-content-between"> <a class="p-2 text-muted" href="#">World</a>  </nav>   </div> !-->
