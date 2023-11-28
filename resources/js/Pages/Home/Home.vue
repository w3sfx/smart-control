<template>
    <div class="h-screen w-screen bg-blue-900 flex">
        <div class="flex flex-col items-center w-2/12">
            <p class="font-bold text-2xl text-white mt-3">SMART CONTROL</p>
            <span class="border-4 border-white w-full mt-3"></span>
            <ul class="mt-5 space-y-8">
                <li @click="apartamento()" class="text-white font-semibold"><i class="text-3xl text-white bi bi-building-fill-add"></i> Cadastro de Apartamento</li>
                <li class="text-white font-semibold"><i class="text-3xl text-white bi bi-person-plus-fill"></i> Cadastro de Morador</li>
                <li class="text-white font-semibold"><i class="text-3xl text-white bi bi-person-lines-fill"></i> Visitantes</li>
            </ul>
            <button @click="logout()" class="bg-gray-900 hover:bg-gray-800 text-white font-bold py-2 px-4 rounded-lg w-36 mt-[450px]">
                Sair
            </button>
        </div>
        <div class="flex justify-end items-end h-full w-10/12">
            <div class="bg-white w-full h-full p-8">
                <slot></slot>
            </div>
        </div>
    </div>
</template>

<script>
import { defineComponent } from "vue";
import { router } from '@inertiajs/vue3';

export default defineComponent({

    methods: {
        logout() {
            router.post(route('logout'));
        },

        apartamento() {
            this.$inertia.get(route('apartamento.cadastro'));
        }
    }

})

</script>