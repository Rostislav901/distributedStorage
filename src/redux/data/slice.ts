import { createAsyncThunk, createSlice } from '@reduxjs/toolkit';
import dataService from '../../services/data';

export const initializeData = createAsyncThunk<DataObject[], string>(
  'data/getAll',
  async (token) => {
    const data = await dataService.getAll(token);
    return data;
  },
);

// eslint-disable-next-line @typescript-eslint/no-explicit-any
export const addData = createAsyncThunk<void, { token: string; newDataObj: any }>(
  'data/addData',
  async ({ token, newDataObj }, { dispatch }) => {
    await dataService.addNewData(token, newDataObj);
    dispatch(initializeData(token));
  },
);

export const removeData = createAsyncThunk<void, { token: string; fileId: string; title: string }>(
  'data/removeData',
  async ({ token, fileId, title }, { dispatch }) => {
    await dataService.deleteData(token, fileId, title);
    dispatch(initializeData(token));
  },
);

export interface DataObject {
  fileId: string;
  title: string;
  description: string;
  location: string;
  startTime: number;
  endTime: number;
  createdAt: number;
  fileName: string;
  filesize: number;
}
export enum LoadingStatus {
  IDLE = 'idle',
  PENDING = 'pending',
  FULFILLED = 'succeeded',
  REJECTED = 'failed',
}

interface DataState {
  events: DataObject[];
  loading: LoadingStatus;
}

const initialState: DataState = { events: [], loading: LoadingStatus.IDLE };

const dataSlice = createSlice({
  name: 'data',
  initialState,
  reducers: {
    setData(state, action) {
      state.events = action.payload;
    },
  },
  extraReducers: (builder) => {
    builder.addCase(initializeData.pending, (state) => {
      state.events = [];
      state.loading = LoadingStatus.PENDING;
    });
    builder.addCase(initializeData.fulfilled, (state, action) => {
      state.events = action.payload;
      state.loading = LoadingStatus.FULFILLED;
    });
    builder.addCase(initializeData.rejected, (state) => {
      state.events = [];
      state.loading = LoadingStatus.REJECTED;
    });
  },
});

export const { setData } = dataSlice.actions;
export default dataSlice.reducer;
