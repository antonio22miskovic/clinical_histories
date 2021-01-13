<template>
    <div>
        <NewUser v-if="getdialog"/>

        <!-- ver datos -->
        <template>
            <v-row justify="space-around">
                <v-col cols="auto">
                    <v-dialog
                        transition="dialog-top-transition"
                        v-model="dialog"
                        max-width="600"
                    >
                        <template>
                            <v-card
                                outlined
                                shaped
                                elevation="24"
                            >
                                <v-toolbar
                                    color="primary"
                                    dark
                                    >{{userVer.name}}
                                </v-toolbar>
                                <v-card-text>
                                    <v-row>
                                        <v-col>
                                            <p>Email:{{userVer.email}}</p>
                                        </v-col>
                                        <v-col>
                                            <p>specialista:{{userVer.specialist_name}}</p>
                                        </v-col>
                                    </v-row>
                                    <v-row>
                                        <v-col>
                                            <p>descripcion:{{userVer.specialist_description}}</p>
                                        </v-col>
                                    </v-row>
                                </v-card-text>
                                <v-card-actions class="justify-end">
                                    <v-btn
                                    text
                                    @click="dialog=false"
                                    color="error"
                                    >cerrar
                                        <v-icon>mdi-close-octagon-outline</v-icon>
                                </v-btn>
                                </v-card-actions>
                            </v-card>
                        </template>
                  </v-dialog>
                </v-col>
            </v-row>
        </template>


<!-- editando -->
        <template> 
            <v-row justify="space-around">
                <v-col cols="auto">
                    <v-dialog
                        transition="dialog-top-transition"
                        v-model="dialog_up"
                        max-width="600"
                    >
                        <template>
                            <v-card
                                outlined
                                shaped
                                elevation="24"
                            >
                                <v-toolbar
                                    color="primary"
                                    dark
                                    >{{userEditar.name}}
                                </v-toolbar>
                                <v-card-text >                                
                                       <h3 class="text-center">Email:</h3>
                                       <p class="text-center">{{userEditar.email}}</p>
                                    <v-row>
                                        <v-select
                                                :items="listSpecialists"
                                                item-value="id"
                                                item-text="name"
                                                prepend-icon="mdi-clipboard-account-outline"
                                                label="Especialidad"
                                                @change="cargarDescripcion"
                                                v-model="userEditar.specialist_id"
                                                :rules="[rules.specialist]"
                                        ></v-select>
                                    </v-row>
                                    <br>
                                        <h3 class="text-center">descripcion:</h3>
                                        <p>{{userEditar.specialist_description}}</p>
                                   
                                </v-card-text>
                                <v-card-actions class="justify-end">
                                     <v-btn
                                        text
                                        @click="updateUser"
                                        color="success"
                                        >Editar
                                            <v-icon>mdi-account-edit</v-icon>
                                    </v-btn>
                                    <v-btn
                                        text
                                        @click="dialog_up=false"
                                        color="error"
                                        >cerrar
                                            <v-icon>mdi-close-octagon-outline</v-icon>
                                    </v-btn>
                                </v-card-actions>
                            </v-card>
                        </template>
                  </v-dialog>
                </v-col>
            </v-row>
        </template>



        <v-card
            outlined
            shaped
            elevation="24"
        >

            <v-tooltip bottom>
                <template v-slot:activator="{ on, attrs }">
                  <v-fab-transition>
                        <v-btn
                            color="primary"
                            v-show="hidden"
                            v-bind="attrs"
                            v-on="on"
                            fab
                            dark
                            absolute
                            top
                            right
                            @click="newUser"
                        > <v-icon>mdi-account-plus</v-icon>
                        </v-btn>
                  </v-fab-transition>
              </template>
              <span>Añadir nuevo usuario</span>
          </v-tooltip>


            <v-card-title>
                Usuarios Especialistas
                <v-spacer/> 
            </v-card-title>
            <v-card-text>
                <v-data-table
                    :page="page"
                    :pageCount="numberOfPages"
                    :server-items-length="total_u"
                    :headers="headers"
                    :items="getDataUser"
                    :options.sync="option"
                    class="elevation-3"
                    locale="es-CL"
                >
                    <template v-slot:item.ver="{ item }">
                        <v-btn
                            color="primary"
                            small
                            @click="ver(item)"
                        >
                            <v-icon>mdi-account-search</v-icon>
                        </v-btn>
                    </template>
                    <template v-slot:item.editar="{ item }">
                        <v-btn
                            color="warning"
                            small
                            @click="editar(item)"
                        >
                            <v-icon>mdi-account-edit</v-icon>
                        </v-btn>
                    </template>
                    <template v-slot:item.eliminar="{ item }">
                        <v-btn
                            color="error"
                            small
                            @click="eliminar(item)"
                        >
                            <v-icon>mdi-account-remove</v-icon>
                        </v-btn>
                    </template>
                     <template v-slot:item.seguimiento="{ item }">
                        <v-btn
                            color="teal"
                            small
                           :to="{name:'seguimiento', params:{id:item.id}}"
                        >
                            <v-icon>mdi-account-search</v-icon>
                        </v-btn>
                    </template>    
                </v-data-table>
        </v-card-text>
        </v-card>
    </div>
</template>
<script>
import { mapGetters, mapActions} from 'vuex'
import Swal from 'sweetalert2'
import NewUser from '@/components/dialogs/NewUser'
    export  default{
        name:'User',
        components:{
            NewUser
        },
        data:() => ({
            headers: [
                { text: 'Name', value: 'name' },
                { text: 'E-mail', value: 'email'},
                { text: 'Specialidad', value: 'specialist.name'},
                { text: 'ver', value: 'ver', sortable: false },
                { text: 'editar', value: 'editar', sortable: false },
                { text: 'eliminar', value: 'eliminar', sortable: false },
                { text: 'seguimiento', value: 'seguimiento', sortable: false },
            ],
            rules:{
                specialist: value => !!value || 'Debe definir su especialidad',
            },
            numberOfPages: 0,
            options:{},
            hidden:true,
            page:1,
            userVer:{
                name:'',
                email:'',
                avatar:'',
                specialist_name:'',
                specialist_description:'',
            },
            userEditar:{
                id:'',
                name:'',
                email:'',
                avatar:'',
                specialist_name:'',
                specialist_description:'',
                specialist_id:null,

            },
            dialog:false,
            dialog_up:false
        }),

        watch: {
            options: {
                handler() {
                    this.loadQuota();
                },
            }
        },

        mounted () {
            this.loadQuota()
            if (this.listSpecialists.length > 0) {

            }else{

                this.getSpecialist()
            }
        },

        methods:{

            ...mapActions({
                all_u: 'all_u',  
                setOverlay:'setOverlay',
                Ondialog:'Ondialog',
                getSpecialist:'getSpecialist',
                destroy_u:'destroy_u',
                update_u_specialist:'update_u_specialist'
            }),

            async seguimiento (item) {

            },

            async ver (item) {

                this.userVer.name = item.name
                this.userVer.email = item.email
                this.userVer.specialist_name = item.specialist.name
                this.userVer.specialist_description = item.specialist.description
                this.dialog = true

            },

            async editar (item) {
                console.log('en el editando:',item)
                this.userEditar.id = item.id
                this.userEditar.name = item.name
                this.userEditar.email = item.email
                this.userEditar.specialist_name = item.specialist.name
                this.userEditar.specialist_description = item.specialist.description
                this.userEditar.specialist_id = item.specialist.id
                this.dialog_up = true

            },

            cargarDescripcion(id){
                if (this.listSpecialists.length > 0) {
                    for (var i = 0; i < this.listSpecialists.length; i++) {
                        if (this.listSpecialists[i].id === id) {
                            this.userEditar.specialist_description = this.listSpecialists[i].description
                        } 
                    }
                }
            },

            async eliminar (item) {

                Swal.fire({
                    title: 'Desea Eliminar a este usuario?',
                    showDenyButton: true,
                    showCancelButton: true,
                    confirmButtonText: `Eliminar`,
                    denyButtonText: `No`,
                    icon: 'warning',
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.setOverlay(true)
                        this.destroy_u(item.id).then(res => {
                            this.setOverlay(false)
                            this.$swal({
                                icon: 'success',
                                title: '¡Usuario eliminado con exito!',
                                text:'exito',
                                confirmButtonColor: '#3085d6',
                            })
                            this.all_u(this.page)
                        })
                    } else if (result.isDenied) {
                        this.setOverlay(false)
                        Swal.fire('Por favor Tenga Cuidado', '', 'info')
                    }
                })    
            },

            async newUser (item) {    
              
                this.Ondialog(true)
            },

            async updateUser () {
                Swal.fire({
                    title: 'Desea cambiar Asignar una nueva especialidad a el usuario?',
                    showDenyButton: true,
                    showCancelButton: true,
                    confirmButtonText: `Cambiar`,
                    denyButtonText: `No`,
                    icon: 'warning',
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.setOverlay(true)
                         this.update_u_specialist([ this.userEditar.id, {specialist_id:this.userEditar.specialist_id}]).then(res => {
                            this.setOverlay(false)
                            this.$swal({
                                icon: 'success',
                                title: '¡Al Usuario se le ah actualizado con exito la specialidad!',
                                text:'exito',
                                confirmButtonColor: '#3085d6',
                            })
                            this.dialog_up = false
                            this.all_u(this.page)
                        })
                    } else if (result.isDenied) {
                        this.setOverlay(false)
                        Swal.fire('Por favor Tenga Cuidado', '', 'info')
                    }
                })           
            },

            async loadQuota () {
                try{
                    this.setOverlay(true)
                    const { page, itemsPerPage } = this.options
                    let pageNumber = page - 1
                    this.all_u(pageNumber).then(res =>{
                        this.setOverlay(false)
                    })
                }catch(err){
                    this.setOverlay(false)
                    console.log(err)
                }
            },
        },
        computed:{

            ...mapGetters({
                getDataUser:'getDataUser',
                total_u:'total_u',
                getdialog:'getdialog',
                listSpecialists:'listSpecialists'
            }),

            paginate:{
                set(value){
                    this.all_u(value)
                },
                get(){
                    return this.getDataUser
                }
            },
            option:{
                set(value){
                    this.all_u(value)
                },
                get(){
                    return this.options
                }
            },

        } 
    }
</script>