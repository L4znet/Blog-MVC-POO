<?php
class UsersController extends Controller
{
    public function show()
    {
        $users = Users::get();
        $data = compact('users');
        $view = new View('users-manage');
        $view->render($data);
    }

    public function delete($id)
    {
        Users::delete($id);
        redirect('/users/manage');
    }

    public function index()
    {
        $view = new View('connect');
        $view->render();
    }

    
    public function logout()
    {
        unset($_SESSION['auth']);
        redirect();
    }

    public function auth($data)
    {
        $errors = [];
        if (empty($data['username'])) {
            $errors['username'] = "Vous devez saisir un nom d'utilisateur";
        }

        if (empty($data['password'])) {
            $errors['password'] = "Vous devez saisir un mot de passe";
        }

        $dataFromDb = Users::findUsingParams('username', $data['username']);
        if (!$dataFromDb) {
            $errors['all'] = "Compte non trouvé";
        }

        if (!password_verify($data['password'], $dataFromDb->password)) {
            $errors['password'] = "Mot de passe incorrect";
        }

        if (empty($errors)) {
            $_SESSION['auth'] = array('id' => $dataFromDb->id, 'auth' => true);
            redirect();
        } else {
            // Affichage des erreurs
        }
    }

    public function getRank($id)
    {
        $data = Users::find($id);
        return $data->rank;
    }

    public function can($rank_needed, $rank_user)
    {
        if ($rank_user >= $rank_needed) {
            return true;
        } else {
            return false;
        }
    }

    public function cant()
    {
        redirect();
    }

    public function store($data)
    {
        $errors = [];

        if ($this->checkfield($data)) {
            $article = Users::create($data);
            flash("message", "L'utilisateur a bien été créé");
            redirect('/users/manage');
        } else {
            redirect('/users/manage');
        }
    }
}
