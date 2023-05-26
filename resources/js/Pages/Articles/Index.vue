<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
const props = defineProps({
    articles: Array
})
</script>

<template>
    <Head title="Articles" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Topics Index</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="flex justify-end my-2 py-2">
                    <Link href="/articles/create" class="px-4 py-2 bg-indigo-500 hover:bg-indigo-600 text-white rounded-lg">Create</Link>
                </div>

                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Title
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Topic
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Created At
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="article in articles" :key="article.id" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{article.title}}
                                </th>
                                <td class="px-6 py-4">
                                    {{article.topic.name}}
                                </td>
                                <td class="px-6 py-4">
                                    {{ new Date(article.created_at).toLocaleDateString('en-US', { weekday: 'long', day: 'numeric', month: 'long', year: 'numeric' }) }}
                                </td>
                                <td class="px-6 py-4">
                                    <Link :href="`/articles/${article.id}/edit`" class="text-indigo-400 hover:text-indigo-500 mr-2">Edit</Link>
                                                        |
                                    <Link :href="`/articles/${article.id}`" method="delete" as="button" type="button" class="text-red-400 hover:text-red-500 ml-2">Delete</Link>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </AuthenticatedLayout>
</template>
