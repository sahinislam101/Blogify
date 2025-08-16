<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, Link, router } from '@inertiajs/vue3';
import { ref, watch } from 'vue';


const props = defineProps<{
    categories: {
        data: {
            id: string;
            name: string;
            slug: string;
            description: string;
            image: string;
            status: boolean;
            created_at: string;
        }[];
        current_page: number;
        last_page: number;
        total: number;
        to: number;
        from: number;
    };
    filters: {
        search?: string;
        status?: string;
    };
}>();


const search = ref(props.filters.search || '');
const status = ref(props.filters.status || '');


watch([search, status], () => {
    router.get(
        '/categories',
        { search: search.value, status: status.value },
        { preserveState: true, replace: true }
    );
});

const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Categories', href: '/categories' },
];
</script>

<template>
    <Head title="Categories" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <!-- Search + Filter + Create -->
        <div class="flex justify-between items-center mt-4 mb-4">
            <!-- Search -->
            <input
                type="text"
                v-model="search"
                placeholder="Search categories..."
                class="px-3 py-2 w-1/3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-emerald-500"
            />

            <div class="flex gap-2">
                <!-- Status Filter -->
                <select
                    v-model="status"
                    class="px-3 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-emerald-500"
                >
                    <option value="">All Status</option>
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>

                <!-- Create New Category -->
                <Link
                    href="/categories/create"
                    class="px-4 py-2 rounded-lg bg-emerald-600 text-white hover:bg-emerald-700 transition"
                >
                    + Create New Category
                </Link>
            </div>
        </div>

        <!-- Table -->
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th class="px-6 py-3">Name</th>
                        <th class="px-6 py-3">Description</th>
                        <th class="px-6 py-3">Status</th>
                        <th class="px-6 py-3">Action</th>
                    </tr>
                </thead>

                <tbody>
                    <tr
                        v-for="category in categories.data"
                        :key="category.id"
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600"
                    >

                        <!-- Name -->
                        <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                            {{ category.name }}
                        </td>

                        <!-- Description -->
                        <td class="px-6 py-4">
                            {{ category.description || '—' }}
                        </td>

                        <!-- Status -->
                        <td class="px-6 py-4">
                            <span
                                :class="[
                                    'px-2 py-1 text-xs font-semibold rounded-full',
                                    category.status
                                        ? 'bg-green-100 text-green-800'
                                        : 'bg-red-100 text-red-800',
                                ]"
                            >
                                {{ category.status ? 'Active' : 'Inactive' }}
                            </span>
                        </td>

                        <!-- Action -->
                        <td class="px-6 py-4 space-x-2">
                            <Link
                                :href="`/categories/${category.slug}/edit`"
                                class="font-medium text-blue-600 dark:text-blue-400 hover:underline"
                            >
                                Edit
                            </Link>
                            <Link
                                :href="`/categories/${category.slug}`"
                                method="delete"
                                as="button"
                                class="font-medium text-red-600 dark:text-red-400 hover:underline"
                            >
                                Delete
                            </Link>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </AppLayout>
</template>
