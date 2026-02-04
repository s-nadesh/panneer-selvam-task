<script setup>
import { useToastStore } from '@/Stores/toast'

const toast = useToastStore()
</script>

<template>
  <div class="fixed top-4 right-4 space-y-2">
    <div
      v-for="msg in toast.messages"
      :key="msg.id"
      class="px-4 py-2 rounded text-white"
      :class="msg.type === 'success' ? 'bg-green-500' : 'bg-red-500'"
    >
      {{ msg.text }}
    </div>
  </div>
</template>
