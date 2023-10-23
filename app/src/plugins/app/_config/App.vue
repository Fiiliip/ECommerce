<template>
  <div>
    <a-header />
    <RouterView />
    <a-footer />
  </div>
</template>

<script setup lang="ts">
import { RouterView } from 'vue-router'
</script>