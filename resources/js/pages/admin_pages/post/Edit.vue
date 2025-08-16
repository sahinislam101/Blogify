<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, Link, useForm } from '@inertiajs/vue3';

const props = defineProps<{
    post: {
        id: number;
        title: string;
        slug: string;
        content: string;
        category_id: number | string;
        status: boolean | number;
    },
    categories: { id: number; name: string }[];
}>();


const form = useForm({
    title: props.post.title,
    slug: props.post.slug,
    content: props.post.content,
    category_id: props.post.category_id,
    status: Boolean(props.post.status),
});



const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Posts', href: '/posts' },
    { title: 'Edit', href: `/posts/${props.post.id}/edit` },
];
</script>

<template>
    <Head title="Edit Post" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 mt-6 w-full max-w-4xl mx-auto">

            <!-- Header -->
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-200">
                    Edit Post
                </h2>
                <Link
                    href="/posts"
                    class="px-4 py-2 rounded-lg bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-100 hover:bg-gray-300 dark:hover:bg-gray-600 transition"
                >
                    ← Back
                </Link>
            </div>

            <!-- Form -->
            <form  @submit.prevent="form.put(route('posts.update', post.slug))" class="space-y-5">

                <!-- Title -->
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Title</label>
                    <input
                        type="text"
                        v-model="form.title"
                        class="w-full px-4 py-2 border rounded-lg dark:bg-gray-900 dark:border-gray-700 text-gray-900 dark:text-gray-100"
                        placeholder="Enter post title"
                    />
                    <span v-if="form.errors.title" class="text-red-500 text-sm">{{ form.errors.title }}</span>
                </div>

                <!-- Description -->
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Description</label>
                    <textarea
                        v-model="form.content"
                        rows="6"
                        class="w-full px-4 py-2 border rounded-lg dark:bg-gray-900 dark:border-gray-700 text-gray-900 dark:text-gray-100"
                        placeholder="Write something about the post..."
                    ></textarea>
                    <span v-if="form.errors.content" class="text-red-500 text-sm">{{ form.errors.content }}</span>
                </div>

                <!-- Category -->
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Category</label>
                    <select
                        v-model="form.category_id"
                        class="w-full px-4 py-2 border rounded-lg dark:bg-gray-900 dark:border-gray-700 text-gray-900 dark:text-gray-100"
                    >
                        <option value="">Select category</option>
                        <option v-for="cat in categories" :key="cat.id" :value="cat.id">
                            {{ cat.name }}
                        </option>
                    </select>
                    <span v-if="form.errors.category_id" class="text-red-500 text-sm">{{ form.errors.category_id }}</span>
                </div>

                <!-- Status -->
                <div class="flex items-center gap-2">
                    <input type="checkbox" v-model="form.status" class="w-4 h-4" />
                    <span class="text-gray-700 dark:text-gray-300">Active</span>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end">
                    <button
                        type="submit"
                        :disabled="form.processing"
                        class="px-6 py-2 rounded-lg bg-emerald-600 text-white hover:bg-emerald-700 transition disabled:opacity-50"
                    >
                        Update Post
                    </button>
                </div>
            </form>
        </div>
    </AppLayout>
</template>
