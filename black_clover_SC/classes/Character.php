<?php

class Character extends DB
{
    function getCharacterJoin()
    {
        $query = "SELECT * FROM tcharacter JOIN squad ON tcharacter.id_squad=squad.id_squad JOIN magic_type ON tcharacter.id_magic_type=magic_type.id_magic_type ORDER BY tcharacter.id_character";

        return $this->execute($query);
    }

    function getCharacter()
    {
        $query = "SELECT * FROM tcharacter";
        return $this->execute($query);
    }

    function getCharacterById($id)
    {
        $query = "SELECT * FROM tcharacter JOIN squad ON tcharacter.id_squad=squad.id_squad JOIN magic_type ON tcharacter.id_magic_type=magic_type.id_magic_type WHERE id_character=$id";
        return $this->execute($query);
    }

    function searchCharacter($keyword)
    {
        $query = "SELECT * FROM tcharacter JOIN squad ON tcharacter.id_squad=squad.id_squad JOIN magic_type ON tcharacter.id_magic_type=magic_type.id_magic_type WHERE character_name LIKE '%$keyword%' OR character_age LIKE '%$keyword%' OR character_height LIKE '%$keyword%' OR squad_name LIKE '$keyword' OR magic_type LIKE '%$keyword%';";

        return $this->execute($query);
    }

    function deleteCharacter($id)
    {
        $sql = "DELETE FROM tcharacter WHERE id_character='$id'";
        return $this->executeAffected($sql);
    }

    function addCharacter($data, $file)
    {
        $image = $file['image']['name'];
        $tempPhoto = $file['image']['tmp_name'];
        $destination = 'assets/images/' . $image;

        if(!move_uploaded_file($tempPhoto, $destination)){
            $image = 'default.jpg';
        }

        $name = $data['nama'];
        $age = $data['age'];
        $height = $data['height'];
        $id_squad = $data['id_squad'];
        $id_magic_type = $data['id_magic_type'];

        $sql = "INSERT INTO tcharacter VALUES (NULL, '$name', '$age', '$height', '$image', '$id_squad', '$id_magic_type')";

        return $this->executeAffected($sql);
    }

    function updateCharacter($id, $data, $file)
    {
        $name = $data['nama'];
        $age = $data['age'];
        $height = $data['height'];
        $id_squad = $data['id_squad'];
        $id_magic_type = $data['id_magic_type'];
        
        $image = $file['image']['name'];

        if($image != ""){
            $tempPhoto = $file['image']['tmp_name'];
            $destination = 'assets/images/' . $image;
            if(!move_uploaded_file($tempPhoto, $destination)){
                $image = 'default.jpg';
            }
            $sql = "UPDATE tcharacter SET character_foto='$image', character_name='$name', character_age='$age', character_height='$height', id_squad='$id_squad', id_magic_type='$id_magic_type' WHERE id_character='$id'";
        }else{
            $sql = "UPDATE tcharacter SET character_name='$name', character_age='$age', character_height='$height', id_squad='$id_squad', id_magic_type='$id_magic_type' WHERE id_character='$id'";
        }
        return $this->executeAffected($sql);
    }

    function sortCharacter($keyword) 
    {
        $sql = "SELECT * FROM tcharacter JOIN squad ON tcharacter.id_squad=squad.id_squad JOIN magic_type ON tcharacter.id_magic_type=magic_type.id_magic_type ORDER BY $keyword";
        return $this->execute($sql);
    }
}

