import type { GetServerSideProps, NextPage } from 'next'

import { FetchBookType } from 'features/book/types'
import { axios } from 'libs/axios'

export const getServerSideProps: GetServerSideProps = async () => {
  const books = await axios.get('/api/books').then((res) => res.data)

  return { props: { books } }
}

const Home: NextPage<FetchBookType> = (books) => {
  return <div className='underline'>テスト</div>
}

export default Home
