import { useEffect, useState } from "react";
import axios from "axios";
import { useNavigate, useParams } from "react-router-dom";
import { Button, Card, Col, Container, Row, Table } from "react-bootstrap";
const SongAlbumList = () => {
    const navigate = useNavigate();
    const { id } = useParams();

    const [listSongs, setListSongs] = useState([]);

    useEffect(() => {
        if (!id) {
            return;
        }
        fetchAlbumArtistList();
    }, [id])

    const fetchAlbumArtistList = () => {
        axios.get("http://localhost:8080/api/song/listbyid/" + id)
            .then((response) => {
                setListSongs(response.data);
            }).catch((error) => {
                console.log(error);
            });
    }
    const editSong = (id) => {
        navigate("/song/edit/" + id);
    }
    const fotoPerfil = (id) => {
        navigate("/song/profile/" + id);
    }
    const addSong = (id) => {
        navigate("/song/audio/" + id);
    }
    const deleteSong = (id) => {
        if (window.confirm("¿Está seguro de eliminar el registro?") === false) {
            return;
        }
        axios.delete("http://localhost:8080/api/song/delete/" + id)
            .then(() => {
                fetchAlbumArtistList();
            }).catch((error) => {
                console.log(error);
            });
    }


    return (
        <>
            <Container className="mt-5">
                <Row>
                    <Col>
                        <Card>
                            <Card.Body>
                                <Card.Title>List of Songs</Card.Title>
                                <Table responsive>
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {listSongs.map(persona => (
                                            <tr key={"tr-" + persona.id}>
                                                <td><img style={{ height: 100 }} src={"http://localhost:8080/api/pictures/" + persona.picture} /></td>
                                                <td><audio controls  type="audio/mp3" src={"http://localhost:8080/api/songs/" + persona.fileName} /></td>
                                                <td>{persona.id}</td>
                                                <td>{persona.name}</td>
                                                <td>
                                                    <Button variant="primary" onClick={() => editSong(persona.id)}>
                                                        Edit
                                                    </Button>
                                                    <Button variant="primary" onClick={() => fotoPerfil(persona.id)}>
                                                        Picture
                                                    </Button>
                                                    <Button variant="primary" onClick={() => addSong(persona.id)}>
                                                        AddSong
                                                    </Button>
                                                    <Button variant="danger" onClick={() => deleteSong(persona.id)}>
                                                        Delete
                                                    </Button>
                                                </td>
                                            </tr>
                                        ))}
                                    </tbody>
                                </Table>
                            </Card.Body>
                        </Card>
                    </Col>
                </Row>
            </Container>

        </>
    );
}

export default SongAlbumList;