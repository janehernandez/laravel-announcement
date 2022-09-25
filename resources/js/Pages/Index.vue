<template>
  <div class="flex flex-col h-screen justify-between">
    <x-public-navbar />
    <div class="container my-24 px-6 mx-auto">
      <section v-if="$page.props.announcements.data.length" class="mb-32 text-gray-800 text-center md:text-left">
        <h2 class="text-3xl font-bold mb-12 text-center">Announcements</h2>
        <div v-for="(announcement, key) in $page.props.announcements.data" :key="key" class="flex flex-wrap mb-6">
          <div class="grow-0 shrink-0 basis-auto w-full px-3 mb-6 md:mb-0 mr-auto">
            <h5 class="text-lg font-bold mb-3">{{ announcement.title }}</h5>
            <p class="text-gray-500 mb-6">
              <small
                >Posted <u>{{ formatPostedDate(announcement.created_at) }}</u></small
              >
            </p>
            <p class="text-gray-500">{{ announcement.content }}</p>
          </div>
        </div>

        <x-pagination :links="$page.props.announcements.links" />
      </section>
      <section v-else class="mb-32 text-gray-800 text-center md:text-left">
        <h2 class="text-3xl font-bold mb-12 text-center">No announcements to display at the moment</h2>
      </section>
    </div>

    <x-footer />
  </div>
</template>

<script>
import moment from 'moment'

export default {
  setup() {
    const formatPostedDate = (value) => {
      if (value) {
        return moment(String(value)).format('YYYY.MM.DD')
      }
    }

    return { formatPostedDate }
  },
}
</script>
