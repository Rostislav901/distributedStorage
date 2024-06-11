import React from 'react';
import NewData from '../components/NewData';
import DataList from '../components/DataList';
import { useNavigate } from 'react-router-dom';
import useAuth from '../hooks/useAuth';

const Data: React.FC = () => {
  const navigate = useNavigate();
  const { isAuth } = useAuth();
  React.useEffect(() => {
    if (!isAuth) {
      navigate('/signIn');
    }
  }, [isAuth, navigate]);

  return isAuth ? (
    <div className={`mx-80 mt-10`}>
      <NewData />
      <DataList />
    </div>
  ) : (
    ''
  );
};

export default Data;
