/** @type {import('next').NextConfig} */

const nextConfig = {
  reactStrictMode: true,
  webpackDevMiddleware: (config) => {
    config.watchOptions = {
      poll: 1200, //チェック時間
      aggregateTimeout: 500, // 遅延時間
      ignored: ['node_modules'],
    }
    return config
  },
}
module.exports = nextConfig
