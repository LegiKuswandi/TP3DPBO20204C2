
<?php

class MagicType extends DB
{
    function getMagicType()
    {
        $query = "SELECT * FROM magic_type";
        return $this->execute($query);
    }

    function getMagicTypeById($id)
    {
        $query = "SELECT * FROM magic_type WHERE id_magic_type=$id";
        return $this->execute($query);
    }

    function addMagicType($data)
    {
        $nama = $data['nama'];
        $query = "INSERT INTO magic_type VALUES('', '$nama')";
        return $this->executeAffected($query);
    }

    function updateMagicType($id, $data)
    {
        $nama = $data['nama'];
        $query = "UPDATE magic_type SET magic_type='$nama' WHERE id_magic_type='$id'";
        return $this->executeAffected($query);
    }

    function deleteMagicType($id)
    {
        $query = "DELETE FROM magic_type WHERE id_magic_type='$id'";
        return $this->executeAffected($query);
    }

    function searchMagicType($keyword)
    {
        $query = "SELECT * FROM magic_type WHERE magic_type LIKE '%$keyword%';";

        return $this->execute($query);
    }

    function sortMagicType($keyword) 
    {
        $sql = "SELECT * FROM magic_type ORDER BY $keyword";
        return $this->execute($sql);
    }
}
