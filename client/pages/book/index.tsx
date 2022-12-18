import { Grid, Card, Col, Row } from '@nextui-org/react'

import { Button94f9f0 } from '../../components/elements/Button/Button94f9f0'

import type { GetServerSideProps, NextPage } from 'next'

import { bookIndexType, fetchBookType } from 'features/book/types'
import { axios } from 'libs/axios'

export const getServerSideProps: GetServerSideProps = async () => {
  const books = await axios.get('/api/books').then((res) => res.data)
  return {
    props: {
      books: books,
    },
  }
}

const Book: NextPage<bookIndexType> = ({ books }) => {
  return (
    <Grid.Container gap={4} justify='center'>
      {books.map((book: fetchBookType, index: number) => {
        return (
          <Grid xs={3} key={index}>
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
                }}
              >
                <Row>
                  <Col>
                    <Row>
                      <Col>
                        <div className={'text-xs text-slate-900'}>{book.title}</div>
                      </Col>
                    </Row>
                  </Col>
                  <Col>
                    <Row justify='flex-end'>
                      <Button94f9f0 text={'Detail'} url={`/books/${book.id}`} />
                    </Row>
                  </Col>
                </Row>
              </Card.Footer>
            </Card>
          </Grid>
        )
      })}
    </Grid.Container>
  )
}

export default Book
