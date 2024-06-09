import classNames from 'classnames';
import React from 'react';
import { PopoverContext } from './PopoverProvider';
import PopoverButton from './PopoverButton';
import PopoverList from './PopoverList';
import PopoverListItem from './PopoverListItem';

interface PopoverComponentProps extends React.ComponentPropsWithoutRef<'div'> {}

const PopoverComponent: React.FC<PopoverComponentProps> = ({ className, children, ...rest }) => {
  const [open, setOpen] = React.useState(false);

  const onOpen = () => setOpen(true);
  const onClose = () => setOpen(false);

  return (
    <PopoverContext.Provider value={{ open, onOpen, onClose }}>
      <div
        {...rest}
        className={classNames(
          `relative hover:shadow-xl hover:bg-gray-200 ${open ? 'bg-gray-200' : ''}`,
          className,
        )}>
        {children}
      </div>
    </PopoverContext.Provider>
  );
};

const Popover = Object.assign(PopoverComponent, {
  Button: PopoverButton,
  List: PopoverList,
  ListItem: PopoverListItem,
});
export default Popover;
