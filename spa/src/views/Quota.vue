<template>
    <div>


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
                                    >{{quota.specialist.name}}
                                </v-toolbar>
                                <v-card-text>
                                    <h3 class="text-center">descripcion:</h3>
                                    <p class="text-center" >{{quota.specialist.description}}</p>
                                    <h4 class="text-center">Quota Restante: {{quota.quota}}</h4>
                                    <h4 class="text-center">Fecha: {{quota.date}}</h4>
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

        <template>
            <v-row justify="space-around">
                <v-col cols="auto">
                    <v-dialog
                        transition="dialog-top-transition"
                        v-model="dialoUpdate"
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
                                    >{{quota.specialist.name}}
                                </v-toolbar>
                                <v-card-text>
                                    <h3 class="text-center">descripcion:</h3>
                                    <p class="text-center" >{{quota.specialist.description}}</p>
                                    <v-text-field
                                        append-icon="mdi-account-multiple"
                                        name="quotaAp"
                                        ref="quotaupdate"
                                        label="Quota por dia "
                                        type="text"
                                        v-model="quota.quota"
                                        :rules="[ rules.required, rules.FormatNumber]"
                                    />
                                </v-card-text>
                                <v-card-actions class="justify-end">
                                    <v-btn
                                    text
                                    @click="updateQuota"
                                    color="warning"
                                    >Actualizar
                                        <v-icon>mdi-pen</v-icon>
                                    </v-btn>
                                    <v-btn
                                    text
                                    @click="dialoUpdate=false"
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


        <template>
            <v-row justify="space-around">
                <v-col cols="auto">
                    <v-dialog
                        transition="dialog-top-transition"
                        v-model="dialoCreate"
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
                                    >Crear nueva Quota
                                </v-toolbar>
                                <v-card-text>
                                    <v-form ref="create">
                                       <v-select
                                            :items="listSpecialistsCreate"
                                            item-value="id"
                                            item-text="name"
                                            prepend-icon="mdi-clipboard-account-outline"
                                            label="Especialidad"
                                            @change="cargarDescripcion"
                                            v-model="form.specialist"
                                            :rules="[rules.specialist]"
                                        ></v-select>
                                        <h4 class="text-center" v-if="description.length > 0" >Descripcion </h4>
                                        <p class="text-center" v-if="description.length > 0" > {{description}} </p>
                                        <v-text-field
                                            prepend-icon="mdi-account-multiple"
                                            name="quotaAp"
                                            ref="quotaupdate"
                                            label="Quota por dia "
                                            type="text"
                                            v-model="form.quota"
                                            :rules="[ rules.required, rules.FormatNumber]"
                                        />
                                        <template>
                                            <v-menu
                                                ref="menu"
                                                v-model="menu"
                                                :close-on-content-click="false"
                                                transition="scale-transition"
                                                offset-y
                                                min-width="290px"
                                            >
                                                <template v-slot:activator="{ on, attrs }">
                                                    <v-text-field
                                                        v-model="date"
                                                        label="Fecha para la quota"
                                                        prepend-icon="mdi-calendar"
                                                        readonly
                                                        v-bind="attrs"
                                                        :rules="[rules.date]"
                                                        v-on="on"
                                                    ></v-text-field>
                                                </template>
                                                <v-date-picker
                                                    ref="picker"
                                                    v-model="date"
                                                    :min="new Date().toISOString().substr(0, 10)"
                                                    @change="save"
                                                ></v-date-picker>
                                            </v-menu>
                                        </template>
                                    </v-form>
                                </v-card-text>
                                <v-card-actions class="justify-end">
                                    <v-btn
                                    text
                                    @click="newQuota"
                                    color="success"
                                    >Crear
                                        <v-icon>mdi-plus</v-icon>
                                    </v-btn>
                                    <v-btn
                                    text
                                    @click="dialoCreate=false"
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
                            @click="dialoCreate = true"
                        > <v-icon>mdi-plus</v-icon>
                        </v-btn>
                  </v-fab-transition>
              </template>
              <span>Añadir nueva Quota</span>
          </v-tooltip>
            <v-card-title>
                Quotas
            </v-card-title>
            <v-card-text>
                <v-data-table
                        :page="page"
                        :pageCount="numberOfPages"
                        :server-items-length="total_q"
                        :headers="headers"
                        :items="getDataQuotas"
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
                                <v-icon> mdi-magnify</v-icon>
                            </v-btn>
                        </template>
                        <template v-slot:item.actualizar="{ item }">
                            <v-btn
                                color="warning"
                                small
                                @click="actualizar(item)"
                            >
                                <v-icon>mdi-pen</v-icon>
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
    export default{
        name:'Quota',
        mounted(){
            if (this.listSpecialistsCreate.length < 1) {
                this.getSpecialist()
            }
        },
        data:() => ({
            hidden:true,
            rules:{
                FormatNumber: value => {
                    let letters = /^[0-9]+$/
                    return letters.test(value) || 'formato invalido'
                },
                date: value => !!value || 'Debe introducir la fecha para la quota',
                required: value => !!value || 'Debe de introducir una quota',
                specialist: value => !!value || 'Debe definir su especialidad',
            },
            headers: [
                { text: 'Quota por dia', value: 'quota' },
                { text: 'specialidad', value: 'specialist.name'},
                { text: 'fecha', value: 'date'},
                { text: 'ver', value: 'ver', sortable: false },
                { text: 'actualizar quota', value: 'actualizar', sortable: false },
            ],
            numberOfPages: 0,
            dialog:false,
            dialoUpdate:false,
            dialoCreate:false,
            options:{},
            page:1,
            quota:{
                id:null,
                quota:null,
                date:null,
                specialist:{
                    name:null,
                    description:null,
                },
                date:null,
                lastQuota:null,
            },
            menu: false,
            form:{
                specialist:null,
                quota:null,
                date:null,
            },
            description:'',
        }),
        watch: {
            options: {
                handler() {
                this.loadQuota()
                },
            },
            menu (val) {
                val && setTimeout(() => (this.$refs.picker.activePicker = 'YEAR'))
            },
        },
        methods:{

            ...mapActions({
                all_q: 'all_q',
                update_q:'update_q',
                setOverlay:'setOverlay',
                 getSpecialist: 'getSpecialist',
                 store_q:'store_q',
            }),

            save (date) {
                this.$refs.menu.save(date)
            },

            cargarDescripcion(id){
                if (this.listSpecialistsCreate.length > 0) {
                    for (var i = 0; i < this.listSpecialistsCreate.length; i++) {
                        if (this.listSpecialistsCreate[i].id === id) {
                            this.description = this.listSpecialistsCreate[i].description
                        }
                    }
                }
            },

            async ver (item){
                this.quota.id = item.id
                this.quota.quota = item.quota
                this.quota.date = item.date
                this.quota.specialist.name = item.specialist.name
                this.quota.specialist.description = item.specialist.description
                this.dialog = true

            },

            async actualizar (item){

                this.quota.id = item.id
                this.quota.quota = item.quota
                this.quota.date = item.date
                this.lastQuota = item.quota
                this.quota.specialist.name = item.specialist.name
                this.quota.specialist.description = item.specialist.description
                this.dialoUpdate = true

            },

            async updateQuota(){
                if (!this.$refs.quotaupdate.validate()) {
                        return
                    }
                if (this.lastQuota === this.quota.quota) {
                     Swal.fire('No ah cambiado el nuemero de la quota', '', 'info')
                     return
                }
                let datos = [this.quota.id,this.quota.quota]
                this.setOverlay(true)
                this.update_q(datos).then(res => {
                    this.$swal({
                        icon: 'success',
                        title: '¡Quota Actualizada con exito!',
                        text:'exito',
                        confirmButtonColor: '#3085d6',
                    })
                    this.setOverlay(false)
                    this.all_q(this.page)
                    this.dialoUpdate = false
                })
            },

            async newQuota(){
               if (!this.$refs.create.validate()) {
                        return
                    }
                this.setOverlay(true)
                let datos = {
                    quota: this.form.quota,
                    specialist_id: this.form.specialist,
                    date: this.date
                }
                this.store_q(datos).then(res => {
                    this.setOverlay(false)
                     this.$swal({
                        icon: 'success',
                        title: '¡Quota Actualizada con exito!',
                        text:'exito',
                        confirmButtonColor: '#3085d6',
                    })
                    this.all_q(this.page)
                    this.dialoCreate = false
                })

            },

            async loadQuota () {
                try{
                    this.setOverlay(true)
                    const { page, itemsPerPage } = this.options
                    let pageNumber = page - 1
                    this.all_q(pageNumber).then(res =>{
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

                getDataQuotas:'getDataQuotas',
                total_q:'total_q',
                getdialog:'getdialog',
                Getquota:'Getquota',
                listSpecialistsCreate: 'listSpecialistsCreate',

            }),
            paginate:{
                set(value){
                    this.all_q(value)
                },
                get(){
                    return this.getDataQuotas
                }
            },

            option:{
                set(value){
                    this.all_q(value)
                },
                get(){
                    return this.options
                }
            },

        }
    }
</script>