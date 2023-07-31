import { useEffect, useState } from "react";
import axios from "axios";
import { useParams } from "react-router-dom";
import { Card, Col, Container, Row, Table } from "react-bootstrap";

const GenderArtistList = () => {
    const { id } = useParams();

    const [listAlbums, setListAlbums] = useState([]);

    useEffect(() => {
        if (!id) {
            return;
        }
        fetchAlbumArtistList();
    }, [id])

    const fetchAlbumArtistList = () => {
        axios.get("http://localhost:8080/api/artistgender/bygender/" + id)
            .then((response) => {
                setListAlbums(response.data);
                console.log(response.data);
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
                                <Card.Title>List of Artists by Gender</Card.Title>
                                <Table responsive>
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Cover</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {listAlbums.map(persona => (
                                            <tr key={"tr-" + persona.id}>
                                                <td>{persona.id}</td>
                                                <td>{persona.idArtist.name}</td>
                                                <td>
                                                    <img
                                                        style={{ height: 100 }}
                                                        src={"http://localhost:8080/api/pictures/" + persona.idArtist.picture}
                                                        alt=""
                                                        className="img-fluid"
                                                    />
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

export default GenderArtistList;