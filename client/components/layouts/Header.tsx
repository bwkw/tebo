import { useState } from 'react'

import Image from 'next/image'
import Link from 'next/link'

export const Header = () => {
  const [isLogin, setIsLogin] = useState(false)
  const notLoginMenuLists = [{ name: 'login', link: '/login' }]
  const loginMenuLists = [
    { name: 'reading', link: '/reading' },
    { name: 'logout', link: '/logout' },
  ]

  return (
    <nav className='flex bg-black bg-opacity-90 sticky top-0 px-2 sm:px-4 py-2.5 rounded'>
      <div className='container flex flex-wrap items-center justify-between mx-auto'>
        <Link href='/'>
          <a className='flex items-center'>
            <Image src='/images/tebo.png' alt='logo' width='60px' height='60px' />
            <span className='self-center text-xl font-semibold whitespace-nowrap dark:text-white'>Tebo</span>
          </a>
        </Link>
        <button
          data-collapse-toggle='navbar-default'
          type='button'
          className='inline-flex items-center p-2 ml-3 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600'
          aria-controls='navbar-default'
          aria-expanded='false'
        >
          <svg
            className='w-6 h-6'
            aria-hidden='true'
            fill='currentColor'
            viewBox='0 0 20 20'
            xmlns='http://www.w3.org/2000/svg'
          >
            <path
              fill-rule='evenodd'
              d='M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z'
              clip-rule='evenodd'
            ></path>
          </svg>
        </button>
        <div className='hidden w-full md:block md:w-auto' id='navbar-default'>
          <ul className='flex flex-col p-4 mt-4 border rounded-lg md:flex-row md:space-x-8 md:mt-0 md:text-sm md:font-medium md:border-0'>
            {isLogin ? (
              <>
                {loginMenuLists.map((value, index) => (
                  <li key={index} className='text-white block py-2 pl-3 pr-4 rounded md:bg-transparent md:p-0'>
                    <Link href={value.link}>{value.name}</Link>
                  </li>
                ))}
              </>
            ) : (
              <>
                {notLoginMenuLists.map((value, index) => (
                  <li key={index} className='text-white block py-2 pl-3 pr-4 rounded md:bg-transparent md:p-0'>
                    <Link href={value.link}>{value.name}</Link>
                  </li>
                ))}
              </>
            )}
          </ul>
        </div>
      </div>
    </nav>
  )
}
