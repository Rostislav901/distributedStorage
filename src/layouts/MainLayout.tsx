import React from 'react';
import { Outlet } from 'react-router-dom';
import Header from '../components/Header';

const MainLayout: React.FC = () => {
  return (
    <div className="bg-gray-300 flex flex-col m-auto min-h-screen">
      <Header />
      <Outlet />
    </div>
  );
};

export default MainLayout;
