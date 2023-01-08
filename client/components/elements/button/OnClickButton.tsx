import { FC } from 'react'

import { Button } from '@nextui-org/react'

import { OnClickButtonType } from 'types/button'

export const OnClickButton: FC<OnClickButtonType> = (props) => {
  return <Button className='bg-purple-900'>{props.text}</Button>
}
