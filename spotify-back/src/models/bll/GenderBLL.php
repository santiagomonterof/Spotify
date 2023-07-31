<?php

namespace App\models\bll;

use App\models\dal\Connection;
use App\models\dto\Artist;
use App\models\dto\Gender;
use PDO;

class GenderBLL
{
    public static function insert($name, $picture): int
    {
        $sql = "INSERT INTO genders (name, picture) 
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
                            FROM genders";
        $objConnection = new Connection();
        $res = $objConnection->query($sql);
        $ist = [];
        while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
            $obj = self::rowToDto($row);
            $ist[] = $obj;
        }
        return $ist;
    }

    public static function select($id): ?Gender
    {
        $sql = "SELECT id, name, picture
                            FROM genders
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
        $sql = "UPDATE genders 
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
        $sql = "DELETE FROM genders WHERE id = :p_id";
        $objConnection = new Connection();
        $objConnection->queryWithParams($sql, array("p_id" => $id));
    }

    private static function rowToDto($row)
    {
        $obj = new Gender();
        $obj->setId($row["id"]);
        $obj->setName($row["name"]);
        $obj->setPicture($row["picture"]);
        return $obj;
    }
}