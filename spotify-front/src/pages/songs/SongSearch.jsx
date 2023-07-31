import { useState } from "react";
import axios from "axios";
import { Button, Card, Col, Container, FormControl, FormLabel, Row } from "react-bootstrap";
import { useNavigate } from "react-router-dom";

const SongSearch = () => {
    const navigate = useNavigate();

    const [nameSong, setNameSong] = useState('');
    const [song, setSong] = useState([]);


    const enviarDatos = (e) => {
        e.preventDefault();
        const song = {
            name: nameSong,
        };
        getSong(song);
    }

    const getSong = (song) => {
        axios.post("http://localhost:8080/api/song/getByNameSong", song)
            .then((response) => {
                console.log(response.data);
                setSong(response.data);
                navigate("/song/search");
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
                                <Card.Title>Search Song</Card.Title>
                                <form onSubmit={enviarDatos}>
                                    <div>
                                        <FormLabel htmlFor="nameSong" />
                                        Name
                                        <FormControl value={nameSong} required type="text" id="nameSong" onChange={(e) => {
                                            setNameSong(e.target.value);
                                        }} />
                                    </div>
                                    <div className="mt-3">
                                        <Button variant="primary" type="submit">Search</Button>
                                    </div>
                                </form>
                            </Card.Body>
                        </Card>
                    </Col>
                </Row>
            </Container>
            <div className="container">
                <h1>Song</h1>
                <div className="card">
                    <div className="card-body">
                        <h5 className="card-title">{song.name}</h5>
                        <p className="card-text">ID: {song.id}</p>
                        <p className="card-text">Album: {song.album}</p>
                        <audio controls type="audio/mp3" src={"http://localhost:8080/api/songs/" + song.fileName} />
                    </div>
                </div>
            </div>
        </>
    );
}

export default SongSearch;