<script>

import App from "@/Layouts/App.vue";
import { Head , Link} from "@inertiajs/vue3";


export default {
    components: {
        App,
        Head,
        Link
    },
    props: {
        posts: Object
    },

    methods: {
        destroy(id){
            if (confirm('Are you sure?')){
                this.$inertia.delete(route("posts.destroy", id));
            }
        }
    }
}


</script>

<template>

    <Head>
        <title>Post Component</title>
    </Head>

    <App>
        <h1 class="text-2xl font-bold mb-3">Postok</h1>
        <Link
            class="px-3 py-2 bg-green-500 font-bold rounded-lg text-gray-900 hover:bg-green-400 mt-3 inline-block"
            :href="route('posts.create')"
        >Add new post</Link>
        <div class="max-w-2xl mx-auto p-3 bg-gray-100 rounded-2xl mb-3 " v-for="post in posts" :key="post.id">
            <h2 class="text-lg font-bold">{{ post.title }}</h2>
            <p>{{ post.description }}</p>
            <div class="flex justify-end ">
                <Link
                    :href="route('posts.edit', post.id)"
                    class="p-3 cursor-pointer text-gray-600 hover:text-blue-500">
                    <i class="fa-solid fa-pen mr-1.5"></i>
                    <span>edit</span>
                </Link>
                <button
                    @click="destroy(post.id)"
                    class="p-3 cursor-pointer text-gray-600 hover:text-red-500">
                    <i class="fa-solid fa-trash mr-1.5"></i>
                    <span>delete</span>
                </button>

            </div>
        </div>
    </App>


</template>

<style scoped>

</style>
