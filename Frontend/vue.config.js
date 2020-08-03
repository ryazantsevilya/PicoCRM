module.exports = {
  "transpileDependencies": [
    "vuetify"
  ],
  devServer: {
    disableHostCheck: true,
    proxy: {
      '^/api': {
        target: 'http://localhost/',
        changeOrigin: true,
        secure: true,
        logLevel: 'debug',
      },
    },
  },
}