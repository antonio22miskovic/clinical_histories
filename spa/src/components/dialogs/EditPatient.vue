<template>
    <div>
        <v-row justify="center">
            <v-dialog
              v-model="dialogOn"
              persistent
              max-width="600px"
            >
                <v-card>
                    <v-container>
                        <v-card-title>
                           Actualizar Datos del Paciente
                        </v-card-title>
                        <v-card-text>
                            <v-form>
                                <v-row>
                                    <v-col>
                                        <v-text-field
                                            label="Nombres"
                                            v-model="form.first_name"
                                        ></v-text-field>
                                    </v-col>
                                    <v-col>
                                        <v-text-field
                                            label="Apellidos"
                                            v-model="form.last_name"
                                        ></v-text-field>
                                    </v-col>
                                </v-row>
                                <v-row>
                                    <v-col>
                                        <v-select
                                            :items="generos"
                                            v-model="form.sex"
                                            label="Genero"
                                        ></v-select>
                                    </v-col>
                                    <v-col>
                                        <v-text-field
                                            label="Cedula"
                                            v-model="form.ci"
                                        ></v-text-field>
                                    </v-col>
                                </v-row>
                                <v-row>
                                    <v-col>
                                        <v-text-field
                                            label="Telefono"
                                            v-model="form.phone"
                                        ></v-text-field>
                                    </v-col>
                                    <v-col>
                                        <v-select
                                            :items="civil_status"
                                            v-model="form.civil_status"
                                            label="Estado Civil"
                                        ></v-select>
                                    </v-col>
                                </v-row>
                                <v-row>
                                    <v-col>
                                        <v-text-field
                                            label="Peso Kg"
                                            v-model="form.weight"
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
                                                        label="Birthday date"
                                                        prepend-icon="mdi-calendar"
                                                        readonly
                                                        v-bind="attrs"
                                                        v-on="on"
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
                                    >
                                        Actualizar
                                    </v-btn>
                                    <v-btn
                                        elevation="3"
                                        @click="dialogOn=false"
                                    >
                                        Cerrar
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
    import { mapGetters, mapActions } from 'vuex'
    export default{
        name:'EditPatient',
        data:()=>({
            patient_shift:'',
            generos:['femenino', 'masculino'],
            civil_status:['casado','soltero'],
            date: null,
            menu: false,
            form:{
                sex:'',
                first_name:'',
                last_name:'',
                phone:'',
                ci:'',
                civil_status:'',
                birthdate:'',
                weight: 0.00
            }
        }),
        watch: {
            menu (val) {
                val && setTimeout(() => (this.$refs.picker.activePicker = 'YEAR'))
            },
        },
        methods:{

            ...mapActions({
                update_p:'update_p',

            }),
            save (date) {
                this.$refs.menu.save(date)
            },
            actualizar(){

                console.log(this.form)
                this.update_p({value:this.form, id:this.getPatient.id}).then(res => {
                    console.log(res)
                })
                
            }

        },
        computed:{
            ...mapGetters({
                getPatient: 'getPatient',
                getdialog: 'getdialog'
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