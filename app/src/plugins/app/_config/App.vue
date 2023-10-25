<template>
  <div class="flex flex-col">
    <a-header />
    <RouterView class="flex-1" />
    <a-footer />
  </div>
</template>

<script lang="ts">
export default {
  created() {
    this.$store.dispatch('emarketplace/initialize')
  }
}
</script>