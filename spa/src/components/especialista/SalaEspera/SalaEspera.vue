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
                <v-card v-if="alert === false"
                    outlined
                    shaped
                    elevation="24"
                >
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
                        <template v-slot:item.index="{ index }">
                                <td class="text-center">{{index}}</td>
                        </template>
                        <template v-slot:item.FormatoCi="{ item }">
                           {{parseInt(item.cedula).toLocaleString('es-ES')}}
                        </template>
                        <template v-slot:item.actions="{ item }">
                            <v-btn
                            color="primary"
                            small
                            @click="atender(item)"
                            >
                                <v-icon>mdi-account-arrow-right</v-icon>
                            </v-btn>
                        </template>
                        <template v-slot:item.no_asistio="{ item }">
                            <v-btn
                            color="red"
                            small
                            @click="no_asistio(item.cedula)"
                            >
                                <v-icon>mdi-account-off</v-icon>
                            </v-btn>
                        </template>
                    </v-data-table>
                </v-card>
                <v-alert
                    v-else
                    border="bottom"
                    colored-border
                    type="warning"
                    elevation="2"
                >
                   Hoy no se encuentran pacientes en espera !Feliz Dia¡         
                </v-alert>
            </v-col>
        </v-row>
    </v-container>
</template>

<script>
import Swal from 'sweetalert2'
import { mapGetters, mapActions} from 'vuex'
import axios from 'axios'
export default {

    name: 'SalaEspera',

    data: () => ({

        headers: [
            { text: 'N° ', value: 'index' },
            { text: 'Cedula', value: 'FormatoCi' },
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
            isloading:'isloading',
            componet:'Getcomponet',
            patient:'Getpatient',
            alert:'alert'

        }),

        paginate:{
            set(value){
                this.all_wl(value)
            },
            get(){
                return this.getDateItems
            }
        },
        option:{
            set(value){
                this.all_wl(value)
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
        },
    },

    methods: {

        ...mapActions({
            quotas: 'quotas',
            all_wl: 'all_wl',
            Setloading:'loading_wl',
            detectPatient:'detectPatient',
            clearPatient: 'clearPatient',
            store_mc:'store_mc',
            setvalue_mr:'setvalue_mr',
            destroy_wl:'destroy_wl',
            setOverlay:'setOverlay,'
        }),

        async no_asistio (cedula) {
            Swal.fire({
                    title: 'Seguro que desea descartar a este Paciente?',
                    showDenyButton: true,
                    showCancelButton: true,
                    confirmButtonText: `Descartar`,
                    denyButtonText: `No`,
                    icon: 'warning',
                }).then((result) => {
                    if (result.isConfirmed) {
                            this.setOverlay(true)
                        this.destroy_wl(cedula).then(res=>{
                            this.setOverlay(false)
                            this.$swal({
                                icon: 'success',
                                title: '¡Eliminado de la lista de espera con exito!',
                                text:'exito',
                                confirmButtonColor: '#3085d6',
                            })
                            this.loadQuota()
                        })
                    }else if (result.isDenied) {
                         Swal.fire('Por favor Tenga Cuidado', '', 'info')
                         
                    }
                })
            
        },

        async atender (item) {
            this.setOverlay(true)
            this.clearPatient() // formatear datos de pacientes antereores
            this.detectPatient(item.cedula).then(res =>{
                if (Object.keys(res).length === 0) {
                    this.setOverlay(false)
                    this.$router.push({name:'consulta', params:{id: item.id}})// montamos el componente de nuevo paciente
                }else{
                    this.setvalue_mr(res.medical_record)
                    this.store_mc(res.medical_record.id).then(response => {
                        this.setOverlay(false)
                        this.$router.push({name:'consultaPatient',params:{
                                id:res.id,
                                consulta:response.id
                            }
                        })// montamos el componente del paciente ya registrado
                    })

                }
            })

        },

        async loadQuota () {
           try{
                this.setOverlay(true)
                const { page, itemsPerPage } = this.options;
                let pageNumber = page - 1;
                this.all_wl(pageNumber).then(res =>{
                    this.setOverlay(false)
                })
               
           }catch(err){
               this.setOverlay(false)
                console.log(err)
           }
        },
    }

}
</script>