import { FC } from 'react'

import { Footer } from './Footer'
import { Header } from './Header'

type LayoutProps = {
  children: FC
}
export const Layout: FC<LayoutProps> = ({ children }) => {
  return (
    <>
      <Header />
      {children}
      <Footer />
    </>
  )
}
