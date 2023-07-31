import { BsChevronLeft } from 'react-icons/bs';
import { BsChevronRight } from 'react-icons/bs';
import { Container, Nav, NavDropdown, Navbar } from "react-bootstrap";
import { NavLink } from "react-router-dom";



import '../css/top.css'




const Top = () => {
    return (
        <>
            <div className='container_top'>
                <div className='container_data'>
                    <div className='container_data_icons'>
                        <div className='arrow_icon'>
                            <BsChevronLeft className='arrow text-white-50' color='white' />
                        </div>
                        <div className='arrow_icon'>
                            <BsChevronRight className='arrow text-white-50' color='white' />
                        </div>
                    </div>
                    <Navbar bg="dark" variant="dark" expand="lg">
                        <Container>
                            <Navbar.Toggle aria-controls="basic-navbar-nav" />
                            <Navbar.Collapse id="basic-navbar-nav">
                                <Nav className="me-auto">
                                    <NavDropdown title="Genres" id="basic-nav-dropdown" >
                                        <NavLink className="dropdown-item" to="/gender/create">Create Gender</NavLink>
                                    </NavDropdown>
                                    <NavDropdown title="Albums" >
                                        <NavLink className="dropdown-item" to="/album/create">Create Album</NavLink>
                                    </NavDropdown>
                                    <NavDropdown title="Artists" >
                                        <NavLink className="dropdown-item" to="/artist/create">Create Artist</NavLink>
                                        <NavLink className="dropdown-item" to="/artist/gender">Add Gender</NavLink>
                                    </NavDropdown>
                                    <NavDropdown title="Songs" >
                                        <NavLink className="dropdown-item" to="/song/create">Create Song</NavLink>
                                        <NavLink className="dropdown-item" to="/song/search">Search</NavLink>

                                    </NavDropdown>
                                </Nav>
                            </Navbar.Collapse>
                        </Container>
                    </Navbar>
                    <div className='container_data_btns'>
                        <div className='btn1'>
                            <p>Sign up</p>
                        </div>
                        <div className='btn2'>
                            <p>Log in</p>
                        </div>
                    </div>

                </div>
            </div>
        </>

    );
}

export default Top;