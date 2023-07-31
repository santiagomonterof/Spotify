<?php

namespace App\models\bll;

use App\models\dal\Connection;
use App\models\dto\Artist;
use PDO;

class ArtistBLL
{
    public static function insert($name, $picture): int
    {
        $sql = "INSERT INTO artists (name, picture) 
                VALUES (:p_name, :p_picture)";
        $objConnection = new Connection();
        $objConnection->queryWithParams(
            $sql, array(
            "p_name" => $name,
            "p_picture" => $picture,
        ));
        return $objConnection->getLastInsertedId();

    }

    public static function selectAll(): array
    {
        $sql = "SELECT id, name, picture
                            FROM artists";
        $objConnection = new Connection();
        $res = $objConnection->query($sql);
        $list = [];
        while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
            $obj = self::rowToDto($row);
            $list[] = $obj;
        }
        return $list;
    }

    public static function select($id): ?Artist
    {
        $sql = "SELECT id, name, picture
                            FROM artists
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

    public static function update($name, $picture, $id)
    {
        $sql = "UPDATE artists 
                SET name = :p_name, 
                    picture = :p_picture
                WHERE id = :p_id";
        $objConnection = new Connection();
        $objConnection->queryWithParams(
            $sql, array(
            "p_name" => $name,
            "p_picture" => $picture,
            "p_id" => $id
        ));
    }


    public static function delete($id)
    {
        $sql = "DELETE FROM artists WHERE id = :p_id";
        $objConnection = new Connection();
        $objConnection->queryWithParams($sql, array("p_id" => $id));
    }






    private static function rowToDto($row)
    {
        $obj = new Artist();
        $obj->setId($row["id"]);
        $obj->setName($row["name"]);
        $obj->setPicture($row["picture"]);
        return $obj;
    }
    //function that insert the genders of an artist
    public static function artistGenders($id){

    }





}