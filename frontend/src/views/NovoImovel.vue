<template>
  <div class="home w-full">
    <div class="flex items-center mb-8">
      <router-link :to="{path:'/'}" class="btn cursor-pointer">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
        </svg>
      </router-link>
      <HeaderTitle name="Adicionar Imóvel"/>
    </div>
    <form>
      <div class="form">
        <div class="form-group">
          <label class="label">Email do proprietário</label>
          <input type="text" class="form-control" />
        </div>

        <div class="form-group">
          <label class="label">Rua</label>
          <input type="text" class="form-control" />
        </div>

        <div class="grid grid-cols-4 gap-8">
          <div class="form-group col-span-3">
            <label class="label">CEP</label>
            <input type="text" class="form-control" />
          </div>
          <div class="form-group">
            <label class="label">Número</label>
            <input type="text" class="form-control" />
          </div>
        </div>

        <div class="grid grid-cols-4 gap-8">
          <div class="form-group col-span-3">
            <label class="label">Cidade</label>
            <input type="text" class="form-control" />
          </div>
          <div class="form-group">
            <label class="label">Estado</label>
            <input type="text" class="form-control" />
          </div>
        </div>

        <div class="w-full text-right">
          <button class="btn btn-blue">
            Cadastrar
          </button>
        </div>
      </div>
    </form>
  </div>
</template>

<script lang="ts">
import { defineComponent } from "@vue/runtime-core"
import HeaderTitle from '@/components/header/HeaderTitle.vue'
export default defineComponent({
  components: {
    HeaderTitle
  },
  setup() {
    //
  }
})
</script>
