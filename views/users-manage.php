<?php require('views/layouts/header.php');?>
<h1>Gestion des utilisateurs</h1>
<form action="<?= BASE_URL ?>/users/create" method="POST">
    <div class="row">
        <div class="form-row">
            <div class="form-group col-md-2">
                <label for="inputPassword4">Nom</label>
                <input type="text" class="form-control" name="lastname" id="inputPassword4" placeholder="Nom">
            </div>
            <div class="form-group col-md-2">
                <label for="inputEmail4">Prénom</label>
                <input type="text" class="form-control" name="firstname" id="inputEmail4" placeholder="Prénom">
            </div>
            <div class="form-group col-md-2">
                <label for="inputEmail4">Nom d'utilisateur</label>
                <input type="text" class="form-control" name="username" id="inputEmail4" placeholder="Nom d'utilisateur">
            </div>
            <div class="form-group col-md-2">
                <label for="inputEmail4">Mot de passe</label>
                <input type="password" class="form-control" name="password" id="inputEmail4" placeholder="Mot de passe">
            </div>
            <div class="form-group col-md-2">
                <label for="inputEmail4">E-mail</label>
                <input type="email" class="form-control" name="email" id="inputEmail4" placeholder="E-mail">
            </div>

            <div class="form-group col-md-2">
                <label for="inputPassword4">Adresse</label>
                <input type="text" class="form-control" name="adress" id="inputPassword4" placeholder="Adresse">
            </div>
            <div class="form-group col-md-2">
                <label for="inputEmail4">Code postal</label>
                <input type="text" class="form-control" name="zipcode" id="inputEmail4" placeholder="Code postal">
            </div>
            <div class="form-group col-md-2">
                <label for="inputEmail4">Ville</label>
                <input type="text" class="form-control" name="city" id="inputEmail4" placeholder="Ville">
            </div>
            <div class="form-group col-md-2">
                <label for="inputEmail4">Téléphone</label>
                <input type="phone" class="form-control" name="phone" id="inputEmail4" placeholder="Téléphone">
            </div>
            <div class="form-group col-md-2">
                <label for="inputEmail4">Rang</label>
                <select id="inputState" class="form-control" name="grade">
                    <option selected disabled>Rang</option>
                    <option value="0">Utilisateur</option>
                    <option value="1">Modérateur</option>
                    <option value="2">Administrateur</option>
                </select>
            </div>
        </div>
        <button type="submit" class="btn btn-success mb-2">Créer un compte</button>
    </div>
</form>
<table class="table">
    <thead>
        <tr>
            <th scope="col">Nom</th>
            <th scope="col">Prénom</th>
            <th scope="col">Nom d'utilisateur</th>
            <th scope="col">E-mail</th>
            <th scope="col">Adresse</th>
            <th scope="col">Code postal</th>
            <th scope="col">Ville</th>
            <th scope="col">Téléphone</th>
            <th scope="col">Rank</th>
            <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
         foreach ($users as $user):
        $grade = switch_grade($user->grade);
        ?>
        <tr>
            <td><?= $user->lastname ?></td>
            <td><?= $user->firstname ?></td>
            <td><?= $user->username ?></td>
            <td><?= $user->email ?></td>
            <td><?= $user->adress ?></td>
            <td><?= $user->zipcode ?></td>
            <td><?= $user->city ?></td>
            <td><?= $user->phone ?></td>
            <td><?= $grade ?></td>
            <td>
                <ul class="nav">
                    <li class="nav-item ml-3">
                        <a class="nav-link btn-danger" href="<?= BASE_URL?>/users/<?= $user->id ?>/delete"><i class="fas fa-trash"></i></a>
                    </li>
                    <li class="nav-item ml-3">
                        <a class="nav-link btn-primary" href="<?= BASE_URL?>/users/<?= $user->id ?>/edit"><i class="fas fa-pen"></i></a>
                    </li>
                </ul>
            </td>
        </tr>
        <?php endforeach;?>
    </tbody>
</table>
<?php require('views/layouts/footer.php')?>
