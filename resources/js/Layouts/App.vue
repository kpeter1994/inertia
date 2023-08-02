<script setup>

import AppHeader from "@/components/AppHeader.vue";


</script>

<template>

    <div>
        <AppHeader/>

        <div class="w-[1200px] mx-auto gap-3">

            <div v-if="$page.props.flash.message"  class="p-3 bg-blue-100 text-blue-900 rounded-lg mb-4 mt-3 max-w-lg  font-bold ">
                <i class="fa-solid fa-circle-check"></i>
                {{ $page.props.flash.message }}
            </div>
            <slot></slot>
        </div>

    </div>

</template>

<style scoped>

</style>
