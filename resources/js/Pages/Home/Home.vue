<template>
    <div class="h-screen w-screen bg-blue-900 flex">
        <div class="flex flex-col items-center w-2/12">
            <p class="font-bold text-2xl text-white mt-3">SMART CONTROL</p>
            <span class="border-4 border-white w-full mt-3"></span>
            <div class="flex items-center">
            <div class="mr-4">
                <!-- Substitua 'caminho/para/imagem.jpg' pelo caminho real da imagem do perfil -->
                <img class="w-12 h-12 rounded-full" src="{{ asset('caminho/para/imagem.jpg') }}" alt="Foto do Perfil">
            </div>
            <div>
                <!-- Substitua 'Nome do Usuário' pelo nome real do usuário -->
                <p class="font-semibold text-lg">Nome do Usuário</p>
            </div>
            </div>
            <ul class="mt-5 space-y-4">
                <li class="text-white font-semibold"><i class="text-3xl text-white bi bi-building-fill-add"></i> Cadastro de Apartamento</li>
                <li class="text-white font-semibold"><i class="text-3xl text-white bi bi-person-plus-fill"></i> Cadastro de Morador</li>
                <li class="text-white font-semibold"><i class="text-3xl text-white bi bi-person-lines-fill"></i> Visitantes</li>
            </ul>
            <button @click="logout()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-48">
                Sair
            </button>
        </div>
        <div class="flex justify-end items-end h-full w-10/12">
            <div class="bg-white w-full h-full">

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
        }
    }

})

</script>