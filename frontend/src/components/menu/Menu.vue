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
      <router-link v-if="isAdmin" :to="{path: '/dashboard'}" :class="['text-left text-secondary px-6 py-2 cursor-pointer hover:bg-purple-100 flex',{'bg-purple-100':routeActive('Dashboard')}]">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
        </svg>
        Dashboard
      </router-link>
      <router-link v-if="isAdmin" :to="{path: '/cobrancas'}" :class="['text-left text-secondary px-6 py-2 cursor-pointer hover:bg-purple-100 flex',{'bg-purple-100':routeActive('Dashboard')}]">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
        </svg>
        Cobranças
      </router-link>
      <router-link v-if="isAdmin" :to="{path: '/clientes'}" :class="['text-left text-secondary px-6 py-2 cursor-pointer hover:bg-purple-100 flex',{'bg-purple-100':routeActive('Clientes')}]">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
        </svg>
        Clientes
      </router-link>
      <router-link :to="{path:'/produtos'}" :class="['text-left text-secondary px-6 py-2 cursor-pointer hover:bg-purple-100 flex',{'bg-purple-100':routeActive('Produtos')}]">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
        </svg>
        Soluções
      </router-link>
      <router-link v-if="isAdmin" :to="{path: '/relatorios'}" :class="['text-left text-secondary px-6 py-2 cursor-pointer hover:bg-purple-100 flex',{'bg-purple-100':routeActive('Relatorios')}]">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
        </svg>
        Relatórios
      </router-link>
      <router-link v-if="isAdmin" :to="{path: '/relatorios'}" :class="['text-left text-secondary px-6 py-2 cursor-pointer hover:bg-purple-100 flex',{'bg-purple-100':routeActive('Relatorios')}]">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        Financeiro
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