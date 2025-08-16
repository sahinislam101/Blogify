<script setup>
import { Head, Link } from '@inertiajs/vue3';
import Login from './auth/Login.vue';

const props = defineProps({
  categories: Array,
  posts: Array,
  post: Array,
});
// Simple function for relative time
function formatTime(dateString) {
  const date = new Date(dateString)
  const diff = (Date.now() - date.getTime()) / 1000 // seconds
  if (diff < 60) return `${Math.floor(diff)} sec ago`
  if (diff < 3600) return `${Math.floor(diff / 60)} min ago`
  if (diff < 86400) return `${Math.floor(diff / 3600)} hours ago`
  if (diff < 2592000) return `${Math.floor(diff / 86400)} days ago`
  return `${Math.floor(diff / 2592000)} months ago`
}
</script>

<template>

  <Head title="Home" />

  <!-- Background Gradient -->
  <div class="absolute inset-0 mx-0 overflow-hidden -z-10 max-w-none">
    <div
      class="absolute left-1/2 top-0 ml-[-38rem] h-[25rem] w-[81.25rem] [mask-image:linear-gradient(white,transparent)] z-[-100] overflow-visible">
      <div
        class="absolute inset-0 bg-gradient-to-r [mask-image:radial-gradient(farthest-side_at_top,white,transparent)] from-[#36b49f]/30 to-[#DBFF75]/30 opacity-100">
        <svg aria-hidden="true"
          class="absolute inset-x-0 inset-y-[-50%] h-[200%] w-full skew-y-[-18deg] fill-black/40 stroke-black/50 mix-blend-overlay stroke-white/5">
          <defs>
            <pattern id="pattern" width="72" height="56" patternUnits="userSpaceOnUse" x="-12" y="4">
              <path d="M.5 56V.5H72" fill="none" />
            </pattern>
          </defs>
          <rect width="100%" height="100%" stroke-width="0" fill="url(#pattern)" />
        </svg>
      </div>
    </div>
  </div>

  <!-- Navbar -->
  <header
    class="inset-x-0 top-0 z-50 shadow-sm backdrop-blur bg-zinc-900/20 ring-1 lg:flex text-zinc-400 ring-white/10">
    <div class="max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8">
      <div class="flex justify-between items-center py-4">
        <!-- Logo -->
        <Link href="/">
        <img class="h-10" src="https://tailwindui.com/img/logos/mark.svg?color=emerald&shade=600" alt="Logo" />
        </Link>

        <!-- Search Box -->
        <form method="GET" action="/" class="w-full max-w-md">
          <label for="search" class="sr-only">Search</label>
          <div class="relative">
            <input id="search" name="query" type="search" placeholder="Search"
              class="block w-full py-2 pl-10 pr-4 text-base bg-white/5 text-zinc-400 rounded-full ring-1 ring-inset ring-white/10 placeholder:text-zinc-400 focus:ring-emerald-600" />
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
              <svg class="w-5 h-5 text-zinc-400" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd"
                  d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z"
                  clip-rule="evenodd" />
              </svg>
            </div>
          </div>
        </form>

        <!-- Login -->
        <Link :href="route('login')" class="text-emerald-400 hover:text-emerald-500 font-semibold">Login</Link>
      </div>
    </div>
  </header>

  <!-- Main Section -->
  <section class="flex flex-col xl:flex-row gap-8 px-4 py-16 mx-auto max-w-7xl sm:px-6 lg:px-8">
    <!-- Posts -->
    <div class="xl:w-2/3 space-y-8">
      <article v-for="post in posts" :key="post.id"
        class="rounded-xl p-6 text-white shadow-lg bg-zinc-900/20 ring-1 ring-white/15 backdrop-blur-sm space-y-6 hover:bg-zinc-900/40 transition">
        <!-- Category + Time -->
        <div class="flex justify-between items-center">
          <a v-if="post.category"
          
            class="text-sm font-medium bg-emerald-400/10 text-emerald-400 px-3 py-1 rounded-full ring-1 ring-inset ring-emerald-400/20">
            {{ post.category.name }}
          </a>

          <p class="text-sm text-zinc-400">
            {{ formatTime(post.created_at) }}
          </p>
        </div>

        <!-- Post Title & Text -->
        <div>
          <h3 class="text-2xl font-bold hover:underline decoration-emerald-700">{{ post.title }}</h3>
          <p class="mt-2 text-zinc-400 line-clamp-2">{{ post.content }}</p>
        </div>

        <!-- Author & Read More -->
        <div class="flex justify-between items-center">
          <div class="flex items-center gap-2">
            <img class="w-8 h-8 rounded-full ring-2 ring-emerald-500"
              src="https://avatars.githubusercontent.com/u/193729110?v=4" alt="Author" />
            <div class="flex flex-col leading-tight">
              <span class="font-medium">{{ post.user?.name }}</span>
              <a href="https://github.com/sahinislam101" target="_blank"
                class="text-emerald-400 hover:text-emerald-500 text-sm flex items-center gap-1">
                <i class="fab fa-github"></i> @sahinislam101
              </a>
            </div>
          </div>

          <Link :href="`/post/view/${post.id}`"
            class="text-emerald-400 hover:text-emerald-500 inline-flex items-center gap-1">
          Read more
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
          </svg>
          </Link>
        </div>
      </article>

    </div>


    <!-- Sidebar -->
    <aside class="xl:w-1/3 space-y-6">
      <!-- Categories -->
      <div class="rounded-xl p-4 text-white bg-zinc-900/20 ring-1 ring-white/15 backdrop-blur-sm">
        <h5 class="text-xl font-semibold mb-4">Browse Categories</h5>
        <div class="flex flex-wrap gap-2">
          <Link v-for="cat in categories" :key="cat.id" 
          :href="route('category.show', cat.slug)"
            class="inline-flex items-center justify-between gap-2 px-3 py-1 rounded-full ring-1 ring-white/10 bg-white/5 hover:bg-white/10 text-sm text-zinc-400 hover:text-white">
          {{ cat.name }}
          <span
            class="bg-emerald-800/40 text-emerald-400 w-6 h-6 text-center rounded-full ring-1 ring-emerald-400/20 text-xs leading-6">
            {{ cat.posts_count }}
          </span>
          </Link>

        </div>
      </div>

      <!-- Social Icons -->
      <div class="rounded-xl p-4 text-white bg-zinc-900/20 ring-1 ring-white/15 backdrop-blur-sm">
        <h5 class="text-xl font-semibold mb-4">Follow Me On Social Media</h5>
        <div class="flex flex-wrap gap-3">
          <a href="https://github.com/sahinislam101" target="_blank" class="text-zinc-400 hover:text-white">
            <i class="fab fa-github text-xl"></i>
          </a>
          <a href="https://www.facebook.com/sa.hi.n.162728" target="_blank" class="text-zinc-400 hover:text-white">
            <i class="fab fa-facebook text-xl"></i>
          </a>

        </div>
      </div>
    </aside>
  </section>
</template>

<style>
@import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css');
</style>
