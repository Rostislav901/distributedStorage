import React from 'react';
import { FileIcon, defaultStyles } from 'react-file-icon';
import DownloadIcon from '@mui/icons-material/Download';
import DeleteIcon from '@mui/icons-material/Delete';
import InfoIcon from '@mui/icons-material/Info';
import dataService from '../services/data';
import Popover from './Popover';
import FileInfoDialog from './FileInfoDialog';

// eslint-disable-next-line react-refresh/only-export-components
export enum FileExtension {
  TXT = 'txt',
  DOCX = 'docx',
  PDF = 'pdf',
  JPG = 'jpg',
  MKV = 'mkv',
}

const DataList: React.FC = () => {
  const [dialogOpen, setDialogOpen] = React.useState(false);
  const [selectedFile, setSelectedFile] = React.useState(null);

  const handleAboutClick = (file) => {
    setSelectedFile(file);
    setDialogOpen(true);
  };

  const handleCloseDialog = () => {
    setDialogOpen(false);
    setSelectedFile(null);
  };

  const downloadFile = async () => {
    try {
      const file = await dataService.getFile();
      const url = window.URL.createObjectURL(new Blob([file]));
      const link = document.createElement('a');
      link.href = url;
      link.setAttribute('download', 'file.pdf');
      document.body.appendChild(link);
      link.click();
    } catch (error) {
      console.log(error);
    }
  };

  return (
    <>
      <ul className="grid grid-cols-6 gap-5 mt-10">
        {files.map((item, index) => (
          <Popover
            key={index}
            className={`flex flex-col w-24 relative p-2 text-gray-500 rounded-lg transition-all duration-200 ease-in-out`}>
            <Popover.Button className="hover:text-gray-600">
              <div className="flex items-center justify-center ">
                <FileIcon extension={item.extension} {...defaultStyles[item.extension]} />
              </div>
              <div className="flex items-center justify-between w-full">
                <div className="truncate w-full">{item.name}</div>
              </div>
            </Popover.Button>
            <Popover.List className="absolute w-full h-full items-center justify-start py-2 top-0 left-0 z-30 flex flex-col rounded-lg bg-gray-200 text-sm shadow-xl gap-1">
              <Popover.ListItem
                onClick={downloadFile}
                className="flex items-center justify-start pl-1 gap-[2px] w-full cursor-pointer hover:bg-gray-300 text-gray-600">
                <DownloadIcon fontSize="small" />
                Завантажити
              </Popover.ListItem>
              <Popover.ListItem className="flex items-center justify-start pl-1 gap-[2px] w-full  cursor-pointer hover:bg-gray-300 text-gray-600">
                <DeleteIcon fontSize="small" />
                Видалити
              </Popover.ListItem>
              <Popover.ListItem
                onClick={() => handleAboutClick(item)}
                className="flex items-center justify-start pl-1 gap-[2px] w-full cursor-pointer hover:bg-gray-300 text-gray-600">
                <InfoIcon fontSize="small" />
                Детальніше
              </Popover.ListItem>
              <Popover.ListItem>Перейменувати</Popover.ListItem>
            </Popover.List>
          </Popover>
        ))}
      </ul>
      {selectedFile && (
        <FileInfoDialog open={dialogOpen} file={selectedFile} onClose={handleCloseDialog} />
      )}
    </>
  );
};

export default DataList;
