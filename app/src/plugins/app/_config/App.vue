<template>
  <div class="flex flex-col">
    <a-header />
    <RouterView class="flex-1" />
    <a-footer />
  </div>
</template>

<script setup lang="ts">
import { RouterView } from 'vue-router'
</script>