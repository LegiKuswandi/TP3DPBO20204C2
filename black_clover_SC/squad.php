<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Squad.php');
include('classes/Template.php');

$squad = new Squad($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$squad->open();
$squad->getSquad();

if (isset($_POST['submit_search'])) {
    $squad->searchSquad($_POST['cari']);
} else {
    $sort = isset($_GET['sort']) ? $_GET['sort'] : ''; // Mengambil nilai sort dari parameter query string
    if ($sort === 'asc') {
        $squad->sortSquad("squad_name ASC");
    } else {
        $squad->sortSquad("squad_name DESC");
    }
}


$view = new Template('templates/skintabel.html');
if (!isset($_GET['id'])) {
    if (isset($_POST['submit'])) {
        if ($squad->addSquad($_POST) > 0) {
            echo "<script>
                alert('Data berhasil ditambah!');
                document.location.href = 'squad.php';
            </script>";
        } else {
            echo "<script>
                alert('Data gagal ditambah!');
                document.location.href = 'squad.php';
            </script>";
        }
    }

    $btn = 'Tambah';
    $title = 'TAMBAH DATA';
    $view->replace('DATA_TITLE', $title);
}

$mainTitle = 'Squad';
$sortName = 'Squad';
$header = '<tr>
<th scope="row">No.</th>
<th scope="row">Squad Name</th>
<th scope="row">Action</th>
</tr>';
$data = null;
$no = 1;
$formLabel = 'squad';

while ($div = $squad->getResult()) {
    $data .= '<tr>
    <th scope="row">' . $no . '</th>
    <td>' . $div['squad_name'] . '</td>
    <td style="font-size: 22px;">
        <a href="squad.php?id=' . $div['id_squad'] . '" title="Edit Data"><i class="bi bi-pencil-square text-warning"></i></a>&nbsp;<a href="squad.php?hapus=' . $div['id_squad'] . '" title="Delete Data"><i class="bi bi-trash-fill text-danger"></i></a>
    </td>
    </tr>';
    $no++;
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($id > 0) {
        if (isset($_POST['submit'])) {
            if ($squad->updateSquad($id, $_POST) > 0) {
                echo "<script>
                alert('Data berhasil diubah!');
                document.location.href = 'squad.php';
            </script>";
            } else {
                echo "<script>
                alert('Data gagal diubah!');
                document.location.href = 'squad.php';
            </script>";
            }
        }

        $squad->getSquadById($id);
        $row = $squad->getResult();

        $dataUpdate = $row['squad_name'];
        $btn = 'Simpan';
        $title = 'Ubah';

        $view->replace('DATA_VAL_UPDATE', $dataUpdate);
    }
}

if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    if ($id > 0) {
        if ($squad->deleteSquad($id) > 0) {
            echo "<script>
                alert('Data berhasil dihapus!');
                document.location.href = 'squad.php';
            </script>";
        } else {
            echo "<script>
                alert('Data gagal dihapus!');
                document.location.href = 'squad.php';
            </script>";
        }
    }
}

$squad->close();

$view->replace('DATA_SORT', $sortName);
$view->replace('DATA_MAIN_TITLE', $mainTitle);
$view->replace('DATA_TABEL_HEADER', $header);
$view->replace('DATA_TITLE', $title);
$view->replace('DATA_BUTTON', $btn);
$view->replace('DATA_FORM_LABEL', $formLabel);
$view->replace('DATA_TABEL', $data);
$view->write();
