import { FC } from 'react'

import { Header } from './Header'

type LayoutProps = {
  children: FC
}
export const Layout: FC<LayoutProps> = ({ children }) => {
  return (
    <>
      <Header />
      {children}
    </>
  )
}
