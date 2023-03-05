import { Grid, Text } from '@nextui-org/react'

import type { GetServerSideProps, NextPage } from 'next'

import { BookImageCard } from 'components/elements/Card/BookImageCard'
import { BookIndexType, FetchBookType } from 'features/book/types'
import { axios } from 'libs/axios'

export const getServerSideProps: GetServerSideProps = async () => {
  const books = await axios.get('/api/books').then((res) => res.data)
  return {
    props: {
      books: books,
    },
  }
}

const Book: NextPage<BookIndexType> = ({ books }) => {
  return (
    <>
      <Text className='mb-6 text-center text-2xl font-bold text-white underline underline-offset-4'>本の一覧</Text>
      <Grid.Container gap={4} justify='center'>
        {books.map((book: FetchBookType, index: number) => {
          return (
            <Grid xs={2} key={index}>
              <BookImageCard book={book} />
            </Grid>
          )
        })}
      </Grid.Container>
    </>
  )
}

export default Book
