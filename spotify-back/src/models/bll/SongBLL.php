<?php

namespace App\models\bll;

use App\models\dal\Connection;
use App\models\dto\Song;
use PDO;

class SongBLL
{
    public static function insert($name, $album, $fileName, $picture): int
    {
        $sql = "INSERT INTO songs (name, album, fileName, picture) 
                VALUES (:p_name, :p_album, :p_fileName, :p_picture)";
        $objConnection = new Connection();
        $objConnection->queryWithParams(
            $sql, array(
            "p_name" => $name,
            "p_album" => $album,
            "p_fileName" => $fileName,
            "p_picture" => $picture,
        ));

        return $objConnection->getLastInsertedId();

    }

    public static function selectAll(): array
    {
        $sql = "SELECT id, name, album, fileName, picture
                            FROM songs";
        $objConnection = new Connection();
        $res = $objConnection->query($sql);
        $ist = [];
        while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
            $obj = self::rowToDto($row);
            $ist[] = $obj;
        }
        return $ist;
    }

    public static function select($id): ?Song
    {
        $sql = "SELECT id, name, album, fileName, picture
                            FROM songs
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


    public static function update($name, $album, $fileName, $picture, $id)
    {
        $sql = "UPDATE songs 
                SET name = :p_name, 
                    album = :p_album,
                    fileName = :p_fileName,
                    picture = :p_picture
                WHERE id = :p_id";
        $objConnection = new Connection();
        $objConnection->queryWithParams(
            $sql, array(
            "p_name" => $name,
            "p_album" => $album,
            "p_fileName" => $fileName,
            "p_picture" => $picture,
            "p_id" => $id
        ));
    }

    public static function delete($id)
    {
        $sql = "DELETE FROM songs WHERE id = :p_id";
        $objConnection = new Connection();
        $objConnection->queryWithParams($sql, array("p_id" => $id));
    }

    private static function rowToDto($row)
    {
        $obj = new Song();
        $obj->setId($row["id"]);
        $obj->setName($row["name"]);
        $obj->setAlbum($row["album"]);
        $obj->setFileName($row["fileName"]);
        $obj->setPicture($row["picture"]);
        return $obj;
    }

    public static function selectName($name): ?Song
    {
        $sql = "SELECT id, `name`, album, fileName, picture
                            FROM songs
                            WHERE `name` LIKE CONCAT('%', :p_name, '%')";
        $objConnection = new Connection();
        $res = $objConnection->queryWithParams($sql, array("p_name" => $name));
        if ($res->rowCount() == 0) {
            return null;
        }
        $row = $res->fetch(PDO::FETCH_ASSOC);
        $obj = self::rowToDto($row);
        return $obj;
    }

    public static function selectByAlbum($idAlbum): array
    {
        $sql = "SELECT id, `name`, album, fileName, picture
                            FROM songs
                            WHERE album = :p_idAlbum";
        $objConnection = new Connection();
        $res = $objConnection->queryWithParams($sql, array("p_idAlbum" => $idAlbum));
        $list = [];
        while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
            $obj = self::rowToDto($row);
            $list[] = $obj;
        }
        return $list;
    }

}