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
    <nav className='sticky top-0 z-50 flex rounded bg-black px-2 py-2.5 opacity-90 sm:px-4'>
      <div className='container mx-auto flex flex-wrap items-center justify-between'>
        <Link href='/'>
          <a className='flex items-center'>
            <Image src='/images/tebo.png' alt='logo' width='60px' height='60px' />
            <span className='self-center whitespace-nowrap p-2 text-3xl font-semibold dark:text-white'>Tebo</span>
          </a>
        </Link>
        <div className='hidden w-full md:block md:w-auto' id='navbar-default'>
          <ul className='flex flex-col items-center rounded-lg border p-5 md:mt-0 md:flex-row md:space-x-8 md:border-0 md:text-sm md:font-medium'>
            {isLogin ? (
              <>
                {loginMenuLists.map((value, index) => (
                  <li key={index} className='m-0 block rounded py-0 pl-3 pr-4 text-white md:bg-transparent'>
                    <Link href={value.link}>{value.name}</Link>
                  </li>
                ))}
              </>
            ) : (
              <>
                {notLoginMenuLists.map((value, index) => (
                  <li key={index} className='block rounded py-2 pl-3 pr-4 text-white md:bg-transparent md:p-0'>
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
