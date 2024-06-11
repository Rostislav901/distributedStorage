import React from 'react';
import Dialog from '@mui/material/Dialog';
import DialogTitle from '@mui/material/DialogTitle';
import DialogContent from '@mui/material/DialogContent';
import DialogActions from '@mui/material/DialogActions';
import Button from '@mui/material/Button';
import { DataObject, removeData } from '../redux/data/slice';
import DownloadIcon from '@mui/icons-material/Download';
import DeleteIcon from '@mui/icons-material/Delete';
import dataService from '../services/data';
import { useAppDispatch, useAppSelector } from '../redux/hooks';
import { selectToken } from '../redux/user/selectors';

interface FileInfoDialogProps {
  open: boolean;
  file: DataObject;
  onClose: () => void;
}

const FileInfoDialog: React.FC<FileInfoDialogProps> = ({ open, file, onClose }) => {
  const token = useAppSelector(selectToken);
  const dispatch = useAppDispatch();
  const handleDownloadFile = async () => {
    try {
      const fileLink = await dataService.downloadFile(token as string, file.fileId);
      const url = window.URL.createObjectURL(new Blob([fileLink]));
      const link = document.createElement('a');
      link.href = url;
      link.setAttribute('download', file.fileName);
      document.body.appendChild(link);
      link.click();
    } catch (error) {
      console.log(error);
    }
  };

  const handleDeleteEvent = async () => {
    try {
      const confirmDelete = window.confirm(
        `Are you sure you want to delete the event "${file.title}"?`,
      );
      if (confirmDelete) {
        if (token) {
          dispatch(removeData({ token, fileId: file.fileId, title: file.title }));
          onClose();
        }
      }
    } catch (error) {
      console.log(error);
    }
  };

  return (
    <Dialog open={open} onClose={onClose}>
      <DialogTitle>Event details</DialogTitle>
      <DialogContent sx={{ width: '300px' }}>
        <p>
          <strong>Description:</strong> {file.description}
        </p>
        <p>
          <strong>Location:</strong> {file.location}
        </p>
        <p>
          <strong>Start time:</strong> {new Date(file.endTime * 1000).toLocaleDateString()}
        </p>
        <p>
          <strong>End time:</strong> {new Date(file.endTime * 1000).toLocaleDateString()}
        </p>

        <Button variant="outlined" onClick={handleDownloadFile}>
          <DownloadIcon fontSize="small" />
          <span className="truncate max-w-[100px]" title={file.fileName}>
            {file.fileName}
          </span>{' '}
          ({`${Math.ceil(file.filesize / 1024)}kb`})
        </Button>
      </DialogContent>
      <DialogActions>
        <Button onClick={handleDeleteEvent} color="error">
          <DeleteIcon fontSize="small" />
          Remove event
        </Button>
        <Button onClick={onClose}>Close</Button>
      </DialogActions>
    </Dialog>
  );
};

export default FileInfoDialog;
