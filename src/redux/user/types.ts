export interface User {
  username: string | null;
  token: string | null;
}

export interface UserCredentials {
  email: string;
  name: string;
  password: string;
}
