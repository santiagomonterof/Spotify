import React from 'react'
import ReactDOM from 'react-dom/client'
import App from './App.jsx'

import { RouterProvider, createBrowserRouter } from 'react-router-dom';
import GenderForm from './pages/genders/GenderForm.jsx';
import GenderPicture from './pages/genders/GenderPicture.jsx';
import ArtistForm from './pages/artists/ArtistForm.jsx';
import ArtistPicture from './pages/artists/ArtistPicture.jsx';
import AlbumForm from './pages/albums/AlbumForm.jsx';
import AlbumArtistList from './pages/albums/AlbumArtistList.jsx';
import SongForm from './pages/songs/SongForm.jsx';
import SongAlbumList from './pages/songs/SongAlbumList.jsx';
import SongAudio from './pages/songs/SongAudio.jsx';
import ArtistGenderForm from './pages/artists/ArtistGenderForm.jsx';
import GenderArtistList from './pages/genders/GenderArtistList.jsx';
import SongSearch from './pages/songs/SongSearch.jsx';
import AlbumPicture from './pages/albums/AlbumPicture.jsx';
import SongPicture from './pages/songs/SongPicture.jsx';

const router = createBrowserRouter([
  {
    path: "/",
    element: <App />,
  },
  { 
    path: "/gender/create",
    element: <GenderForm />,
  },
  {
    path: "/gender/:id",
    element: <GenderForm />,
  },
  { 
    path: "/gender/profile/:id",
    element: <GenderPicture />,
  },
  { 
    path: "/artist/create",
    element: <ArtistForm />,
  },
  {
    path: "/artist/:id",
    element: <ArtistForm />,
  },
  { 
    path: "/artist/profile/:id",
    element: <ArtistPicture />,
  },
  { 
    path: "/album/create",
    element: <AlbumForm />,
  },
  { 
    path: "/album/list/:id",
    element: <AlbumArtistList />,
  },
  {
    path: "/album/edit/:id",
    element: <AlbumForm />,
  },
  { 
    path: "/album/profile/:id",
    element: <AlbumPicture />,
  },
  { 
    path: "/song/create",
    element: <SongForm />,
  },
  { 
    path: "/song/list/:id",
    element: <SongAlbumList />,
  },
  { 
    path: "/song/audio/:id",
    element: <SongAudio />,
  },
  { 
    path: "/song/profile/:id",
    element: <SongPicture />,
  },
  {
    path: "/song/edit/:id",
    element: <SongForm />,
  },
  { 
    path: "/artist/gender/",
    element: <ArtistGenderForm />,
  },
  { 
    path: "/artist/genderlist/:id",
    element: <GenderArtistList />,
  },
  {
    path: "/song/search",
    element: <SongSearch />,
  }
  
]);

ReactDOM.createRoot(document.getElementById('root')).render(
  <React.StrictMode>
    <RouterProvider router={router} />
  </React.StrictMode>,
)
