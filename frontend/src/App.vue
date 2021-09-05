<template>
  <div class="bg-gray-100 min-h-screen w-full">
    <div id="modal" class="fixed top-0 left-0 z-50"></div>
    <template v-if="!isLogin">
    <HeaderPage />
    <div class="flex">
      <Menu class="flex-shrink-0"/>
      <router-view v-slot="{ Component }" class="pr-16 pl-80 py-20">
        <transition name="fade" mode="out-in">
          <component :is="Component" />
        </transition>
      </router-view>
    </div>
    </template>
    <router-view name="login" />
  </div>
</template>

<script lang="ts">
import HeaderPage from '@/components/header/HeaderPage.vue';
import Menu from '@/components/menu/Menu.vue';
import { defineComponent, onMounted } from '@vue/runtime-core';
import {computed} from 'vue';
import { useRoute } from 'vue-router';
import { useStore } from 'vuex';
import { api } from './services';

import useAlert from './composables/useAlert';

export default defineComponent({
  components: {
    HeaderPage,
    Menu,
  },
  setup() {
    const route = useRoute();
    const store = useStore();
    const {errorAlert} = useAlert();

    const isLogin = computed(() => {
      return route.name === 'Login'
    });

    onMounted(async () => {
      try {
        const response = await api.get('/');
        store.commit('UPDATE_SPEC', response.data);
      } catch (error) {
        errorAlert(error);
      }
    });

    return {
      isLogin
    }
  }
})
</script>


<style>
@import url('https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700&display=swap');
html, body {
  font-family: 'Montserrat', sans-serif;
}
#app {
  font-family: 'Montserrat', Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  color: #2c3e50;
  min-height: 100vh;
}
.fade-enter-active,
.fade-leave-active {
  transition: all 0.3s;
}


::-webkit-scrollbar {
  width: 10px;
}

/* Track */
::-webkit-scrollbar-track {
  background: transparent;
}

/* Handle */
::-webkit-scrollbar-thumb {
  background: #555;
}

/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
  background: #555;
}
</style>