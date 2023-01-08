import { FC } from 'react'

import { Button, Text } from '@nextui-org/react'
import Link from 'next/link'
import { ImInfo } from 'react-icons/im'

import { ButtonType } from 'types/button'

export const InfoButton86878A: FC<ButtonType> = (props) => {
  return (
    <Button flat auto css={{ color: '#ffffff', bgColor: '#86878A' }}>
      <ImInfo className={'pr-1'} />
      <Link href={props.url}>
        <Text css={{ color: 'inherit' }} size={12} weight='bold'>
          {props.text}
        </Text>
      </Link>
    </Button>
  )
}
