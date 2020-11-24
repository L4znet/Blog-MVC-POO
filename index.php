<?php
session_start();

define('BASE_URL', '/blog_mvc_poo');

require('vendor/autoload.php');
require('inc/helpers.php');

require('app/controllers/Controller.php');
require('app/models/Model.php');
require('app/controllers/ArticleController.php');
require('app/controllers/CommentController.php');
require('app/controllers/HomeController.php');
require('app/controllers/UsersController.php');
require('app/views/Stylizer.php');
require('app/views/View.php');
require('app/models/Article.php');
require('app/models/Comment.php');
require('app/models/Users.php');

$uri = $_SERVER['REQUEST_URI'];
$uri = substr($uri, strlen(BASE_URL));
$uri = '/' . trim($uri, '/');


if (isset($_SESSION['auth'])) {
    $auth = $_SESSION['auth'];
}

switch (1) {

    case preg_match('#^/users/create$#', $uri):
       
         $controller = new UsersController();
        if (isset($auth)) {
            $can = $controller->can(2, $controller->getRank($auth['id']));
            if ($can) {
                $controller->store($_POST);
            } else {
                $controller->cant();
            }
        } else {
            $controller->cant();
        }
        break;
    case preg_match('#^/users/([0-9]+)/update$#i', $uri, $matches):
       
        $controller = new UsersController();
        $controller->update($_POST, $matches[1]);

        break;

    case preg_match('#^/users/([0-9]+)/edit$#i', $uri, $matches):
       
        $controller = new UsersController();
         if (isset($auth)) {
             $can = $controller->can(2, $controller->getRank($auth['id']));
             if ($can) {
                 $controller->edit($matches[1]);
             } else {
                 $controller->cant();
             }
         } else {
             $controller->cant();
         }
        break;
    case preg_match('#^/users/([0-9]+)/delete$#i', $uri, $matches):
       
        $controller = new UsersController();
         if (isset($auth)) {
             $can = $controller->can(2, $controller->getRank($auth['id']));
             if ($can) {
                 $controller->delete($matches[1]);
             } else {
                 $controller->cant();
             }
         } else {
             $controller->cant();
         }
        break;
    case preg_match('#^/users/manage$#i', $uri):
       
        $controller = new UsersController();
         if (isset($auth)) {
             $can = $controller->can(2, $controller->getRank($auth['id']));
             if ($can) {
                 $controller->show();
             } else {
                 $controller->cant();
             }
         } else {
             $controller->cant();
         }
        break;

    case preg_match('#^/users/logout$#i', $uri):
       $controller = new UsersController();
        $controller->logout();

        break;
    case preg_match('#^/users/connect$#i', $uri):
       $controller = new UsersController();
        $controller->index();

        break;
    case preg_match('#^/users/auth$#i', $uri):
       $controller = new UsersController();
        $controller->auth($_POST);

        break;

    case preg_match('#^/article/comments$#i', $uri):
       
       $users_controller = new UsersController();
         if (isset($auth)) {
             $can = $users_controller->can(2, $users_controller->getRank($auth['id']));
             if ($can) {
                 $controller = new CommentController();
                 $controller->index();
             } else {
                 $users_controller->cant();
             }
         } else {
             $users_controller->cant();
         }
        break;

    case preg_match('#^/article/([0-9]+)/comment/([0-9]+)/edit$#i', $uri, $matches):
       
        $controller = new CommentController();
        $controller->edit($matches[2]);

        break;

    case preg_match('#^/article/([0-9]+)/comment/([0-9]+)/update$#i', $uri, $matches):
       
        $controller = new CommentController();
        $controller->update($_POST, intval($matches[1]), intval($matches[2]));

        break;
        
    case preg_match('#^/article/([0-9]+)/comment/([0-9]+)/delete$#i', $uri, $matches):
       
        $controller = new CommentController();
        $controller->deleteForArticle(intval($matches[1]), intval($matches[2]));

        break;

    case preg_match('#^/article/comment/([0-9]+)/delete$#i', $uri, $matches):
       
        $controller = new CommentController();
        $controller->delete(intval($matches[1]));

        break;
        
    case preg_match('#^/article/comment/([0-9]+)/validate$#i', $uri, $matches):
       
        $controller = new CommentController();
        $controller->validate(intval($matches[1]));

        break;

    case preg_match('#^/article/([0-9]+)/comment/store$#i', $uri, $matches):
       
        $controller = new CommentController();
//
        $controller->store($_POST, intval($matches[1]));

        break;

    case preg_match('#^/article/([0-9]+)/comment/create$#i', $uri):
       
        $controller = new CommentController();
        $controller->create($_POST);

        break;

    case preg_match('#^/article/([0-9]+)$#i', $uri, $matches):
       
        $controller = new ArticleController();
        $controller->show($matches[1]);

        break;

    case preg_match('#^/article/create$#', $uri):
       
         $users_controller = new UsersController();
        if (isset($auth)) {
            $can = $users_controller->can(2, $users_controller->getRank($auth['id']));
            if ($can) {
                $controller = new ArticleController();
                $controller->create($_POST);
            } else {
                $users_controller->cant();
            }
        } else {
            $users_controller->cant();
        }
        break;

    case preg_match('#^/article/store$#', $uri):
       
        $controller = new ArticleController();
        $controller->store($_POST);

        break;

    case preg_match('#^/article/([0-9]+)/edit$#i', $uri, $matches):
        $users_controller = new UsersController();
        if (isset($auth)) {
            $can = $users_controller->can(2, $users_controller->getRank($auth['id']));
            if ($can) {
                $controller = new ArticleController();
                $controller->edit($matches[1]);
            } else {
                $users_controller->cant();
            }
        } else {
            $users_controller->cant();
        }
        
        break;

    case preg_match('#^/article/([0-9]+)/update$#i', $uri, $matches):
       
        $controller = new ArticleController();
        $controller->update($_POST, $matches[1]);

        break;


    case preg_match('#^/article/deleted$#i', $uri, $matches):
       
         $controller = new ArticleController();
         $controller->softdelete();
        break;

    case preg_match('#^/article/([0-9]+)/soft_destroy$#i', $uri, $matches):
       
        $users_controller = new UsersController();
        if (isset($auth)) {
            $can = $users_controller->can(2, $users_controller->getRank($auth['id']));
            if ($can) {
                $controller = new ArticleController();
                $controller->soft_destroy($matches[1]);
            } else {
                $users_controller->cant();
            }
        } else {
            $users_controller->cant();
        }
        break;


    case preg_match('#^/article/([0-9]+)/restore$#i', $uri, $matches):
       
        $users_controller = new UsersController();
        if (isset($auth)) {
            $can = $users_controller->can(2, $users_controller->getRank($auth['id']));
            if ($can) {
                $controller = new ArticleController();
                $controller->restore($matches[1]);
            } else {
                $users_controller->cant();
            }
        } else {
            $users_controller->cant();
        }

        break;

    case preg_match('#^/article/([0-9]+)/hard_destroy$#i', $uri, $matches):
       
        $controller = new ArticleController();
        $controller->hard_destroy($matches[1]);

        break;



    case preg_match('#^/$#i', $uri, $matches):
    case preg_match('#^/index\.php$#i', $uri, $matches):
        
        $controller = new HomeController;
        $controller->index();

        break;

    default:
        echo 'non trouvé';
}
