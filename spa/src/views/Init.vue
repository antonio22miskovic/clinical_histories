<template>
    <div>
        <v-container mt-15 >
            <v-row no-gutters>
                <v-col md7 xs12>
                    <template>
                        <v-carousel
                            style="max-width:550px; min-width:550px;"
                            cycle
                            hide-delimiter-background
                            show-arrows-on-hover
                        >
                            <v-carousel-item
                                v-for="(item, i) in items"
                                :key="i"
                                height="50%"
                                :src="item.src"
                            >
                            </v-carousel-item>
                        </v-carousel>
                    </template>
                </v-col>
                <v-col md5 xs12>
                    <div class="layout column align-center">
                        <img src="/logos/bicentenario.jpg" alt="DR. tulio pineda" width="100" height="100">
                        <h1 class=" text-center font-italic"> DR. TULIO PINEDA </h1>
                    </div>
                    <transition name="fade"> 
                        <router-view/>
                    </transition>
                    <div class="text-center font-italic">
                        <strong> Ministerio del Poder Popular para la Salud</strong>
                    </div>
                </v-col>
            </v-row>
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
    ...mapActions({
        setOverlay: 'setOverlay',
        setfondo: 'setfondo'
    })
  },
}
</script>
<style type="text/css">
    .fade-enter-active, .fade-leave-active {
         transition-property: opacity;
         transition-duration: .80s;
    }

    .fade-enter-active {
         transition-delay: .80s;
    }

    .fade-enter, .fade-leave-active {
         opacity: 0
    }
</style>
