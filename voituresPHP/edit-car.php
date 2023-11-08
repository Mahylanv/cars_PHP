<?php
require_once('settings/config.php');
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <?php include('includes/head.php')?>
    <title>Modification d'une voiture</title>
</head>
<body>
<?php include('includes/header.php'); ?>

<div class="formulaire">
    <p>Modifier une voiture</p>
    <form method="POST" action="<?= $_SERVER['PHP_SELF'] ?>" enctype="multipart/form-data">
        <input type="text" name="edit-nom" placeholder="Nom">

        <input type="text" name="edit-color" placeholder="Colors">

        <input name="brand-edit" type="hidden" value="<?php echo $_GET['id']; ?>">

        <input type="text" name="edit-date" placeholder="Date">

        <button type="submit" value="<?= $_GET['id'] ?>" name="edit-car">Valider</button>
    </form>
</div>
</body>