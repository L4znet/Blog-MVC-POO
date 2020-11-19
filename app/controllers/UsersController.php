<?php
class UsersController extends Controller
{
    public function index()
    {
        $view = new View('connect');
        $view->render();
    }

    public function logout()
    {
        unset($_SESSION['auth']);
        header('location:' .  BASE_URL);
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
            header('location:' .  BASE_URL);
        } else {
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
        header('location:' .  BASE_URL);
    }

    public function show($id)
    {
        $view = new View('article');
                        
        $view->render($data);
    }
    public function create($data)
    {
        $view = new View('article-create');
        
        $data = $_SESSION['data'] ?? null;
        $errors = $_SESSION['errors'] ?? null;


        unset($_SESSION['data']);
        unset($_SESSION['errors']);

        
        $view->render(compact('data', 'errors'));
    }
}
