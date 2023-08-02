<script setup>

import {Link} from "@inertiajs/vue3";
</script>

<template>
    <div class="p-3 flex gap-3 bg-gray-100">
        <div class="w-[1200px] mx-auto gap-3">
            <Link
                class="py-3 px-1 font-bold hover:text-gray-800"
                :class="{
                'text-blue-500' : $page.component === 'Post/Index',
                'text-gray-500' : $page.component !== 'Post/Index'
                         }"
                :href="route('posts.index')">Posts</Link>

            <Link
                class="py-3 px-1 font-bold hover:text-gray-800"
                :class="{
                'text-blue-500' : $page.component === 'About',
                'text-gray-500' : $page.component !== 'About'
                         }"
                :href="route('pages.about')">About</Link>
        </div>

    </div>

</template>

<style scoped>

</style>
