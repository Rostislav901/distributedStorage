import { PayloadAction, createAsyncThunk, createSlice } from '@reduxjs/toolkit';
import { UserCredentials, User, OmittedUser } from './types';
import { createUser as createUserService } from '../../services/user';
import { login as loginUserService } from '../../services/auth';
import { LoadingStatus } from '../data/slice';

export const createUser = createAsyncThunk<OmittedUser, UserCredentials>(
  'user/createUser',
  async (newUserParams) => {
    const token = (await createUserService(newUserParams)).token;
    return { token, name: newUserParams.name };
  },
);

export const logIn = createAsyncThunk<OmittedUser, UserCredentials>(
  'user/logIn',
  async (credentials) => {
    const token = (await loginUserService(credentials)).token;
    // dispatch(setUser({ name: credentials.name, token }));
    return { token, name: credentials.name };
  },
);

const initialState: User = {
  name: null,
  token: null,
  loading: LoadingStatus.IDLE,
};
const userSlice = createSlice({
  name: 'user',
  initialState,
  reducers: {
    setUser(state, action: PayloadAction<User>) {
      state.name = action.payload.name;
      state.token = action.payload.token;
    },
    removeUser(state) {
      state.name = null;
      state.token = null;
    },
  },
  extraReducers: (builder) => {
    builder.addCase(logIn.pending, (state) => {
      state.name = null;
      state.token = null;
      state.loading = LoadingStatus.PENDING;
    });
    builder.addCase(logIn.fulfilled, (state, action) => {
      state.name = action.payload.name;
      state.token = action.payload.token;
      state.loading = LoadingStatus.FULFILLED;
    });
    builder.addCase(logIn.rejected, (state) => {
      state.name = null;
      state.token = null;
      state.loading = LoadingStatus.REJECTED;
    });

    builder.addCase(createUser.pending, (state) => {
      state.name = null;
      state.token = null;
      state.loading = LoadingStatus.PENDING;
    });
    builder.addCase(createUser.fulfilled, (state, action) => {
      state.name = action.payload.name;
      state.token = action.payload.token;
      state.loading = LoadingStatus.FULFILLED;
    });
    builder.addCase(createUser.rejected, (state) => {
      state.name = null;
      state.token = null;
      state.loading = LoadingStatus.REJECTED;
    });
  },
});

export const { setUser, removeUser } = userSlice.actions;

export default userSlice.reducer;
