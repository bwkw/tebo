import { DateTime } from 'luxon'
import { GetServerSideProps, NextPage } from 'next'

import { BookType } from 'features/book/types'
import { axios } from 'libs/axios'

export const getServerSideProps: GetServerSideProps = async (context) => {
  const { id } = context.query
  const book = await axios.get(`/api/books/${id}`).then((res) => res.data)
  return {
    props: {
      book,
    },
  }
}

const Book: NextPage<BookType> = ({ book }) => {
  return (
    <>
      <div className='relative flex min-h-screen items-center overflow-hidden p-5'>
        <div className='relative mx-auto w-full max-w-5xl rounded bg-white text-gray-800 shadow-xl md:p-14 md:text-left lg:p-20'>
          <div className='-mx-10 items-center md:flex'>
            <img
              className='mb-10 w-full px-10 md:mb-0 md:w-1/2'
              src={book.cover_image_url}
              alt={book.title}
              width={300}
              height={600}
            />
            <div className='w-full px-7 md:w-1/2'>
              <div className='mb-9'>
                <h1 className='text-2xl font-bold'>{book.title}</h1>
              </div>
              <div>
                <div className='mb-12'>
                  <div>{book.description}</div>
                </div>
                <div className='mb-1 flex justify-end'>
                  <span className='pr-4 align-baseline'>出版社:{book.publisher}</span>
                  <span className='align-baseline'>
                    出版日:{DateTime.fromISO(book.published_date.toString()).toFormat('yyyy-MM-dd')}
                  </span>
                </div>
                <div className='flex justify-end'>
                  <span className='pr-4 align-baseline'>著者:{book.authors}</span>
                  <span className='align-baseline'>ページ数:{book.page}</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </>
  )
}

export default Book
