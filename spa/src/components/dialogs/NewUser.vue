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
                           Añadir Nuevo Usuario
                        </v-card-title>
                        <v-card-text>
                            <v-form ref="newuser">
                                <v-row> 
                                    <v-col>
                                        <v-text-field
                                            prepend-icon="mdi-account"
                                            label="Name"
                                            v-model="form.name"
                                            :rules="[rules.name, rules.FormatString]"
                                        ></v-text-field>
                                    </v-col>
                                    <v-col>
                                        <v-text-field
                                            label="Email"
                                            prepend-icon="mdi-email"
                                            class="purple-input"
                                            v-model="form.email"
                                            :rules="[rules.email, rules.emailRequired]"
                                          />
                                    </v-col>
                                </v-row>
                                <v-row>
                                    <v-col>
                                           <v-select
                                                :items="listSpecialists"
                                                item-value="id"
                                                item-text="name"
                                                prepend-icon="mdi-clipboard-account-outline"
                                                label="Especialidad"
                                                v-model="form.specialist_id"
                                                :rules="[rules.specialist]"
                                            ></v-select>
                                    </v-col>
                                    <v-col>
                                         <v-text-field
                                            :type="hidePassword ? 'password' : 'text'"
                                            :append-icon="hidePassword ? 'mdi-eye' : 'mdi-eye-off'"
                                            name="password"
                                            label="New Contraseña"
                                            @click:append="hidePassword = !hidePassword"
                                            :rules="[rules.password]"
                                            v-model="form.password"
                                        />
                                    </v-col>
                                </v-row>
                                <v-row>
                                    <v-col>
                                        <v-text-field
                                            type="password"
                                            append-icon="mdi-eye-off"
                                            name="password"
                                            label="Confirmar Contraseña"
                                            :rules="[(form.password === confirm_password) || 'contraseña no coinciden',
                                            rules.confPassword
                                            ]"
                                            v-model="confirm_password"
                                        />
                                    </v-col>
                                </v-row>
                                <v-card-actions>
                                    <v-btn
                                        elevation="3"
                                        @click="adduser"
                                        color="success"
                                    >
                                        Añadir
                                         <v-icon>mdi-account-plus</v-icon>
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

        name:'NewUser',

        mounted(){
            
            this.getSpecialist()
        },

        data: () => ({
            confirm_password:'',
            form:{
                name:'',
                email:'',
                password:'',
                avatar:'defect.jpg',
                rol_id: 2,
                specialist_id:null,
            },
            hidePassword: true,
            rules: {
                confPassword: value => !!value || 'Por Favor confirme su Contraseña',
                FormatString: value => {
                    let letters = /^[A-Za-z]+$/
                    return letters.test(value) || 'formato invalido'
                },
                password: value => !!value || 'Debe introducir una Contraseña',
                specialist: value => !!value || 'Debe definir su especialidad',
                name: value => !!value || 'Debe introducir el nombre para el usuario',
                emailRequired: value => !!value || 'Debe introducir un email',
                email: value => {
                    const pattern = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
                    return pattern.test(value) || 'E-mail Invalido.'
                },
            },

        }),

        methods:{

            ...mapActions({
                dialogForm:'Ondialog',
                getSpecialist:'getSpecialist',
                store_u:'store_u',
                all_u:'all_u',
                setOverlay:'setOverlay'
            }),

            async adduser () {
                if (!this.$refs.newuser.validate()) {
                    return
                }
                this.setOverlay(true)
                this.store_u(this.form).then(res => {
                    this.dialogOn = false
                    this.setOverlay(false)
                    this.$swal({
                        icon: 'success',
                        title: '¡Nuevo usuario creado con exito!',
                        text:'exito',
                        confirmButtonColor: '#3085d6',
                    })
                    this.all_u(1)

                })
            },

            // async montar () {
            //     this.form.name = this.getUser.name
            //     this.form.email = this.getUser.email
            //     this.form.specialist_id = this.getUser.specialist_id
            // },

        },

        computed:{

            ...mapGetters({

                listSpecialists: 'listSpecialists',
                getdialog: 'getdialog',

            }),

            dialogOn:{
                set(value){
                    return this.dialogForm(value)
                },
                get(){
                    return this.getdialog
                }
            }

        }

    }

</script>