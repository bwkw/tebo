import { FC } from 'react'

import { Card, Col, Row } from '@nextui-org/react'

import { Button94f9f0 } from 'components/elements/Button/Button94f9f0'
import { BookType } from 'features/book/types'

export const BookImageCard: FC<BookType> = ({ book }) => (
  <Card css={{ w: '100%', h: 'auto' }}>
    <Card.Body css={{ p: 0 }}>
      <Card.Image
        src={book.cover_image_url}
        objectFit='cover'
        width='100%'
        height='100%'
        alt='Relaxing app background'
      />
    </Card.Body>
    <Card.Footer
      isBlurred
      css={{
        position: 'absolute',
        bgBlur: '#0f111466',
        borderTop: '$borderWeights$light solid $gray800',
        bottom: 0,
        zIndex: 1,
        height: 12,
      }}
    >
      <Row>
        <Col>
          <Row justify='flex-end'>
            <Button94f9f0 text={'Detail'} url={`/books/${book.id}`} />
          </Row>
        </Col>
      </Row>
    </Card.Footer>
  </Card>
)
