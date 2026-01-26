<script setup>
import EasyDataTable from 'vue3-easy-data-table'
import { Link, router } from '@inertiajs/vue3'
import { ref, watch } from 'vue'

const props = defineProps({
  posts: Object,
  filters: Object,
})

const headers = [
  { text: 'ID', value: 'id' },
  { text: 'Title', value: 'title' },
  { text: 'Email', value: 'email' },
  { text: 'Action', value: 'action' },
]

const search = ref(props.filters.search ?? '')

/* reload page with search */
watch(search, (value) => {
  router.get(
    '/posts',
    { search: value },
    {
      preserveState: true,
      replace: true,
    }
  )
})

const deletepost = (id) => {
  if(!confirm('Are you confirm to delete ?')) return

  router.delete(`posts/${id}`,{
    preserveScroll: true,
  })
} 
</script>

<template>
  <div style="margin-bottom:10px">
    <input
      v-model="search"
      placeholder="Search title or email..."
    />

    <Link href="/posts/create" style="margin-left:10px">
      ➕ Add Post
    </Link>
  </div>

  <EasyDataTable
    :headers="headers"
    :items="posts.data"
  >
    <template #item-action="{ id }">
      <Link :href="`/posts/${id}/edit`">Edit</Link>
      <button @click=deletepost(id)>Delete</button>
    </template>
  </EasyDataTable>
</template>
