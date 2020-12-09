<template>
	<v-container >
        <v-row  no-gutters>
            <v-col cols="6">
                <template>
					<v-carousel
						cycle
						hide-delimiter-background
						show-arrows-on-hover
					>
						<v-carousel-item
							v-for="(item, i) in items"
							:key="i"
							:src="item.src"
						>
						</v-carousel-item>
					</v-carousel>
				</template>
            </v-col>
            <v-col cols="6">
                <v-container>
                            <div class="layout column align-center">
                                <img src="/logos/bicentenario.jpg" alt="DR. tulio pineda" width="100" height="100">
                                <h1 class=" text-center font-italic"> DR. TULIO PINEDA </h1>
                            </div>
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
                                                label="Password"
                                                id="password"
                                                :rules="[rulesPassword.required]"
                                                v-model="form.password"
                                                @click:append="hidePassword = !hidePassword"
                                            />

                                            <v-card-actions>
                                                <v-btn block color="deep-orange darken-2" @click="login">Login</v-btn>
                                                <br>
                                            </v-card-actions>
                                        </v-form>
                                    <div class="text-center">
                                        <v-btn text color="secondary"> Forgot your Password? </v-btn>
                                    </div>
                                </div>
                            </v-container>
                            <div class="text-center font-italic">
                                <strong> Ministerio del Poder Popular para la Salud</strong>
                            </div>
                </v-container>
            </v-col>
        </v-row>
	</v-container>
</template>
<script>
import { mapActions } from 'vuex'
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
        	required: value => !!value || 'Debe introducir Password'
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
  	async login () {
  		if (!this.$refs.login.validate()) {
  			return
  		}
  		this.setOverlay(true)
  		try {
  			const resp = await this.$store.dispatch('login', this.form)
  			this.setOverlay(false)
  			this.$router.push({ name: 'home' })
  			this.setfondo('background-color:#FFFFFF')//cambio el fondo a blanco
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
    ...mapActions({
      	setOverlay: 'setOverlay',
      	setfondo: 'setfondo'
    })
  },
}
</script>
<style type="text/css">
    #fondo:{
        height: 100%;
        width: 100%;
        position: absolute;
        top: 0;
        left: 0;
        content: "";
        z-index: 0;
        background-image:url(/logos/imagen1.jpg);
    }
</style>
