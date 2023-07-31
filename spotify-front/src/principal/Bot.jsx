
import '../css/bot.css'

const Bot = () => {
    return (
        <>
            <div className='container_bot'>
                <div className='container_bot_wrapper'>
                    <div className='container_bot_item'>
                        <h1>Company</h1>
                        <p>About</p>
                        <p>Jobs</p>
                        <p>For the Record</p>
                    </div>
                    <div className='container_bot_item'>
                        <h1>Communities</h1>
                        <p>For Artists</p>
                        <p>Developers</p>
                        <p>Advertising</p>
                        <p>Investors</p>
                        <p>Vendors</p>
                        <p>Spotify for Work</p>
                    </div>
                    <div className='container_bot_item'>
                        <h1>Useful links</h1>
                        <p>Support</p>
                        <p>Free Mobile App</p>
                    </div>
                </div>
                <div className='container_bot_author'>
                    <span className='line'></span>
                    <p>© 2021 Spotify AB</p>
                </div>
            </div>
        </>
    );
}

export default Bot;