<template>
  <ul class="text-sm text-red-700" v-if="errors && Object.keys(errors).length > 0">
    <li v-for="(error, index) in errors" :key="index">{{ error }}</li>
  </ul>
  <div class="text-sm text-green-700" v-if="$page.props.flash.success">
    {{ $page.props.flash.success }}
  </div>
</template>
<script>
export default {
  name: 'Errors',
  props: ['errors'],
}
</script>
