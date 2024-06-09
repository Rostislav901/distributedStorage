// import axios from 'axios';
import { UserCredentials, User } from '../redux/user/types';

const baseUrl = '#';

export const createUser = async (newUserObj: UserCredentials): Promise<User> => {
  console.log(baseUrl);
  return { username: newUserObj.username, id: 'sdfsdfsdf3123', token: 'sdfsdfsd' };
};
// export const createUser = async (newUserObj: UserCredentials): Promise<User> => {
//   const response = await axios.post(baseUrl, newUserObj);
//   return response.data;
// };
