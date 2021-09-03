<template>
  <div class="home w-full">
    <HeaderTitle name="Imoveis" class="mb-8">
      <router-link :to="{path:'/imoveis/novo'}" class="btn btn-blue">
        Adicionar
      </router-link>
    </HeaderTitle>
    <div>
      <div class="text-right">
      </div>

      <transition-group tag="div">
      <Loading v-if="loading" />
        <template v-else-if="!loading && imoveis && imoveis.length">
          <TabelaImoveis :modelValue="imoveis" @update:modelValue="imoveis = $event"/>
        </template>
        <p v-else>Nenhum resultado encontrado.</p>
      </transition-group>

    </div>
  </div>
</template>

<script lang="ts">
import { defineComponent, onMounted, ref } from "@vue/runtime-core"
import HeaderTitle from '@/components/header/HeaderTitle.vue'
import { api } from "@/services"
import TabelaImoveis from "@/components/imoveis/TabelaImoveis.vue"
import useAlert from "@/composables/useAlert"
export default defineComponent({
  components: {
    HeaderTitle,
    TabelaImoveis
  },
  setup() {
    const imoveis = ref([]);
    const loading = ref<boolean>(false);
    const {errorAlert} = useAlert()

    const getImoveis = async () => {
      loading.value = true;
      try {
        const response = await api.get('/imoveis');
        imoveis.value = response.data.data;
      } catch (error) {
        errorAlert(error)
      } finally {
        loading.value = false;
      }
    }

    onMounted(getImoveis);

    return {
      imoveis,
      loading
    }
  }
})
</script>
