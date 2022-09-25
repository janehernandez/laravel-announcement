<template>
  <MainLayout :url="url">
    <div class="mt-10">
      <div class="md:grid md:grid-cols-3 md:gap-6">
        <div class="mt-5 md:col-span-2 md:mt-0">
          <form method="post" @submit.prevent="submit">
            <div class="overflow-hidden shadow sm:rounded-md">
              <div class="bg-white px-4 py-5 sm:p-6">
                <div class="grid grid-cols-6 gap-6">
                  <div class="col-span-6">
                    <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                    <input v-model="form.title" type="text" name="title" id="title" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
                  </div>

                  <div class="col-span-6">
                    <label for="content" class="block text-sm font-medium text-gray-700">Content</label>
                    <textarea v-model="form.content" id="content" name="content" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="Your message..."></textarea>
                  </div>

                  <div class="col-span-6 sm:col-span-3">
                    <label for="startDate" class="block text-sm font-medium text-gray-700">Start Date</label>
                    <input v-model="form.startDate" type="date" name="startDate" id="startDate" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
                  </div>

                  <div class="col-span-6 sm:col-span-3">
                    <label for="endDate" class="block text-sm font-medium text-gray-700">End Date</label>
                    <input v-model="form.endDate" type="date" name="endDate" id="endDate" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
                  </div>
                </div>

                <x-errors :errors="errors" />
              </div>

              <div class="bg-gray-50 px-4 py-3 text-right sm:px-6">
                <button type="submit" class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Save</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </MainLayout>
</template>

<script>
import { Inertia } from '@inertiajs/inertia'
import { usePage, Link } from '@inertiajs/inertia-vue3'
import { reactive, inject } from 'vue'
import MainLayout from '../../Layouts/Main.vue'

export default {
  components: { MainLayout, Link },
  props: {
    errors: Object,
  },
  setup() {
    const initialState = {
      title: null,
      content: null,
      startDate: null,
      endDate: null,
      _token: usePage().props.value.csrf_token,
    }

    const form = reactive({ ...initialState })

    const resetForm = () => {
      Object.assign(form, initialState)
    }

    const route = inject('$route')
    const submit = () => {
      Inertia.post(route('announcements.store'), form)
      resetForm()
    }

    const url = usePage().url.value
    return { form, submit, url }
  },
}
</script>
