<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const props = defineProps({
    article: Object,
    topics: Array
})
const form = useForm({
  topic_id: props.article.topic_id,
  title: props.article.title,
  content: props.article.content,
})

function updateArticle() {
    router.post(`/articles/${props.article.id}`, {
        _method: 'put',
        topic_id: form.topic_id,
        title: form.title,
        content: form.content
    })
}
</script>

<template>
    <Head title="Edit Article" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Topics Index</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="flex justify-end my-2 py-2">
                    <Link href="/articles" class="px-4 py-2 bg-indigo-500 hover:bg-indigo-600 text-white rounded-lg">Back</Link>
                </div>
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg px-6 py-3">
                    
                    <form @submit.prevent="updateArticle">
                    <div class="mb-6">
                        <label for="topic_id" class="block mb-2 text-sm font-medium text-gray-900">Topic</label>
                        <select v-model="form.topic_id" id="topic_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        <option value="" disabled>Select a topic</option>
                        <option v-for="topic in topics" :value="topic.id" :key="topic.id" :selected="topic.id === form.topic_id">{{ topic.name }}</option>
                        </select>
                    </div>
                    <div class="mb-6">
                        <label for="title" class="block mb-2 text-sm font-medium text-gray-900 ">Title</label>
                        <input type="title" v-model="form.title" id="title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Title">
                    </div>
                    <div class="mb-6">
                        <label for="content" class="block mb-2 text-sm font-medium text-gray-900 ">Content</label>
                        <textarea v-model="form.content" name="content" id="content" cols="30" rows="10" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="some content..."></textarea>
                    </div>
                    <button type="submit" class="px-4 py-2 bg-indigo-500 hover:bg-indigo-600 text-white rounded-lg border border-gray-300">Edit</button>
                    </form>

                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>