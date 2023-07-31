import { useEffect, useState } from "react";
import axios from "axios";
import { useNavigate, useParams } from "react-router-dom";
import { Button, Card, Col, Container, Row, Table } from "react-bootstrap";
const AlbumArtistList = () => {
    const navigate = useNavigate();
    const { id } = useParams();

    const [listAlbums, setListAlbums] = useState([]);

    useEffect(() => {
        if (!id) {
            return;
        }
        fetchAlbumArtistList();
    }, [id])

    const fetchAlbumArtistList = () => {
        axios.get("http://localhost:8080/api/album/listbyid/" + id)
            .then((response) => {
                setListAlbums(response.data);
            }).catch((error) => {
                console.log(error);
            });
    }
    const editAlbum = (id) => {
        navigate("/album/edit/" + id);
    }
    const goSongs = (id) => {
        navigate("/song/list/" + id);
    }
    const addImage = (id) => {
        navigate("/album/profile/" + id);
    }
    
    const deleteSong = (id) => {
        if (window.confirm("¿Está seguro de eliminar el registro?") === false) {
            return;
        }
        axios.delete("http://localhost:8080/api/album/delete/" + id)
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
                                <Card.Title>List of Albums</Card.Title>
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
                                        {listAlbums.map(album => (
                                            <tr key={"tr-" + album.id}>
                                                <td><img style={{ height: 100 }} src={"http://localhost:8080/api/pictures/" + album.picture} /></td>
                                                <td>{album.id}</td>
                                                <td>{album.name}</td>
                                                <td>
                                                    <Button variant="primary" onClick={() => editAlbum(album.id)}>
                                                        Edit
                                                    </Button>
                                                    <Button variant="primary" onClick={() => addImage(album.id)}>
                                                        Image
                                                    </Button>
                                                    <Button variant="primary" onClick={() => goSongs(album.id)}>
                                                        Songs
                                                    </Button>
                                                    <Button variant="danger" onClick={() => deleteSong(album.id)}>
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

export default AlbumArtistList;