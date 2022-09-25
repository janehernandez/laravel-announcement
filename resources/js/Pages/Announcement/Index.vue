<template>
  <MainLayout :url="url">
    <div class="flex flex-col">
      <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
          <table class="min-w-full">
            <thead class="border-b">
              <tr>
                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">Title</th>
                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">Start Date</th>
                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">End Date</th>
                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">Action</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(announcement, key) in $page.props.announcements.data" :key="key" class="border-b">
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ announcement.title }}</td>
                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">{{ announcement.startDate }}</td>
                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">{{ announcement.endDate }}</td>
                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                  <Link :href="$route('announcements.edit', announcement.id)" class="me-3">Edit</Link> |
                  <a href="javascript:void(0)" @click="deleteResource(announcement.id)" class="me-3">Delete</a>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <x-pagination :links="$page.props.announcements.links" />
    </div>
  </MainLayout>
</template>

<script>
import { usePage, Link } from '@inertiajs/inertia-vue3'
import MainLayout from '../../Layouts/Main.vue'

export default {
  components: { MainLayout, Link },
  data() {
    return {
      deleteForm: this.$inertia.form(),
    }
  },

  methods: {
    deleteResource(id) {
      this.deleteForm.delete(route('announcements.destroy', id))
    },
  },

  setup() {
    const url = usePage().url.value
    return { url }
  },
}
</script>
