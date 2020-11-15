<?php
class ArticleController extends Controller
{
    protected $rules = [
        'title' => 'required',
        'text' => 'required'
    ];


    public function index()
    {
    }
    public function show($id)
    {
        $stylizer = new Stylizer();
        $article = Article::find($id);
        
        $comments = Comment::getForArticle($id);
        $data = compact('article', 'comments');
        $view = new View('article');
                        
        $view->render($data);
    }
    public function create($data)
    {
        $view = new View('article-create');
        
        $view->render(compact($data));
    }
    public function store($data)
    {
        $errors = [];

        if ($this->checkfield($data)) {
            $article = Article::create($data);
            flash("message", "L'article a bien été posté !");
            header('location:' .  BASE_URL . '/article/' . $article->id);
        } else {
            header('location:' .  BASE_URL . '/article/create');
        }
    }

    public function edit($id)
    {
        $article = Article::find($id);

        $view = new View('article-edit');
        $view->render(compact('article'));
    }
    
    public function update($data, $id)
    {
        /* idée
            * Beaucoup de répétition de code, ce serait bien de pouvoir réutiliser store et de lui faire gérer différent type de requête en fonction de ce qu'il se passe dans l'URL.

            * Faire un système de soft delete / hard delete avec une page dédié
        */
        
        $stylizer = new Stylizer();
        $errors = [];

        if (empty($data['title'])) {
            $errors['title'] = "Le titre est vide.";
        }
        if (empty($data['text'])) {
            $errors['text'] = "Le contenu ne doit pas être vide.";
        }
        if (empty($errors)) {
            $article = Article::update($data, $id);
            

            flash("message", "L'article a bien été modifié.");
            
            header('location:' .  BASE_URL . '/article/' . $id);
        } else {
            flash('data', $data);
            flash('errors', $errors);
            
            header('location:' .  BASE_URL . "/article/{$id}/edit");
        }
    }

    public function softdelete()
    {
        $articles = Article::get();
        $view = new View('article-softdelete');
        $view->render(compact('articles'));
    }

    public function soft_destroy($id)
    {
        $errors = [];

        if (empty($id)) {
            $errors['id'] = "L'id est vide";
        }
        if (empty($errors)) {
            $article = Article::soft_destroy($id);
            
            flash("message", "L'article a bien été supprimé.");
            header('location:' .  BASE_URL . '/');
        } else {
            $_SESSION['data'] = $data;
            $_SESSION['errors'] = $errors;
            header('location:' .  BASE_URL . '/');
        }
    }

    public function hard_destroy($id)
    {
        $errors = [];

        if (empty($id)) {
            $errors['id'] = "L'id est vide";
        }
        if (empty($errors)) {
            $article = Article::hard_destroy($id);
            
            flash("message", "L'article a bien été supprimé définitivement.");
            header('location:' .  BASE_URL . '/');
        } else {
            $_SESSION['data'] = $data;
            $_SESSION['errors'] = $errors;
            header('location:' .  BASE_URL . '/');
        }
    }

    public function restore($id)
    {
        $errors = [];

        if (empty($id)) {
            $errors['id'] = "L'id est vide";
        }
        if (empty($errors)) {
            $article = Article::restore($id);
            
            flash("message", "L'article a bien été restauré.");
            header('location:' .  BASE_URL . '/');
        } else {
            $_SESSION['errors'] = $errors;
            header('location:' .  BASE_URL . '/');
        }
    }
}
