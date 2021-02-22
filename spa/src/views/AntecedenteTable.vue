<template>
    <v-container>


          <template>
            <v-row justify="space-around">
                <v-col cols="auto">
                    <v-dialog
                        transition="dialog-top-transition"
                        v-model="dialogCreate"
                        max-width="600"
                    >
                        <template>
                            <v-card
                                outlined
                                shaped
                                elevation="24"
                            >
                                <v-toolbar
                                    color="primary"
                                    dark
                                    >Nuevo Antecedente
                                </v-toolbar>
                                <v-card-text>
                                    <v-form ref="formCreate">
                                        <v-container  mt-5>
                                            <v-text-field
                                                label="Antecedente"
                                                auto-grow
                                                outlined
                                                 prepend-icon="mdi-hospital"
                                                rows="1"
                                                row-height="15"
                                                v-model="antecedente"
                                                :rules="[rules.antecedente]"
                                            ></v-text-field>
                                            <v-textarea
                                                label="Descripcion"
                                                auto-grow
                                                outlined
                                                rows="3"
                                                row-height="25"
                                                prepend-icon="mdi-comment"
                                                v-model="description"
                                                :rules="[rules.descriptionAntecedente]"
                                            ></v-textarea>
                                        </v-container>
                                    </v-form>
                                </v-card-text>
                                <v-card-actions class="justify-end">
                                    <v-btn
                                        elevation="3"
                                        color="success"
                                        @click="registrar">
                                        registrar
                                        <v-icon>mdi-gavel</v-icon>
                                    </v-btn>
                                    <v-btn
                                        text
                                        @click="dialogCreate=false"
                                        color="error"
                                        >cerrar
                                            <v-icon>mdi-close-octagon-outline</v-icon>
                                    </v-btn>
                                </v-card-actions>
                            </v-card>
                        </template>
                  </v-dialog>
                </v-col>
            </v-row>
        </template>


        <template>
            <v-row justify="space-around">
                <v-col cols="auto">
                    <v-dialog
                        transition="dialog-top-transition"
                        v-model="dialog"
                        max-width="600"
                    >
                        <template>
                            <v-card
                                outlined
                                shaped
                                elevation="24"
                            >
                                <v-toolbar
                                    color="primary"
                                    dark
                                    >Antecedente: {{verifcar.name}}
                                </v-toolbar>
                                <v-card-text>
                                   <p class="text-center">Descripción:</p>
                                   <p class="text-center">{{verifcar.description}}</p>
                                </v-card-text>
                                <v-card-actions class="justify-end">
                                    <v-btn
                                    text
                                    @click="dialog=false"
                                    color="error"
                                    >cerrar
                                        <v-icon>mdi-close-octagon-outline</v-icon>
                                </v-btn>
                                </v-card-actions>
                            </v-card>
                        </template>
                  </v-dialog>
                </v-col>
            </v-row>
        </template>


        <template>
            <v-row justify="space-around">
                <v-col cols="auto">
                    <v-dialog
                        transition="dialog-top-transition"
                        v-model="dialogEditar"
                        max-width="600"
                    >
                        <template>
                            <v-card
                                outlined
                                shaped
                                elevation="24"
                            >
                                <v-toolbar
                                    color="primary"
                                    dark
                                    >Editar Antecedente
                                </v-toolbar>
                                <v-card-text>
                                    <v-form ref="EditarForm">
                                            <v-text-field
                                                append-icon="mdi-account-multiple"
                                                name="antecedenteFrom"
                                                ref="quotaupdate"
                                                label="Antecedente"
                                                type="text"
                                                v-model="editarAntecendente.name"
                                                :rules="[rules.antecedente]"
                                            />
                                            <v-textarea
                                                label="Descripción"
                                                auto-grow
                                                outlined
                                                rows="3"
                                                row-height="25"
                                                prepend-icon="mdi-needle"
                                                v-model="editarAntecendente.description"
                                                :rules="[rules.descriptionAntecedente]"
                                            ></v-textarea>
                                    </v-form>
                                </v-card-text>
                                <v-card-actions class="justify-end">
                                    <v-btn
                                        text
                                        @click="editarItem"
                                        color="primary"
                                    >Editar
                                        <v-icon>mdi-close-octagon-outline</v-icon>
                                    </v-btn>
                                     <v-btn
                                        text
                                        @click="dialogEditar=false"
                                        color="error"
                                    >cerrar
                                            <v-icon>mdi-close-octagon-outline</v-icon>
                                    </v-btn>
                                </v-card-actions>
                            </v-card>
                        </template>
                  </v-dialog>
                </v-col>
            </v-row>
        </template>



        <v-card
            outlined
            shaped
            elevation="24"
        >
          <v-tooltip bottom>
                <template v-slot:activator="{ on, attrs }">
                  <v-fab-transition>
                        <v-btn
                            color="primary"
                            v-show="hidden"
                            v-bind="attrs"
                            v-on="on"
                            fab
                            dark
                            absolute
                            top
                            right
                            @click="DialogCreate"
                        > <v-icon>mdi-plus</v-icon>
                        </v-btn>
                  </v-fab-transition>
              </template>
              <span>Añadir Antecedentes</span>
          </v-tooltip>
            <v-card-title>
                <v-btn
                    text
                    color="primary"
                    @click="NexRouter"
                >
                <v-icon>
                    mdi-chevron-left
                </v-icon>
              </v-btn>  paciente {{Getpatient.first_name}}  {{Getpatient.last_name}}
                <v-btn  text>
                </v-btn>
            </v-card-title>

            <v-card-subtitle>
                <v-row>
                    <v-col>
                        Genero: {{Getpatient.sex}}
                    </v-col>
                    <v-col>
                        Cedula: {{parseInt(Getpatient.ci).toLocaleString('es-ES')}}
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
                                    <v-card v-if="getDataAntecedentes.length > 0">
                                        <v-card-title>
                                           Antecedentes
                                            <v-spacer />
                                        </v-card-title>
                                        <v-data-table
                                            :page="page"
                                            :pageCount="numberOfPages"
                                            :server-items-length="total_ant"
                                            :headers="headers"
                                            :items="getDataAntecedentes"
                                            :options.sync="option"
                                            class="elevation-3"
                                            locale="es-CL"
                                        >
                                        <template v-slot:item.ver="{ item }">
                                            <v-btn
                                                color="primary"
                                                small
                                                @click="vertable(item)"
                                            >
                                                <v-icon>mdi-eye</v-icon>
                                            </v-btn>
                                        </template>
                                        <template v-slot:item.editar="{ item }">
                                            <v-btn
                                                color="warning"
                                                small
                                                @click="montarEditar(item)"
                                            >
                                                <v-icon>mdi-grease-pencil</v-icon>
                                            </v-btn>
                                        </template>
                                         <template v-slot:item.eliminar="{ item }">
                                            <v-btn
                                                color="error"
                                                small
                                                @click="eliminarItem(item.id)"
                                            >
                                                <v-icon>mdi-delete-empty</v-icon>
                                            </v-btn>
                                        </template>
                                        </v-data-table>
                                    </v-card>
                                    <v-card v-else>
                                        <v-alert
                                            border="bottom"
                                            colored-border
                                            type="warning"
                                            elevation="2"
                                        >
                                           Paciente no presenta Antecedentes
                                        </v-alert>
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
    import Swal from 'sweetalert2'
    export default{
        name:'ClinicHistory',
        mounted(){
            this.verificar()
        },
        data:()=>({
            hidden:true,
            dialogCreate:false,
            antecedente:'',
            description:'',
            dataArray:[],
            headers: [
                { text: 'Antecedente', value: 'name' },
                { text: 'Descripción', value: 'description'},
                { text: 'ver', value: 'ver', sortable: false},
                { text: 'editar', value: 'editar', sortable: false},
                { text: 'eliminar', value: 'eliminar', sortable: false},
            ],
            rules: {
                antecedente: value => !!value || 'Introduzca el Antecedente',
                descriptionAntecedente: value => !!value || 'Introduzca la descripción de antecedente',
            },
            numberOfPages: 0,
            options:{},
             page:1,
             dialog:false,
             dialogEditar:false,
             verifcar:{
                name:'',
                description:''
             },
            editarAntecendente:{
                id:'',
                name:'',
                description:''
            }
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
                getDataAntecedentes:'getDataAntecedentes',
                getMedical_record:'getMedical_record',
                total_ant:'total_ant'
            }),
            patient_url(){
                return this.$route.params.id
            },
            patient(){
                return this.Getpatient
            },
            paginate:{
                set(value){
                    this.all_ant({page:value, id:this.patient_url})
                },
                get(){
                    return this.getDataAntecedentes
                }
            },
            option:{
                set(value){
                    this.all_ant({page:value, id:this.patient_url})
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
                all_ant:'all_ant',
                setOverlay:'setOverlay',
                destroy_ant:'destroy_ant',
                update_ant:'update_ant',
                store_ant:'store_ant'
            }),

            async registrar(){

                if (!this.$refs.formCreate.validate()) {

                        return
                }
                this.setOverlay(true)
                let set = { name:this.antecedente,  description:this.description }
                this.dataArray.push(set)
                this.store_ant({'array':this.dataArray,patient:this.Getpatient.id}).then(res => {
                    if (res.data === true) {
                        this.loadQuota()
                        this.setOverlay(false)
                        this.dialogCreate = false
                        this.antecedente  = null
                        this.description  = null
                        this.$refs.formCreate.resetValidation()
                        this.$swal({
                            icon: 'success',
                            title: 'Antecedente creado con éxito',
                            text:'éxito',
                            confirmButtonColor: '#3085d6',
                        })
                    }else{
                        this.setOverlay(false)
                        this.$swal({
                            icon: 'error',
                            title:'¡Ha ocurrido un error!',
                            text: 'error de la consulta',
                            confirmButtonColor: '#3085d6',
                        })
                    }
                }).catch(err =>{
                    this.setOverlay(false)
                    this.$swal({
                        icon: 'error',
                        title: '¡Hubo un problema intente de nuevo!',
                        text:'error',
                        confirmButtonColor: '#3085d6',
                    })
                })

            },

            async DialogCreate(){
                this.dialogCreate = true
            },

            async vertable(item){

                this.verifcar.id = item.id
                this.verifcar.name = item.name
                this.verifcar.description = item.description
                this.dialog = true

            },

            async editarItem(){

                if (!this.$refs.EditarForm.validate()) {

                    return
                }

                Swal.fire({
                    title: 'Seguro Desea editar el antecedente del Paciente?',
                    showDenyButton: true,
                    showCancelButton: true,
                    confirmButtonText: `Editar`,
                    denyButtonText: `No`,
                    icon: 'warning',
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.setOverlay(true)
                        this.update_ant(this.editarAntecendente).then(res => {
                            this.setOverlay(false)
                            this.$swal({
                                icon: 'success',
                                title: 'Antecedente Editado con éxito',
                                text:'éxito',
                                confirmButtonColor: '#3085d6',
                            })
                            this.dialogEditar = false
                        })
                        this.loadQuota()
                    } else if (result.isDenied) {
                        Swal.fire('Por favor Tenga Cuidado', '', 'info')
                    }
                })

            },

            async montarEditar(item){

                this.editarAntecendente.id = item.id
                this.editarAntecendente.name = item.name
                this.editarAntecendente.description = item.description
                this.dialogEditar = true
                // console.log(this.editarAntecendente)
            },

            async eliminarItem(id){

                Swal.fire({
                    title: 'Desea Eliminar el antecedente del Paciente?',
                    showDenyButton: true,
                    showCancelButton: true,
                    confirmButtonText: `Eliminar`,
                    denyButtonText: `No`,
                    icon: 'warning',
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.setOverlay(true)
                        this.destroy_ant(id).then(res => {
                            this.setOverlay(false)
                            this.$swal({
                                icon: 'success',
                                title: 'Antecedente Eliminado con éxito',
                                text:'éxito',
                                confirmButtonColor: '#3085d6',
                            })
                        })
                        this.loadQuota()
                    } else if (result.isDenied) {
                        Swal.fire('Por favor Tenga Cuidado', '', 'info')
                    }
                })
            },

            async loadQuota () {
                try{
                    this.setOverlay(true)
                    const { page, itemsPerPage } = this.options
                    let pageNumber = page - 1
                    this.all_ant({page:pageNumber, id:this.patient_url}).then(res => {
                        this.setOverlay(false)
                    })
                }catch(err){
                    this.setOverlay(false)
                    console.log(err)
                }
            },

            async NexRouter(){
                this.$router.go(-1)
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