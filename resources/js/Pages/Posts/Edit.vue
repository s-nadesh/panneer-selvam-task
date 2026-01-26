<script setup>
import PostForm from './components/PostForm.vue'

defineProps({
  post: Object,
})
</script>

<template>
  <h1>Edit Post</h1>

  <img
    v-if="post.image"
    :src="`${post.image}`"
    width="100"
  />

  <PostForm
    :post="post"
    :url="`/posts/${post.id}`"
    method="put"
  />
</template>
