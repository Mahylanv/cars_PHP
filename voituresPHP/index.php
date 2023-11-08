<?php // /oct/index.php
//importer la config
require_once('settings/config.php');

//requete de lecture des festivals
$read = $db->prepare('SELECT * FROM cars');
$read->execute();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <?php include('includes/head.php')?>
    <title>Voitures</title>
</head>
<body>
<?php include('includes/header.php'); ?>
<h1>Liste des voitures</h1>
<table class="table">
    <thead>
    <tr>
        <th>Nom</th>
        <th>Couleur</th>
        <th>Année</th>
        <th>Modifier</th>
        <th>Supprimer</th>
    </tr>
    </thead>
    <tbody>
    <?php while($data = $read->fetch(PDO::FETCH_ASSOC)) : ?>
        <tr>
            <td><?= $data['name'] ?></td>
            <td><?= $data['colors'] ?></td>
            <td><?= $data['released_date'] ?></td>
            <td><form method="POST" action="<?= $_SERVER['PHP_SELF'] ?>"><button type="submit" name="delete-car" value="<?= $data['id'] ?>">Delete</button></form></td>
            <td><a href="edit-car.php?id=<?= $data['id'] ?>"><button>Edit</button></a></td>
        </tr>
    <?php endwhile; ?>
    </tbody>
</table>
</body>
