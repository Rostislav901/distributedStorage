import { ComponentPropsWithoutRef, FC } from 'react';
import { usePopoverContext } from './PopoverProvider';
import classNames from 'classnames';

interface PopoverButtonProps extends ComponentPropsWithoutRef<'button'> {}

const PopoverButton: FC<PopoverButtonProps> = ({ children, className, onClick, ...rest }) => {
  const props = usePopoverContext();
  return (
    <button
      {...rest}
      className={classNames('', className)}
      onClick={(e) => {
        onClick?.(e);
        props.onOpen();
      }}>
      {children}
    </button>
  );
};

export default PopoverButton;
