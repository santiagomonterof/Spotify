<?php

namespace App\controllers;

use App\models\bll\AlbumBLL;
use App\utils\HttpUtilities;

class AlbumController
{
    static function index()
    {
        try {
            $listAlbums = AlbumBLL::selectAll();
        } catch (\Exception $e) {
            HttpUtilities::send500($e->getMessage());

            return;
        }
        echo json_encode($listAlbums);
    }

    static function detail($id)
    {
        try {
            $objAlbum = AlbumBLL::select($id);

        } catch (\Exception $e) {
            HttpUtilities::send500($e->getMessage());

            return;
        }
        if (!$objAlbum) {
            HttpUtilities::send404();

            return;
        }
        echo json_encode($objAlbum);
    }

    static function store($request)
    {
        if (!isset($request)) {
            HttpUtilities::send400();

            return;
        }
        if (HttpUtilities::verifyField($request, "name")) {
            return;
        }
        if (HttpUtilities::verifyField($request, "artist")) {

            return;
        }
        $name = $request["name"];
        $artist = $request["artist"];
        try {
            $id = AlbumBLL::insert($name, "", $artist);
        } catch (\Exception $e) {
            HttpUtilities::send500($e->getMessage());

            return;
        }
        $objInsert = AlbumBLL::select($id);
        echo json_encode($objInsert);
    }

    static function updatePut($request, $id)
    {
        if (!isset($request)) {
            HttpUtilities::send400();
            return;
        }
        try {

            $objAlbum = AlbumBLL::select($id);
            if (!$objAlbum) {
                HttpUtilities::send404();
                return;
            }
            if (HttpUtilities::verifyField($request, "name")) {
                return;
            }
            if (HttpUtilities::verifyField($request, "picture")) {
                return;
            }
            if (HttpUtilities::verifyField($request, "artist")) {
                return;
            }
            $name = $request["name"];
            $picture = $request["picture"];
            $artist = $request["artist"];
            AlbumBLL::update($name, $picture, $artist, $id);
        } catch (\Exception $e) {
            HttpUtilities::send500($e->getMessage());

            return;
        }

        $objUpdate = AlbumBLL::select($id);
        echo json_encode($objUpdate);
    }

    static function updatePatch($request, $id)
    {
        if (!isset($request)) {
            HttpUtilities::send400();

            return;
        }
        try {
            $objAlbum = AlbumBLL::select($id);
            if (!$objAlbum) {
                HttpUtilities::send404();
                return;
            }
            $name = $request["name"] ?? $objAlbum->name;
            $picture = $request["picture"] ?? $objAlbum->picture;
            $artist = $request["artist"] ?? $objAlbum->artist;
            AlbumBLL::update($name, $picture, $artist, $id);
        } catch (\Exception $e) {
            HttpUtilities::send500($e->getMessage());

            return;
        }
        $objUpdate = AlbumBLL::select($id);
        echo json_encode($objUpdate);
    }

    static function destroy($id)
    {
        try {

            $objAlbum = AlbumBLL::select($id);
            if (!$objAlbum) {
                HttpUtilities::send404();

                return;
            }
            AlbumBLL::delete($id);
        } catch (\Exception $e) {
            HttpUtilities::send500($e->getMessage());

            return;
        }
        echo json_encode([
            "msg" => "Registro eliminado correctamente"
        ]);
    }

    static function getAlbumsByArtist($id)
    {
        try {
            $listAlbums = AlbumBLL::selectByArtist($id);
        } catch (\Exception $e) {
            HttpUtilities::send500($e->getMessage());

            return;
        }
        echo json_encode($listAlbums);
    }
    static function profilePicture($id)
    {
        $objAlbum = AlbumBLL::select($id);
        if ( ! $objAlbum) {
            HttpUtilities::send404();

            return;
        }
        if (isset($_FILES['file'])) {

            $file = $_FILES['file'];

            // Nombre y ubicación temporal del archivo cargado
            $randomStr   = uniqid();
            $ext         = pathinfo($file['name'], PATHINFO_EXTENSION);
            $fileName    = "$randomStr.$ext";
            $fileTmpPath = $file['tmp_name'];

            // Mueve el archivo cargado a una ubicación deseada
            $destination = 'pictures/'.$fileName;

            if ($objAlbum->picture != "") {
                unlink("pictures/".$objAlbum->picture);
            }
            move_uploaded_file($fileTmpPath, $destination);
            AlbumBLL::update(
                $objAlbum->name,
                $fileName,
                $objAlbum->artist,
                $id
            );
            echo json_encode([
                "msg" => "Foto de perfil actualizada correctamente"
            ]);
        } else {
            HttpUtilities::send400();
        }
    }

}