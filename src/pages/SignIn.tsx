import React from 'react';
import Form from '../components/Form';
import { Link, useNavigate } from 'react-router-dom';
import useAuth from '../hooks/useAuth';
import { useAppDispatch } from '../redux/hooks';
import { logIn } from '../redux/user/slice';

const SignIn: React.FC = () => {
  const dispatch = useAppDispatch();
  const navigate = useNavigate();
  const { isAuth } = useAuth();
  React.useEffect(() => {
    if (isAuth) {
      navigate('/');
    }
  }, [isAuth, navigate]);

  const handleSignIn = (event: React.FormEvent<HTMLFormElement>) => {
    event.preventDefault();
    try {
      const form = event.target as HTMLFormElement;
      const username = form.username.value;
      const password = form.password.value;
      dispatch(logIn({ username, password }));
    } catch (error) {
      console.log(error);
    }
  };

  return (
    <div className="flex flex-col justify-center items-center px-40 mt-20">
      <h1 className="text-3xl font-bold mb-8">Sign in</h1>
      <span className="flex flex-row mb-4">
        Don't have an account?{' '}
        <Link to={'/signUp'} className="flex underline">
          Create one
        </Link>
      </span>
      <Form
        onSubmit={(e) => handleSignIn(e)}
        className="flex flex-col gap-3 items-center justify-center">
        <Form.Input
          name="username"
          placeholder="username"
          className="flex w-56 rounded-xl px-3 py-1 shadow-custom"
        />
        <Form.Input
          name="password"
          placeholder="password"
          type="password"
          className="flex w-56 rounded-xl px-3 py-1 shadow-custom"
        />
        <Form.Submit className=" bg-gray-900">Sign in</Form.Submit>
      </Form>
    </div>
  );
};

export default SignIn;