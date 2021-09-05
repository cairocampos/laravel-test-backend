<template>
  <aside class="fixed top-12 left-0 h-full bg-white w-1/5 border border-gray-300">
    <ul class="space-y-4">
      <button class="text-gray-200 flex items-center bg-secondary px-4 py-2 rounded-md mx-auto my-8 relative">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
          </svg>
            <span>Cairo Campos</span>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
            
            <transition name="fade">
            <div class="hidden absolute p-4 bg-gray-500 shadow-md w-full mt-24 left-0">
              <ul>
                <li class="cursor-pointer">Minha Conta</li>
              </ul>
            </div>
            </transition>
      </button>
      <router-link :to="{path: '/'}" :class="['text-left text-secondary px-6 py-2 cursor-pointer hover:bg-purple-100 flex',{'bg-purple-100':routeActive('Home')}]">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
        </svg>
        Home
      </router-link>
    </ul>
  </aside>
</template>

<script lang="ts">
import { defineComponent } from '@vue/runtime-core';
import { useRoute } from 'vue-router';
export default defineComponent({
    setup() {
        const route = useRoute();
        const routeActive = (name:string) => {
            return route.name === name
        }

        return {
          routeActive
        }
    }
})
</script>

<style>

</style>