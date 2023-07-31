import logo from '../assets/imgs/logo.png';
import home from '../assets/imgs/home.png';
import search from '../assets/imgs/search.png';
import library from '../assets/imgs/library.png';
import plus from '../assets/imgs/plus.png';
import heart from '../assets/imgs/heart.png';
import language from '../assets/imgs/language.png';


import '../css/left.css'



const Left = () => {
    return (
        <>
            <div className='container_left'>
                <img src={logo} className='logo'></img>
                <div className='container_data_first'>
                    <div className='item'>
                        <img src={home} className='icon'></img>
                        <p className='text-light'>Home</p>
                    </div>
                    <div className='item'>
                        <img src={search} className='icon'></img>
                        <p>Search</p>
                    </div>
                    <div className='item'>
                        <img src={library} className='icon'></img>
                        <p>Your Library</p>
                    </div>
                </div>
                <div className='container_data_second'>
                    <div className='item'>
                        <img src={plus} className='icon1'></img>
                        <p>Create Playlist</p>
                    </div>
                    <div className='item'>
                        <img src={heart} className='icon1'></img>
                        <p>Liked Songs</p>
                    </div>
                </div>
                <div className='container_data_third'>
                    <p>Legal</p>
                    <p>Privacy Center</p>
                    <p>Privacy Policy</p>
                    <p>Cookies</p>
                    <p>About Ads</p>
                </div>
                <div className='container_data_fourth'>
                    <img src={language} className='icon2'></img>
                    <p>English</p>
                </div>
            </div>
        </>
    );
}

export default Left;