import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/inertia-vue3'
import { InertiaProgress } from '@inertiajs/progress'

require('./bootstrap')

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Ramaroo'
const route = window.route
window.Vapor = require('laravel-vapor')

createInertiaApp({
  title: (title) => `${title} - ${appName}`,
  resolve: (name) => {
    return require(`./Pages/${name}`)
  },
  setup ({ el, app, props, plugin }) {
    return createApp({ render: () => h(app, props) })
      .use(plugin)
      .mixin({ methods: { route } })
      .mount(el)
  }
})

InertiaProgress.init({ color: '#4B5563' })
