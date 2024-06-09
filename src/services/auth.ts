// import axios from 'axios';
import { UserCredentials } from '../redux/user/types';

const baseUrl = '#';

export const login = async (authCredentials: UserCredentials) => {
  console.log(authCredentials, baseUrl);
  return await { token: 'qweq3123qq', username: authCredentials.username, id: '123112313fsdfsd' };
};
// export const login = async (authCredentials: UserCredentials) => {
//   const response = await axios.post(baseUrl, authCredentials);
//   return response.data;
// };
