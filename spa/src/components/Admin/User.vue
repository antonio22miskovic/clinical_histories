<template>
    <div>
        <v-card
            outlined
            shaped
            elevation="24"
        >
            <v-card-title>
                Usuarios Especialistas
                <v-spacer/>
                <v-btn> añadir new usuario</v-btn>
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
                    
                </v-data-table>
        </v-card-text>
        </v-card>
    </div>
</template>
<script>
import { mapGetters, mapActions} from 'vuex'
    export  default{
        name:'User',
        data:() => ({
            headers: [
                { text: 'N° ', value: 'name' },
                { text: 'email', value: 'email'},
                { text: 'specialidad', value: 'specialist.name'},
            ],
            numberOfPages: 0,
            options:{},
            page:1
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
        },

        methods:{

            ...mapActions({
                all_u: 'all_u',  
                setOverlay:'setOverlay'
            }),

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