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
        flash("message", "L'utilisateur a bien été supprimé.");
        redirect('/users/manage');
    }

    public function edit($id)
    {
        $user = Users::find($id);
        $user->grade = switch_grade($user->grade);

        $data = compact('user');
       
        $view = new View('edit-users');
        $view->render($data);
    }

    public function update($data, $id)
    {
        $errors = [];

        if (empty($data['lastname'])) {
            $errors['lastname'] = "Le nom ne peut pas rester vide.";
        }
        if (empty($data['firstname'])) {
            $errors['firstname'] = "Le prénom ne peut pas rester vide.";
        }
        if (empty($data['username'])) {
            $errors['username'] = "Le nom d'utilisateur ne peut pas rester vide.";
        }
        if (empty($data['email'])) {
            $errors['email'] = "L'email ne peut pas rester vide.";
        }
        if (empty($data['grade'])) {
            $errors['grade'] = "Le rang ne peut pas rester vide.";
        }
        if (empty($data['city'])) {
            $errors['city'] = "La ville ne peut pas rester vide.";
        }
        if (empty($data['adress'])) {
            $errors['adress'] = "L'adresse ne peut pas rester vide.";
        }
        if (empty($data['zipcode'])) {
            $errors['zipcode'] = "Le code postal ne peut pas rester vide.";
        }
        if (empty($data['phone'])) {
            $errors['phone'] = "Le numéro de téléphone ne peut pas rester vide.";
        }
        if (empty($data['password'])) {
            $errors['password'] = "Le mot de passe ne peut pas rester vide.";
        }

        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['emailvalid'] = "L'adresse e-mail saisi n'est pas valide.";
        }
        if (empty($errors)) {
            $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
            Users::update($data, $id);

            flash("message", "L'utilisateur a bien été modifié.");
            
            header('location:' .  BASE_URL . '/users/manage');
        } else {
            flash('data', $data);
            flash('errors', $errors);
            
            header('location:' .  BASE_URL . "/users/{$id}/edit");
        }
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
        return $data->grade;
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
            $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
            $users = Users::create($data);
            flash("message", "L'utilisateur a bien été créé");
            redirect('/users/manage');
        } else {
            redirect('/users/manage');
        }
    }
}
