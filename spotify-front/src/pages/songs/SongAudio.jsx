import { useEffect, useState } from "react";

import axios from "axios";
import { Button, Card, Col, Container, FormLabel, Row } from "react-bootstrap";
import { useNavigate, useParams } from "react-router-dom";

const SongAudio = () => {
    const navigate = useNavigate();
    const { id } = useParams();

    const [file, setFile] = useState(null);
    const handleFileChange = (e) => {
        setFile(e.target.files[0]);
    };

    useEffect(() => {
        if (!id) {
            return;
        }
    }, [id])



    const enviarDatos = (e) => {
        e.preventDefault();
        const picture = new FormData();
        picture.append('file', file);
        axios.post("http://localhost:8080/api/song/audio/" + id, picture)
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
                                        <FormLabel inputid="imagen" titulo="Foto de Perfil" />
                                        <input accept=".mp3" id="imagen" type="file" onChange={handleFileChange} className="form-control" />
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

export default SongAudio;