<template>
    <v-container>
        <v-card
            elevation="2"
        >
            <v-card-title> 
                paciente {{Getpatient.first_name}}  {{Getpatient.last_name}}
                <v-btn  text>
                    <v-icon>mdi-account-edit</v-icon>
                </v-btn>
            </v-card-title>

            <v-card-subtitle>
                <v-row>
                    <v-col>
                        Genero: {{Getpatient.sex}}
                    </v-col>
                    <v-col>
                        Cedula: {{Getpatient.ci}}
                    </v-col>
                    <v-col>
                        Telefono: {{Getpatient.phone}}
                    </v-col>
                </v-row>
                <v-row>
                    <v-col>
                        Estado Civil: {{Getpatient.civil_status}}
                    </v-col>
                    <v-col>
                        Fecha de Nacimiento: {{Getpatient.birthdate}}
                    </v-col>
                    <v-col>
                        Peso Kg: {{Getpatient.weight}}
                    </v-col>
                </v-row>
            </v-card-subtitle>
            <v-card-text>
                <v-row>
                    <v-col>
                        <v-container>
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
                                           Consultas Medicas
                                            <v-spacer />
                                        </v-card-title>
                                        <v-data-table
                                            :page="page"
                                            :pageCount="numberOfPages"
                                            :server-items-length="total_mc"
                                            :headers="headers"
                                            :items="getDataConsulta"
                                            :options.sync="option"
                                            class="elevation-3"
                                            locale="es-CL"
                                        >
                                        <template v-slot:item.ver="{ item }">
                                            <v-btn
                                                color="primary"
                                                small
                                                 :to="{
                                                    name:'clinichistoryconsult',
                                                    params:{id:item.id}
                                                }"
                                            >
                                                <v-icon>mdi-eye</v-icon>
                                            </v-btn>
                                        </template>
                                        </v-data-table>
                                    </v-card>
                                </v-col>
                            </v-row>
                        </v-container>
                    </v-col>
                </v-row>
            </v-card-text>
        </v-card>
    </v-container>
</template>
<script>
    import { mapGetters, mapActions} from 'vuex'
    export default{
        name:'ClinicHistory',
        mounted(){
            this.verificar()
        },
        data:()=>({
            headers: [
                { text: 'fecha', value: 'fecha' },
                { text: 'historial', value: 'ver', sortable: false},
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
        computed:{
            ...mapGetters({
                Getpatient:'Getpatient',
                getDataConsulta:'getDataConsulta',
                getMedical_record:'getMedical_record',
                total_mc:'total_mc'
            }),
            patient_url(){
                return this.$route.params.id
            },
            patient(){
                return this.Getpatient
            },
            paginate:{
                set(value){
                    this.all_mc({page:value, id:this.patient_url})
                },
                get(){
                    return this.getDataConsulta
                }
            },
            option:{
                set(value){
                    this.all_mc({page:value, id:this.patient_url})
                },
                get(){
                    return this.options
                }
            }
        }, 
        methods:{

            ...mapActions({
                show_p:'show_p',
                setvalue_mr:'setvalue_mr',
                all_mc:'all_mc'
            }),

            async loadQuota () {
                try{
                    const { page, itemsPerPage } = this.options
                    let pageNumber = page - 1
                    this.all_mc({page:pageNumber, id:this.patient_url})
                }catch(err){
                    console.log(err)
                }
            },

            async verificar(){
                if (this.Getpatient.id !== this.patient_url) {
                    this.show_p(this.patient_url).then(res => {
                        this.setvalue_mr(res.medical_record)
                    }).catch(err =>{
                        console.log(err)
                    })   
                }         
            },
        }
    }
</script>