import { FC } from 'react'

import { Button, Text } from '@nextui-org/react'

import { ButtonType } from 'types/Button'

export const ButtonSecondary: FC<ButtonType> = ({ text, url }) => {
  return (
    <Button flat auto rounded color='secondary'>
      <Text css={{ color: 'inherit' }} size={12} weight='bold' transform='uppercase'>
        Notify Me
      </Text>
    </Button>
  )
}
