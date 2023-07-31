<?php

use App\controllers\AlbumController;
use App\controllers\ArtistController;
use App\controllers\ArtistGenderController;
use App\controllers\GenderController;
use App\controllers\SongController;
use App\utils\HttpUtilities;

$controller = "artist";
$action = "list";

if (isset($_REQUEST["controller"])) {
    $controller = $_REQUEST["controller"];
}
if (isset($_REQUEST["action"])) {
    $action = $_REQUEST["action"];
}
switch ($controller) {
    case "artist":
        switch ($action) {
            case "list":
                if (HttpUtilities::verifyMethod("GET")) {
                    return;
                }
                ArtistController::index();

                return;
            case "detail":
                if (HttpUtilities::verifyMethod("GET")) {
                    return;
                }
                ArtistController::detail($_GET["id"]);

                return;
            case "store":
                if (HttpUtilities::verifyMethod("POST")) {
                    return;
                }
                $jsonBody = HttpUtilities::getJsonBody();
                ArtistController::store($jsonBody);

                return;
            case "updatePut":
                if (HttpUtilities::verifyMethod("PUT")) {
                    return;
                }
                $jsonBody = HttpUtilities::getJsonBody();
                ArtistController::updatePut($jsonBody, $_GET["id"]);

                return;
            case "updatePatch":
                if (HttpUtilities::verifyMethod("PATCH")) {
                    return;
                }
                $jsonBody = HttpUtilities::getJsonBody();
                ArtistController::updatePatch($jsonBody, $_GET["id"]);

                return;
            case "delete":
                if (HttpUtilities::verifyMethod("DELETE")) {
                    return;
                }
                ArtistController::destroy($_GET["id"]);

                return;
            case "profile":
                if (HttpUtilities::verifyMethod("POST")) {
                    return;
                }
                ArtistController::profilePicture($_GET["id"]);
                return;
        }
        break;

    case "album":
        switch ($action) {
            case "list":
                if (HttpUtilities::verifyMethod("GET")) {
                    return;
                }
                AlbumController::index();

                return;
            case "detail":
                if (HttpUtilities::verifyMethod("GET")) {
                    return;
                }
                AlbumController::detail($_GET["id"]);

                return;
            case "store":
                if (HttpUtilities::verifyMethod("POST")) {
                    return;
                }
                $jsonBody = HttpUtilities::getJsonBody();
                AlbumController::store($jsonBody);

                return;
            case "updatePut":
                if (HttpUtilities::verifyMethod("PUT")) {
                    return;
                }
                $jsonBody = HttpUtilities::getJsonBody();
                AlbumController::updatePut($jsonBody, $_GET["id"]);

                return;
            case "updatePatch":
                if (HttpUtilities::verifyMethod("PATCH")) {
                    return;
                }
                $jsonBody = HttpUtilities::getJsonBody();
                AlbumController::updatePatch($jsonBody, $_GET["id"]);

                return;
            case "delete":
                if (HttpUtilities::verifyMethod("DELETE")) {
                    return;
                }
                AlbumController::destroy($_GET["id"]);

                return;

            case "listbyid":
                if (HttpUtilities::verifyMethod("GET")) {
                    return;
                }
                AlbumController::getAlbumsByArtist($_GET["id"]);
                return;
            case "profile":
                if (HttpUtilities::verifyMethod("POST")) {
                    return;
                }
                AlbumController::profilePicture($_GET["id"]);
                return;
        }


        break;

    case "song":
        switch ($action) {
            case "list":
                if (HttpUtilities::verifyMethod("GET")) {
                    return;
                }
                SongController::index();

                return;
            case "detail":
                if (HttpUtilities::verifyMethod("GET")) {
                    return;
                }
                SongController::detail($_GET["id"]);

                return;
            case "store":
                if (HttpUtilities::verifyMethod("POST")) {
                    return;
                }
                $jsonBody = HttpUtilities::getJsonBody();
                SongController::store($jsonBody);

                return;
            case "updatePut":
                if (HttpUtilities::verifyMethod("PUT")) {
                    return;
                }
                $jsonBody = HttpUtilities::getJsonBody();
                SongController::updatePut($jsonBody, $_GET["id"]);

                return;
            case "updatePatch":
                if (HttpUtilities::verifyMethod("PATCH")) {
                    return;
                }
                $jsonBody = HttpUtilities::getJsonBody();
                SongController::updatePatch($jsonBody, $_GET["id"]);

                return;
            case "delete":
                if (HttpUtilities::verifyMethod("DELETE")) {
                    return;
                }
                SongController::destroy($_GET["id"]);

                return;
            case "audio":
                if (HttpUtilities::verifyMethod("POST")) {
                    return;
                }
                SongController::profileAudio($_GET["id"]);
                return;
                case "listbyid":
                if (HttpUtilities::verifyMethod("GET")) {
                    return;
                }
                SongController::getSongsByAlbums($_GET["id"]);
                return;

            case "getByNameSong":
                if (HttpUtilities::verifyMethod("POST")) {
                    return;
                }
                $jsonBody = HttpUtilities::getJsonBody();
                SongController::searchByName($jsonBody);
                return;
            case "profile":
                if (HttpUtilities::verifyMethod("POST")) {
                    return;
                }
                SongController::profilePicture($_GET["id"]);
                return;
        }
        break;
    case "gender":
        switch ($action) {
            case "list":
                if (HttpUtilities::verifyMethod("GET")) {
                    return;
                }
                GenderController::index();

                return;
            case "detail":
                if (HttpUtilities::verifyMethod("GET")) {
                    return;
                }
                GenderController::detail($_GET["id"]);

                return;
            case "store":
                if (HttpUtilities::verifyMethod("POST")) {
                    return;
                }
                $jsonBody = HttpUtilities::getJsonBody();
                GenderController::store($jsonBody);

                return;
            case "updatePut":
                if (HttpUtilities::verifyMethod("PUT")) {
                    return;
                }
                $jsonBody = HttpUtilities::getJsonBody();
                GenderController::updatePut($jsonBody, $_GET["id"]);

                return;
            case "updatePatch":
                if (HttpUtilities::verifyMethod("PATCH")) {
                    return;
                }
                $jsonBody = HttpUtilities::getJsonBody();
                GenderController::updatePatch($jsonBody, $_GET["id"]);

                return;
            case "delete":
                if (HttpUtilities::verifyMethod("DELETE")) {
                    return;
                }
                GenderController::destroy($_GET["id"]);

                return;
            case "profile":
                if (HttpUtilities::verifyMethod("POST")) {
                    return;
                }
                GenderController::profilePicture($_GET["id"]);
                return;
        }
    case "artistgender":
        switch ($action) {
            case "list":
                if (HttpUtilities::verifyMethod("GET")) {
                    return;
                }
                ArtistGenderController::index();
                return;
            case "detail":
                if (HttpUtilities::verifyMethod("GET")) {
                    return;
                }
                ArtistGenderController::detail($_GET["id"]);

                return;
            case "store":
                if (HttpUtilities::verifyMethod("POST")) {
                    return;
                }
                $jsonBody = HttpUtilities::getJsonBody();
                ArtistGenderController::store($jsonBody);

                return;
            case "updatePut":
                if (HttpUtilities::verifyMethod("PUT")) {
                    return;
                }
                $jsonBody = HttpUtilities::getJsonBody();
                ArtistGenderController::updatePut($jsonBody, $_GET["id"]);

                return;
            case "updatePatch":
                if (HttpUtilities::verifyMethod("PATCH")) {
                    return;
                }
                $jsonBody = HttpUtilities::getJsonBody();
                ArtistGenderController::updatePatch($jsonBody, $_GET["id"]);

                return;
            case "delete":
                if (HttpUtilities::verifyMethod("DELETE")) {
                    return;
                }
                ArtistGenderController::destroy($_GET["id"]);
                return;
                case "bygender":
                    if (HttpUtilities::verifyMethod("GET")) {
                        return;
                    }
                    ArtistGenderController::selectByGender($_GET["id"]);
                    return;
        }
        break;
}
echo "Error 404";
http_response_code(404);