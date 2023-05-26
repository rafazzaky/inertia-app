<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { router } from '@inertiajs/vue3';

const props = defineProps({
    topic: Object,
    image: String
})
const form = useForm({
  name: props.topic.name,
  image: null,
})

function updateTopic() {
    router.post(`/topics/${props.topic.id}`, {
        _method: 'put',
        name: form.name,
        image: form.image
    })
}
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
                    <Link href="/topics" class="px-4 py-2 bg-indigo-500 hover:bg-indigo-600 text-white rounded-lg">Back</Link>
                </div>
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg px-6 py-3">
                    
                    <form @submit.prevent="updateTopic">
                    <div class="mb-6">
                        <label for="title" class="block mb-2 text-sm font-medium text-gray-900 ">Name</label>
                        <input type="title" v-model="form.name" id="title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Topic's name">
                    </div>
                    <div class="mb-6">
                        <label for="image" class="block mb-2 text-sm font-medium text-gray-900 ">Image</label>
                        <div class="my-2">
                            <img :src="image" class="w-32 max-h-32 rounded" alt="">
                        </div>
                        <input type="file"  @input="form.image = $event.target.files[0]" id="image" name="image" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                    </div>
                    <button type="submit" class="px-4 py-2 bg-indigo-500 hover:bg-indigo-600 text-white rounded-lg border border-gray-300">Update</button>
                    </form>

                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>