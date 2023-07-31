<?php

namespace App\utils;

class HttpUtilities
{
    static function send404()
    {
        echo json_encode([
            "msg" => "404 Not Found"
        ]);
        http_response_code(404);
    }

    public static function sendFieldError(string $nombreCampo)
    {
        echo json_encode([
            "msg" => "El campo $nombreCampo es requerido"
        ]);
        http_response_code(400);
    }

    public static function send400()
    {
        echo json_encode([
            "msg" => "400 Bad Request"
        ]);
        http_response_code(400);
    }

    public static function send500(string $getMessage)
    {
        echo json_encode([
            "msg"   => "500 Internal Server Error",
            "error" => $getMessage
        ]);
        http_response_code(500);
    }

    public static function send405()
    {
        echo json_encode([
            "msg" => "Method not allowed"
        ]);
        http_response_code(405);
    }

    public static function getJsonBody()
    {
        $body = file_get_contents('php://input');

        return json_decode($body, true);
    }

    public static function verifyMethod(string $method)
    {
        if ($_SERVER['REQUEST_METHOD'] == $method) {
            return false;
        }
        HttpUtilities::send405();

        return true;
    }

    public static function verifyField($request, $field)
    {
        if ( ! isset($request[$field])) {
            HttpUtilities::sendFieldError($field);

            return true;
        }

        return false;
    }
}