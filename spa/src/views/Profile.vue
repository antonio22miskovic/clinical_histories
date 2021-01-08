<template>
    <v-container>
            <v-row justify="center">
      <v-col
        cols="12"
        md="8"
      >
        <v-card
            elevation="24"
            outlined
            shaped
        >
            <v-card-title>
                Perfil
            </v-card-title>
         <v-form ref="up">
            <v-container class="py-0">
              <v-row>
                <v-col
                  cols="12"
                  md="6"
                >
                  <v-text-field
                    class="purple-input"
                    prepend-icon="mdi-account"
                    label="Nombre"
                    :rules="[rules.name]"
                    v-model="form.name"
                  />
                </v-col>

                <v-col
                  cols="12"
                  md="6"
                >
                  <v-text-field
                    label="Email"
                    prepend-icon="mdi-email"
                    class="purple-input"
                    v-model="form.email"
                    :rules="[rules.email, rules.emailRequired]"
                  />
                </v-col>
                <v-col
                  cols="12"
                  md="6"
                >
                    <v-select
                        :items="listSpecialists"
                        item-value="id"
                        item-text="name"
                        prepend-icon="mdi-clipboard-account-outline"
                        label="Especialidad"
                        v-model="form.specialist"
                        :rules="[rules.specialist]"
                    ></v-select>
                </v-col>

                <v-col
                    cols="12"
                    md="6"
                >
                    <v-text-field
                        accept="image/png, image/jpeg, image/bmp"
                        placeholder="imagen de perfil"
                        prepend-icon="mdi-camera"
                        label="Avatar"
                        v-model="nameImage"
                        @click='pickFile'
                    ></v-text-field>
                    <input
                    type="file"
                    style="display: none"
                    ref="image"
                    :rules="[rules.file]"
                    accept="image/*"
                    @change="obtenerimagen"
                    >
                </v-col>

                <v-col
                  cols="12"
                  md="6"
                >
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

                <v-col
                  cols="12"
                  md="6"
                >
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
                <v-col
                  cols="12"
                  class="text-right"
                >
                  <v-btn
                    color="success"
                    @click="update"
                  >
                    Actualizar  <v-icon>mdi-account-convert</v-icon>
                  </v-btn>
                </v-col>
              </v-row>
            </v-container>
          </v-form>
        </v-card>
      </v-col>

      <v-col
        cols="12"
        md="4"
      >
        <v-card
          class="v-card-profile text-center"
            elevation="10"
            outlined
            shaped
        >
        <v-avatar
            size="200">
            <v-img
              :src="'/img/avatars/'+ userAuth.avatar"
            ></v-img>
        </v-avatar>
          <v-card-text class="text-center">
            <h6 class="display-1 mb-1 grey--text">
              {{specialistAuth.name}}
            </h6>

            <h4 class="display-2 font-weight-light mb-3 black--text">
              {{userAuth.name}}
            </h4>

            <p class="font-weight-light grey--text">
                {{specialistAuth.description}}
            </p>
          </v-card-text>
        </v-card>
      </v-col>
    </v-row>
    </v-container>
</template>
<script>
    import { mapGetters, mapActions } from 'vuex'
    export default{
        name:'Profile',
        created(){
            this.form.name       = this.userAuth.name
            this.nameImage       = this.userAuth.avatar
            this.form.email      = this.userAuth.email
            this.form.specialist = this.specialistAuth

            if (this.listSpecialists.length === 0) {
                this.getSpecialist()
            }

        },
        data: () => ({

            rules: {
                confPassword: value => !!value || 'Por Favor confirme su Contraseña',
                password: value => !!value || 'Debe introducir una Contraseña',
                specialist: value => !!value || 'Debe definir su especialidad',
                name: value => !!value || 'Debe introducir nombre y apellido',
                emailRequired: value => !!value || 'Debe introducir un email',
                email: value => {
                    const pattern = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
                    return pattern.test(value) || 'E-mail Invalido.'
                },
                file: value => !value || value.size < 2000000 || 'Su imagen de perfil no pude ser mayor 2 MB!',
            },

            hidePassword: true,
            form:{
                name: '',
                email:'' ,
                avatar:'' ,
                password:'' ,
                specialist:null
            },
            nameImage:'',
            confirm_password:'',
        }),
        computed:{
            ...mapGetters({
                userAuth:'userAuth',
                specialistAuth:'specialistAuth',
                listSpecialists: 'listSpecialists'
            }),
        },
        methods:{

            ...mapActions({
                getSpecialist: 'getSpecialist',
                update_u:'update_u',
                SetUser:'SetUser',
                specialistSet:'specialistSet',
                setOverlay:'setOverlay'
            }),

///////////////////CARGA DE IMAGEN /////////////////////////
            pickFile(){
                this.$refs.image.click()
            },
            obtenerimagen(e){
                let file = e.target.files[0]
                this.form.avatar = file
                this.nameImage = file.name
                this.cargarimagen(file)
            },
            cargarimagen(file){
                let reader = new FileReader()
                reader.onload = (e) =>{
                    this.form.avatar = e.target.result
                }
                reader.readAsDataURL(file)
            },
////////////////// FIN DE CARGA DE IMAGEN ///////////////////////////

            update(){
                if (!this.$refs.up.validate()) {
                    return
                }
                this.setOverlay(true)
                if (this.form.avatar === '') {
                    this.form.avatar = this.nameImage
                }
                this.form.specialist = this.form.specialist.id
                this.update_u([this.userAuth.id,this.form]).then(res => {
                    this.setOverlay(false)
                    this.SetUser(res)
                    this.specialistSet()
                    this.$swal({
                                icon: 'success',
                                title: '¡Usuario actualizado con exito!',
                                text:'exito',
                                confirmButtonColor: '#3085d6',
                            })
                }).catch(err => {
                return console.log(err)
                })

            }

        }
    }
</script>