<template>
  <nav class="md:left-0 md:block md:fixed md:top-0 md:bottom-0 md:overflow-y-auto md:flex-row md:flex-nowrap md:overflow-hidden shadow-xl bg-white flex flex-wrap items-center justify-between relative md:w-64 z-10 py-4 px-6">
    <div class="md:flex-col md:items-stretch md:min-h-full md:flex-nowrap px-0 flex flex-wrap items-center justify-between w-full mx-auto">
      <button class="cursor-pointer text-black opacity-50 md:hidden px-3 py-1 text-xl leading-none bg-transparent rounded border border-solid border-transparent" type="button" @click="toggleCollapseShow('bg-white m-2 py-3 px-6')">
        <font-awesome-icon icon="fa-bars" />
      </button>
      <span class="md:block text-left md:pb-2 text-blueGray-600 mr-0 inline-block whitespace-nowrap text-sm uppercase font-bold p-4 px-0"> Announcement App </span>
      <div class="md:flex md:flex-col md:items-stretch md:opacity-100 md:relative md:mt-4 md:shadow-none shadow absolute top-0 left-0 right-0 z-40 overflow-y-auto overflow-x-hidden h-auto items-center flex-1 rounded" v-bind:class="collapseShow">
        <div class="md:min-w-full md:hidden block pb-4 mb-4 border-b border-solid border-blueGray-200">
          <div class="flex flex-wrap">
            <div class="w-6/12">
              <span class="md:block text-left md:pb-2 text-blueGray-600 mr-0 inline-block whitespace-nowrap text-sm uppercase font-bold p-4 px-0"> Announcement App </span>
            </div>
            <div class="w-6/12 flex justify-end">
              <button type="button" class="cursor-pointer text-black opacity-50 md:hidden px-3 py-1 text-xl leading-none bg-transparent rounded border border-solid border-transparent" @click="toggleCollapseShow('hidden')">
                <font-awesome-icon icon="fa-times" />
              </button>
            </div>
          </div>
        </div>

        <hr class="my-2 md:min-w-full" />
        <ul class="md:flex-col md:min-w-full flex flex-col list-none md:mb-2">
          <li class="items-center">
            <Link class="text-xs uppercase py-3 font-bold block" :class="[isActive('/announcements') ? 'text-emerald-500 hover:text-emerald-600' : 'text-blueGray-700 hover:text-blueGray-500']" :href="$route('announcements.index')" as="button" method="get">
              <font-awesome-icon icon="fa-tv" class="mr-2 text-sm" :class="[isActive('/announcements') ? 'opacity-75' : 'text-blueGray-300']" />
              <span>Announcements</span>
            </Link>
          </li>

          <li class="items-center">
            <Link class="text-xs uppercase py-3 font-bold block" :class="[isActive('/announcements/create') ? 'text-emerald-500 hover:text-emerald-600' : 'text-blueGray-700 hover:text-blueGray-500']" :href="$route('announcements.create')" as="button" method="get">
              <font-awesome-icon icon="fa-square-plus" class="mr-2 text-sm" :class="[isActive('/announcements/create') ? 'opacity-75' : 'text-blueGray-300']" />
              <span>Create Announcement</span>
            </Link>
          </li>
        </ul>

        <hr class="my-2 md:min-w-full" />
        <h6 class="md:min-w-full text-blueGray-500 text-xs uppercase font-bold block pt-1 pb-4 no-underline">Settings</h6>
        <ul class="md:flex-col md:min-w-full flex flex-col list-none md:mb-4">
          <li class="items-center">
            <Link :href="$route('logout')" as="button" method="post" class="text-blueGray-700 hover:text-blueGray-500 text-xs uppercase py-3 font-bold block" type="button">
              <font-awesome-icon icon="fa-right-from-bracket" class="mr-2 text-sm text-blueGray-300" />
              Logout
            </Link>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3'
export default {
  props: {
    url: String,
  },

  components: { Link },

  data() {
    return {
      collapseShow: 'hidden',
    }
  },
  methods: {
    toggleCollapseShow(classes) {
      this.collapseShow = classes
    },

    isActive(link) {
      return this.url === link
    },
  },
}
</script>
