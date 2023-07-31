import Top from './principal/Top'
import Left from './principal/Left'

import 'bootstrap/dist/css/bootstrap.min.css'
import './App.css'
import Bot from './principal/Bot'
import CenterGender from './principal/CenterGender'
import CenterArtist from './principal/CenterArtist'


function App() {

  return (
    <>
      <Left />
      <Top />
      <CenterGender />
      <CenterArtist />
      <Bot />
    </>
  )
}

export default App
