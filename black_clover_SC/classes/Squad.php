
<?php

class Squad extends DB
{
    function getSquad()
    {
        $query = "SELECT * FROM squad";
        return $this->execute($query);
    }

    function getSquadById($id)
    {
        $query = "SELECT * FROM squad WHERE id_squad=$id";
        return $this->execute($query);
    }

    function addSquad($data)
    {
        $nama = $data['nama'];
        $query = "INSERT INTO squad VALUES('', '$nama')";
        return $this->executeAffected($query);
    }

    function updateSquad($id, $data)
    {
        $nama = $data['nama'];
        $query = "UPDATE squad SET squad_name='$nama' WHERE id_squad='$id'";
        return $this->executeAffected($query);
    }

    function deleteSquad($id)
    {
        $query = "DELETE FROM squad WHERE id_squad='$id'";
        return $this->executeAffected($query);
    }

    function searchSquad($keyword)
    {
        $query = "SELECT * FROM squad WHERE squad_name LIKE '%$keyword%';";

        return $this->execute($query);
    }

    function sortSquad($keyword) 
    {
        $sql = "SELECT * FROM squad ORDER BY $keyword";
        return $this->execute($sql);
    }
}
