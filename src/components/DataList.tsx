import React from 'react';

import CircularProgress from '@mui/material/CircularProgress';

import FileInfoDialog from './FileInfoDialog';
import { useAppDispatch, useAppSelector } from '../redux/hooks';
import { selectToken } from '../redux/user/selectors';
import { DataObject, LoadingStatus, initializeData } from '../redux/data/slice';
import { selectLoadingStatus, selectUserData, selectUserDataLength } from '../redux/data/selectors';

// eslint-disable-next-line react-refresh/only-export-components

const DataList: React.FC = () => {
  const [dialogOpen, setDialogOpen] = React.useState(false);
  const [selectedFile, setSelectedFile] = React.useState<DataObject | null>(null);

  const token = useAppSelector(selectToken);
  const dispatch = useAppDispatch();
  const data = useAppSelector(selectUserData);
  const dataLength = useAppSelector(selectUserDataLength);
  const loading = useAppSelector(selectLoadingStatus);

  React.useEffect(() => {
    dispatch(initializeData(token as string));
  }, [dispatch, token]);

  const handleCloseDialog = () => {
    setDialogOpen(false);
    setSelectedFile(null);
  };

  return (
    <>
      {loading === LoadingStatus.PENDING ? (
        <div className="fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
          <CircularProgress />
        </div>
      ) : (
        <>
          {dataLength === 0 ? (
            <div className="flex m-auto mt-20 justify-center items-center text-gray-900 text-xl mb-2 font-semibold">
              Event list is empty
            </div>
          ) : (
            <>
              <ul className="flex flex-col gap-2 mt-10 w-[600px]">
                <div className="flex m-auto justify-center items-center text-gray-900 text-xl mb-2 font-semibold">
                  Event list
                </div>
                <div className="grid grid-cols-12 bg-gray-900 text-gray-300 text-lg w-full justify-between px-5 py-1 rounded-xl shadow-custom">
                  <span className="col-span-1">№</span>
                  <span className="col-span-5">Title</span>
                  <span className="col-span-5 text-right">Creation date</span>
                </div>
                {data.map((item, index) => {
                  return (
                    <li key={index} className="flex flex-col">
                      <div
                        onClick={() => {
                          setSelectedFile(item);
                          setDialogOpen(true);
                        }}
                        className="grid grid-cols-12 bg-gray-900 hover:bg-gray-800 transition-all	duration-200	ease-in-out text-gray-300 text-lg w-full justify-between px-5 py-1 rounded-xl shadow-custom cursor-pointer items-center">
                        <span className="col-span-1">{index + 1}</span>
                        <span className="col-span-5">{item.title}</span>
                        <span className="col-span-5 text-right">
                          {new Date(item.createdAt * 1000).toLocaleString()}
                        </span>
                      </div>
                    </li>
                  );
                })}
              </ul>
              {selectedFile && (
                <FileInfoDialog open={dialogOpen} file={selectedFile} onClose={handleCloseDialog} />
              )}
            </>
          )}
        </>
      )}
    </>
  );
};

export default DataList;
