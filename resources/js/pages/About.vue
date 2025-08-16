<script setup>
const props = defineProps({
  categories: {
    type: Array,
    required: true,
  },
})
</script>

<template>
  <div v-if="categories.length">
    <div v-for="category in categories" :key="category.id">
      <p>{{ category.name }}</p>
    </div>
  </div>
  <p v-else>No categories found.</p>
</template>
