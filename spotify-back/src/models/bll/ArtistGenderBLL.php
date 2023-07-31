<?php

namespace App\models\bll;

use App\models\dal\Connection;
use App\models\dto\Artist;
use App\models\dto\ArtistGender;
use PDO;

class ArtistGenderBLL
{
    public static function insert($idArtist, $idGender): int
    {
        $sql = "INSERT INTO artistgender (idArtist, idGender) 
                VALUES (:p_idArtist, :p_idGender)";

        $objConnection = new Connection();
        $objConnection->queryWithParams(
            $sql, array(
            "p_idArtist" => $idArtist,
            "p_idGender" => $idGender,
        ));
        return $objConnection->getLastInsertedId();

    }

    public static function selectAll(): array
    {
        $sql = "SELECT id, idArtist, idGender
                            FROM artistsgender";
        $objConnection = new Connection();
        $res = $objConnection->query($sql);
        $list = [];
        while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
            $obj = self::rowToDto($row);
            $list[] = $obj;
        }
        return $list;
    }

    public static function select($id): ?ArtistGender
    {
        $sql = "SELECT id, idArtist, idGender
                            FROM artistsgender
                            WHERE id = :p_id";
        $objConnection = new Connection();
        $res = $objConnection->queryWithParams($sql, array("p_id" => $id));
        if ($res->rowCount() == 0) {
            return null;
        }
        $row = $res->fetch(PDO::FETCH_ASSOC);
        $obj = self::rowToDto($row);
        return $obj;
    }

    public static function update($idArtist, $idGender, $id)
    {
        $sql = "UPDATE artistsgender 
                SET idArtist = :p_idArtist, 
                    idGender = :p_idGender
                WHERE id = :p_id";
        $objConnection = new Connection();
        $objConnection->queryWithParams(
            $sql, array(
            "p_idArtist" => $idArtist,
            "p_idGender" => $idGender,
            "p_id" => $id
        ));
    }


    public static function delete($id)
    {
        $sql = "DELETE FROM artistsgender WHERE id = :p_id";
        $objConnection = new Connection();
        $objConnection->queryWithParams($sql, array("p_id" => $id));
    }
    

    private static function rowToDto($row)
    {
        $obj = new ArtistGender();
        $obj->setId($row["id"]);
        $obj->setIdArtist($row["idArtist"]);
        $obj->setIdGender($row["idGender"]);
        return $obj;
    }

    public static function selecByGender($idGender): array
    {
        $sql = "SELECT id, idArtist, idGender
            FROM artistgender
            WHERE idGender = :p_idGender";

        $objConnection = new Connection();
        $res = $objConnection->queryWithParams($sql, array("p_idGender" => $idGender));
        $list = [];
        while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
            $obj = self::rowToDto($row);

            // Obtener el objeto artista correspondiente al idArtist
            $artist = ArtistBLL::select($obj->getIdArtist());

            // Almacenar el objeto artista en lugar del idArtist
            if ($artist) {
                $obj->setIdArtist($artist);
                $list[] = $obj;
            }
        }
        return $list;
    }

//selecByGender inner join obj artist






}