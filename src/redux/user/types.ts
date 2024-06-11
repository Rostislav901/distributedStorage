import { LoadingStatus } from '../data/slice';

export interface User {
  name: string | null;
  token: string | null;
  loading: LoadingStatus;
}

export type OmittedUser = Omit<User, 'loading'>;

export interface UserCredentials {
  email?: string;
  name: string;
  password: string;
}
