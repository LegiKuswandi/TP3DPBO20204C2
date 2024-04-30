<?php

include('config/db.php');
include('classes/DB.php');
include('classes/MagicType.php');
include('classes/Template.php');

$magict = new magicType($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$magict->open();
$magict->getMagicType();

if (isset($_POST['submit_search'])) {
    $magict->searchMagicType($_POST['cari']);
} else {
    $sort = isset($_GET['sort']) ? $_GET['sort'] : '';
    if ($sort === 'asc') {
        $magict->sortMagicType("magic_type ASC");
    } else {
        $magict->sortMagicType("magic_type DESC");
    }
}

if (!isset($_GET['id'])) {
    if (isset($_POST['submit'])) {
        if ($magict->addMagicType($_POST) > 0) {
            echo "<script>
                alert('Data berhasil ditambah!');
                document.location.href = 'magic_type.php';
            </script>";
        } else {
            echo "<script>
                alert('Data gagal ditambah!');
                document.location.href = 'magic_type.php';
            </script>";
        }
    }

    $btn = 'Tambah';
    $title = 'Tambah';
}

$view = new Template('templates/skintabel.html');

$mainTitle = 'Magic Type';
$sortName = 'magic_type';
$header = '<tr>
<th scope="row">No.</th>
<th scope="row">Magic Type Name</th>
<th scope="row">Action</th>
</tr>';
$data = null;
$no = 1;
$formLabel = 'magict';

while ($div = $magict->getResult()) {
    $data .= '<tr>
    <th scope="row">' . $no . '</th>
    <td>' . $div['magic_type'] . '</td>
    <td style="font-size: 22px;">
        <a href="magic_type.php?id=' . $div['id_magic_type'] . '" title="Edit Data"><i class="bi bi-pencil-square text-warning"></i></a>&nbsp;<a href="magic_type.php?hapus=' . $div['id_magic_type'] . '" title="Delete Data"><i class="bi bi-trash-fill text-danger"></i></a>
        </td>
    </tr>';
    $no++;
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($id > 0) {
        if (isset($_POST['submit'])) {
            if ($magict->updateMagicType($id, $_POST) > 0) {
                echo "<script>
                alert('Data berhasil diubah!');
                document.location.href = 'magic_type.php';
            </script>";
            } else {
                echo "<script>
                alert('Data gagal diubah!');
                document.location.href = 'magic_type.php';
            </script>";
            }
        }

        $magict->getMagicTypeById($id);
        $row = $magict->getResult();

        $dataUpdate = $row['magic_type'];
        $btn = 'Simpan';
        $title = 'Ubah';

        $view->replace('DATA_VAL_UPDATE', $dataUpdate);
    }
}

if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    if ($id > 0) {
        if ($magict->deleteMagicType($id) > 0) {
            echo "<script>
                alert('Data berhasil dihapus!');
                document.location.href = 'magic_type.php';
            </script>";
        } else {
            echo "<script>
                alert('Data gagal dihapus!');
                document.location.href = 'magic_type.php';
            </script>";
        }
    }
}

$magict->close();

$view->replace('DATA_SORT', $sortName);
$view->replace('DATA_MAIN_TITLE', $mainTitle);
$view->replace('DATA_TABEL_HEADER', $header);
$view->replace('DATA_TITLE', $title);
$view->replace('DATA_BUTTON', $btn);
$view->replace('DATA_FORM_LABEL', $formLabel);
$view->replace('DATA_TABEL', $data);
$view->write();
