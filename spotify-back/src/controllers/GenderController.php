<?php

namespace App\controllers;

use App\models\bll\GenderBLL;
use App\models\dto\Gender;
use App\utils\HttpUtilities;

class GenderController
{
    static function index()
    {
        try {
            $listGenders = GenderBLL::selectAll();
        } catch (\Exception $e) {
            HttpUtilities::send500($e->getMessage());
            return;
        }
        echo json_encode($listGenders);
    }

    static function detail($id)
    {
        try {
            $objGender = GenderBLL::select($id);
        } catch (\Exception $e) {
            HttpUtilities::send500($e->getMessage());
            return;
        }
        if (!$objGender) {
            HttpUtilities::send404();
            return;
        }
        echo json_encode($objGender);
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
        $name = $request["name"];
        try {
            $id = GenderBLL::insert($name, "");
        } catch (\Exception $e) {
            HttpUtilities::send500($e->getMessage());
            return;
        }
        $objInsert = GenderBLL::select($id);
        echo json_encode($objInsert);
    }

    static function updatePut($request, $id)
    {
        if (!isset($request)) {
            HttpUtilities::send400();
            return;
        }
        try {
            $objGender = GenderBLL::select($id);
            if (!$objGender) {
                HttpUtilities::send404();
                return;
            }
            if (HttpUtilities::verifyField($request, "name")) {
                return;
            }
            if (HttpUtilities::verifyField($request, "picture")) {
                return;
            }
            $name = $request["name"];
            $picture = $request["picture"];
            GenderBLL::update($name, $picture, $id);
        } catch (\Exception $e) {
            HttpUtilities::send500($e->getMessage());

            return;
        }

        $objUpdate = GenderBLL::select($id);
        echo json_encode($objUpdate);
    }

    static function updatePatch($request, $id)
    {
        if (!isset($request)) {
            HttpUtilities::send400();

            return;
        }
        try {
            $objGender = GenderBLL::select($id);
            if (!$objGender) {
                HttpUtilities::send404();

                return;
            }
            $name = $request["name"] ?? $objGender->name;
            $picture = $request["picture"] ?? $objGender->picture;
            GenderBLL::update($name, $picture, $id);
        } catch (\Exception $e) {
            HttpUtilities::send500($e->getMessage());

            return;
        }
        $objUpdate = GenderBLL::select($id);
        echo json_encode($objUpdate);
    }

    static function destroy($id)
    {
        try {

            $objGender = GenderBLL::select($id);
            if (!$objGender) {
                HttpUtilities::send404();
                return;
            }
            GenderBLL::delete($id);
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
        $objGender = GenderBLL::select($id);
        if ( ! $objGender) {
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

            if ($objGender->picture != "") {
                unlink("pictures/".$objGender->picture);
            }
            move_uploaded_file($fileTmpPath, $destination);
            GenderBLL::update(
                $objGender->name,
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