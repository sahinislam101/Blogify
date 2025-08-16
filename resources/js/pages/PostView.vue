<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';

const props = defineProps({
  categories: Array,  
  post: Object,    
});
</script>

<template>
  <!-- Background Gradient -->
  <div class="absolute inset-0 mx-0 overflow-hidden -z-10 max-w-none">
    <div
      class="absolute left-1/2 top-0 ml-[-38rem] h-[25rem] w-[81.25rem] [mask-image:linear-gradient(white,transparent)] z-[-100] overflow-visible"
    >
      <div
        class="absolute inset-0 bg-gradient-to-r [mask-image:radial-gradient(farthest-side_at_top,white,transparent)] from-[#36b49f]/30 to-[#DBFF75]/30 opacity-100"
      >
        <svg
          aria-hidden="true"
          class="absolute inset-x-0 inset-y-[-50%] h-[200%] w-full skew-y-[-18deg] fill-black/40 stroke-black/50 mix-blend-overlay stroke-white/5"
        >
          <defs>
            <pattern id="pattern" width="72" height="56" patternUnits="userSpaceOnUse" x="-12" y="4">
              <path d="M.5 56V.5H72" fill="none"></path>
            </pattern>
          </defs>
          <rect width="100%" height="100%" stroke-width="0" fill="url(#pattern)"></rect>
        </svg>
      </div>
    </div>
  </div>

  <!-- Back Button -->
  <main class="w-full px-4 py-20 mx-auto sm:px-6 lg:px-8 max-w-7xl">
    <div class="w-full mx-auto max-w-7xl">
      <Link
        href="/"
        class="inline-flex items-center justify-center gap-2 px-3 py-1 mb-6 text-lg font-medium transition rounded-full ring-1 ring-inset text-zinc-400 ring-white/10 hover:bg-white/5 hover:text-white"
      >
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
          <path
            fill-rule="evenodd"
            d="M7.793 2.232a.75.75 0 0 1-.025 1.06L3.622 7.25h10.003a5.375 5.375 0 0 1 0 10.75H10.75a.75.75 0 0 1 0-1.5h2.875a3.875 3.875 0 0 0 0-7.75H3.622l4.146 3.957a.75.75 0 0 1-1.036 1.085l-5.5-5.25a.75.75 0 0 1 0-1.085l5.5-5.25a.75.75 0 0 1 1.06.025Z"
            clip-rule="evenodd"
          />
        </svg>
        Back
      </Link>

      <!-- Article -->
      <article
        class="w-full rounded-xl p-6 md:p-10 text-white shadow-lg bg-zinc-900/20 ring-1 backdrop-blur-[2px] ring-white/15 space-y-6"
      >
        <!-- Post Title -->
        <h3 class="mb-4 text-xl font-bold sm:text-4xl lg:text-6xl text-center !leading-tight">{{ post.title }}</h3>

        <!-- Meta Info -->
        <div
          class="flex flex-row flex-wrap items-center justify-center gap-4 my-6 text-center divide-x divide-zinc-700"
        >
          <!-- Author Info -->
          <div class="flex items-center gap-2">
            <img
              class="w-8 h-8 p-0.5 rounded-full ring-1 ring-emerald-500"
              :src="post.user?.avatar || 'https://avatars.githubusercontent.com/u/193729110?v=4'"
              alt="Author"
            />
            <h4>{{ post.user?.name || 'Unknown Author' }}</h4>
          </div>

          <!-- Date -->
          <p class="pl-4 text-lg font-semibold sm:text-base text-zinc-400">
            {{ new Date(post.created_at).toLocaleDateString() }}
          </p>

          <!-- Category -->
          <div v-if="post.category" class="pl-4">
            <a
              class="inline-flex gap-0.5 justify-center overflow-hidden text-sm sm:text-base font-medium transition rounded-full py-1 px-3 bg-emerald-400/10 text-emerald-400 ring-1 ring-inset ring-emerald-400/20 hover:bg-emerald-400/10 hover:text-emerald-300 hover:ring-emerald-300"
              href="#"
            >
              {{ post.category.name }}
            </a>
          </div>
        </div>

        <hr class="h-px my-8 border-0 bg-zinc-700" />

        <!-- Post Content -->
        <p class="text-base font-normal text-zinc-400 md:text-xl whitespace-pre-line">
          {{ post.content }}
        </p>
      </article>
    </div>
  </main>
</template>
