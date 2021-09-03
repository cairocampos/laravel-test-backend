<template>
    <table class="w-full">
        <thead>
            <th>Email proprietário</th>
            <th>Endereço</th>
            <th>Status</th>
            <th>Ações</th>
        </thead>
        <tbody>
            <tr v-for="imovel in modelValue" :key="imovel.id">
            <td class="text-sm">{{imovel.email_proprietario}}</td>
            <td class="text-sm">{{ imovel.rua }}</td>
            <td>
                <span :class="[`bg-${imovel.status == imovelContratado ? 'red' : 'green'}-500 p-2 rounded-md text-white text-xs`]">
                {{imovel.status == imovelContratado ? 'Contratado' : 'Disponível'}}
                </span>
            </td>
            <td>
                <button class="btn">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                </svg>
                </button>
            </td>
            </tr>
        </tbody>
    </table>
</template>

<script lang="ts">
import { defineComponent } from "@vue/runtime-core";
import {computed} from 'vue';
import { useStore } from "vuex";

export default defineComponent({
    props: {
        modelValue: {
            type: Array,
            required:true
        }
    },
    emits: ['update:modelValue'],
    setup() {
        const store = useStore();
        const imovelContratado = computed(() => {
            return store.state.spec.imoveis.status.contratado
        });

        return {
            imovelContratado
        }
    }
});
</script>

<style>

</style>