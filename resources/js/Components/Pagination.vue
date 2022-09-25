<template>
  <nav class="text-center pt-6">
    <ul class="inline-flex items-center -space-x-px">
      <li v-for="(link, index) in links" :key="`link-${index}`">
        <a v-if="link.url" :href="link.url" v-html="link.label" :class="[link.active ? 'z-10 py-2 px-3 leading-tight text-blue-600 bg-blue-50 border border-blue-300 hover:bg-blue-100 hover:text-blue-700 dark:border-gray-700 dark:bg-gray-700 dark:text-white' : 'py-2 px-3 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white']" />
        <span v-else v-html="link.label" :class="[link.active ? 'z-10 py-2 px-3 leading-tight text-blue-600 bg-blue-50 border border-blue-300 hover:bg-blue-100 hover:text-blue-700 dark:border-gray-700 dark:bg-gray-700 dark:text-white' : 'py-2 px-3 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white']" style="cursor: pointer" />
      </li>
    </ul>
  </nav>
</template>

<script>
export default {
  props: {
    links: Object,
  },
}
</script>
