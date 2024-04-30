<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Squad.php');
include('classes/MagicType.php');
include('classes/Character.php');
include('classes/Template.php');

$character = new Character($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$character->open();

$data = null;
$characterdetail = null;
$dataNama = null;
$key = null;
if(isset($_GET['id_edit'])){
  $key = $_GET['id_edit'];
  $character->getCharacterById($key);
  $characterdetail = $character->getResult();
}

if(isset($_POST['submit'])) {
  $key = $_GET['id_edit'];
  if ($character->updateCharacter($key, $_POST, $_FILES) > 0) {
    echo "<script>
        alert('Data berhasil diubah!');
        document.location.href = 'detail.php?id=" . $key . "';
    </script>";
  } else {
    echo "<script>
        alert('Data gagal ditambah!');
        document.location.href = 'updatechar.php?id_edit=" . $key . "';
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
$detail->replace('DATA_ID', $key);
$detail->replace('DATA_NAMA', $characterdetail['character_name']);
$detail->replace('DATA_AGE', $characterdetail['character_age']);
$detail->replace('DATA_HEIGHT', $characterdetail['character_height']);
$detail->replace('DATA_FOTO', $characterdetail['character_foto']);
$detail->replace('DATA_SQUAD', $dataSquad);
$detail->replace('DATA_MAGIC_TYPE', $dataMagicType);
$detail->write();