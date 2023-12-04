<template>
    <app-layout>
        <p class="text-black font-semibold mb-4"><i class="text-3xl text-black bi bi-building-fill-add"></i> Cadastro de Apartamento</p>

        <p>Olá, <span class="font-semibold">{{ this.$attrs.auth.user.name }}</span>!</p>
        <div class="border-4 border-gray-500 h-auto w-full p-8 mt-4">
            <div class="grid grid-cols-3 gap-8">
                <div>
                    <Label value="Andar de Nº"/>
                    <Text required v-model="form.andar" type="number" name="andar"/>
                </div>
                <div>
                    <Label value="Nº do Apartamento"/>
                    <Text required v-model="form.numero" type="number" name="numero"/>
                </div>
                <div>
                    <Label value="QTD de Quartos"/>
                    <Text required v-model="form.qtd_quartos" type="number" name="qtd_quartos"/>
                </div>
            </div>
            <div class="mt-8 flex justify-center">
                <Save @click="store()">Salvar</Save>
            </div>
        </div>
    </app-layout>
</template>

<script>
import { defineComponent } from "vue";
import Text from "@/Components/TextInput.vue";
import Label from "@/Components/InputLabel.vue"
import Save from "@/Components/PrimaryButton.vue"
import Swal from 'sweetalert2';

export default defineComponent({

    data() {
        return {
            form: {
                andar: null,
                numero: null,
                qtd_quartos: null
            }
        }
    },

    components: {
        Text,
        Label,
        Save
    },

    methods: {
        store() {
            this.$inertia.post(route('apartamento.store'), this.form, {
                preserveScroll: true,
                onSuccess: (page) => {
                    Swal.fire({
                        title: "Apartamento cadastrado com sucesso!",
                        text: "Informações adicionadas.",
                        icon: "success"
                    });
                },
            });
        }
    }
    
});

</script>