<?php

class CommentController extends Controller
{
    private $rules = [
        'author' => 'required',
        'text' => 'required'
    ];


    public function index()
    {
        $comments = Comment::getNotValidate();
        
        $view = new View('comments');
        $data = compact('comments');
        $view->render($data);
    }

 
    public function store($data, $article_id)
    {
        $stylizer = new Stylizer();

    
        if ($this->checkfield($data)) {
            $data['article_id'] = $article_id;
            $comments = Comment::create($data);
            
            flash("message", "Le commentaire a bien été posté !");
            header('location:' .  BASE_URL . '/article/' . $article_id);
        } else {
            header('location:' .  BASE_URL . '/article/' . $article_id);
        }
    }

    public function edit($id)
    {
        $comment = Comment::find($id);
        $view = new View('comment-edit');
        $view->render(compact('comment'));
    }
    
    public function update($data, $article_id, $comment_id)
    {
        $stylizer = new Stylizer();
        $errors = [];


        if (empty($data['author'])) {
            $errors['title'] = "L'auteur est vide.";
        }
        if (empty($data['text'])) {
            $errors['text'] = "Le contenu ne doit pas être vide.";
        }
        if (empty($errors)) {
            $comment = Comment::update($data, $comment_id);
        
            flash("message", "Le commentaire a bien été modifié.");
            
            header("location:" . BASE_URL . "/article/{$article_id}");
        } else {
            flash('data', $data);
            flash('errors', $errors);
            
            header('location:' .  BASE_URL . "/article/{$article_id}");
        }
    }

    public function delete($id)
    {
        $errors = [];

        if (empty($id)) {
            $errors['id'] = "L'id n'est pas défini.";
        }
        if (empty($errors)) {
            $article = Comment::delete($id);
            
            flash("message", "Le commentaire a bien été supprimé définitivement.");
            header('location:' .  BASE_URL . '/article/comments');
        } else {
            flash('data', $data);
            flash('errors', $errors);
            header('location:' .  BASE_URL . '/article/comments');
        }
    }

    public function deleteForArticle($article_id, $id)
    {
        $errors = [];

        if (empty($id)) {
            $errors['id'] = "L'id n'est pas défini.";
        }
        if (empty($errors)) {
            $article = Comment::delete($id);
            
            flash("message", "Le commentaire a bien été supprimé définitivement.");
            header("location:" .  BASE_URL . "/article/{$article_id}");
        } else {
            flash('data', $data);
            flash('errors', $errors);
            header("location:" .  BASE_URL . "/article/{$article_id}");
        }
    }

    public function validate($id)
    {
        $errors = [];

        if (empty($id)) {
            $errors['id'] = "L'id n'est pas défini.";
        }
        if (empty($errors)) {
            $result = Comment::validate($id);

            if ($result) {
                flash("message", "Le commentaire a bien été validé.");
                header('location:' .  BASE_URL . '/article/comments');
            } else {
                flash("message", "Un problème a été rencontré");
                header('location:' .  BASE_URL . '/article/comments');
            }
        } else {
            flash('errors', $errors);
            header('location:' .  BASE_URL . '/article/comments');
        }
    }
}
