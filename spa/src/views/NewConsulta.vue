<template>
    <v-container>
        <v-card
            outlined
            shaped
            elevation="24"
        >
            <v-container>
                <v-card-title>
                    Paciente en turno: {{parseInt(this.form.ci).toLocaleString('es-ES')}}
                </v-card-title>
                <v-list-item-subtitle class="text-center">
                    debe registrar los datos del paciente
                </v-list-item-subtitle>
                <v-card-text>
                    <v-form ref="reg">
                        <v-row>
                            <v-col>
                                <v-text-field
                                    label="Nombre"
                                    v-model="form.first_name"
                                    :rules="[rules.first_name, rules.FormatString]"
                                ></v-text-field>
                            </v-col>
                            <v-col>
                                <v-text-field
                                    label="Apellido"
                                    v-model="form.last_name"
                                    :rules="[rules.last_name, rules.FormatString]"
                                ></v-text-field>
                            </v-col>
                        </v-row>
                        <v-row>
                            <v-col>
                                <v-select
                                    :items="generos"
                                    v-model="form.sex"
                                    label="Género"
                                    :rules="[rules.sex]"
                                ></v-select>
                            </v-col>
                            <v-col>
                                <v-text-field
                                    label="Cédula"
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
                                    label="Teléfono"
                                    v-model="form.phone"
                                    hint="Formato permitido: 0000-000-0000"
                                    :rules="[rules.FormatPhone]"
                                ></v-text-field>
                            </v-col>
                            <v-col>
                                <v-select
                                    :items="civil_status"
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
                                                label="Fecha de Nacimiento"
                                                prepend-icon="mdi-calendar"
                                                readonly
                                                v-bind="attrs"
                                                :rules="[rules.date]"
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
                                @click="registrar"
                                color="success"
                            >
                                Registrar
                                <v-icon>
                                    mdi-account-plus
                                </v-icon>
                            </v-btn>
                        </v-card-actions>
                    </v-form>
                </v-card-text>
            </v-container>
        </v-card>
    </v-container>
</template>
<script>
    import { mapGetters, mapActions } from 'vuex'
    export default{

        name:'NewConsulta',

        data:()=>({
            patient_shift:'',
            generos:['Femenina', 'Masculino'],
            civil_status:['Casado','Soltero',],
            date: null,
            menu: false,
            errorCi:false,
            mensajeErrorCI:null,
            form:{
                sex:'',
                first_name:'',
                last_name:'',
                phone:'',
                ci:'',
                civil_status:'',
                birthdate:'',
                weight: 0.00
            },
            rules: {
                sex: value => !!value || 'Introduzca el género',
                first_name: value => !!value || 'Por favor introduzca el nombre',
                last_name: value => !!value || 'Por favor introduzca el apellido',
                ci: value => !!value || 'Debe introducir el numero de cedula',
                FormatString: value => {
                    let letters = /^[A-Za-z]+$/
                    return letters.test(value) || 'formato inválido'
                },
                FormatNumber: value => {
                    let letters = /^[0-9]+$/
                    return letters.test(value) || 'formato inválido'
                },
                FormatCI: value => {
                    let letters = /^\d*(\.\d{8})?\d{0,8}$/
                    return letters.test(value) || 'formato inválido'
                },
                FormatPhone: value => {
                    let letters = /^(\([0-9]{4}\)\s*|[0-9]{4}\-)[0-9]{3}-[0-9]{4}$/
                    return letters.test(value) || 'formato inválido'
                },
                FormatFloat: value => {
                    let letters = /^\d*(\.\d{1})?\d{0,1}$/
                    return letters.test(value) || 'formato inválido'
                },
                civil_status: value => !!value || 'Debe introducir el status civil',
                date: value => !!value || 'Debe introducir la fecha de nacimiento',
                weight: value => !!value || 'Debe introducir el peso actual del paciente',
            },
        }),

        mounted(){
            this.verificacion()
            this.form.ci = this.patient_shift.cedula
        },
        watch: {
            menu (val) {
                val && setTimeout(() => (this.$refs.picker.activePicker = 'YEAR'))
            },
        },

        methods:{

            ...mapActions({
                store_p:'store_p',
                show: 'show_wl',
                store_mc:'store_mc',
                store_mr:'store_mr',
                setvalue_mr:'setvalue_mr',
                setvalue_mc:'setvalue_mc',
                setOverlay:'setOverlay',
            }),

            save (date) {
                this.$refs.menu.save(date)
            },

            async verificacion(){// verificar que no este vacio los datos
                if (this.getDateItems.length < 1){
                    this.show(this.patient).then(res =>{
                        console.log(res)
                        this.form.ci = res.cedula
                    })
                }else{
                    let array = this.data.filter(item => item.id === this.patient)
                    for (var i = 0; i <= array.length; i++) {
                        this.patient_shift = array[0]
                    }
                }
            },

            async registrar(){
                try{
                    if (!this.$refs.reg.validate()) {
                        return
                    }
                    this.setOverlay(true)
                    this.form.birthdate = this.date
                    this.store_p(this.form).then(res => { // creacion del paciente
                         if (res.validation !== undefined) {
                            let validaciones = res.validation
                               this.mensajeErrorCI = validaciones.ci[0]
                               this.errorCi = true
                               return
                        }
                        this.setvalue_mr(res.data.medical_record)
                        // this.setvalue_mc(res.consulta)
                        this.setOverlay(false)
                        this.$swal({
                            icon: 'success',
                            title: '¡Paciente registrado con exito!',
                            text:'exito',
                            confirmButtonColor: '#3085d6',
                        })
                        // this.$router.push({name:'consultaPatient',params:{id:res.data.id,
                        //             consulta: res.consulta.id }})

                        this.$router.push({name:'antecedente',params:{id:res.data.id }
                         })
                    })

                }catch(e){
                    console.log(e)
                }
            }

        },

        computed:{

            ...mapGetters({
                getDateItems: 'getDateItems',
                getPatient:   'getPatient',
            }),
            data(){
                return this.getDateItems
            },
            patient(){
                return this.$route.params.id
            },
        }
    }

</script>