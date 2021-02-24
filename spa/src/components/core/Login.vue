<template>
    <div>
        <v-container>

            <v-container>
                <div>
                    <v-form ref="login">

                        <v-text-field
                            append-icon="mdi-email"
                            name="login"
                            label="E-mail"
                            type="text"
                            v-model="form.email"
                            :rules="[rulesUser.required]"
                        />

                        <v-text-field
                            :type="hidePassword ? 'password' : 'text'"
                            :append-icon="hidePassword ? 'mdi-eye' : 'mdi-eye-off'"
                            name="password"
                            label="Contraseña"
                            id="password"
                            :rules="[rulesPassword.required]"
                            v-model="form.password"
                            @click:append="hidePassword = !hidePassword"
                        />

                        <v-card-actions>
                            <v-btn block color="blue darken-2" @click="login">Login</v-btn>
                            <br>
                        </v-card-actions>
                    </v-form>
                    <div class="text-center font-italic">
                        <v-btn  text color="blue darken-2" :to="{name:'witing_list'}">solicitar <v-icon>mdi-send</v-icon></v-btn>
                    </div>
                    <!-- <div class="text-center">
                        <v-btn text color="secondary"> Forgot your Password <v-icon>mdi-key-change</v-icon> </v-btn>
                    </div> -->
                    <br>
                </div>
            </v-container>
        </v-container>
    </div>
</template>
<script>
import { mapActions } from 'vuex'
import {setAuthorization} from '@/conf/axiosHeader'
import axios from 'axios'
export default {
  name: 'Login',
  data () {
    return {
    	form: {
	        email: '',
	        password: ''
	    },
	    rulesUser: {
        	required: value => !!value || 'Debe introducir un E-mail.'
      	},
      	rulesPassword: {
        	required: value => !!value || 'Por favor Introduzca su Contrseña'
      	},
      	hidePassword: true,
      	error: false,
        items: [
            {
                src:'/logos/1.jpg',
            },
            {
                src:'/logos/2.jpg',
            },
            {
                src:'/logos/3.jpg',
            },
            {
                src:'/logos/4.jpg',
            },
            {
                src:'/logos/5.png',
            },
        ],
    }
  },
  methods: {
    ...mapActions({
        setOverlay: 'setOverlay',
        setfondo: 'setfondo'
    }),
  	async login () {
  		if (!this.$refs.login.validate()) {
  			return
  		}
  		this.setOverlay(true)
  		try {
  			const resp = await this.$store.dispatch('login', this.form)
  			this.setOverlay(false)
  			this.$router.push({ name: 'home' })
            setAuthorization(resp.access_token) // añadir el token por defecto
  		} catch (error) {
  			this.setOverlay(false)
  			this.$swal({
  				icon: 'error',
  				title: '¡Credenciales no Validas!',
  				text: error,
  				confirmButtonColor: '#3085d6',
  			})
  		}
  	},
  },
}
</script>
<style type="text/css">
</style>
