require('./bootstrap')

import { createApp, h } from 'vue'
import { App, plugin } from '@inertiajs/inertia-vue3'
import { InertiaProgress } from '@inertiajs/progress'
import Toast from 'vue-toastification'
import 'vue-toastification/dist/index.css'

const el = document.getElementById('app')
InertiaProgress.init()

const app = createApp({
  render: () =>
    h(App, {
      initialPage: JSON.parse(el.dataset.page),
      resolveComponent: (name) => require(`./Pages/${name}`).default,
    }),
})

const requireComponent = require.context('./Components', true, /\.vue$/i)
requireComponent.keys().forEach((key) => {
  app.component(`X${key.split('/').pop().replace('.vue', '')}`, requireComponent(key).default)
})

app.config.globalProperties.$route = window.route
app.provide('$route', window.route)
app.use(Toast, { toastClassName: 'custom', hideProgressBar: true })
app.use(plugin).mount(el)
