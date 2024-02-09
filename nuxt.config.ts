// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
  devtools: { enabled: false },
  //esto es para ver la configuracion y los puntos a b de nuxt 
  css:['~/assets/assets.css','~/assets/borders.css'],
  vite:{
    define:{
      'process.env.DEBUG': false,
    }
  },
  plugins:[
    '~/plugins/sweetalert2',
  ],
  components:[
    {
     path:'~/components',
     pathPrefix:false,  //el pathPrefix permite que con solo el nombre que esta dentro del Path es suficiente par buscar
    }
  ],
  //esto es para el server.component
  experimental:{
    componentIslands: true,
  },
  modules:['@pinia/nuxt'],
  app:{
    head: {
      link: [
          {
              rel: 'stylesheet',
              href: 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css',
              integrity: 'sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN',
              crossorigin: 'anonymous'
          }
      ],
      script: [
          {
              src: 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js',
              integrity: 'sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL',
              crossorigin: 'anonymous'
          }
      ],
  }
  },
  hooks:{
    'ready': (ctx) => console.log(ctx)
  },

})
