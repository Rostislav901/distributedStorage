import React from 'react';
import Form from './Form';
import FormData from 'form-data';
import { useAppDispatch, useAppSelector } from '../redux/hooks';
import { selectToken } from '../redux/user/selectors';
import { addData } from '../redux/data/slice';

const NewData: React.FC = () => {
  const [visible, setVisible] = React.useState<boolean>(false);
  const token = useAppSelector(selectToken);
  const dispatch = useAppDispatch();

  const handleAddNewData = (event: React.FormEvent<HTMLFormElement>) => {
    event.preventDefault();

    const form = event.target as HTMLFormElement;
    const formData = new FormData(form);

    const title = form.eventTitle.value;
    const description = form.eventDescription.value;
    const location = form.eventLocation.value;
    const file = formData.get('eventFile');
    const startTime = form.startTime.value;
    const endTime = form.endTime.value;
    const newDataObj = { title, description, location, file, startTime, endTime };
    if (token) {
      dispatch(addData({ token, newDataObj }));
    }
    setVisible(false);
  };

  return (
    <>
      {visible ? (
        <>
          <button
            className="flex mx-52 px-2 py-2 bg-gray-900 hover:bg-gray-800 transition-all	duration-200	ease-in-out text-gray-300 rounded-xl w-20 items-center justify-center shadow-custom"
            onClick={() => {
              setVisible(false);
            }}>
            <svg
              xmlns="http://www.w3.org/2000/svg"
              fill="none"
              viewBox="0 0 24 24"
              strokeWidth={1.5}
              stroke="currentColor"
              className="size-6">
              <path strokeLinecap="round" strokeLinejoin="round" d="M6 18 18 6M6 6l12 12" />
            </svg>
            Hide
          </button>
          <Form
            onSubmit={(e) => handleAddNewData(e)}
            className="flex flex-col gap-3 mt-3 items-start w-[360px]">
            <div className="flex flex-row justify-between items-center w-full">
              <span className="">Title:</span>
              <Form.Input
                name="eventTitle"
                placeholder="event title"
                type="text"
                className="flex p-3 bg-gray-200 rounded-lg shadow-md w-[260px]"
              />
            </div>
            <div className="flex flex-row justify-between items-center w-full">
              <span className="">Description:</span>
              <Form.Input
                name="eventDescription"
                placeholder="event description"
                type="text"
                className="flex p-3 bg-gray-200 rounded-lg shadow-md w-[260px]"
              />
            </div>
            <div className="flex flex-row justify-between items-center w-full">
              <span className="">Location:</span>
              <Form.Input
                name="eventLocation"
                type="text"
                placeholder="event location"
                className="flex p-3 bg-gray-200 rounded-lg shadow-md w-[260px]"
              />
            </div>
            <div className="flex flex-row justify-between items-center w-full">
              <span className="">Start time:</span>
              <Form.Input
                name="startTime"
                type="date"
                placeholder="location"
                className="flex p-3 justify-center bg-gray-200 rounded-lg shadow-md w-[260px]"
              />
            </div>
            <div className="flex flex-row justify-between items-center w-full">
              <span className="">End time:</span>
              <Form.Input
                name="endTime"
                type="date"
                placeholder="location"
                className="flex p-3 justify-center bg-gray-200 rounded-lg shadow-md w-[260px]"
              />
            </div>
            <div className="flex flex-row justify-between items-center w-full">
              <span className="flex">File:</span>
              <Form.Input
                name="eventFile"
                type="file"
                accept=".txt,.pdf,.docx,.mkv,.jpg"
                className="flex text-xs p-3 bg-gray-200 rounded-lg shadow-md w-[260px]"
              />
            </div>
            <Form.Submit>Add new event</Form.Submit>
          </Form>
        </>
      ) : (
        <button
          className="flex px-2 py-2 bg-gray-900 hover:bg-gray-800 transition-all	duration-200	ease-in-out text-gray-300 rounded-xl w-20 items-center justify-center shadow-custom"
          onClick={() => {
            setVisible(true);
          }}>
          <svg
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            strokeWidth={1.5}
            stroke="currentColor"
            className="size-6">
            <path strokeLinecap="round" strokeLinejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
          </svg>
          Add
        </button>
      )}
    </>
  );
};

export default NewData;
