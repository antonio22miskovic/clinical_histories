<template>
    <v-app>
        <v-navigation-drawer
            app
            v-model="drawer"
            color="blue darken-2"
        >
            <v-list-item two-line>
                <v-list-item-avatar class="ml-4">
                    <img :src="'/img/avatars/' + userAuth.avatar">
                </v-list-item-avatar>

            <v-list-item-content>
                <v-list-item-title  v-if="isAdmin" class="text-center"> Administrador</v-list-item-title>
                <v-list-item-title v-else class="text-center"> {{specialistAuth.name}} </v-list-item-title>
                <v-list-item-subtitle class="text-center">{{userAuth.name}}</v-list-item-subtitle>
            </v-list-item-content>
          </v-list-item>

          <v-divider></v-divider>
            <v-list  nav dense>

                <v-list-item-group 
                    v-if="isAdmin"
                    v-model="group"
                    active-class="deep-red--text text--accent-4"
                >
                    <v-list-item  :to="{name:'home'}">
                        <v-list-item-icon>
                            <v-icon>mdi-account-details</v-icon>
                        </v-list-item-icon>
                        <v-list-item-title>Usuarios</v-list-item-title>
                    </v-list-item>
                    <v-list-item :to="{name:'quotas'}" >
                        <v-list-item-icon>
                            <v-icon>mdi-account-multiple</v-icon>
                        </v-list-item-icon>
                        <v-list-item-title>Quotas</v-list-item-title>
                    </v-list-item>

                    <v-list-item :to="{name:'profile'}">
                        <v-list-item-icon>
                            <v-icon>mdi-account</v-icon>
                        </v-list-item-icon>
                        <v-list-item-title>Perfil</v-list-item-title>
                    </v-list-item>

            </v-list-item-group>


            <v-list-item-group 
                    v-else
                    v-model="group"
                    active-class="deep-red--text text--accent-4"
                >
                    <v-list-item  :to="{name:'home'}">
                        <v-list-item-icon>
                            <v-icon>mdi-account-details</v-icon>
                        </v-list-item-icon>
                        <v-list-item-title>Sala de Espera</v-list-item-title>
                    </v-list-item>
                    <v-list-item :to="{name:'patients'}" >
                        <v-list-item-icon>
                            <v-icon>mdi-account-multiple</v-icon>
                        </v-list-item-icon>
                        <v-list-item-title>Pacientes</v-list-item-title>
                    </v-list-item>

                    <v-list-item :to="{name:'profile'}">
                        <v-list-item-icon>
                            <v-icon>mdi-account</v-icon>
                        </v-list-item-icon>
                        <v-list-item-title>Perfil</v-list-item-title>
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

        created(){
            if (this.isAdmin === false){      
                this.specialistSet()
            }else {

            }
        },
        data:() => ({
            group: null,
            mini: true,
        }),

        methods:{
            ...mapActions({
                setDrawer: 'setDrawer',
                specialistSet:'specialistSet'
            }),
        },

        computed: {

        ...mapGetters({
            drawerOn: 'drawer',
            userAuth:'userAuth',
            specialistAuth:'specialistAuth',
            isAdmin:'isAdmin'
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