<template>
    <v-container>
        <v-card>
            <v-container>
                <v-card-title>
                    Paciente en turno: {{patient_shift.cedula}}
                </v-card-title>
                <v-list-item-subtitle class="text-center">
                    debe registrar los datos de paciente
                </v-list-item-subtitle>
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
                                @click="registrar"
                            >
                                Registrar
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
                show: 'show_wl'
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
                    this.form.birthdate = this.date
                    this.store_p(this.form).then(res => {
                        this.$swal({
                            icon: 'success',
                            title: '¡Paciente registrado con exito!',
                            text:'exito',
                            confirmButtonColor: '#3085d6',
                         })
                        console.log('la res',res)
                        this.$router.push({name:'consultaPatient',params:{id:res.data.id}})
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