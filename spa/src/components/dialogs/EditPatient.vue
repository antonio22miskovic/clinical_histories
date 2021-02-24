<template>
    <div>
        <v-row justify="center">
            <v-dialog
              v-model="dialogOn"
              persistent
              max-width="600px"
            >
                <v-card
                    outlined
                    shaped
                    elevation="24"
                >
                    <v-container>
                        <v-card-title>
                           Actualizar Datos del Paciente
                        </v-card-title>
                        <v-card-text>
                            <v-form ref="up">
                                <v-row>
                                    <v-col>
                                        <v-text-field
                                            label="Nombres"
                                            v-model="form.first_name"
                                            :rules="[rules.first_name, rules.FormatString]"
                                        ></v-text-field>
                                    </v-col>
                                    <v-col>
                                        <v-text-field
                                            label="Apellidos"
                                            v-model="form.last_name"
                                            :rules="[rules.last_name, rules.FormatString]"
                                        ></v-text-field>
                                    </v-col>
                                </v-row>
                                <v-row>
                                    <v-col>
                                        <v-select
                                            :items="['femenino', 'masculino']"
                                            v-model="form.sex"
                                            label="Genero"
                                            :rules="[rules.sex]"
                                        ></v-select>
                                    </v-col>
                                    <v-col>
                                        <v-text-field
                                            label="Cedula"
                                            v-model="form.ci"
                                            :error="errorCi"
                                            :error-messages="errorCi ? mensajeErrorCI : ''"
                                            :rules="[rules.ci, rules.FormatCI]"
                                        ></v-text-field>
                                    </v-col>
                                </v-row>
                                <v-row>
                                    <v-col>
                                        <v-text-field
                                            label="Telefono"
                                            hint="Formato permitido: 0000-000-0000"
                                            v-model="form.phone"
                                            :rules="[rules.FormatPhone]"
                                        ></v-text-field>
                                    </v-col>
                                    <v-col>
                                        <v-select
                                            :items="['casado','soltero']"
                                            v-model="form.civil_status"
                                            label="Estado Civil"
                                            :rules="[rules.civil_status]"
                                        ></v-select>
                                    </v-col>
                                </v-row>
                                <v-row>
                                    <v-col>
                                        <v-text-field
                                            label="Peso Kg"
                                            v-model="form.weight"
                                            :rules="[rules.weight, rules.FormatFloat]"
                                        ></v-text-field>
                                    </v-col>
                                    <v-col>
                                        <template>
                                            <v-menu
                                                ref="menu"
                                                v-model="menu"
                                                :close-on-content-click="false"
                                                transition="scale-transition"
                                                offset-y
                                                min-width="290px"
                                            >
                                                <template v-slot:activator="{ on, attrs }">
                                                    <v-text-field
                                                        v-model="date"
                                                        label="Fecha Nacimiento"
                                                        prepend-icon="mdi-calendar"
                                                        readonly
                                                        v-bind="attrs"
                                                        v-on="on"
                                                        :rules="[rules.date]"
                                                    ></v-text-field>
                                                </template>
                                                <v-date-picker
                                                    ref="picker"
                                                    v-model="date"
                                                    :max="new Date().toISOString().substr(0, 10)"
                                                    min="1950-01-01"
                                                    @change="save"
                                                ></v-date-picker>
                                            </v-menu>
                                        </template>
                                    </v-col>
                                </v-row>
                                <v-card-actions>
                                    <v-btn
                                        elevation="3"
                                        @click="actualizar"
                                        color="success"
                                    >
                                        Actualizar
                                         <v-icon>mdi-account-convert</v-icon>
                                    </v-btn>
                                    <v-btn
                                        elevation="3"
                                        @click="dialogOn=false"
                                        color="error"
                                    >
                                        Cerrar
                                        <v-icon>mdi-close-octagon-outline</v-icon>
                                    </v-btn>
                                </v-card-actions>
                            </v-form>
                        </v-card-text>
                    </v-container>
                </v-card>
            </v-dialog>
        </v-row>
    </div>
</template>
<script>
    import Swal from 'sweetalert2'
    import { mapGetters, mapActions } from 'vuex'
    export default{
        name:'EditPatient',
        mounted(){
            this.montar()
        },
        data:()=>({
            patient_shift:'',
            date: null,
            menu: false,
            errorCi:false,
            form:{
                sex:'',
                first_name:'',
                last_name:'',
                phone:'',
                ci:'',
                civil_status:'',
                birthdate:'',
                weight: 0.00,
                mensajeErrorCI:null
            },
            rules: {
                sex: value => !!value || 'Introduzca el genero',
                first_name: value => !!value || 'Por Favor introduzca el nombre',
                last_name: value => !!value || 'Por Favor introduzca el apellido',
                ci: value => !!value || 'Debe introducir el numero de cedula',
                FormatString: value => {
                    let letters = /^[A-Za-z]+$/
                    return letters.test(value) || 'formato invalido'
                },
                FormatNumber: value => {
                    let letters = /^[0-9]+$/
                    return letters.test(value) || 'formato invalido'
                },
                FormatCI: value => {
                    let letters = /^\d*(\.\d{8})?\d{0,8}$/
                    return letters.test(value) || 'formato invalido'
                },
                FormatPhone: value => {
                    let letters = /^(\([0-9]{4}\)\s*|[0-9]{4}\-)[0-9]{3}-[0-9]{4}$/
                    return letters.test(value) || 'formato invalido'
                },
                FormatFloat: value => {
                    let letters = /^\d*(\.\d{1})?\d{0,1}$/
                    return letters.test(value) || 'formato invalido'
                },
                civil_status: value => !!value || 'Debe introducir el status civil',
                date: value => !!value || 'Debe introducir la fecha de nacimiento',
                weight: value => !!value || 'Debe introducir el peso actual del paciente',
            },
        }),
        watch: {
            menu (val) {
                val && setTimeout(() => (this.$refs.picker.activePicker = 'YEAR'))
            },
        },
        methods:{

            ...mapActions({
                update_p:'update_p',
                dialogForm:'Ondialog',
                all_p:'all_p',
                setOverlay:'setOverlay'

            }),
            save (date) {
                this.$refs.menu.save(date)
            },
            montar(){
                this.form.sex = this.getPatient.sex
                this.form.first_name = this.getPatient.first_name
                this.form.last_name = this.getPatient.last_name
                this.form.phone = this.getPatient.phone
                this.form.ci = this.getPatient.ci
                this.form.civil_status = this.getPatient.civil_status
                this.form.weight = this.getPatient.weight
                this.date = this.getPatient.birthdate
            },
            actualizar(){
                this.setOverlay(true)
                this.errorCi = false
                this.form.birthdate = this.date
                if (!this.$refs.up.validate()) {
                    return
                }
                let data=[this.getPatient.id,this.form]
                if ( // validar que los campos sean actualizados

                    this.form.sex === this.getPatient.sex &&
                    this.form.first_name === this.getPatient.first_name &&
                    this.form.last_name === this.getPatient.last_name &&
                    this.form.phone === this.getPatient.phone &&
                    this.form.ci === this.getPatient.ci &&
                    this.form.civil_status === this.getPatient.civil_status &&
                    this.form.weight === this.getPatient.weight &&
                    this.date === this.getPatient.birthdate

                ){
                    this.$swal({
                        icon: 'error',
                        title: '¡UPss no a modificado ningun dato por favor!',
                        text:'exito',
                        confirmButtonColor: '#3085d6',
                    })
                    return
                }
                Swal.fire({
                    title: 'Seguro de Editar Los Datos de Paciente?',
                    showDenyButton: true,
                    showCancelButton: true,
                    confirmButtonText: `Actualizar`,
                    denyButtonText: `No`,
                    icon: 'warning',
                }).then((result) => {
                if (result.isConfirmed) {
                    this.update_p(data).then(res => {
                         this.setOverlay(false)
                        if (res.validation !== undefined) {
                            let validaciones = res.validation
                               this.mensajeErrorCI = validaciones.ci[0]
                               this.errorCi = true
                        }else{
                            this.all_p(this.pageUpdate_p)
                             this.setOverlay(false)
                                Swal.fire('Datos Actualizados', '', 'success')
                            this.dialogOn = false
                        }
                    })

                } else if (result.isDenied) {
                     Swal.fire('Por favor Tenga Cuidado', '', 'info')
                     this.dialogOn = false
                }
                })

            }

        },
        computed:{
            ...mapGetters({
                getPatient: 'Getpatient',
                getdialog: 'getdialog',
                pageUpdate_p:'pageUpdate_p'
            }),
            dialogOn:{
                set(value){
                    return this.dialogForm(value)
                },
                get(){
                    return this.getdialog
                }
            }
        },

    }
</script>