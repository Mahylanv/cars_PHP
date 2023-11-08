<?php
require_once('settings/config.php');

//requete de lecture des voitures
$read = $db->prepare('SELECT * FROM brands');
$read->execute();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <?php include('includes/head.php')?>
    <title>Marques</title>
</head>
<body>
<?php include('includes/header.php'); ?>
<h1>Liste des marques</h1>
<table class="table">
    <thead>
    <tr>
        <th>Nom</th>
        <th>Logo</th>
        <th>Origine</th>
        <th>Supprimer</th>
        <th>Modifier</th>
    </tr>
    </thead>
    <tbody>
    <?php while($data = $read->fetch(PDO::FETCH_ASSOC)) : ?>
        <tr>
            <td><a href="marque.php?brand=<?= $data['name'] ?>&id=<?= $data['id'] ?>"><?= $data['name'] ?></a></td>
            <?php if (empty($data['logo'])) {
                echo '<td><img style="width: 100px" src="https://t3.ftcdn.net/jpg/00/64/48/96/360_F_64489688_TkrImAzpbc7ogv4eAMAPZLCKN6563fLN.jpg" alt=""></td>';
            }
                else { ?>
                    <td><img style="width: 100px" src="img/<?=$data['logo']?>" alt=""></td>
             <?php   }
            ?>
            <td><?= $data['origin'] ?></td>
            <td><form method="POST" action="<?= $_SERVER['PHP_SELF'] ?>"><button type="submit" name="delete-brand" value="<?= $data['id'] ?>">Delete</button></form></td>
            <td><a href="edit-brand.php?id=<?= $data['id'] ?>"><button>Edit</button></a></td>
        </tr>
    <?php endwhile;?>
    </tbody>
</table>

<div class="formulaire">
    <p>Ajouter une marque</p>
    <form method="POST" action="<?= $_SERVER['PHP_SELF'] ?>" enctype="multipart/form-data">
        <input type="text" name="marque" placeholder="Nom">

        <input type="file" name="logo">

        <input type="text" name="origin" placeholder="Origin">

        <button type="submit" name="brand">Valider</button>
    </form>
</div>
</body>