import classNames from 'classnames';
import { ComponentPropsWithoutRef, FC } from 'react';
import { usePopoverContext } from './PopoverProvider';

interface PopoverListItemProps extends ComponentPropsWithoutRef<'button'> {}

const PopoverListItem: FC<PopoverListItemProps> = ({ onClick, className, children, ...rest }) => {
  const props = usePopoverContext();

  return (
    <button
      {...rest}
      onClick={(e) => {
        onClick?.(e);
        props.onClose();
      }}
      className={classNames(
        `flex py-1 cursor-pointer transition-all	duration-200	ease-in-out `,
        className,
      )}>
      {children}
    </button>
  );
};

export default PopoverListItem;
