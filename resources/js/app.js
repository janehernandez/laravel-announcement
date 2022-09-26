require('./bootstrap')

import { createApp, h } from 'vue'
import { App, plugin } from '@inertiajs/inertia-vue3'
import { InertiaProgress } from '@inertiajs/progress'
/* import font awesome icon component */
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import { library } from '@fortawesome/fontawesome-svg-core'
import { fas } from '@fortawesome/free-solid-svg-icons'
import { far } from '@fortawesome/free-regular-svg-icons'
import { fab } from '@fortawesome/free-brands-svg-icons'

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

library.add(fas)
library.add(fab)
library.add(far)

app.component('font-awesome-icon', FontAwesomeIcon)
app.config.globalProperties.$route = window.route
app.provide('$route', window.route)
app.use(plugin).mount(el)
