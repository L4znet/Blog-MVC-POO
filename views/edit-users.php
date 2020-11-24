<?php

    require('views/layouts/header.php');

?>
<h1>Modifier un utilisateur</h1>
<form action="<?= BASE_URL ?>/users/<?= $user->id ?>/update" method="POST">
    <div class="form-row">
        <div class="form-group col-md-6">
            <?= isset($errors['lastname']) ? '<div class="alert alert-danger" role="alert"> ' . $errors["lastname"] . ' </div>' : '' ?>
            <label for="inputEmail4">Nom</label>
            <input type="text" class="form-control" name="lastname" id="inputEmail4" placeholder="Nom" value="<?= $user->lastname ?>">
        </div>

        <div class="form-group col-md-6">
            <?= isset($errors['firstname']) ? '<div class="alert alert-danger" role="alert"> ' . $errors["firstname"] . ' </div>' : '' ?>
            <label for="inputPassword4">Prénom</label>
            <input type="text" class="form-control" name="firstname" id="inputPassword4" placeholder="Prénom" value="<?= $user->firstname ?>">
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <?= isset($errors['username']) ? '<div class="alert alert-danger" role="alert"> ' . $errors["username"] . ' </div>' : '' ?>
            <label for="inputEmail4">Nom d'utilisateur</label>
            <input type="text" class="form-control" name="username" id="inputEmail4" placeholder="Nom d'utilisateur" value="<?= $user->username ?>">
        </div>
        <div class="form-group col-md-6">
            <?= isset($errors['email']) ? '<div class="alert alert-danger" role="alert"> ' . $errors["email"] . ' </div>' : '' ?>
            <?= isset($errors['emailvalid']) ? '<div class="alert alert-danger" role="alert"> ' . $errors["emailvalid"] . ' </div>' : '' ?>
            <label for="inputPassword4">E-mail</label>
            <input type="email" class="form-control" name="email" id="inputPassword4" placeholder="E-mail" value="<?= $user->email ?>">
        </div>
    </div>
    <div class="form-row">

    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <?= isset($errors['grade']) ? '<div class="alert alert-danger" role="alert"> ' . $errors["grade"] . ' </div>' : '' ?>
            <label for="inputState">Rang</label>
            <select id="inputState" class="form-control" name="grade">
                <option selected disabled><?= $user->grade ?></option>
                <option value="0">Utilisateur</option>
                <option value="1">Modérateur</option>
                <option value="2">Administrateur</option>
            </select>
        </div>

        <div class="form-group col-md-6">
            <?= isset($errors['city']) ? '<div class="alert alert-danger" role="alert"> ' . $errors["city"] . ' </div>' : '' ?>
            <label for="inputEmail4">Ville</label>
            <input type="text" class="form-control" name="city" id="inputEmail4" placeholder="Ville" value="<?= $user->city ?>">
        </div>

    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <?= isset($errors['adress']) ? '<div class="alert alert-danger" role="alert"> ' . $errors["adress"] . ' </div>' : '' ?>
            <label for="inputPassword4">Adresse</label>
            <input type="text" class="form-control" name="adress" id="inputPassword4" placeholder="Adresse" value="<?= $user->adress ?>">
        </div>
        <div class="form-group col-md-6">
            <?= isset($errors['password']) ? '<div class="alert alert-danger" role="alert"> ' . $errors["password"] . ' </div>' : '' ?>
            <label for="inputPassword4">Mot de passe</label>
            <input type="password" class="form-control" name="password" id="inputPassword4" placeholder="Mot de passe">
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <?= isset($errors['zipcode']) ? '<div class="alert alert-danger" role="alert"> ' . $errors["zipcode"] . ' </div>' : '' ?>
            <label for="inputPassword4">Code postal</label>
            <input type="text" class="form-control" name="zipcode" id="inputPassword4" placeholder="Code postal" value="<?= $user->zipcode ?>">
        </div>
        <div class="form-group col-md-6">
            <?= isset($errors['phone']) ? '<div class="alert alert-danger" role="alert"> ' . $errors["phone"] . ' </div>' : '' ?>
            <label for="inputEmail4">Téléphone</label>
            <input type="phone" class="form-control" name="phone" id="inputEmail4" placeholder="Téléphone" value="<?= $user->phone ?>">
        </div>
    </div>

    <button type="submit" class="btn btn-success">Modifier</button>
</form>
<?php require('views/layouts/footer.php')?>
