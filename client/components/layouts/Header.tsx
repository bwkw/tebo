import { Text } from '@nextui-org/react'
import Image from 'next/image'
import Link from 'next/link'

export const Header = () => {
  const menuLists = [{ name: 'login', link: '/login' }]
  return (
    <div className='flex bg-black bg-opacity-90 sticky top-0 h-20'>
      <div className='flex-none flex-1'>
        <Link href='/'>
          <a className='flex'>
            <Image src='/images/tebo.png' alt='logo' width='80px' height='80px' />
            <div className='font-bold text-4xl text-white'>Tebo</div>
          </a>
        </Link>
      </div>
      <div className='flex shrink font-bold items-center'>
        <ul className='flex flex-initial text-left items-center'>
          {menuLists.map((value, index) => (
            <li key={index} className='text-white'>
              <Link href={value.link}>{value.name}</Link>
            </li>
          ))}
        </ul>
      </div>
    </div>
  )
}
