<template>
  <AuthLayout>
    <div class="container mx-auto px-4 h-full">
      <div class="flex content-center items-center justify-center h-full">
        <div class="w-full lg:w-4/12 px-4">
          <div class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-lg bg-blueGray-200 border-0 pt-6">
            <div class="flex-auto px-4 lg:px-10 py-10 pt-0">
              <div class="text-blueGray-400 text-center mb-3 font-bold">
                <h6 class="text-blueGray-500 text-sm font-bold">Sign in</h6>
              </div>
              <form method="post" @submit.prevent="submit">
                <div class="relative w-full mb-3">
                  <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2" htmlFor="grid-password"> Email </label>
                  <input v-model="form.email" type="email" class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150" placeholder="Email" />
                </div>

                <div class="relative w-full mb-3">
                  <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2" htmlFor="grid-password"> Password </label>
                  <input v-model="form.password" type="password" class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150" placeholder="Password" />
                </div>

                <x-errors :errors="errors" />

                <div class="text-center mt-6">
                  <button type="submit" class="bg-blueGray-800 text-white active:bg-blueGray-600 text-sm font-bold uppercase px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 w-full ease-linear transition-all duration-150">Sign In</button>
                </div>
              </form>
            </div>
          </div>
          <div class="flex flex-wrap mt-6 relative">
            <div class="w-100">
              <Link :href="$route('register')" as="button" method="get" class="text-blueGray-200">
                <small>Create new account</small>
              </Link>
            </div>
          </div>
        </div>
      </div>
    </div>
  </AuthLayout>
</template>

<script>
import { Inertia } from '@inertiajs/inertia'
import { usePage, Link } from '@inertiajs/inertia-vue3'
import { reactive, inject } from 'vue'
import AuthLayout from '../../Layouts/Auth.vue'

export default {
  components: { AuthLayout, Link },
  props: {
    errors: Object,
  },
  setup() {
    const form = reactive({
      email: null,
      password: null,
      _token: usePage().props.value.csrf_token,
    })

    const route = inject('$route')
    const submit = () => {
      Inertia.post(route('login.store'), form)
    }

    return {
      form,
      submit,
    }
  },
}
</script>
