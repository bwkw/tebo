import type { GetServerSideProps, NextPage } from 'next'

import { FetchBookType } from 'features/book/types'
import { axios } from 'libs/axios'

export const getServerSideProps: GetServerSideProps = async () => {
  // const fetcher = (url: string): Promise<fetchBookType[]> => axios.get(url).then((res) => res.data)
  // const { data: books, error } = useSWR('/api/books', fetcher)
  const books = await axios.get('/api/books').then((res) => res.data)

  return { props: { books } }
}

const Home: NextPage<FetchBookType> = (books) => {
  console.log(books)
  return <div className='underline'>テス</div>
}

export default Home
