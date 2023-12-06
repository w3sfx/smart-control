<template>
    <app-layout>
        <p class="text-black font-semibold mb-4"><i class="text-3xl text-black bi bi-person-lines-fill"></i> Controle de Visitantes</p>

        <p>Olá, <span class="font-semibold">{{ this.$attrs.auth.user.name }}</span>!</p>
        <div class="border-4 border-gray-500 h-auto w-full p-8 mt-4 mb-8">
            <div class="grid grid-cols-2 gap-8">
                <div class="flex flex-col">
                    <Label value="Morador"/>
                    <Multiselect
                        v-model="form.morador"
                        :options="moradorArr"
                        track-by="id"
                        label="name"
                        placeholder="Selecione"

                    />
                </div>
                <div class="flex flex-col">
                    <Label value="Tipo Pessoa"/>
                    <Multiselect
                        v-model="form.tipo"
                        :options="options"
                        track-by="id"
                        label="name"
                        placeholder="Selecione"

                    />
                </div>
                <div>
                    <Label value="Nome"/>
                    <Text required v-model="form.nome" name="nome"/>
                </div>
                <div>
                    <Label value="Descrição"/>
                    <Text required v-model="form.descricao" name="descricao"/>
                </div>
            </div>
            <div class="mt-8 flex justify-center">
                <Save @click="store()">Registrar</Save>
            </div>
        </div>
        <div class="card">
            <DataTable editMode="cell" rowHover="true" :value="visitantes" tableStyle="min-width: 50rem" @row-dblclick="handleRowClick">
                <Column field="morador" header="Morador"></Column>
                <Column field="tipo" header="Tipo Pessoa"></Column>
                <Column field="nome" header="Nome"></Column>
                <Column field="descricao" header="Descrição"></Column>
                <Column field="status" header="Status"></Column>
                <Column field="data_entrada" header="Data Entrada"></Column>
                <Column field="data_saida" header="Data Saída"></Column>
            </DataTable>
        </div>
    </app-layout>
</template>

<script>
import { defineComponent } from "vue";
import Multiselect from 'vue-multiselect';
import Label from "@/Components/InputLabel.vue";
import Text from "@/Components/TextInput.vue";
import Save from "@/Components/PrimaryButton.vue";
import Swal from 'sweetalert2';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';

export default defineComponent({

    data() {
        return {
            options: [
                {id: 0, name: 'Pessoa Física'},
                {id: 1, name: 'Prestador de Serviço'}
            ],
            form: {
                tipo: null,
                nome: null,
                descricao: null,
                data_entrada: null,
                data_saida: null,
                status: null,
                morador: null
            },
            visitantes: [],
            tipoDescricao: {
                0: 'Pessoa Física',
                1: 'Prestador de Serviço',   
            },
            statusDescricao: {
                0: 'Visitando',
                1: 'Finalizado',   
            },
            style: {
                'min-width': '50rem',
                'border': '1px solid #ccc',
                'border-radius': '5px',
                'overflow': 'hidden',
            },
            moradorArr: []
        }
    },

    components: {
        Multiselect,
        Label,
        Text,
        Save,
        DataTable,
        Column
    },

    props: {
        visitante: Object,
        morador: Object
    },

    created() {
        this.moradorArr = this.objectToArray(this.morador);
    },

    mounted() {
        this.formatar();
    },

    methods: {
        store() {
            this.$inertia.post(route('visitante.store'), this.form, {
                preserveScroll: true,
                onSuccess: (page) => {
                    Swal.fire({
                        title: "Visitante cadastrado com sucesso!",
                        text: "Informações adicionadas.",
                        icon: "success"
                    });
                    setTimeout(() => {
                        location.reload();
                    }, 1000);
                },
            });
        },

        handleRowClick(event) {
            Swal.fire({
                title: "Deseja finalizar a visita?",
                text: "Após a confirmação, não poderá ser desfeita!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Sim!",
                cancelButtonText: "Não!"
            }).then((result) => {
                if (result.isConfirmed) {
                    this.$inertia.post(route('visitante.saida'), event, {
                        preserveScroll: true,
                        onSuccess: (page) => {
                            Swal.fire({
                                title: "Horário de saída setado!",
                                text: "Informações atualizadas.",
                                icon: "success"
                            });
                            setTimeout(() => {
                                location.reload();
                            }, 1000);
                        },
                    });
                }
            });
        },

        formatar() {
            this.visitantes = this.visitante.map(objeto => ({
                ...objeto,
                tipo: this.tipoDescricao[objeto.tipo],
                status: this.statusDescricao[objeto.status],
                data_entrada: this.formatarDataBrasileira(objeto.data_entrada),
                data_saida: objeto.data_saida ? this.formatarDataBrasileira(objeto.data_saida) : null,
            }));
        },

        formatarDataBrasileira(data) {
            const dataObj = new Date(data);
            const dia = String(dataObj.getDate()).padStart(2, '0');
            const mes = String(dataObj.getMonth() + 1).padStart(2, '0');
            const ano = dataObj.getFullYear();
            const horas = String(dataObj.getHours()).padStart(2, '0');
            const minutos = String(dataObj.getMinutes()).padStart(2, '0');
            const segundos = String(dataObj.getSeconds()).padStart(2, '0');

            return `${dia}/${mes}/${ano} ${horas}:${minutos}:${segundos}`;
        },

        objectToArray(obj) {
            const keys = Object.keys(obj);
            return keys.map((key) => ({ id: obj[key].nome, name: obj[key].nome }));
        },
    },


})

</script>

<style src="vue-multiselect/dist/vue-multiselect.css"></style>