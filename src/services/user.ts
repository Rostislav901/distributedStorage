import axios from 'axios';
import FormData from 'form-data';
import { UserCredentials, User } from '../redux/user/types';

const baseUrl = 'http://192.168.0.104:8001/registration';

export const createUser = async (newUserObj: UserCredentials): Promise<User> => {
  const formData = new FormData();

  formData.append('name', newUserObj.name);
  formData.append('password', newUserObj.password);
  formData.append('email', newUserObj.email);

  try {
    const response = await axios.post(baseUrl, formData);
    console.log('Server response:', response.data);
    return response.data;
  } catch (error) {
    console.error('Error creating user:', error);
    throw error;
  }
};
