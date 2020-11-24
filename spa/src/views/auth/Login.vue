<template>
	<v-app id="login">
	    <v-main>
	      	<v-container fluid fill-height>
	        	<v-layout align-center pa-15 justify->
	          		<v-flex xs12 sm8 md4 lg4>
	            		<v-card class="elevation-70 pa-3" width="400" shaped outlined>
	              			<div class="layout column align-center">
	                			<img src="/logos/tulio1.jpg" alt="Vue Material Admin" width="180" height="180">
	                			<h1 class="primary--text text-center"> DR. TULIO PINEDA </h1>
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
								          		<v-btn block color="primary" @click="login">Login</v-btn>
								          		<br>
								   			</v-card-actions>
								        </v-form>
								    </v-card-text>
								    <div class="text-center">
								      	<v-btn text color="secondary"> Forgot your Password? </v-btn>
								    </div>
								</div>
	              			</v-container>
	                		<div class="text-center">
	                  			<strong> Centro Diagnostico Integral Tulio Pineda-2020 </strong>
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
		// try {
		// const resp = await this.$store.dispatch('login', this.form)
		// this.setOverlay(false)
		// this.$router.push({ name: 'home' })
		// } catch (error) {
		// this.setOverlay(false)
		// 	this.$swal({
		//    icon: 'error',
		//    title: '¡Disculpe!',
		//    text: error,
		//    confirmButtonColor: '#3085d6',
		//  })
		// }
    },
    ...mapActions({
      setOverlay: 'setOverlay'
    })
  },
}
</script>
<style scoped lang="css">
	#login {
	    height: 100%;
	    width: 100%;
	    position:absolute;
	    top: 0;
	    left: 0;
	    content: "";
	    z-index: 0;
	    background-image:url(/logos/login3.jpg);
	    display:cover;
	}
</style>
