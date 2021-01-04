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
                        <v-card>
                            <v-toolbar
                                color="primary"
                                dark
                                >{{patient.first_name}} {{patient.last_name}}
                            </v-toolbar>
                            <v-card-text>
                                <v-row>
                                    <v-col>
                                        <p>Genero:{{patient.sex}}</p>
                                    </v-col>
                                    <v-col>
                                        <p>Telefono:{{patient.phone}}</p>
                                    </v-col>
                                </v-row>
                                <v-row>
                                    <v-col>
                                        <p>Cedula:{{patient.ci}}</p>
                                    </v-col>
                                    <v-col>
                                        <p>Estado Civil:{{patient.civil_status}}</p>
                                    </v-col>
                                </v-row>
                                <v-row>
                                    <v-col>
                                        <p>Fecha de Nacimiento:{{patient.birthdate}}</p>
                                    </v-col>
                                    <v-col>
                                        <p>Peso Kg:{{patient.weight}}</p>
                                    </v-col>
                                </v-row>
                            </v-card-text>
                            <v-card-actions class="justify-end">
                                <v-btn
                                text
                                @click="dialog=false"
                                >Close</v-btn>
                            </v-card-actions>
                        </v-card>
                    </template>
              </v-dialog>
            </v-col>
        </v-row>
    </template>


	<v-container>
		 <v-row
        align="center"
        justify="center"
        >
            <v-col
            cols="12"
            class="mx-auto"
            >
                <v-card>
                    <v-card-title>
                      	Pacientes
                        <v-spacer />
                    </v-card-title>
                    <v-data-table
                        :page="page"
                        :pageCount="numberOfPages"
                        :server-items-length="total_p"
                        :headers="headers"
                        :items="getDataPatients"
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
                        <template v-slot:item.historial="{ item }">
                            <v-btn
                                color="primary"
                                small
                                :to="{
                                    name:'clinichistory',
                                    params:{id:item.id}
                                }"
                            >
                                <v-icon>mdi-account-box</v-icon>
                            </v-btn>
                        </template>
                    </v-data-table>
                </v-card>
            </v-col>
        </v-row>
	</v-container>
</div>
</template>
<script>
	import { mapGetters, mapActions} from 'vuex'
	export default{
		name:'Patient',
		data:() => ({
			headers: [
	            { text: 'Nombre', value: 'first_name' },
	            { text: 'Cedula', value: 'ci' },
	            { text: 'Telefono', value: 'phone'},
	            { text: 'Genero', value: 'sex'},
                { text: 'ver', value: 'ver', sortable: false },
                { text: 'historial', value: 'historial', sortable: false },
        	],
            patient:{
                sex:'',
                first_name:'',
                last_name:'',
                phone:'',
                ci:'',
                civil_status:'',
                birthdate:'',
                weight:0
            },
            numberOfPages: 0,
            dialog:false,
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
	            all_p: 'all_p',
        	}),

			async loadQuota () {
           		try{
	                const { page, itemsPerPage } = this.options
	                let pageNumber = page - 1
	                this.all_p(pageNumber)
           		}catch(err){
	                console.log(err)
           		}
        	},

            async ver(item){
                this.patient.first_name = item.first_name
                this.patient.sex = item.sex
                this.patient.last_name = item.last_name
                this.patient.phone = item.phone
                this.patient.ci = item.ci
                this.patient.civil_status = item.civil_status
                this.patient.birthdate = item.birthdate
                this.patient.weight = item.weight
                this.dialog = true
            },

		},
		 computed:{
		 	...mapGetters({
	            getquotas:'getquotas',
	            getDataPatients:'getDataPatients',
	            total_p:'total_p',
        	}),

        paginate:{
            set(value){
                this.all_p(value)
            },
            get(){
                return this.getDataPatients
            }
        },
        option:{
            set(value){
                this.all_p(value)
            },
            get(){
                return this.options
            }

		 }
	}
}
</script>