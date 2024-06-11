import React from 'react';
import { Link } from 'react-router-dom';
import useAuth from '../hooks/useAuth';
import { useAppDispatch } from '../redux/hooks';
import { removeUser } from '../redux/user/slice';
import LogoutIcon from '@mui/icons-material/Logout';
import PersonIcon from '@mui/icons-material/Person';

const Header: React.FC = () => {
  const dispatch = useAppDispatch();
  const handleLogOut = () => {
    dispatch(removeUser());
  };

  const { isAuth, username } = useAuth();

  return (
    <div className="flex flex-row items-center px-80 h-14 text-xl gap-10 bg-gray-900 text-gray-300 shadow-custom">
      {isAuth ? (
        <>
          <div className="flex flex-row items-center">
            {username}
            <PersonIcon fontSize="small" />
          </div>
          <button
            onClick={handleLogOut}
            className=" hover:underline underline-offset-[6px] decoration-[3px] transition-all	duration-200	ease-in-out">
            Log out <LogoutIcon fontSize="small" />
          </button>
        </>
      ) : (
        <>
          <Link
            to={'/signIn'}
            className=" hover:underline underline-offset-[6px] decoration-[3px] transition-all	duration-200	ease-in-out">
            Sign in
          </Link>
          <Link
            to={'/signUp'}
            className=" hover:underline underline-offset-[6px] decoration-[3px] transition-all	duration-200	ease-in-out">
            Sign up
          </Link>
        </>
      )}
    </div>
  );
};

export default Header;
