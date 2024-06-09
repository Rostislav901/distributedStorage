import React from 'react';
import Dialog from '@mui/material/Dialog';
import DialogTitle from '@mui/material/DialogTitle';
import DialogContent from '@mui/material/DialogContent';
import DialogActions from '@mui/material/DialogActions';
import Button from '@mui/material/Button';
import { FileExtension } from './DataList';

interface FileInfoDialogProps {
  open: boolean;
  file: { name: string; extension: FileExtension; date: string };
  onClose: () => void;
}

const FileInfoDialog: React.FC<FileInfoDialogProps> = ({ open, file, onClose }) => {
  return (
    <Dialog open={open} onClose={onClose}>
      <DialogTitle>File Information</DialogTitle>
      <DialogContent>
        <p>
          <strong>Name:</strong> {file.name}
        </p>
        <p>
          <strong>Extension:</strong> {file.extension}
        </p>
        <p>
          <strong>Date:</strong> {file.date}
        </p>
      </DialogContent>
      <DialogActions>
        <Button onClick={onClose}>Close</Button>
      </DialogActions>
    </Dialog>
  );
};

export default FileInfoDialog;
