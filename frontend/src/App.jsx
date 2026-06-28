import './App.css'
import { Route, Routes, useLocation } from 'react-router-dom';
import { Layout } from './layout/Layout';
import { SongPlayer } from './features/songs/components/SongPlayer';

export default function App() {
  const location = useLocation();

  return (
    <Routes location={location} key={location.pathname}>
      <Route element={<Layout />}>
        <Route path="/" element={<SongPlayer/>} />
      </Route>
    </Routes>
  );
}