import { useEffect, useState } from "react";
import axios from "axios";
import { Button, Card, Col, Container, FormControl, FormLabel, FormSelect, Row } from "react-bootstrap";
import { useNavigate, useParams } from "react-router-dom";

const SongForm = () => {
    const navigate = useNavigate();
    const { id } = useParams();

    const [songName, setSongName] = useState('');
    const [idAlbum, setIdAlbum] = useState('1');

    const [listAlbums, setListAlbums] = useState([]);

    useEffect(() => {
        if (!id) {
            return;
        }
        const fetchSong = () => {
            axios.get("http://localhost:8080/api/song/detail/" + id)
                .then((response) => {
                    const song = response.data;
                    setSongName(song.name);
                    setIdAlbum(song.album);
                }).catch((error) => {
                    console.log(error);
                });
        }
        fetchSong();
    }, [id])

    useEffect(() => {
        fetchAlbumsList();
    }, [])

    const fetchAlbumsList = () => {
        axios.get("http://localhost:8080/api/album/list")
            .then((response) => {
                setListAlbums(response.data);
            }).catch((error) => {
                console.log(error);
            });
    }


    const enviarDatos = (e) => {
        e.preventDefault();
        const song = {
            name : songName,
            album: idAlbum,
            fileName: "",
            picture: "",
        };
        if (id) {
            updateSong(song);
        } else {
            insertSong(song);
        }
    }
    const updateSong = (mascota) => {
        axios.patch("http://localhost:8080/api/song/updatePatch/" + id, mascota)
            .then(() => {
                navigate("/");
            }).catch((error) => {
                console.log(error);
            });
    }
    const insertSong = (mascota) => {
        axios.post("http://localhost:8080/api/song/store", mascota)
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
                                <Card.Title>Create Song</Card.Title>
                                <form onSubmit={enviarDatos}>
                                    <div>
                                        <FormLabel htmlFor="songName" />
                                        Name
                                        <FormControl value={songName} required type="text" id="songName" onChange={(e) => {
                                            setSongName(e.target.value);
                                        }} />
                                    </div>
                                    <div>
                                        <FormLabel htmlFor="idAlbum" />
                                        Albums
                                        <FormSelect value={idAlbum} required type="text" id="idAlbum" onChange={(e) => {
                                            setIdAlbum(e.target.value);
                                        }} >
                                            {listAlbums.map((album) => (
                                                <option key={album.id} value={album.id}>{album.name} </option>
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

export default SongForm;