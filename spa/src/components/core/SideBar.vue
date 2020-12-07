<template>
    <v-app>
        <v-navigation-drawer
            floating
            v-model="drawer"
            color="deep-orange darken-1"
        >
            <v-list-item two-line>
                <v-list-item-avatar class="ml-4">
                    <img :src="'/img/avatars/' + userAuth.avatar">
                </v-list-item-avatar>

            <v-list-item-content>
                <v-list-item-title class="text-center"> Especialista </v-list-item-title>
                <v-list-item-subtitle class="text-center">{{userAuth.name}}</v-list-item-subtitle>
            </v-list-item-content>
          </v-list-item>

          <v-divider></v-divider>
            <v-list  nav dense>
                <v-list-item-group
                    v-model="group"
                    active-class="deep-red--text text--accent-4"
                >
                    <v-list-item>
                        <v-list-item-icon>
                            <v-icon>mdi-account-details</v-icon>
                        </v-list-item-icon>
                        <v-list-item-title :to="{name:'home'}">Sala de Espera</v-list-item-title>
                    </v-list-item>

                    <v-list-item>
                        <v-list-item-icon>
                            <v-icon>mdi-account-details</v-icon>
                        </v-list-item-icon>
                        <v-list-item-title>Historias clinicas</v-list-item-title>
                    </v-list-item>

                    <v-list-item>
                        <v-list-item-icon>
                            <v-icon>mdi-account</v-icon>
                        </v-list-item-icon>
                        <v-list-item-title>Pacientes</v-list-item-title>
                    </v-list-item>
            </v-list-item-group>
        </v-list>
    </v-navigation-drawer>

    </v-app>
</template>
<script>
 import { mapGetters, mapActions } from 'vuex'
    export default {

        name:'SideBar',

        mounted(){
            console.log('dentro del mmounted')
            console.log(this.userAuth)
        },

        data:() => ({
            group: null,
            mini: true,
        }),

        methods:{
            ...mapActions({
                setDrawer: 'setDrawer'
            }),
        },

        computed: {

        ...mapGetters({
            drawerOn: 'drawer',
            userAuth    : 'userAuth'
        }),

        drawer:{
            get(){
                return this.drawerOn
            },
            set(value){
                return this.setDrawer(value)
            }
        }

    }
}
</script>