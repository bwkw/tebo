import { BookType } from '../../features/book/types'

import type { GetServerSideProps, NextPage } from 'next'

import { BuyButtonED9734 } from 'components/elements/Button/BuyButtonED9734'
import { axios } from 'libs/axios'

export const getServerSideProps: GetServerSideProps = async (context) => {
  const id = context.query.id
  const book = await axios.get(`/api/books/${id}`).then((res) => res.data)
  return {
    props: {
      book: book,
    },
  }
}

const Book: NextPage<BookType> = ({ book }) => {
  return (
    <>
      <div className='relative flex min-h-screen items-center overflow-hidden p-5'>
        <div className='relative mx-auto w-full rounded bg-white p-10 text-gray-800 shadow-xl md:text-left lg:p-20'>
          <div className='items-center md:flex'>
            <div className='mb-10 w-full px-10 md:mb-0 md:w-1/2'>
              <div className='relative'>
                <img
                  className='w-full rounded-xl shadow-xl'
                  src='https://www.shoshinsha-design.com/wp-content/uploads/2020/05/noimage-760x460.png'
                  alt={book.title}
                />
              </div>
            </div>
            <div className='w-full px-10 md:w-1/2'>
              <div className='mb-10'>
                <h1 className='text-2xl font-bold text-gray-800'>{book.title}</h1>
                <p className='text-sm'>{book.description}</p>
              </div>
              <div>
                <div className='mr-5 inline-block align-bottom'>
                  <span className='align-baseline text-2xl leading-none'>$</span>
                  <span className='align-baseline text-5xl font-bold leading-none'>59</span>
                  <span className='align-baseline text-2xl leading-none'>.99</span>
                </div>
                <div className='inline-block align-bottom'>
                  <BuyButtonED9734 text={'Buy'} url={`/books/${book.id}/buy`} />
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div className='fixed bottom-0 right-0 z-10 mb-4 mr-4 flex items-end justify-end'>
        <div></div>
      </div>
    </>
  )
}

export default Book
