export interface User {
  username: string | null;
  token: string | null;
  id: string | null;
}

export interface UserCredentials {
  username: string;
  password: string;
}
