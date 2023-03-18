import { FC } from 'react'

import { Card, Col, Row } from '@nextui-org/react'

import { BuyButtonED9734 } from 'components/elements/Button/BuyButtonED9734'
import { InfoButton86878A } from 'components/elements/Button/InfoButton86878A'
import { BookType } from 'features/book/types'

export const BookImageCard: FC<BookType> = ({ book }) => (
  <Card css={{ w: '100%', h: 'auto' }}>
    <Card.Body css={{ p: 0 }}>
      {book.cover_image_url ? (
        <Card.Image src={book.cover_image_url} alt={book.title} width={'100%'} height={'100%'} objectFit={'cover'} />
      ) : (
        <Card.Image src={'images/noImage.png'} alt={book.title} width={'100%'} height={'100%'} objectFit={'cover'} />
      )}
    </Card.Body>
    <Card.Footer
      isBlurred
      css={{
        position: 'absolute',
        bgBlur: '#0f111466',
        borderTop: '$borderWeights$light solid $gray500',
        bottom: 0,
        padding: 0,
      }}
    >
      <Row>
        <Col>
          <Row justify='center'>
            <BuyButtonED9734 text={'Buy'} url={`/books/${book.id}/buy`} />
            <InfoButton86878A text={'Detail'} url={`/books/${book.id}`} />
          </Row>
        </Col>
      </Row>
    </Card.Footer>
  </Card>
)
