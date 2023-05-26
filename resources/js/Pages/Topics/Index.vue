<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
const props = defineProps({
    topics: Array
})
</script>

<template>
    <Head title="Topics" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Topics Index</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="flex justify-end my-2 py-2">
                    <Link href="/topics/create" class="px-4 py-2 bg-indigo-500 hover:bg-indigo-600 text-white rounded-lg">Create</Link>
                </div>
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Name
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Image
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="topic in topics" :key="topic.id" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <th scope="row" class="flex items-center font-medium px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                                    <div class="">
                                        {{topic.name}}
                                    </div>  
                                </th>
                                <td class="px-6 py-4">
                                    <!-- <img :src="topic.image" class="w-12 max-h-12 rounded" alt=""> -->
                                    <img :src="topic.image.replace('http://inertia-app.test/storage/', '')" class="w-18 max-h-12 rounded" alt="">
                                </td>
                                <td class="px-6 py-4 flex justify-end">
                                        <Link :href="`/topics/${topic.id}/edit`" class="text-indigo-400 hover:text-indigo-500 mr-2">Edit</Link>
                                        |
                                        <Link :href="`/topics/${topic.id}`" method="delete" as="button" type="button" class="text-red-400 hover:text-red-500 ml-2">Delete</Link>
                                </td>
                            </tr>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
