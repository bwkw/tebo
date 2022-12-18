import { FC } from 'react'

import { Button } from '@nextui-org/react'
import Link from 'next/link'

import { ButtonType } from 'types/Button'

export const Button94f9f0: FC<ButtonType> = (props) => {
  return (
    <Button flat auto rounded css={{ color: '#94f9f0', bg: '#94f9f026' }}>
      <Link href={props.url}>
        <p>{props.text}</p>
      </Link>
    </Button>
  )
}
