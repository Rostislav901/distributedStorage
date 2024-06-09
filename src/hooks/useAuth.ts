import { useAppSelector } from '../redux/hooks';
import { selectToken, selectUserId, selectUsername } from '../redux/user/selectors';

const useAuth = () => {
  const username = useAppSelector(selectUsername);
  const token = useAppSelector(selectToken);
  const id = useAppSelector(selectUserId);

  return {
    isAuth: !!token,
    username,
    token,
    id,
  };
};

export default useAuth;
