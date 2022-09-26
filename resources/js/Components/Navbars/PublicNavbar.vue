<template>
  <nav class="top-0 fixed z-50 w-full flex flex-wrap items-center justify-between px-2 py-3 navbar-expand-lg bg-white shadow">
    <div class="container px-4 mx-auto flex flex-wrap items-center justify-between">
      <div class="w-full relative flex justify-between lg:w-auto lg:static lg:block lg:justify-start">
        <a class="text-blueGray-700 text-sm font-bold leading-relaxed inline-block mr-4 py-2 whitespace-nowrap uppercase">ANNOUNCEMENT APP</a>

        <button class="cursor-pointer text-xl leading-none px-3 py-1 border border-solid border-transparent rounded bg-transparent block lg:hidden outline-none focus:outline-none" type="button" v-on:click="setNavbarOpen">
          <font-awesome-icon icon="fa-bars" />
        </button>
      </div>

      <div class="lg:flex flex-grow items-center" :class="[navbarOpen ? 'block' : 'hidden']" id="example-navbar-warning">
        <ul class="flex flex-col lg:flex-row list-none lg:ml-auto">
          <li class="flex items-center">
            <Link :href="$route('login')" as="button" method="get" class="bg-blue-500 text-white active:bg-blue-600 text-xs font-bold uppercase px-4 py-2 rounded shadow hover:shadow-lg outline-none focus:outline-none lg:mr-1 lg:mb-0 ml-3 mb-3 ease-linear transition-all duration-150"> <font-awesome-icon icon="fa-solid fa-user" class="mr-2" /> Login </Link>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3'

export default {
  components: { Link },
  data() {
    return {
      navbarOpen: false,
    }
  },
  methods: {
    setNavbarOpen() {
      this.navbarOpen = !this.navbarOpen
    },
  },
}
</script>
