import { createContext, useContext } from 'react';
interface PopoverContextProps {
  open: boolean;
  onClose: () => void;
  onOpen: () => void;
}

export const PopoverContext = createContext<PopoverContextProps>(null!);

// eslint-disable-next-line react-refresh/only-export-components
export const usePopoverContext = () => {
  const props = useContext(PopoverContext);
  if (!props) {
    throw new Error('No popover context found! ');
  }

  return props;
};
