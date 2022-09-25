<template>
  <div>
    <x-sidebar :url="url" />
    <div class="relative md:ml-64">
      <x-navbar />
      <div class="px-4 md:px-10 mx-auto w-full">
        <slot />
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    url: String,
  },
}
</script>
