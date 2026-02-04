import { defineStore } from 'pinia'

export const useToastStore = defineStore('toast', {

  state: () => ({
    messages: []
  }),

  actions: {
    success(text) {
      this.add(text, 'success')
    },
    error(text) {
      this.add(text, 'error')
    },
    add(text, type) {
      this.messages.push({
        id: Date.now(),
        text,
        type
      })

      setTimeout(() => {
        this.remove(this.messages[0]?.id)
      }, 3000)
    },
    remove(id) {
      this.messages = this.messages.filter(m => m.id !== id)
    }
  }

})
