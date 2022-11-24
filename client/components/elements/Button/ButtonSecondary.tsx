import { FC } from 'react'

import { Button, Text } from '@nextui-org/react'

import { ButtonType } from 'types/Button'

export const ButtonSecondary: FC<ButtonType> = (props) => {
  return (
    <Button flat auto rounded color='secondary'>
      <Text css={{ color: 'inherit' }} size={12} weight='bold' transform='uppercase'>
        {props.text}
      </Text>
    </Button>
  )
}
