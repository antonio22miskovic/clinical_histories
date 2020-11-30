<template>
	<v-app>
	    <v-main>
	      	<v-container fluid fill-height>
	        	<v-layout align-center pa-15 justify-center>
	          		<v-flex xs12 sm8 md4 lg4>
	            		<v-card class="elevation-70 pa-3" width="400" shaped outlined>
	              			<div class="layout column align-center">
	                			<img src="/logos/bicentenario.jpg" alt="DR. tulio pineda" width="180" height="180">
	                			<h1 class=" text-center font-italic"> DR. TULIO PINEDA </h1>
	              			</div>
	              			<v-container style="min-height:320px">
							    <div>
								    <v-card-text>
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
								    </v-card-text>
								    <div class="text-center">
								      	<v-btn text color="secondary"> Forgot your Password? </v-btn>
								    </div>
								</div>
	              			</v-container>
	                		<div class="text-center font-italic">
	                  			<strong> Ministerio del Poder Popular para la Salud</strong>
	                		</div>
	            		</v-card>
	          		</v-flex>
	        	</v-layout>
	      	</v-container>
	    </v-main>
	</v-app>
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
        	required: value => !!value || 'E-mail Required.'
      	},
      	rulesPassword: {
        	required: value => !!value || 'Password Required.'
      	},
      	hidePassword: true,
      	error: false,
    }
  },
  methods: {
  	async login () {
  		this.setOverlay(true)
  		try {
  			const resp = await this.$store.dispatch('login', this.form)
  			this.setOverlay(false)
  			this.$router.push({ name: 'home' })
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
      	setOverlay: 'setOverlay'
    })
  },
}
</script>
<style scoped lang="css">
	#login {
	    background-image:url(/logos/bicentenario.jpg);
	}
</style>
