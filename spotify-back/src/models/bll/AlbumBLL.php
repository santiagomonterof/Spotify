<?php

namespace App\models\bll;

use App\models\dal\Connection;
use App\models\dto\Album;
use PDO;

class AlbumBLL
{
    public static function insert($name, $picture, $artist): int
    {
        $sql = "INSERT INTO albums (name, picture, artist) 
                VALUES (:p_name, :p_picture, :p_artist)";
        $objConnection = new Connection();
        $objConnection->queryWithParams(
            $sql, array(
            "p_name" => $name,
            "p_picture" => $picture,
            "p_artist" => $artist,
        ));
        return $objConnection->getLastInsertedId();
    }

    public static function selectAll(): array
    {
        $sql = "SELECT id, name, picture, artist
                            FROM albums";
        $objConnection = new Connection();
        $res = $objConnection->query($sql);
        $list = [];
        while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
            $obj = self::rowToDto($row);
            $list[] = $obj;
        }
        return $list;
    }

    public static function select($id): ?Album
    {
        $sql = "SELECT id, name, picture, artist
                            FROM albums
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

    static function selectByArtist($artist): array
    {
        $sql = "SELECT id, name, picture, artist
                            FROM albums
                            WHERE artist = :p_artist";
        $objConnection = new Connection();
        $res = $objConnection->queryWithParams($sql, array("p_artist" => $artist));
        $list = [];
        while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
            $obj = self::rowToDto($row);
            $list[] = $obj;
        }
        return $list;
    }

    public static function update($name, $picture, $artist, $id)
    {
        $sql = "UPDATE albums 
                SET name = :p_name, 
                    picture = :p_picture,
                    artist = :p_artist
                WHERE id = :p_id";
        $objConnection = new Connection();
        $objConnection->queryWithParams(
            $sql, array(
            "p_name" => $name,
            "p_picture" => $picture,
            "p_artist" => $artist,
            "p_id" => $id
        ));
    }

    public static function delete($id)
    {
        $sql = "DELETE FROM albums WHERE id = :p_id";
        $objConnection = new Connection();
        $objConnection->queryWithParams($sql, array("p_id" => $id));
    }

    private static function rowToDto($row)
    {
        $obj = new Album();
        $obj->setId($row["id"]);
        $obj->setName($row["name"]);
        $obj->setPicture($row["picture"]);
        $obj->setArtist($row["artist"]);
        return $obj;
    }
}