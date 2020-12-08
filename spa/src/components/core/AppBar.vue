<template>
    <div>
        <v-app-bar
            color="blue accent-3"
            app
            dense
        >
            <v-app-bar-nav-icon @click="Drawer_on()"></v-app-bar-nav-icon>

            <v-toolbar-title class="font-italic"> <v-icon>mdi-hospital-box</v-icon> DR. TULIO PINEDA</v-toolbar-title>

            <v-spacer></v-spacer>

            <v-btn icon>
                <v-icon>mdi-bell-ring-outline</v-icon>
            </v-btn>
            <v-menu
                left
                bottom
            >
                <template v-slot:activator="{ on, attrs }">
                    <v-btn
                        icon
                        v-bind="attrs"
                        v-on="on"
                    >
                        <v-icon>mdi-dots-vertical</v-icon>
                    </v-btn>
                </template>

                <v-list>
                    <v-list-item>
                        <v-list-item-title> <v-icon>mdi-account</v-icon> perfil</v-list-item-title>
                    </v-list-item>
                    <v-list-item>
                        <v-list-item-title @click="logout_on"> <v-icon>mdi-power-standby</v-icon> cerrar sesion</v-list-item-title>
                    </v-list-item>
                </v-list>
            </v-menu>
        </v-app-bar>
    </div>
</template>
<script>
   import { mapGetters, mapActions } from 'vuex'
  export default {
    name: 'CoreBar',

    methods:{

        ...mapActions({
            drawerOn: 'setDrawer',
            logout: 'logout'
        }),

        async logout_on(){
            try {
                const res = await this.logout()
                this.$router.push({name:'auth-login'})
            } catch(e) {
                    console.log(e)
            }




        },

        Drawer_on(){

            if (this.drawer === false) {
                this.drawerOn(true)
            }else{
                this.drawerOn(false)
            }

        }

    },
    computed: {

        ...mapGetters({
            drawer: 'drawer',
        }),
    },

  }
</script>