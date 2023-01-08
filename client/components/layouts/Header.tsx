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
    <nav className='flex bg-black bg-opacity-90 sticky top-0 px-2 sm:px-4 py-2.5 z-50 border-b border-gray-700'>
      <div className='container flex flex-wrap items-center justify-between mx-auto'>
        <Link href='/'>
          <a className='flex items-center'>
            <Image src='/images/tebo.png' alt='logo' width='60px' height='60px' />
            <span className='self-center text-3xl font-semibold whitespace-nowrap dark:text-white p-2'>Tebo</span>
          </a>
        </Link>
        <div className='hidden w-full md:block md:w-auto' id='navbar-default'>
          <ul className='flex flex-col p-5 items-center border rounded-lg md:flex-row md:space-x-8 md:mt-0 md:text-sm md:font-medium md:border-0'>
            {isLogin ? (
              <>
                {loginMenuLists.map((value, index) => (
                  <li key={index} className='text-white block rounded md:bg-transparent m-0 py-0 pl-3 pr-4'>
                    <Link href={value.link}>{value.name}</Link>
                  </li>
                ))}
              </>
            ) : (
              <>
                {notLoginMenuLists.map((value, index) => (
                  <li key={index} className='text-white block py-2 pl-3 pr-4 rounded md:bg-transparent p-0 m-0'>
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
