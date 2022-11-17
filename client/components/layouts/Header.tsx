import Image from 'next/image'
import Link from 'next/link'

export const Header = () => {
  const menuLists = [{ name: 'login', link: '/login' }]
  return (
    <div className='flex bg-black bg-opacity-90 sticky top-0'>
      <div className='flex-none flex-1'>
        <Link href='/'>
          <Image src='/images/tech-book.png' alt='logo' width={200} height={100} />
        </Link>
      </div>
      <div className='shrink font-bold m-5'>
        <ul className='flex flex-initial text-left'>
          {menuLists.map((value, index) => (
            <li key={index} className='p-4 text-white'>
              <Link href={value.link}>{value.name}</Link>
            </li>
          ))}
        </ul>
      </div>
    </div>
  )
}
