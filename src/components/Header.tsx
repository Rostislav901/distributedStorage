import React from 'react';
import { Link } from 'react-router-dom';
import useAuth from '../hooks/useAuth';
import { useAppDispatch } from '../redux/hooks';
import { removeUser } from '../redux/user/slice';

const Header: React.FC = () => {
  const dispatch = useAppDispatch();
  const handleLogOut = () => {
    dispatch(removeUser());
  };

  const { isAuth, username } = useAuth();

  return (
    <div className="flex flex-row items-center px-40 h-14 text-xl gap-5 bg-gray-900 text-gray-300 shadow-custom">
      {isAuth ? (
        <>
          <div className="flex flex-row items-center">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              fill="none"
              viewBox="0 0 24 24"
              strokeWidth={1.5}
              stroke="currentColor"
              className="size-6">
              <path
                strokeLinecap="round"
                strokeLinejoin="round"
                d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z"
              />
            </svg>
            {username}
          </div>
          <button
            onClick={handleLogOut}
            className=" hover:underline underline-offset-[6px] decoration-[3px] transition-all	duration-200	ease-in-out">
            Log out
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
