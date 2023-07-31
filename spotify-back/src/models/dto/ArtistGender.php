<?php

namespace App\models\dto;

use stdClass;

class ArtistGender
{
    public $id;
    public $idArtist;
    public $idGender;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getIdArtist()
    {
        return $this->idArtist;
    }

    /**
     * @param mixed $idArtist
     */
    public function setIdArtist($idArtist): void
    {
        $this->idArtist = $idArtist;
    }

    /**
     * @return mixed
     */
    public function getIdGender()
    {
        return $this->idGender;
    }

    /**
     * @param mixed $idGender
     */
    public function setIdGender($idGender): void
    {
        $this->idGender = $idGender;
    }



}