<?php

namespace App\controllers;

use App\models\bll\ArtistGenderBLL;
use App\utils\HttpUtilities;
class ArtistGenderController
{
    static function index()
    {
        try {
            $listArtistsGenders = ArtistGenderBLL::selectAll();
        } catch (\Exception $e) {
            HttpUtilities::send500($e->getMessage());

            return;
        }
        echo json_encode($listArtistsGenders);
    }

    static function detail($id)
    {
        try {
            $objArtistGender = ArtistGenderBLL::select($id);
        } catch (\Exception $e) {
            HttpUtilities::send500($e->getMessage());
            return;
        }
        if ( ! $objArtistGender) {
            HttpUtilities::send404();
            return;
        }
        echo json_encode($objArtistGender);
    }

    static function store($request)
    {
        if ( ! isset($request)) {
            HttpUtilities::send400();
            return;
        }
        if (HttpUtilities::verifyField($request, "idArtist")) {
            return;
        }
        if (HttpUtilities::verifyField($request, "idGender")) {
            return;
        }
        $idArtist         = $request["idArtist"];
        $idGender       = $request["idGender"];

        try {
            $id = ArtistGenderBLL::insert($idArtist, $idGender);
        } catch (\Exception $e) {
            HttpUtilities::send500($e->getMessage());

            return;
        }
        $objInsert = ArtistGenderBLL::select($id);
        echo json_encode($objInsert);
    }

    static function updatePut($request, $id)
    {
        if ( ! isset($request)) {
            HttpUtilities::send400();
            return;
        }
        try {
            $objArtistGender = ArtistGenderBLL::select($id);
            if ( ! $objArtistGender) {
                HttpUtilities::send404();
                return;
            }
            if (HttpUtilities::verifyField($request, "idArtist")) {
                return;
            }
            if (HttpUtilities::verifyField($request, "idGender")) {
                return;
            }
            $idArtist         = $request["idArtist"];
            $idGender       = $request["idGender"];
            ArtistGenderBLL::update($idArtist, $idGender, $id);
        } catch (\Exception $e) {
            HttpUtilities::send500($e->getMessage());

            return;
        }
        $objUpdate = ArtistGenderBLL::select($id);
        echo json_encode($objUpdate);
    }

    static function updatePatch($request, $id)
    {
        if ( ! isset($request)) {
            HttpUtilities::send400();
            return;
        }
        try {
            $objArtistGender = ArtistGenderBLL::select($id);
            if ( ! $objArtistGender) {
                HttpUtilities::send404();
                return;
            }
            $idArtist         = $request["idArtist"] ?? $objArtistGender->idArtist;
            $idGender       = $request["idGender"] ?? $objArtistGender->idGender;
            ArtistGenderBLL::update($idArtist, $idGender, $id);
        } catch (\Exception $e) {
            HttpUtilities::send500($e->getMessage());
            return;
        }
        $objUpdate = ArtistGenderBLL::select($id);
        echo json_encode($objUpdate);
    }

    static function destroy($id)
    {
        try {

            $objArtistGender = ArtistGenderBLL::select($id);
            if ( ! $objArtistGender) {
                HttpUtilities::send404();

                return;
            }
            ArtistGenderBLL::delete($id);
        } catch (\Exception $e) {
            HttpUtilities::send500($e->getMessage());
            return;
        }
        echo json_encode([
            "msg" => "Registro eliminado correctamente"
        ]);
    }

    static function selectByGender($idGender)
    {
        try {
            $listArtistsGenders = ArtistGenderBLL::selecByGender($idGender);
        } catch (\Exception $e) {
            HttpUtilities::send500($e->getMessage());

            return;
        }
        echo json_encode($listArtistsGenders);
    }



}