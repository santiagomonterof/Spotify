import { useEffect, useState } from "react";
import axios from "axios";
import { Button, Card, Col, Container, FormLabel, FormSelect, Row } from "react-bootstrap";
import { useNavigate, useParams } from "react-router-dom";

const ArtistGenderForm = () => {
    const navigate = useNavigate();
    const { id } = useParams();

    
    const [idArtist, setIdArtist] = useState('1');
    const [listArtist, setListArtists] = useState([]);


    const [idGender, setIdGender] = useState('1');
    const [listGenders, setListGenders] = useState([]);

    useEffect(() => {
        fetchArtistsList();
        fetchGendersList();
    }, [])

    const enviarDatos = (e) => {
        e.preventDefault();
        const genderartist = {
            idArtist: idArtist,
            idGender: idGender,
        };
        if (id) {
            update(genderartist);
        } else {
            insert(genderartist);
        }
    }
    const update = (genderartist) => {
        axios.put("http://localhost:8080/api/artistgender/updatePut/" + id, genderartist)
            .then(() => {
                navigate("/mascotas");
            }).catch((error) => {
                console.log(error);
            });
    }
    const insert = (genderartist) => {
        axios.post("http://localhost:8080/api/artistgender/store", genderartist)
            .then((response) => {
                console.log(response.data);
                navigate("/");
            }).catch((error) => {
                console.log(error);
            });
    }
    const fetchArtistsList = () => {
        axios.get("http://localhost:8080/api/artist/list")
            .then((response) => {
                setListArtists(response.data);
            }).catch((error) => {
                console.log(error);
            });
    }
    const fetchGendersList = () => {
        axios.get("http://localhost:8080/api/gender/list")
            .then((response) => {
                setListGenders(response.data);
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
                                <Card.Title>Formulario de Mascotas</Card.Title>
                                <form onSubmit={enviarDatos}>
                                    <div>
                                        <FormLabel htmlFor="idArtist" />
                                        Artists
                                        <FormSelect value={idArtist} required type="text" id="idArtist" onChange={(e) => {
                                            setIdArtist(e.target.value);
                                        }} >
                                            {listArtist.map((persona) => (
                                                <option key={persona.id} value={persona.id}>{persona.name} </option>
                                            ))}
                                        </FormSelect>
                                    </div>
                                    <div>
                                        <FormLabel htmlFor="idGender" />
                                        Generos
                                        <FormSelect value={idGender} required type="text" id="idGender" onChange={(e) => {
                                            setIdGender(e.target.value);
                                        }} >
                                            {listGenders.map((gender) => (
                                                <option key={gender.id} value={gender.id}>{gender.name} </option>
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

export default ArtistGenderForm;