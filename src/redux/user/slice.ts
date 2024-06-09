import { PayloadAction, createAsyncThunk, createSlice } from '@reduxjs/toolkit';
import { UserCredentials, User } from './types';
import { createUser as createUserService } from '../../services/user';
import { login as loginUser } from '../../services/auth';

export const createUser = createAsyncThunk<void, UserCredentials>(
  'user/createUser',
  async (newUserParams, { dispatch }) => {
    const token = (await createUserService(newUserParams)).token
    console.log(token)
    dispatch(setUser({ username: newUserParams.name, token }))
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

};
const userSlice = createSlice({
  name: 'user',
  initialState,
  reducers: {
    setUser(state, action: PayloadAction<User>) {
      state.username = action.payload.username;
      state.token = action.payload.token;

    },
    removeUser(state) {
      state.username = null;
      state.token = null;

    },
  },
});

export const { setUser, removeUser } = userSlice.actions;

export default userSlice.reducer;
