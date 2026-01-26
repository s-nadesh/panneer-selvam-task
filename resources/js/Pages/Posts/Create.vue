<script setup>
import PostForm from './components/PostForm.vue'
</script>

<template>
  <h1>Create Post</h1>

  <PostForm
    url="/posts"
    method="post"
  />
</template>
