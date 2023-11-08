<?php

if (!empty($_POST)) {
    if (isset($_POST['brand'])) {
        $_POST = array_map('trim', $_POST);
        $error = false;

        if (empty($_POST['marque']) && empty($_POST['origin'])) {
            $error = true;
            flash_in('error', 'LE CONTENU EST OBLIGATOIRE');
        }

        if (strlen($_POST['marque']) > 50 || strlen($_POST['origin']) > 40) {
            $error = true;
            flash_in('error', 'LE CONTENU EST TROP LONG');
        }
        //var_dump($error, $_POST);
       

        if(!$error ) {
            if(isset($_FILES['logo'])&& $_FILES["logo"]['error'] === UPLOAD_ERR_OK) {
                $tmpName = $_FILES['logo']['tmp_name'];
                $name = $_FILES['logo']['name'];
                $name = uniqid().$name;
                move_uploaded_file($tmpName, './img/'.$name);

                $add = $db->prepare('INSERT INTO brands (name, logo, origin) VALUES (:n, :l, :o)');
                $add->execute([':n' => $_POST['marque'], ':l' => $name, ':o' => $_POST['origin']]);
                flash_in('success', 'ENREGISTRE');
                header('Location: brand.php');
                exit();
            }
        }
    }

    if (isset($_POST['car'])) {
        $_POST = array_map('trim', $_POST);
        $error = false;

        if (empty($_POST['nom']) && empty($_POST['brand']) && empty($_POST['color']) && empty($_POST['date'])) {
            $error = true;
            flash_in('error', 'LE CONTENU EST OBLIGATOIRE');
        }

        if (strlen($_POST['nom']) > 50 || strlen($_POST['brand']) > 30 || strlen($_POST['color']) > 100 || strlen($_POST['date']) > 240) {
            $error = true;
            flash_in('error', 'LE CONTENU EST TROP LONG');
        }
        //var_dump($error, $_POST);

        if (!$error) {
            $name = $_POST['nom'];
            $color = $_POST['color'];
            $date = $_POST['date'];
            $brandId = $_POST['brand'];


                // Insérez les données dans la table "cars" avec le nom de la marque correspondant à l'ID
                $add = $db->prepare('INSERT INTO cars (name, brand_id, colors, released_date) VALUES (:name, :brand, :color, :released_date)');
                $add->execute([':name' => $name, ':brand' => $brandId, ':color' => $color, ':released_date' => $date]);
                flash_in('success', 'ENREGISTRE');

            header('Location: brand.php');
            exit();
        }
    }

    if (isset($_POST['delete-brand'])) {
        $idMarque = $_POST['delete-brand'];
        $deleteCars = $db->prepare('DELETE FROM cars WHERE brand_id = :id');
        $deleteCars->execute([':id' => $idMarque]);

        $delete = $db->prepare('DELETE FROM brands WHERE id = :id');
        $delete->execute([':id' => $idMarque]);
        header('Location: brand.php');
        exit();
    }

    if (isset($_POST['delete-car'])) {
        $idMarque = $_POST['delete-car'];
        $delete = $db->prepare('DELETE FROM cars WHERE id = :id');
        $delete->execute([':id' => $idMarque]);
        header('Location: index.php');
        exit();
    }

    if (isset($_POST['edit-brand'])) {
        $_POST = array_map('trim', $_POST);
        $error = false;

        if (empty($_POST['edit-marque']) && empty($_POST['edit-origin'])) {
            $error = true;
            flash_in('error', 'LE CONTENU EST OBLIGATOIRE');
        }

        if (strlen($_POST['edit-marque']) > 50 || strlen($_POST['edit-origin']) > 40) {
            $error = true;
            flash_in('error', 'LE CONTENU EST TROP LONG');
        }

        if(!$error ) {
            if(isset($_FILES['edit-logo'])&& $_FILES["edit-logo"]['error'] === UPLOAD_ERR_OK) {
                $tmpName = $_FILES['edit-logo']['tmp_name'];
                $name = $_FILES['edit-logo']['name'];
                $name = uniqid().$name;
                move_uploaded_file($tmpName, './img/'.$name);
                $id = $_POST['edit-brand'];
                $add = $db->prepare('UPDATE brands SET name = :n, logo = :l, origin = :o WHERE id = :id');
                $add->execute([':n' => $_POST['edit-marque'], ':l' => $name, ':o' => $_POST['edit-origin'], ':id' => $id]);
                flash_in('success', 'MODIFIE');
                header('Location: brand.php');
                exit();
            }
        }
    }


    if (isset($_POST['edit-car'])) {
        $_POST = array_map('trim', $_POST);
        $error = false;

        if (empty($_POST['edit-nom']) && empty($_POST['edit-color']) && empty($_POST['edit-date'])) {
            $error = true;
            flash_in('error', 'LE CONTENU EST OBLIGATOIRE');
        }

        if (strlen($_POST['edit-nom']) > 50 || strlen($_POST['edit-color']) > 100 || strlen($_POST['edit-date']) > 240) {
            $error = true;
            flash_in('error', 'LE CONTENU EST TROP LONG');
        }

        if (!$error) {
            $name = $_POST['edit-nom'];
            $color = $_POST['edit-color'];
            $date = $_POST['edit-date'];
            $id = $_POST['edit-car'];


            // Insérez les données dans la table "cars" avec le nom de la marque correspondant à l'ID
            $add = $db->prepare('UPDATE cars SET name = :name, colors = :color, released_date = :released_date WHERE id = :id');
            $add->execute([':name' => $name, ':color' => $color, ':released_date' => $date, ':id' => $id]);
            flash_in('success', 'MODIFIE');

            header('Location: index.php');
            exit();
        }
    }
}