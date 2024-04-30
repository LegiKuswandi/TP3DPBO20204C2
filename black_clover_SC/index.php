<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Squad.php');
include('classes/Character.php');
include('classes/Template.php');

$listCharacter = new Character($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);

$listCharacter->open();
$listCharacter->getCharacterJoin();

if (isset($_POST['submit_search'])) {
    $listCharacter->searchCharacter($_POST['cari']);
} else {
    $sort = isset($_GET['sort']) ? $_GET['sort'] : '';
    if ($sort === 'asc') {
        $listCharacter->sortCharacter("character_name ASC");
    } else {
        $listCharacter->sortCharacter("character_name DESC");
    }
}

$data = null;

while ($row = $listCharacter->getResult()) {
    $data .= '<div class="col-3 gx-2 gy-3 justify-content-center">' .
        '<div class="card pt-4 px-2 character-thumbnail">
        <a href="detail.php?id=' . $row['id_character'] . '">
            <div class="row justify-content-center">
                <img src="assets/images/' . $row['character_foto'] . '" class="card-img-top" style="height: 200px; object-fit: cover;" alt="' . $row['character_foto'] . '">
            </div>
            <div class="card-body">
                <p class="card-text character-nama my-0">' . $row['character_name'] . '</p>
                <p class="card-text squad-nama">' . $row['squad_name'] . '</p>
                <p class="card-text magictype-nama my-0">' . $row['magic_type'] . '</p>
            </div>
        </a>
    </div>    
    </div>';
}

$sortName = 'index';
$listCharacter->close();

$home = new Template('templates/skin.html');

$home->replace('DATA_SORT', $sortName);
$home->replace('DATA_CHARACTER', $data);
$home->write();
