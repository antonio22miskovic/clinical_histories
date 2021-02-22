<template>
	<v-container>

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
                            >
								<v-btn
									text
									color="primary"
									@click="NexRouter"
								>
									<v-icon>
										mdi-chevron-left
									</v-icon>
								</v-btn>
                        	Antecedentes Presentes: {{countAntecendente}}</v-toolbar>
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
                            v-show="countAntecendente >= 1"
                            v-bind="attrs"
                            v-on="on"
                            fab
                            dark
                            absolute
                            top
                            right
                            @click="activarDialog"
                        >{{countAntecendente}}
                        </v-btn>
                  </v-fab-transition>
                </template>
                    <span>Antecendentes</span>
            </v-tooltip>
            <v-container>
                <v-card-title>
                    {{patient.first_name}}  {{patient.last_name }}

                   <!--  <v-tooltip bottom>
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
 -->                    <v-spacer/>
                    {{patient.sex}}
                </v-card-title>
                <v-list-item-subtitle class="text-center">
                    Describa los Antecedentes del Paciente
                </v-list-item-subtitle>
                <v-card-text>
                    <v-container class="">
                        <v-form ref="form">
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
                            <v-card-actions>
                                <v-btn
                                    elevation="3"
                                    color="primary"
                                    @click="Antecedente">
                                    Antecedente
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
                                    :disabled="countAntecendente === 0"
                                    @click="registrar">
                                    registrar
                                    <v-icon>mdi-gavel</v-icon>
                                </v-btn>
                                 <v-btn
                                    elevation="3"
                                    color="success"
                                    :disabled="countAntecendente > 0"
                                    @click="registrar">
                                    Sin antecendetes
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
	export default{

		name:'Antecedente',

		mounted(){
            this.verificar()
        },

		data:() => ({
			antecedente:'',
			description:'',
			editando:'',
			referenciaIndex:'',
			dataArray:[],
			dialog:'',
			rules: {
                antecedente: value => !!value || 'Introduzca el Antecedente',
                descriptionAntecedente: value => !!value || 'Introduzca la descripción del antecedente',
            }
        }),

		computed:{
			...mapGetters({
                Getpatient:'Getpatient',
                getMedical_record:'getMedical_record',
                getdialog:'getdialog',
                getMedical_record:'getMedical_record'
            }),
			patient(){
                return this.Getpatient
            },
            patient_url(){
                return this.$route.params.id
            },

            countAntecendente(){
                return this.dataArray.length
            }

		},

		methods:{

			...mapActions({
                store_mc:'store_mc',
                show_mc:'show_mc',
                show_p:'show_p',
                store_mr:'store_mr',
                setvalue_mr:'setvalue_mr',
                setvalue_mc:'setvalue_mc',
                store_ant:'store_ant',
                destroy_wl:'destroy_wl',
                Ondialog:'Ondialog',
                setOverlay:'setOverlay'
            }),

            activarDialog(){
                this.dialog = true
            },

            registrar(){

                this.setOverlay(true)
                if (this.dataArray.length === 0) {

                    this.store_mc(this.getMedical_record.id).then(response => {
                         this.setOverlay(false)
                            this.$swal({
                                icon: 'success',
                                title: '¡Paciente sin Antecedentes!',
                                text:'exito',
                                confirmButtonColor: '#3085d6',
                            })
                            this.$router.push({name:'consultaPatient',params:{
                                id:this.patient_url,
                                consulta:response.id
                                }
                            })
                        })// montamos el componente del paciente ya registrado

                }else{
                    this.store_ant({'array':this.dataArray,patient:this.patient_url}).then(res => {
                        if (res.data === true) {
                            this.setOverlay(false)
                            this.store_mc(this.getMedical_record.id).then(response => {
                                this.$swal({
                                    icon: 'success',
                                    title: '¡Registro de la consulta exitoso!',
                                    text:'exito',
                                    confirmButtonColor: '#3085d6',
                                })
                                this.$router.push({name:'consultaPatient',params:{
                                    id:this.patient_url,
                                    consulta:response.id
                                    }
                                })
                            })// montamos el componente del paciente ya registrado
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
                            title: '¡hubo un problema por intente de nuevo!',
                            text:'error',
                            confirmButtonColor: '#3085d6',
                        })
                  })
                }
            },

            async verificar(){

                if (this.patient.id !== this.patient_url) {
                    this.show_p(this.patient_url).then(res => {
                        this.setvalue_mr(res.medical_record)
                    }).catch(err =>{
                        console.log(err)
                    })
                    // this.show_mc(this.patient_consulta)
                }
            },

            async editaritem(item, index){
                this.referenciaIndex = index
                this.dialog = false
                this.editando = true
                this.antecedente = item.name
                this.description = item.description
            },

            async NexRouter(){
                this.$router.go(-1)
            },

            async Antecedente(){

                if (!this.$refs.form.validate()) {

                        return
                    }


                if (!this.editando) {
                    let set = { name:this.antecedente,  description:this.description }
                    this.dataArray.push(set)
                    this.antecedente = ''
                    this.description = ''
                    this.referenciaIndex=null
                    this.editando = false
                    this.$refs.form.resetValidation()
                }else{/// si va a editar
                    for (var i=0; i <= this.dataArray.length; i++) {
                        if (i === this.referenciaIndex) {
                            this.dataArray[i].name=this.antecedente
                            this.dataArray[i].description=this.description
                        }
                    }
                    this.antecedente = ''
                    this.description = ''
                    this.editando = false
                    this.referenciaIndex=null
                }

            },

            clear(){
                this.antecedente = ''
                this.description = ''
                this.editando = false
                this.referenciaIndex=null
                this.$refs.form.resetValidation()
            },

            eliminarItem(index){
                this.dataArray.splice(index, 1);
                this.antecedente = ''
                this.description = ''
                this.referenciaIndex=null
                this.editando = false
                this.dialog = false
            },
		}
	}

</script>