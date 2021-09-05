<template>
  <div class="fixed top-0 left-0 h-screen w-screen bg-black bg-opacity-50 flex items-center justify-center">
      <div class="modal shadow-sm rounded-sm bg-white px-10 py-5 w-6/12 space-y-8 max-h-screen overflow-y-scroll">
        <div class="modal-header flex items-center justify-between">
            <h1 class="text-xl">Criar Contrato</h1>
            <button class="btn">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </button>
        </div>
        <div class="modal-body">
            <form class="form space-y-8" @submit.prevent="salvarContrato">
                <div class="space-y-4">
                    <div class="text-gray-400 text-sm mb-4">Dados do contratante</div>
                    <div class="form-group">
                        <label for="" class="label">Nome do contratante</label>
                        <input type="text" class="form-control" v-model="contrato.nome_contratante" />
                    </div>
                    <div class="form-group">
                        <label for="" class="label">Email do contratante</label>
                        <input type="text" class="form-control" v-model="contrato.email_contratante" />
                    </div>
                    <div class="form-group">
                        <label for="" class="label">Tipo de pessoa</label>
                        <select class="form-control" v-model="contrato.tipo_pessoa">
                            <option value="pf">Pessoa física</option>
                            <option value="pj">Pessoa jurídica</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="label">{{ contrato.tipo_pessoa == 'pf' ? 'CPF' : 'CNPJ' }}</label>
                        <input 
                        v-if="contrato.tipo_pessoa == 'pf'" 
                        v-maska="'###.###.###-##'" type="text" class="form-control" v-model="contrato.cpf_cnpj" />

                        <input 
                        v-else 
                        v-maska="'##.###.###/####-##'" type="text" class="form-control" v-model="contrato.cpf_cnpj" />
                    </div>
                </div>
                <div class="space-y-4">
                    <div class="text-gray-400 text-sm mb-4">Dados do imovel a ser contratado</div>
                    <div class="form-group">
                        <label for="" class="label">Bairro</label>
                        <input type="text" disabled class="form-control cursor-not-allowed" :value="contratoImovel.bairro" />
                    </div>  
                    <div class="form-group">
                        <label for="" class="label">Rua</label>
                        <input type="text" disabled class="form-control cursor-not-allowed" :value="contratoImovel.rua" />
                    </div>  
                    <div class="grid grid-cols-2 gap-4">
                        <div class="form-group">
                            <label for="" class="label">Numero</label>
                            <input type="text" disabled class="form-control cursor-not-allowed" :value="contratoImovel.numero" />
                        </div>
                        <div class="form-group">
                            <label for="" class="label">CEP</label>
                            <input type="text" v-maska="'#####-###'" disabled class="form-control cursor-not-allowed" :value="contratoImovel.cep" />
                        </div>
                    </div>
                </div>
                <div class="form-group mt-10">
                    <button class="btn btn-blue">Finalizar</button>
                </div>
            </form>
        </div>
      </div>
  </div>
</template>

<script lang="ts">
import {IImovel} from '@/types/IImovel';
import { defineComponent } from '@vue/runtime-core';
import {ref} from 'vue';

import useAlert from '@/composables/useAlert'
import { api } from '@/services';
export default defineComponent({
    props: {
        contratoImovel: {
            type: Object,
            required:true
        }
    },
    emits: ['contrato-adicionado'],
    setup(props, {emit}) {
        const {successAlert,errorAlert} = useAlert();
        const contrato = ref({
            imovel_id: props.contratoImovel.id,
            email_contratante:"",
            nome_contratante:"",
            cpf_cnpj:"",
            tipo_pessoa:"pf"
        });

        const salvarContrato = async () => {
            try {
                // const response = await api.post('/contratos', contrato.value);
                // successAlert(response.data.message);

                emit('contrato-adicionado', props.contratoImovel.id);
            } catch (error) {
                errorAlert(error);
            }
        }

        return {
            contrato,
            salvarContrato
        }
    }
})
</script>2