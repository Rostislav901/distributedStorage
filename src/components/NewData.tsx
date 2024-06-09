import React from 'react';
import Form from './Form';

const NewData: React.FC = () => {
  const [visible, setVisible] = React.useState<boolean>(false);

  const handleAddNewData = (event: React.FormEvent<HTMLFormElement>) => {
    event.preventDefault();
    try {
      const form = event.target as HTMLFormElement;

      const file = form.file.value;
      console.log(file);
      setVisible(false);
    } catch (error) {
      console.log(error);
    }
  };

  return (
    <>
      {visible ? (
        <>
          <button
            className="flex px-2 py-2 bg-gray-900 hover:bg-gray-800 transition-all	duration-200	ease-in-out text-gray-300 rounded-full items-center justify-center shadow-custom"
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
          </button>
          <Form
            onSubmit={(e) => handleAddNewData(e)}
            className="flex flex-col gap-3 mt-3 items-center max-w-max">
            <Form.Input
              name="file"
              type="file"
              accept=".txt,.pdf,.docx,.mkv,.jpg"
              className="flex p-3 bg-gray-200 rounded-lg shadow-custom"
            />
            <Form.Submit>Add new file</Form.Submit>
          </Form>
        </>
      ) : (
        <button
          className="flex px-2 py-2 bg-gray-900 hover:bg-gray-800 transition-all	duration-200	ease-in-out text-gray-300 rounded-full items-center justify-center shadow-custom"
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
        </button>
      )}
    </>
  );
};

export default NewData;
