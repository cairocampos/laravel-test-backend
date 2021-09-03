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
          <label class="label">Email do proprietário <span class="text-red-500">*</span></label>
          <input type="text" class="form-control" v-model="form.email_proprietario" />
        </div>

        <div class="grid grid-cols-4 gap-8">
          <div class="form-group col-span-3">
            <label class="label">CEP <span class="text-red-500">*</span></label>
            <input type="text" class="form-control" v-model="form.cep" v-maska="'#####-###'" />
          </div>
          <div class="form-group">
            <label class="label">Número <span class="text-red-500">*</span></label>
            <input type="text" class="form-control" v-model="form.numero" />
          </div>
        </div>

        <div class="form-group">
          <label class="label">Rua <span class="text-red-500">*</span></label>
          <input type="text" class="form-control" v-model="form.rua" />
        </div>

        <div class="form-group">
          <label class="label">Bairro <span class="text-red-500">*</span></label>
          <input type="text" class="form-control" v-model="form.bairro" />
        </div>

        <div class="grid grid-cols-4 gap-8">
          <div class="form-group col-span-3">
            <label class="label">Cidade <span class="text-red-500">*</span></label>
            <input type="text" class="form-control" v-model="form.cidade" />
          </div>
          <div class="form-group">
            <label class="label">Estado <span class="text-red-500">*</span></label>
            <input type="text" class="form-control" v-model="form.estado" v-maska="'AA'" />
          </div>
        </div>
        <div class="grid grid-cols-4 gap-8">
          <div class="form-group">
            <label class="label">Total de divisões <span class="text-red-500">*</span></label>
            <input type="number" min="1" class="form-control" v-model="form.total_divisoes" />
          </div>
          <div class="form-group">
            <label class="label">Cor do imóvel</label>
            <input type="text" class="form-control" v-model="form.cor" placeholder="Ex: Amarelo" />
          </div>
        </div>

        <div class="w-full text-right">
          <button type="button" class="btn btn-blue" @click="cadastrar">
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
import {ref, watch} from 'vue';
import { api } from "@/services";
import { useRouter } from "vue-router";

import { IImovel } from "@/types/IImovel";
import useAlert from "@/composables/useAlert";
import { IViacep } from "@/types/IViacep";

export default defineComponent({
  components: {
    HeaderTitle
  },
  setup() {
    const router = useRouter();
    const {successAlert, errorAlert} = useAlert();
    const form = ref<IImovel>({
      email_proprietario:"",
      rua:"",
      cep:"",
      cidade:"",
      estado:"",
      numero:"",
      bairro:"",
      total_divisoes:1,
      cor:"",
      complemento:"",
    });
    
    const consultaCep = async () => {
      try {
        const response = await api.get<IViacep>('/cep', {params:{cep:form.value.cep.replace('-', '')}});
        form.value.cidade = response.data.localidade;
        form.value.cidade = response.data.localidade;
        form.value.bairro = response.data.bairro;
        form.value.estado = response.data.uf;
        form.value.rua = response.data.logradouro;
      } catch (error) {
        errorAlert(error);
      }
    }

    watch(form.value, value => {
      const {cep} = value;
      if(cep.length === 9)
        consultaCep()
    });

    const cadastrar = async () => {
      try {
        const response = await api.post('/imoveis', form.value);
        successAlert(response.data.message);
        router.push({path:"/"});
      } catch (error) {
        errorAlert(error);
      }
    }

    return {
      form,
      cadastrar
    }
  }
})
</script>