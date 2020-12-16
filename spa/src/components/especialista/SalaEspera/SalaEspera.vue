<template>
    <v-container class="fill-height fliut">
        <v-row
        align="center"
        justify="center"
        >
            <v-col
            cols="12"
            class="mx-auto"
            >
                <v-card>
                    <v-card-title>
                        Pacientes del dia:{{getquotas.quota}}
                        <v-spacer />
                        {{getquotas.date}}
                    </v-card-title>
                    <v-data-table
                        :page="page"
                        :pageCount="numberOfPages"
                        :server-items-length="total"
                        :loading="loading"
                        :headers="headers"
                        :items="getDateItems"
                        :options.sync="option"
                        class="elevation-3"
                        locale="es-CL"
                    >
                        <template v-slot:item.index="{ item }">
                           <td>{{item.index}}</td>
                        </template>
                        <template v-slot:item.actions="{ item }">
                            <v-btn
                            color="primary"
                            small
                            @click="atender(item.id)"
                            >
                                <v-icon>mdi-account-arrow-right</v-icon>
                            </v-btn>
                        </template>
                        <template v-slot:item.no_asistio="{ item }">
                            <v-btn
                            color="red"
                            small
                            @click="no_asistio(item.id)"
                            >
                                <v-icon>mdi-account-off</v-icon>
                            </v-btn>
                        </template>
                    </v-data-table>
                </v-card>
            </v-col>
        </v-row>
    </v-container>
</template>

<script>
import { mapGetters, mapActions} from 'vuex'
import axios from 'axios'
export default {

    name: 'SalaEspera',

    data: () => ({

        headers: [
            { text: 'N° ', value: 'index' },
            { text: 'Cedula', value: 'cedula' },
            { text: 'Atender', value: 'actions', sortable: false },
            { text: 'No atendido', value: 'no_asistio', sortable: false },
        ],   
        numberOfPages: 0,
        options:{},
        page:1 
    }),
    watch: {
        options: {
            handler() {
                this.loadQuota();
            },
        }
    },

    mounted () {
        this.loadQuota()
    },

    computed:{

        ...mapGetters({
            getquotas:'getquotas',
            getDateItems:'getDateItems',
            total:'total',
            isloading:'isloading'

        }),

        paginate:{
            set(value){
                this.GetData(value)
            },
            get(){
                return this.getDateItems
            }
        },
        option:{
            set(value){
                this.GetData(value)
            },
            get(){
                return this.options
            }   
        },
        loading:{
            set(value){ 
                this.Setloading(value)
            },
            get(){
                return this.isloading
            }
        }
    },

    methods: {
        ...mapActions({
            quotas: 'quotas',
            GetData: 'GetData',
            Setloading:'Setloading'
        }),

        async no_asistio (id) {

        },

        async atender (id) {

            this.$router.push({name:'consulta', params:{id: id}})

        },

        async loadQuota () {
           try{
                this.loading = true
                const { page, itemsPerPage } = this.options;
                let pageNumber = page - 1;
                this.GetData(pageNumber)
                this.loading = false
           }catch(err){
                this.loading = false
                console.log(err)
           }
        },
    }

}
</script>