<?php
require_once('settings/config.php');
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <?php include('includes/head.php')?>
    <title>Modification de la marque</title>
</head>
<body>
<?php include('includes/header.php'); ?>

<div class="formulaire">
    <p>Modifier la marque</p>
    <form method="POST" action="<?= $_SERVER['PHP_SELF'] ?>" enctype="multipart/form-data">
        <input type="text" name="edit-marque" placeholder="Nom">

        <input type="file" name="edit-logo">

        <input type="text" name="edit-origin" placeholder="Origin">

        <button type="submit" value="<?= $_GET['id'] ?>" name="edit-brand">Valider</button>
    </form>
</div>
</body>