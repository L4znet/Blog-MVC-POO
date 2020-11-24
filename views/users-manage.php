<?php require('views/layouts/header.php');?>
<h1>Gestion des utilisateurs</h1>
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
        <tr>
            <td>Mark</td>
            <td>Mark</td>
            <td>Mark</td>
            <td>Mark</td>
            <td>Mark</td>
            <td>Mark</td>
            <td>Mark</td>
            <td>Mark</td>
            <td>Mark</td>
            <td>
                <ul class="nav">
                    <li class="nav-item ml-3">
                        <a class="nav-link btn-danger" href="<?= BASE_URL?>/users/delete"><i class="fas fa-trash"></i></a>
                    </li>
                    <li class="nav-item ml-3">
                        <a class="nav-link btn-primary" href="<?= BASE_URL?>/users/edit"><i class="fas fa-pen"></i></a>
                    </li>
                </ul>
            </td>
        </tr>
    </tbody>
</table>
<?php require('views/layouts/footer.php')?>
