import { createSelector } from '@reduxjs/toolkit';
import { RootState } from '../store';

const selectData = (state: RootState) => state.data;

export const selectUserData = createSelector(selectData, (data) => data.events);
export const selectUserDataLength = createSelector(selectData, (data) => data.events.length);
export const selectLoadingStatus = createSelector(selectData, (data) => data.loading);
