<template>
    <app-layout>
        <p>Olá, <span class="font-semibold">{{ this.$attrs.auth.user.name }}</span>!</p>
        <div class="border-4 border-gray-500 h-auto w-full p-8 mt-4">
            <div class="grid grid-cols-3 gap-8">
                <div>
                    <Label value="Nome do Morador"/>
                    <Text required v-model="form.morador" name="morador"/>
                </div>
                <div class="flex flex-col">
                    <Label value="Nº do Apartamento"/>
                    <Multiselect
                        v-model="form.apartamento"
                        :options="options"
                        track-by="id"
                        label="name"
                        placeholder="Selecione o apartamento"

                    />
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
import Multiselect from 'vue-multiselect';
import Text from "@/Components/TextInput.vue";
import Label from "@/Components/InputLabel.vue"
import Save from "@/Components/PrimaryButton.vue"
import Swal from 'sweetalert2';

export default defineComponent({

    data() {
        return {
            selectedValue: null,
            options: null,
            form: {
                morador: null,
                apartamento: null,
            }
        }
    },

    created() {
        this.options = this.objectToArray(this.apartamentos);
    },

    components: {
        Multiselect,
        Label,
        Text,
        Save
    },

    props: {
        apartamentos: Object,
    },

    methods: {
        objectToArray(obj) {
            const keys = Object.keys(obj);
            return keys.map((key) => ({ id: key, name: obj[key] }));
        },

        store() {
            this.$inertia.post(route('morador.store'), this.form, {
                preserveScroll: true,
                onSuccess: (page) => {
                    Swal.fire({
                        title: "Morador cadastrado com sucesso!",
                        text: "Informações adicionadas.",
                        icon: "success"
                    });
                },
            });
        }
    }

})

</script>

<style src="vue-multiselect/dist/vue-multiselect.css"></style>