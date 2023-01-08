import '../styles/globals.css'
import { createTheme, NextUIProvider } from '@nextui-org/react'

import type { AppProps } from 'next/app'

import { Layout } from 'components/layouts/Layout'

const theme = createTheme({
  type: 'dark',
})

function MyApp({ Component, pageProps }: AppProps) {
  return (
    <NextUIProvider theme={theme}>
      <Layout>
        <Component {...pageProps} />
      </Layout>
    </NextUIProvider>
  )
}

export default MyApp
