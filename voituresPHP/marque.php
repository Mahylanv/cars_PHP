<?php
require_once('settings/config.php');

//requete de lecture des voitures
$brand = $_GET['id']; // Récupérer la valeur du paramètre "brand" de l'UR
$read = $db->prepare('SELECT * FROM cars WHERE brand_id = :brand');
$read->execute([':brand' => $brand]);

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <?php include('includes/head.php') ?>
    <title>Marques</title>
</head>
<body>
<?php include('includes/header.php'); ?>
<h1><?= $_GET['brand'] ?></h1>
<table class="table">
    <thead>
    <tr>
        <th>Nom</th>
        <th>Couleur</th>
        <th>Date de sortie</th>
        <th>Supprimer</th>
        <th>Editer</th>
    </tr>
    </thead>
    <tbody>
    <?php while($data = $read->fetch(PDO::FETCH_ASSOC)) : ?>
        <tr>
            <td><?= $data['name'] ?></a></td>
            <td><?= $data['colors'] ?></td>
            <td><?= $data['released_date'] ?></td>
            <td><form method="POST" action="<?= $_SERVER['PHP_SELF'] ?>"><button type="submit" name="delete-car" value="<?= $data['id'] ?>">Delete</button></form></td>
            <td><a href="edit-car.php?id=<?= $data['id'] ?>"><button>Edit</button></a></td>
        </tr>
    <?php endwhile; ?>
    </tbody>
</table>
<div class="formulaire">
    <p>Ajouter une voiture</p>
    <form method="POST" action="<?= $_SERVER['PHP_SELF'] ?>">
        <input type="text" name="nom" placeholder="Nom">

        <input type="text" name="color" placeholder="Colors">

        <input name="brand" type="hidden" value="<?php echo $_GET['id']; ?>">

        <input type="text" name="date" placeholder="Date">

        <button type="submit" name="car">Valider</button>
    </form>
</div>
</body>