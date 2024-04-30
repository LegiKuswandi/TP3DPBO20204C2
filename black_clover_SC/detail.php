<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Squad.php');
include('classes/MagicType.php');
include('classes/Character.php');
include('classes/Template.php');

$character = new Character($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$character->open();

$data = nulL;

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($id > 0) {
        $character->getCharacterById($id);
        $row = $character->getResult();

        $data .= '<div class="card-header text-center">
        <h3 class="my-0">Detail ' . $row['character_name'] . '</h3>
        </div>
        <div class="card-body text-end">
            <div class="row mb-5">
                <div class="col-3">
                    <div class="row justify-content-center">
                        <img src="assets/images/' . $row['character_foto'] . '" class="img-thumbnail" alt="' . $row['character_foto'] . '" width="60">
                        </div>
                    </div>
                    <div class="col-9">
                        <div class="card px-3">
                            <table border="0" class="text-start">
                                <tr>
                                    <td>Name</td>
                                    <td>:</td>
                                    <td>' . $row['character_name'] . '</td>
                                </tr>
                                <tr>
                                    <td>Age</td>
                                    <td>:</td>
                                    <td>' . $row['character_age'] . '</td>
                                </tr>
                                <tr>
                                    <td>Height</td>
                                    <td>:</td>
                                    <td>' . $row['character_height'] . '</td>
                                </tr>
                                <tr>
                                    <td>Squad</td>
                                    <td>:</td>
                                    <td>' . $row['squad_name'] . '</td>
                                </tr>
                                <tr>
                                    <td>Magic Type</td>
                                    <td>:</td>
                                    <td>' . $row['magic_type'] . '</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-end">
                <a href="updatechar.php?id_edit='. $id .'"><button type="button" class="btn btn-success text-white">Ubah Data</button></a>
                <a href="hapuschar.php?id_hapus='. $id .'"><button type="button" class="btn btn-danger">Hapus Data</button></a>
            </div>';
    }
}

if(isset($_GET['id_hapus'])){
    $key = $_GET['id_hapus'];
    if ($key > 0) {
        if ($artis->deleteCharacter($key) > 0) {
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
$detail = new Template('templates/skindetail.html');
$detail->replace('DATA_DETAIL_CHARACTER', $data);
$detail->write();
