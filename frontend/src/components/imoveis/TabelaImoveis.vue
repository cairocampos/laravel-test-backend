<template>
    <div>
        <table class="w-full">
            <thead>
                <th>Email proprietário</th>
                <th>Endereço</th>
                <th>Status</th>
                <th></th>
            </thead>
            <tbody>
                <tr v-for="(imovel, index) in imoveis" :key="imovel.id">
                <td class="text-sm">{{imovel.email_proprietario}}</td>
                <td class="text-sm">{{ imovel.rua }}</td>
                <td>
                    <span :class="[`bg-${imovel.status == statusImovelContratado ? 'red' : 'green'}-500 p-2 rounded-md text-white text-xs`]">
                    {{imovel.status == statusImovelContratado ? 'Contratado' : 'Disponível'}}
                    </span>
                </td>
                <td class="text-right">
                    <button
                        class="btn" 
                        @click="deletarImovel(imovel.id,index)"
                        >
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                    </button>

                    <button
                        v-if="imovel.status != statusImovelContratado"
                        class="btn"
                        @click="adicionarContrato(imovel)"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3" />
                        </svg>
                    </button>
                </td>
                </tr>
            </tbody>
        </table>
        <teleport to="#modal" v-if="Object.keys(contratoImovel).length">
            <AdicionarContrato  @contrato-adicionado="atualizaStatusImovel" :contratoImovel="contratoImovel" />
        </teleport>
    </div>
</template>

<script lang="ts">
import { defineComponent } from "@vue/runtime-core";
import {computed, ref} from 'vue';
import { useStore } from "vuex";

import useAlert from '@/composables/useAlert'
import { SweetAlertResult } from "sweetalert2";
import { api } from "@/services";

import AdicionarContrato from './AdicionarContrato.vue'
import { IImovel } from "@/types/IImovel";

export default defineComponent({
    props: ['modelValue'],
    emits: ['update:modelValue'],
    components: {
        AdicionarContrato
    },
    setup(props) {
        const {confirmAlert, errorAlert, successAlert} = useAlert();
        const store = useStore();
        const imoveis = ref<IImovel[]>(props.modelValue);
        const contratoImovel = ref({});

        const statusImovelContratado = computed(() => {
            return store.state.spec.imoveis.status.contratado
        });

        const deletarImovel = (imovel_id: number, index:number) => {
            confirmAlert('Deseja apagar esse imóvel ?', async (result: SweetAlertResult) => {
                if(result.isConfirmed) {
                    try {
                        const response = await api.delete(`/imoveis/${imovel_id}`);
                        successAlert(response.data.message);

                        imoveis.value.splice(index, 1);
                    } catch (error) {
                        errorAlert(error);
                    }
                }
            });
        }

        const adicionarContrato = (imovel: IImovel) => {
            confirmAlert("Deseja criar um contrato para esse imóvel ?", async (result: SweetAlertResult) => {
                if(result.isConfirmed) {
                    contratoImovel.value = imovel;
                }
            });
        }

        const atualizaStatusImovel = (imovel_id: number) => {
            imoveis.value = imoveis.value.map(imovel =>  {
                if(imovel.id === imovel_id) {
                    imovel.status = store.state.spec.imoveis.status.contratado
                }

                return imovel;
            })

            contratoImovel.value = {};
        }

        return {
            imoveis,
            statusImovelContratado,
            contratoImovel,
            deletarImovel,
            adicionarContrato,
            atualizaStatusImovel
        }
    },
});
</script>

<style>

</style>