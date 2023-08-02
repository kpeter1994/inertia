<script setup>

import App from "@/Layouts/App.vue";
import {Head, useForm} from "@inertiajs/vue3";


const props = defineProps({
    post: Object,
    errors: Object
})

const form = useForm(
    {
        id: props.post.id,
        title: props.post.title,
        description: props.post.description
    })
</script>

<template>
    <Head>
        <title>Edit Post</title>
    </Head>

    <App>
        <form class="bg-gray-100 p-3 max-w-2xl mx-auto rounded-lg mt-20" @submit.prevent="form.put(route('posts.update', form.id))">
            <div class="flex flex-col gap-1.5 mb-3">
                <label for="title" class="text-sm uppercase text-gray-900 font-bold">
                    Title
                </label>
                <input v-model="form.title" id="title" type="text" class="p-3">
                <p v-if="props.errors.title" class="text-red-500">{{props.errors.title}}</p>
            </div>

            <div class="flex flex-col gap-1.5 mb-3">
                <label for="description" class="text-sm uppercase text-gray-900 font-bold">
                    Content
                </label>
                <textarea v-model="form.description" id="description" class="p-3"></textarea>
                <p v-if="props.errors.description" class="text-red-500">{{props.errors.description}}</p>
            </div>


            <div>
                <button
                    class="px-3 py-2 bg-blue-500 font-bold rounded-lg text-white hover:bg-blue-400 mt-3 inline-block "
                    type="submit"
                    :disabled="form.processing"
                >Submit</button>
            </div>

        </form>
    </App>

</template>

<style scoped>

</style>
