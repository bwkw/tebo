import { FC } from 'react'

import { Card } from '@nextui-org/react'

import { ImageCardType } from 'types/Card'

export const ImageCard: FC<ImageCardType> = (props) => (
  <Card css={{ h: `${props.heightPx}px`, w: `${props.widthPx}px` }}>
    <Card.Body css={{ p: 0 }}>
      <Card.Image src={props.imageUrl} width='100%' height='100%' objectFit='cover' alt='image' />
    </Card.Body>
  </Card>
)
