import axios from 'axios';
import FormData from 'form-data';
import { UserCredentials, User } from '../redux/user/types';

const baseUrl = 'https://127.0.0.1:8001/registration';


export const createUser = async (newUserObj: UserCredentials): Promise<User> => {
  const formData = new FormData();

  // Добавьте данные в форму
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
