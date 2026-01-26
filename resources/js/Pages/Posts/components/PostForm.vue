<script setup>
import { useForm } from '@inertiajs/vue3'

const props = defineProps({
  post: Object,
  url: String,
  method: String,
})

const form = useForm({
  title: props.post?.title ?? '',
  email: props.post?.email ?? '',
  image: null,
})

const submit = () => {
  form.submit(props.method, props.url, {
    forceFormData: true,
  })
}
</script>

<template>
  <form @submit.prevent="submit">
    <div>
      <input v-model="form.title" placeholder="Title" />
      <div v-if="form.errors.title" class="error">
        {{ form.errors.title }}
      </div>
    </div>

    <div>
      <input v-model="form.email" placeholder="Email" />
      <div v-if="form.errors.email" class="error">
        {{ form.errors.email }}
      </div>
    </div>

    <div>
      <input type="file" @change="e => form.image = e.target.files[0]" />
      <div v-if="form.errors.image" class="error">
        {{ form.errors.image }}
      </div>
    </div>

    <button type="submit" :disabled="form.processing">
      Save
    </button>
  </form>
</template>
