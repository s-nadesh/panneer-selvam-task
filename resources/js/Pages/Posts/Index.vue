<script setup>

    import {ref} from 'vue'
    import {useForm,router} from '@inertiajs/vue3'

    const props = defineProps({
        posts: Array,
        post:Array
    })

    const form = useForm({
        title : props.post?.title || '',
        email : props.post?.email || '',
        image : null,
    });

    function submit(){

        if(props.post){
            form.put(`/posts/${props.post.id}`,{
                method:'put',
                preserveScroll:true
            })
        }else{
            form.post('/posts',{
                preserveScroll:true,
            })
        }

    }

    function remove(id){
        router.delete(`/posts/${id}`)
    }

    function edit(id){
        router.get(`/posts/${id}/edit`)
    }
    
</script>

<template>
    <h1>Post</h1>
    <form @submit.prevent="submit">

        <label>Title</label>
        <input v-model="form.title" placeholder="post title">
        <div v-if="form.errors.title">{{form.errors.title}}</div>

        <div>
            <label>email</label>
            <input v-model="form.email" type="email">
            <div v-if="form.errors.email">{{form.errors.email}}</div>
        </div>

        <div>
            <label>Image</label>
            <input type="file" @change="e=>form.image = e.target.files[0]" />
        </div>
        <div v-if="props.post?.image"><img :src="`${props.post.image}`" alt="image" width="160"></div>
        
        <button type="submit">{{props.post?'Update':'Add'}}</button>

    </form>

    <ul>
        <li v-for="post in posts" :key="post.id">
            {{post.title}}
            <button @click="edit(post.id)">edit</button>
            <button @click="remove(post.id)">Remove</button>
        </li>
    </ul>

</template>

