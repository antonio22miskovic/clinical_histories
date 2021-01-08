<template>
    <v-container>
        <EditPatient v-if="getdialog"></EditPatient>
        <template>
            <v-row justify="space-around">
                <v-col>
                    <v-dialog
                    max-width="600"
                    transition="dialog-top-transition"
                    v-model="dialog"
                    >
                        <v-card
                            outlined
                            shaped
                            elevation="24"
                        >
                            <v-toolbar
                            color="primary"
                            dark
                            >Patologias Presente: {{countDesease}}</v-toolbar>
                            <v-card-text>
                                <div class="text-center" v-for="(item, index) in dataArray">
                                    <v-row>
                                        <v-col>
                                            <p><strong>{{index + 1}}</strong></p>
                                        </v-col>
                                        <v-col>
                                            <p><strong>{{item.name}}</strong></p>
                                        </v-col>
                                        <v-col>
                                            <v-btn                                      
                                                icon
                                                @click="editaritem(item, index)"
                                            >
                                               
                                                 <v-icon color="warning">mdi-grease-pencil</v-icon>
                                            </v-btn>
                                            <v-btn
                                                icon
                                                @click="eliminarItem(index)"
                                                
                                            >
                                               
                                            <v-icon color="error">mdi-delete-forever</v-icon>
                                            </v-btn>
                                        </v-col>
                                    </v-row>
                                </div>
                            </v-card-text>
                            <v-card-actions class="justify-end">
                                <v-btn
                                    text
                                    color="error"
                                    @click="dialog = false"
                                >
                                    cerrar
                                    <v-icon>mdi-close-octagon-outline</v-icon>
                                </v-btn>
                            </v-card-actions>
                        </v-card>
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
                            v-show="countDesease >= 1"
                            v-bind="attrs"
                            v-on="on"
                            fab
                            dark
                            absolute
                            top
                            right
                            @click="activarDialog"
                        >{{countDesease}}
                        </v-btn>
                  </v-fab-transition>
                </template>
                    <span>Patologias Registradas</span>
            </v-tooltip>
            <v-container>
                <v-card-title>
                    {{patient.first_name}}  {{patient.last_name }}

                    <v-tooltip bottom>
                        <template v-slot:activator="{ on, attrs }">
                            <v-btn icon
                                @click="editarPatient"
                            >
                                <v-icon
                                v-bind="attrs"
                                v-on="on"
                                >mdi-account-edit</v-icon>
                            </v-btn>
                        </template>
                        <span>editar usuario</span>
                    </v-tooltip>
                    <v-tooltip bottom>
                        <template v-slot:activator="{ on, attrs }">
                            <v-btn  icon
                            :to="{name:'clinichistory', params:{id: patient.id}}"
                            >
                                <v-icon
                                v-bind="attrs"
                                v-on="on"
                                >mdi-account-box</v-icon>
                            </v-btn>
                        </template>
                        <span>Historial clinico</span>
                    </v-tooltip>
                    <v-spacer/>
                    {{patient.sex}}
                </v-card-title>
                <v-list-item-subtitle class="text-center">
                    describa el diagnostico del paciente
                </v-list-item-subtitle>
                <v-card-text>
                    <v-container class="">
                        <v-form ref="patologias">
                            <v-text-field
                                label="nombre del diagnostico"
                                auto-grow
                                outlined
                                 prepend-icon="mdi-hospital"
                                rows="1"
                                row-height="15"
                                v-model="diagnostico"
                                :rules="[rules.sintoma]"
                            ></v-text-field>
                            <v-textarea
                                label="Descripcion"
                                auto-grow
                                outlined
                                rows="3"
                                row-height="25"
                                prepend-icon="mdi-comment"
                                v-model="description"
                                :rules="[rules.descriptionSintoma]"
                            ></v-textarea>
                            <v-container v-if="diagnostico !== '' && description !== ''">
                                <v-textarea
                                    label="espesifique los medicamentos a utilizar"
                                    auto-grow
                                    outlined
                                    rows="3"
                                    row-height="25"
                                    prepend-icon="mdi-needle"
                                    v-model="medicamentos"
                                    :rules="[rules.medicamento]"
                                ></v-textarea>
                                <v-textarea
                                    label="Describa el uso de los medicamento"
                                    auto-grow
                                    outlined
                                    rows="3"
                                    row-height="25"
                                    prepend-icon="mdi-comment"
                                    v-model="usoMedicamentos"
                                    :rules="[rules.usomedicamento]"
                                ></v-textarea>
                            </v-container>

                            <v-card-actions>
                                <v-btn
                                    elevation="3"
                                    color="primary"
                                    @click="diagnosticar">
                                    Diagnosticar
                                    <v-icon>mdi-plus</v-icon>
                                </v-btn>
                                <v-btn
                                    elevation="3"
                                    color="warning"
                                    @click="clear">
                                    limpiar
                                    <v-icon>mdi-broom</v-icon>
                                </v-btn>
                                <v-btn
                                    elevation="3"
                                    color="success"
                                    :disabled="countDesease === 0"
                                    @click="registrar">
                                    registrar
                                    <v-icon>mdi-gavel</v-icon>
                                </v-btn>
                            </v-card-actions>

                        </v-form>
                    </v-container>
                </v-card-text>
            </v-container>
        </v-card>
    </v-container>
</template>
<script>
    import { mapGetters, mapActions} from 'vuex'
    import EditPatient from '@/components/dialogs/EditPatient'
    export default{
        name:'ConsultaPatient',
        components:{
           EditPatient
        },
        data:()=>({
            diagnostico:'',
            description:'',
            enabled: false,
            dataArray:[],
            editando:false,
            referenciaIndex:null,
            usoMedicamentos:'',
            medicamentos:'',
            dialog:false,
             rules: {
                sintoma: value => !!value || 'Introduzca el nombre del sintoma',
                descriptionSintoma: value => !!value || 'Introduzca la descripcion de sintoma',
                medicamento: value => !!value || 'Introduzca el medicamento a suministrar',
                usomedicamento: value => !!value || 'Describa el uso del medicamento',
            }
        }),
        mounted(){
            this.verificar()
        },
        methods:{

            ...mapActions({
                store_mc:'store_mc',
                show_mc:'show_mc',
                show_p:'show_p',
                store_mr:'store_mr',
                setvalue_mr:'setvalue_mr',
                setvalue_mc:'setvalue_mc',
                store_dd:'store_dd',
                destroy_wl:'destroy_wl',
                Ondialog:'Ondialog',
                setOverlay:'setOverlay',
            }),

            async verificar(){

                if (this.patient.id !== this.patient_url) {
                    this.show_p(this.patient_url).then(res => {
                        this.setvalue_mr(res.medical_record)
                    }).catch(err =>{
                        console.log(err)
                    })
                    this.show_mc(this.patient_consulta)
                }
            },

            async diagnosticar(){
                if (!this.$refs.patologias.validate()) {
                        return
                    }
                if (!this.editando) {
                    let set = {name:this.diagnostico, description:this.description ,medicina: this.medicamentos, descriptionMedicina: this.usoMedicamentos}
                    this.dataArray.push(set)
                    this.diagnostico = ''
                    this.description = ''
                    this.medicamentos = ''
                    this.usoMedicamentos =''
                    this.referenciaIndex=null
                    this.editando = false
                    this.$refs.patologias.resetValidation()
                }else{/// si va a editar
                    for (var i=0; i <= this.dataArray.length; i++) {
                        if (i === this.referenciaIndex) {
                            this.dataArray[i].name=this.diagnostico
                            this.dataArray[i].description=this.description
                            this.dataArray[i].medicina=this.medicamentos
                            this.dataArray[i].descriptionMedicina=this.usoMedicamentos
                        }
                    }
                    this.diagnostico = ''
                    this.description = ''
                    this.medicamentos = ''
                    this.usoMedicamentos =''
                    this.editando = false
                    this.referenciaIndex=null
                }

            },
            async editarPatient(){
                    this.Ondialog(true)
            },

            async editaritem(item, index){
                this.referenciaIndex = index
                this.dialog = false
                this.editando = true
                this.diagnostico = item.name
                this.description = item.description
                this.medicamentos = item.medicina
                this.usoMedicamentos = item.descriptionMedicina
            },

            clear(){
                this.diagnostico = ''
                this.description = ''
                this.medicamentos = ''
                this.usoMedicamentos =''
                this.editando = false
                this.referenciaIndex=null
                this.$refs.patologias.resetValidation()
            },

            registrar(){
                this.setOverlay(true)
                this.store_dd({'array':this.dataArray,consulta:this.patient_consulta}).then(res => {
                        this.setOverlay(false)
                        this.destroy_wl(this.patient.ci).then(res=>{
                            this.$swal({
                                icon: 'success',
                                title: '¡Registro de la consulta exitoso!',
                                text:'exito',
                                confirmButtonColor: '#3085d6',
                            })
                            this.$router.push({name:'home'})
                        })

                }).catch(err =>{
                    this.setOverlay(false)
                    this.$swal({
                        icon: 'error',
                        title: '¡hubo un problema por intente de neuvo!',
                        text:'exito',
                        confirmButtonColor: '#3085d6',
                    })
              })
            },
            eliminarItem(index){
                this.dataArray.splice(index, 1);
                this.diagnostico = ''
                this.description = ''
                this.medicamentos = ''
                this.usoMedicamentos =''
                this.referenciaIndex=null
                this.editando = false
                this.dialog = false
            },

            activarDialog(){
                this.dialog = true
            }

        },
        computed:{

            ...mapGetters({
                Getpatient:'Getpatient',
                getMedical_record:'getMedical_record',
                getdialog:'getdialog'
            }),

            patient(){
                return this.Getpatient
            },
            patient_url(){
                return this.$route.params.id
            },

            patient_consulta(){
                return this.$route.params.consulta
            },

            countDesease(){
                return this.dataArray.length
            }
        }
    }
</script>