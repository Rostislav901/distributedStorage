import axios from 'axios';

import { UserCredentials } from '../redux/user/types';

const baseUrl = 'http://192.168.0.103:8001/main-server/v1/login';

export const login = async (authCredentials: UserCredentials) => {
  const response = await axios.post(baseUrl, {
    username: authCredentials.name,
    password: authCredentials.password,
  });
  return response.data;
};
