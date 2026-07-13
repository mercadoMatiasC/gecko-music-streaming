import './App.css'
import { Route, Routes, useLocation } from 'react-router-dom';
import { Layout } from './layout/Layout';
import { Index } from './features/home/pages/Index';
import { Login } from './features/profiles/pages/Login';

export default function App() {
  const location = useLocation();

  return (
    <Routes location={location} key={location.pathname}>
      <Route element={<Layout />}>
        <Route path="/" element={<Index/>} />
        <Route path="/Login" element={<Login/>} />
      </Route>
    </Routes>
  );
}