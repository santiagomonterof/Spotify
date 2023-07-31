import { useEffect, useState } from "react";
import axios from "axios";
import { Button, Card, Col, Container, FormControl, FormLabel, Row } from "react-bootstrap";
import { useNavigate, useParams } from "react-router-dom";

const ArtistForm = () => {
    const navigate = useNavigate();
    const { id } = useParams();

    const [name, setName] = useState('');


    useEffect(() => {
        if (!id) {
            return;
        }
        const fetchPersona = () => {
            axios.get("http://localhost:8080/api/artist/detail/" + id)
                .then((response) => {
                    const persona = response.data;
                    // console.log(persona)
                    setName(persona.name);
                }).catch((error) => {
                    console.log(error);
                });
        }
        fetchPersona();
    }, [id])


    const enviarDatos = (e) => {
        e.preventDefault();
        const persona = {
            name
        };
        if (id) {
            actualizarPersona(persona);
        } else {
            insertarPersona(persona);
        }
    }
    const actualizarPersona = (persona) => {
        axios.patch("http://localhost:8080/api/artist/updatePatch/" + id, persona)
            .then(() => {
                navigate("/");
            }).catch((error) => {
                console.log(error);
            });
    }
    const insertarPersona = (persona) => {
        axios.post("http://localhost:8080/api/artist/store", persona)
            .then(() => {
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
                                <Card.Title>Formulario de Personas</Card.Title>
                                <form onSubmit={enviarDatos}>
                                    <div>
                                        <FormLabel htmlFor="name" titulo="name" />
                                        <FormControl value={name} required type="text" id="name" onChange={(e) => {
                                            setName(e.target.value);
                                        }} />
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

export default ArtistForm;