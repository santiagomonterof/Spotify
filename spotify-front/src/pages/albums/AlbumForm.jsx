import { useEffect, useState } from "react";
import axios from "axios";
import { Button, Card, Col, Container, FormControl, FormLabel, FormSelect, Row } from "react-bootstrap";
import { useNavigate, useParams } from "react-router-dom";

const AlbumForm = () => {
    const navigate = useNavigate();
    const { id } = useParams();

    const [albumName, setAlbumName] = useState('');
    const [idArtist, setIdArtist] = useState('1');

    const [listArtists, setListArtist] = useState([]);

    useEffect(() => {
        if (!id) {
            return;
        }
        const fetchAlbum = () => {
            axios.get("http://localhost:8080/api/album/detail/" + id)
                .then((response) => {
                    const album = response.data;
                    setAlbumName(album.name);
                    setIdArtist(album.artist);
                    console.log(album);
                }).catch((error) => {
                    console.log(error);
                });
        }
        fetchAlbum();
    }, [id])

    useEffect(() => {
        fetchArtistList();
    }, [])

    const fetchArtistList = () => {
        axios.get("http://localhost:8080/api/artist/list")
            .then((response) => {
                setListArtist(response.data);
            }).catch((error) => {
                console.log(error);
            });
    }



    const enviarDatos = (e) => {
        e.preventDefault();
        const album = {
            name : albumName,
            artist: idArtist,
        };
        if (id) {
            updateAlbum(album);
        } else {
            insertAlbum(album);
        }
    }
    const updateAlbum = (album) => {
        axios.patch("http://localhost:8080/api/album/updatePatch/" + id, album)
            .then(() => {
                navigate("/");
            }).catch((error) => {
                console.log(error);
            });
    }
    const insertAlbum = (album) => {
        axios.post("http://localhost:8080/api/album/store", album)
            .then((response) => {
                console.log(response.data);
                navigate("/");
            }).catch((error) => {
                console.log(error);
            });
    }
    return (
        <>
            <Container>
                <Row className="mt-3">
                    <Col lg={6}>
                        <Card>
                            <Card.Body>
                                <Card.Title>Form Album</Card.Title>
                                <form onSubmit={enviarDatos}>
                                    {console.log(albumName+"asd")}
                                <div>
                                        <FormLabel htmlFor="albumName" titulo="name" />
                                        Name
                                        <FormControl value={albumName} required type="text" id="albumName" onChange={(e) => {
                                            setAlbumName(e.target.value);
                                        }} />
                                    </div>
                                    <div>
                                        <FormLabel htmlFor="idArtist" />
                                        Artists
                                        <FormSelect value={idArtist} required type="text" id="idArtist" onChange={(e) => {
                                            setIdArtist(e.target.value);
                                        }} >
                                            {listArtists.map((artist) => (
                                                <option key={artist.id} value={artist.id}>{artist.name} </option>
                                            ))}
                                        </FormSelect>
                                    </div>
                                    <div className="mt-3">
                                        <Button variant="primary" type="submit">Guardar datos</Button>
                                    </div>
                                </form>
                            </Card.Body>
                        </Card>
                    </Col>
                </Row>
            </Container>
        </>
    );
}

export default AlbumForm;