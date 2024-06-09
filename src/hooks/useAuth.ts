import { useAppSelector } from '../redux/hooks';
import { selectToken, selectUsername } from '../redux/user/selectors';

const useAuth = () => {
  const username = useAppSelector(selectUsername);
  const token = useAppSelector(selectToken);


  return {
    isAuth: !!token,
    username,
    token,

  };
};

export default useAuth;
