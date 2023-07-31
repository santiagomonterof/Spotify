

import { useRef, useEffect, useState } from 'react';
import Button from 'react-bootstrap/Button';
import axios from "axios";

import { useNavigate } from 'react-router-dom';
import '../css/center.css'


function CenterArtist() {
    const navigate = useNavigate();
    const [listArtists, setListArtists] = useState([]);



    const fetchGenderList = () => {
        axios.get("http://localhost:8080/api/artist/list")
            .then((response) => {
                setListArtists(response.data);
            }).catch((error) => {
                console.log(error);
            });
    }

    const profilePicture = (id) => {
        navigate("/artist/profile/" + id);
    }
    const editArtist = (id) => {
        navigate("/artist/" + id);
    }
    const albumList = (id) => {
        navigate("/album/list/" + id);
    }
    const deleteArtist = (id) => {
        if (window.confirm("¿Está seguro de eliminar el registro?") === false) {
            return;
        }
        axios.delete("http://localhost:8080/api/artist/delete/" + id)
            .then(() => {
                fetchGenderList();

            }).catch((error) => {
                console.log(error);
            });
    }

    const boxRef = useRef(null);
    const prevArrowRef = useRef(null);
    const nextArrowRef = useRef(null);

    useEffect(() => {
        fetchGenderList();
        const box = boxRef.current;
        const prevArrow = prevArrowRef.current;
        const nextArrow = nextArrowRef.current;

        let x = 0;

        function handleArrowClick() {
            if (this.classList.contains('arrow-next')) {
                x = box.offsetWidth / 2 + box.scrollLeft - 10;
                box.scrollTo({
                    left: x,
                    behavior: 'smooth',
                });
            } else {
                x = box.offsetWidth / 2 - box.scrollLeft - 10;
                box.scrollTo({
                    left: -x,
                    behavior: 'smooth',
                });
            }
        }


        if (box && prevArrow && nextArrow) {
            prevArrow.addEventListener('click', handleArrowClick);
            nextArrow.addEventListener('click', handleArrowClick);

            return () => {
                prevArrow.removeEventListener('click', handleArrowClick);
                nextArrow.removeEventListener('click', handleArrowClick);
            };
        }
    }, []);

    return (
        <>
            <div className="container_center">
                <div className="hs__wrapper">
                    <div className="hs__header">
                        <h2 className="hs__headline">Artists</h2>
                        <div className="hs__arrows"><a className="arrow disabled arrow-prev" ref={prevArrowRef}>&lt;</a><a className="arrow arrow-next" ref={nextArrowRef}>&gt;</a></div>
                    </div>
                    <ul className="hs" ref={boxRef}>
                        {listArtists.map(persona =>
                            <li key={persona.id} className="hs__item">
                                <div className="hs__item__image__wrapper">
                                    <div className="d-flex justify-content-center">
                                        <img className="hs__item__image mx-auto d-block" src={"http://localhost:8080/api/pictures/" + persona.picture} alt="" />
                                    </div>
                                    <div className="hs__item__description">
                                        <a onClick={() => {
                                            albumList(persona.id)
                                        }}>{persona.name}</a>
                                        <div className="d-flex justify-content-center mt-3">
                                            <div className="btn-group">
                                                <Button variant="btn btn-dark mx-1" onClick={() => {
                                                    editArtist(persona.id)
                                                }}>Edit</Button>
                                                <Button variant="btn btn-dark mx-1" onClick={() => {
                                                    profilePicture(persona.id)
                                                }}>Image</Button>
                                                <Button variant="btn btn-dark mx-1" onClick={() => {
                                                    deleteArtist(persona.id)
                                                }}>Delete</Button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        )}
                    </ul>
                </div>
            </div>
        </>
    );
}

export default CenterArtist;