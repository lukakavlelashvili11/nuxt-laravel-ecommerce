export default {
    // Global page headers: https://go.nuxtjs.dev/config-head
    head: {
        title: 'front',
        htmlAttrs: {
            lang: 'en'
        },
        meta: [
            { charset: 'utf-8' },
            { name: 'viewport', content: 'width=device-width, initial-scale=1' },
            { hid: 'description', name: 'description', content: '' },
            { name: 'format-detection', content: 'telephone=no' }
        ],
        link: [],
        script: [{
            src: 'https://www.paypal.com/sdk/js?client-id=AfK2HSEPZfEbwBoeu3J1cWyeq7XpjwNHcULFhn6SEv0qODBp7FOd8sBe2au2XgnIJo8BBmNF-em5Gvqj&disable-funding=card'
        }],
    },

    // Global CSS: https://go.nuxtjs.dev/config-css
    css: [
        '@/assets/css/globalClasses.css'
    ],

    // Plugins to run before rendering page: https://go.nuxtjs.dev/config-plugins
    plugins: [
        { src: '@/plugins/rangeSlider', ssr: false },
        { src: '@/plugins/vueCarousel', ssr: false }
    ],

    // Auto import components: https://go.nuxtjs.dev/config-components
    components: true,

    // Modules for dev and build (recommended): https://go.nuxtjs.dev/config-modules
    buildModules: [
        '@nuxtjs/moment',
    ],

    // Modules: https://go.nuxtjs.dev/config-modules
    modules: [
        'bootstrap-vue/nuxt',
        '@nuxtjs/axios',
        '@nuxtjs/auth-next'
    ],

    auth: {
        strategies: {
            'laravelSanctum': {
                provider: 'laravel/sanctum',
                url: 'http://localhost:8000',
                endpoints: {
                    login: {
                        url: '/api/login',
                        method: 'POST'
                    },
                    logout: {
                        url: '/api/logout',
                        method: 'POST'
                    },
                    user: {
                        url: '/api/user',
                        methods: 'GET'
                    }
                }
            }
        }
    },

    axios: {
        credentials: true,
        baseURL: "http://localhost:8000/api"
    },

    // Build Configuration: https://go.nuxtjs.dev/config-build
    build: {},

    loading: {
        color: '#a7f8fc',
        height: '2px'
      }
}