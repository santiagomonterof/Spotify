<?php

namespace App\controllers;

use App\models\bll\ArtistBLL;
use App\utils\HttpUtilities;
class ArtistController
{
    static function index()
    {
        try {
            $listArtists = ArtistBLL::selectAll();
        } catch (\Exception $e) {
            HttpUtilities::send500($e->getMessage());

            return;
        }
        echo json_encode($listArtists);
    }

    static function detail($id)
    {
        try {
            $objArtist = ArtistBLL::select($id);
        } catch (\Exception $e) {
            HttpUtilities::send500($e->getMessage());
            return;
        }
        if ( ! $objArtist) {
            HttpUtilities::send404();
            return;
        }
        echo json_encode($objArtist);
    }

    static function store($request)
    {
        if ( ! isset($request)) {
            HttpUtilities::send400();
            return;
        }
        if (HttpUtilities::verifyField($request, "name")) {
            return;
        }
        $name         = $request["name"];
        try {
            $id = ArtistBLL::insert($name, "");
        } catch (\Exception $e) {
            HttpUtilities::send500($e->getMessage());

            return;
        }
        $objInsert = ArtistBLL::select($id);
        echo json_encode($objInsert);
    }

    static function updatePut($request, $id)
    {
        if ( ! isset($request)) {
            HttpUtilities::send400();
            return;
        }
        try {
            $objArtist = ArtistBLL::select($id);
            if ( ! $objArtist) {
                HttpUtilities::send404();
                return;
            }
            if (HttpUtilities::verifyField($request, "name")) {
                return;
            }
            if (HttpUtilities::verifyField($request, "picture")) {
                return;
            }
            $name         = $request["name"];
            $picture         = $request["picture"];
            ArtistBLL::update($name, $picture, $id);
        } catch (\Exception $e) {
            HttpUtilities::send500($e->getMessage());

            return;
        }
        $objUpdate = ArtistBLL::select($id);
        echo json_encode($objUpdate);
    }

    static function updatePatch($request, $id)
    {
        if ( ! isset($request)) {
            HttpUtilities::send400();
            return;
        }
        try {
            $objArtist = ArtistBLL::select($id);
            if ( ! $objArtist) {
                HttpUtilities::send404();
                return;
            }
            $name         = $request["name"] ?? $objArtist->name;
            $picture       = $request["picture"] ?? $objArtist->picture;
            ArtistBLL::update($name, $picture, $id);
        } catch (\Exception $e) {
            HttpUtilities::send500($e->getMessage());
            return;
        }
        $objUpdate = ArtistBLL::select($id);
        echo json_encode($objUpdate);
    }

    static function destroy($id)
    {
        try {

            $objArtist = ArtistBLL::select($id);
            if ( ! $objArtist) {
                HttpUtilities::send404();

                return;
            }
            ArtistBLL::delete($id);
        } catch (\Exception $e) {
            HttpUtilities::send500($e->getMessage());
            return;
        }
        echo json_encode([
            "msg" => "Registro eliminado correctamente"
        ]);
    }

    static function profilePicture($id)
    {
        $objArtist = ArtistBLL::select($id);
        if ( ! $objArtist) {
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

            if ($objArtist->picture != "") {
                unlink("pictures/".$objArtist->picture);
            }
            move_uploaded_file($fileTmpPath, $destination);
            ArtistBLL::update(
                $objArtist->name,
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


}