import { FC } from 'react'

import { Button, Text } from '@nextui-org/react'
import Link from 'next/link'
import { AiOutlineShoppingCart } from 'react-icons/ai'

import { ButtonType } from 'types/Button'

export const BuyButtonED9734: FC<ButtonType> = (props) => {
  return (
    <Button flat auto rounded css={{ color: '#ffffff', bgColor: '#ED9734' }}>
      <AiOutlineShoppingCart className={'pr-1'} />
      <Link href={props.url}>
        <Text css={{ color: 'inherit' }} size={12} weight='bold'>
          {props.text}
        </Text>
      </Link>
    </Button>
  )
}
