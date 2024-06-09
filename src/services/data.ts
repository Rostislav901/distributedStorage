import axios from 'axios';

const baseUrl = 'http://localhost:3000/api/download/';

const getFile = async () => {
  const response = await axios.get(baseUrl, { responseType: 'blob' });
  return response.data;
};

export default { getFile };
