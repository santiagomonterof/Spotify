<?php

namespace App\controllers;

use App\models\bll\SongBLL;
use App\utils\HttpUtilities;

class SongController
{
    static function index()
    {
        try {
            $listSongs = SongBLL::selectAll();
        } catch (\Exception $e) {
            HttpUtilities::send500($e->getMessage());

            return;
        }
        echo json_encode($listSongs);
    }

    static function detail($id)
    {
        try {
            $objSong = SongBLL::select($id);

        } catch (\Exception $e) {
            HttpUtilities::send500($e->getMessage());

            return;
        }
        if (!$objSong) {
            HttpUtilities::send404();

            return;
        }
        echo json_encode($objSong);
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
        if (HttpUtilities::verifyField($request, "album")) {
            return;
        }
        if (HttpUtilities::verifyField($request, "fileName")) {
            return;
        }
        if (HttpUtilities::verifyField($request, "picture")) {
            return;
        }
        $name = $request["name"];
        $album = $request["album"];
        try {
            $id = SongBLL::insert($name, $album, "", "");
        } catch (\Exception $e) {
            HttpUtilities::send500($e->getMessage());

            return;
        }
        $objInsertado = SongBLL::select($id);
        echo json_encode($objInsertado);
    }

    static function updatePut($request, $id)
    {
        if (!isset($request)) {
            HttpUtilities::send400();

            return;
        }
        try {

            $objSong = SongBLL::select($id);
            if (!$objSong) {
                HttpUtilities::send404();

                return;
            }
            if (HttpUtilities::verifyField($request, "name")) {
                return;
            }
            if (HttpUtilities::verifyField($request, "album")) {
                return;
            }
            $name = $request["name"];
            $album = $request["album"];
            $fileName = $request["fileName"];
            $picture = $request["picture"];
            SongBLL::update($name, $album, $fileName,$picture, $ $id);
        } catch (\Exception $e) {
            HttpUtilities::send500($e->getMessage());

            return;
        }

        $objUpdate = SongBLL::select($id);
        echo json_encode($objUpdate);
    }

    static function updatePatch($request, $id)
    {
        if (!isset($request)) {
            HttpUtilities::send400();

            return;
        }
        try {
            $objSong = SongBLL::select($id);
            if (!$objSong) {
                HttpUtilities::send404();

                return;
            }
            $name = $request["name"] ?? $objSong->name;
            $album = $request["album"] ?? $objSong->album;
            $fileName = $request["fileName"] ?? $objSong->fileName;
            $picture = $request["picture"] ?? $objSong->picture;
            SongBLL::update($name, $album, $fileName, $picture, $id);
        } catch (\Exception $e) {
            HttpUtilities::send500($e->getMessage());

            return;
        }
        $objUpdate = SongBLL::select($id);
        echo json_encode($objUpdate);
    }

    static function destroy($id)
    {
        try {

            $objSong = SongBLL::select($id);
            if (!$objSong) {
                HttpUtilities::send404();

                return;
            }
            SongBLL::delete($id);
        } catch (\Exception $e) {
            HttpUtilities::send500($e->getMessage());

            return;
        }
        echo json_encode([
            "msg" => "Registro eliminado correctamente"
        ]);
    }

    static function profileAudio($id)
    {
        $objSong = SongBLL::select($id);
        if (!$objSong) {
            HttpUtilities::send404();

            return;
        }
        if (isset($_FILES['file'])) {

            $file = $_FILES['file'];

            // Nombre y ubicación temporal del archivo cargado
            $randomStr = uniqid();
            $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
            $fileName = "$randomStr.$ext";
            $fileTmpPath = $file['tmp_name'];

            // Mueve el archivo cargado a una ubicación deseada
            $destination = 'songs/' . $fileName;

            if ($objSong->fileName != "") {
                unlink("songs/" . $objSong->fileName);
            }
            move_uploaded_file($fileTmpPath, $destination);
            SongBLL::update(
                $objSong->name,
                $objSong->album,
                $fileName,
                $objSong->picture,
                $id
            );
            echo json_encode([
                "msg" => "Foto de perfil actualizada correctamente"
            ]);
        } else {
            HttpUtilities::send400();
        }
    }
    static function profilePicture($id)
    {
        $objSong = SongBLL::select($id);
        if ( ! $objSong) {
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

            if ($objSong->picture != "") {
                unlink("pictures/".$objSong->picture);
            }
            move_uploaded_file($fileTmpPath, $destination);
            SongBLL::update(
                $objSong->name,
                $objSong->album,
                $objSong->fileName,
                $fileName,
                $id
            );
            echo json_encode([
                "msg" => "Foto de perfil actualizada correctamente"
            ]);
        } else {
            HttpUtilities::send400();
        }
    }


    static function searchByName($request)
    {
        try {
            $Song = SongBLL::selectName($request["name"]);
        } catch (\Exception $e) {
            HttpUtilities::send500($e->getMessage());

            return;
        }
        echo json_encode($Song);
    }

    static function getSongsByAlbums($idAlbum)
    {
        try {
            $listSongs = SongBLL::selectByAlbum($idAlbum);
        } catch (\Exception $e) {
            HttpUtilities::send500($e->getMessage());

            return;
        }
        echo json_encode($listSongs);
    }

}