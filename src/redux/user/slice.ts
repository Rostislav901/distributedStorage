import { PayloadAction, createAsyncThunk, createSlice } from '@reduxjs/toolkit';
import { UserCredentials, User } from './types';
import { createUser as createUserService } from '../../services/user';
import { login as loginUser } from '../../services/auth';

export const createUser = createAsyncThunk<void, UserCredentials>(
  'user/createUser',
  async (newUserParams, { dispatch }) => {
    await createUserService(newUserParams);
    dispatch(logIn({ username: newUserParams.username, password: newUserParams.password }));
  },
);

export const logIn = createAsyncThunk<void, UserCredentials>(
  'user/logIn',
  async (credentials, { dispatch }) => {
    const user = await loginUser(credentials);
    dispatch(setUser(user));
  },
);

const initialState: User = {
  username: null,
  token: null,
  id: null,
};
const userSlice = createSlice({
  name: 'user',
  initialState,
  reducers: {
    setUser(state, action: PayloadAction<User>) {
      state.username = action.payload.username;
      state.token = action.payload.token;
      state.id = action.payload.id;
    },
    removeUser(state) {
      state.username = null;
      state.token = null;
      state.id = null;
    },
  },
});

export const { setUser, removeUser } = userSlice.actions;

export default userSlice.reducer;
