<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Squad.php');
include('classes/MagicType.php');
include('classes/Character.php');
include('classes/Template.php');

$character = new Character($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$character->open();

if(isset($_GET['id_hapus'])){
    $key = $_GET['id_hapus'];
    if ($key > 0) {
        if ($character->deleteCharacter($key) > 0) {
            echo "<script>
                alert('Data berhasil dihapus!');
                document.location.href = 'index.php';
            </script>";
        } else {
            echo "<script>
                alert('Data gagal dihapus!');
                document.location.href = 'index.php';
            </script>";
        }
    }
}

$character->close();
