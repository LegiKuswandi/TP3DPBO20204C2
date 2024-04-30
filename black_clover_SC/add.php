<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Squad.php');
include('classes/MagicType.php');
include('classes/Character.php');
include('classes/Template.php');

$character = new Character($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$character->open();

if (isset($_POST['submit'])) {
    if ($character->addCharacter($_POST, $_FILES) > 0) {
        echo "<script>
            alert('Data berhasil ditambah!');
            document.location.href = 'index.php';
        </script>";
    } else {
        echo "<script>
            alert('Data gagal ditambah!');
            document.location.href = 'add.php';
        </script>";
    }
}

$squad = new Squad($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$squad->open();
$squad->getSquad();
$dataSquad = null;
while ($listSquad = $squad->getResult()) {
  $id_squad = $listSquad['id_squad'];
  $squad_name = $listSquad['squad_name'];
  
  // create input select option
  $dataSquad .= "
    <option value='". $id_squad ."'>". $id_squad ." - ". $squad_name ."</option>
  ";
}

$magictype = new MagicType($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$magictype->open();
$magictype->getMagicType();
$dataMagicType = null;
while ($listMagicType = $magictype->getResult()) {
  $id_magic_type = $listMagicType['id_magic_type'];
  $magic_type = $listMagicType['magic_type'];
  
  $dataMagicType .= "
    <option value='". $id_magic_type ."'>". $id_magic_type ." - ". $magic_type ."</option>
  ";
}

$character->close();
$squad->close();
$magictype->close();
$detail = new Template('templates/skinaddedit.html');
$detail->replace('DATA_SQUAD', $dataSquad);
$detail->replace('DATA_MAGIC_TYPE', $dataMagicType);
$detail->write();