<template>
    <div>
     <EditPatient v-if="getdialog"></EditPatient>
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
                                        <p>Cedula:{{parseInt(patient.ci).toLocaleString('es-ES')}}</p>
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


	<v-container>
		 <v-row
        align="center"
        justify="center"
        >
            <v-col
            cols="12"
            class="mx-auto"
            >
                <v-card
                    outlined
                    shaped
                    elevation="24"
                >
                    <v-card-title>
                      	Pacientes Atendidos
                        <v-spacer/>
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
                        <template v-slot:item.ciFormato="{ item }">
                           {{parseInt(item.ci).toLocaleString('es-ES')}}
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
                        <template v-slot:item.xml="{ item }">
                            <v-btn
                                color="primary"
                                small
                                @click="CdaHL7(item.id)"
                            >
                                <v-icon>mdi-file-import</v-icon>
                            </v-btn>
                        </template>
                        <template v-slot:item.pdf="{ item }">
                            <v-btn
                                color="primary"
                                small
                                @click="pdfImport(item.id)"
                            >
                                <v-icon>mdi-file-pdf</v-icon>
                            </v-btn>
                        </template>
                        <template v-slot:item.edit="{ item }">
                            <v-btn
                                color="primary"
                                small
                                @click="editar(item)"
                            >
                                <v-icon>mdi-account-edit</v-icon>
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
    import Swal from 'sweetalert2'
    import EditPatient from '@/components/dialogs/EditPatient'
	export default{
		name:'Patient',
        components:{
           EditPatient
        },
		data:() => ({
			headers: [
	            { text: 'Nombre', value: 'first_name' },
	            { text: 'Cédula', value: 'ciFormato'},
	            { text: 'Teléfono', value: 'phone'},
	            { text: 'Género', value: 'sex'},
                { text: 'Ver', value: 'ver', sortable: false },
                { text: 'Historial', value: 'historial', sortable: false },
                { text: 'CDA', value: 'xml', sortable: false },
                { text: 'PDF', value: 'pdf', sortable: false },
                { text: 'Editar', value: 'edit', sortable: false },
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
                this.loadQuota()
            	},
        	}
    	},

    	mounted () {
        	this.loadQuota()
    	},

		methods:{
			...mapActions({
	            all_p: 'all_p',
                documentXml_p:'documentXml_p',
                documentPdf_p:'documentPdf_p',
                Ondialog:'Ondialog',
                setDialog:'setDialog',
                setOverlay:'setOverlay'
        	}),

			async loadQuota () {
           		try{
                    this.setOverlay(true)
	                const { page, itemsPerPage } = this.options
	                let pageNumber = page - 1
	                this.all_p(pageNumber).then(res =>{
                        this.setOverlay(false)
                    })
           		}catch(err){
                    this.setOverlay(false)
	                console.log(err)
           		}
        	},

            async pdfImport(item){
                Swal.fire({
                    title: 'Desea Generar Documento PDF del pacinete?',
                    showDenyButton: true,
                    showCancelButton: true,
                    confirmButtonText: `Generar`,
                    denyButtonText: `No`,
                    icon: 'warning',
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.setOverlay(true)
                        this.documentPdf_p(item).then(res =>{
                            this.$swal({
                                icon: 'success',
                                title: '¡Documento PDF generado con exito!',
                                text:'exito',
                                confirmButtonColor: '#3085d6',
                            })
                            this.setOverlay(false)
                        })
                    } else if (result.isDenied) {
                        this.setOverlay(false)
                        Swal.fire('Por favor Tenga Cuidado', '', 'info')
                    }
                })

            },
            async CdaHL7(id){
                 Swal.fire({
                    title: 'Desea Generar Documento HL7/CDA del pacinete?',
                    showDenyButton: true,
                    showCancelButton: true,
                    confirmButtonText: `Generar`,
                    denyButtonText: `No`,
                    icon: 'warning',
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.setOverlay(true)
                        this.documentXml_p(id).then(res => {
                            this.setOverlay(false)
                            this.$swal({
                                icon: 'success',
                                title: '¡Documento HL7/CDA generado con exito!',
                                text:'exito',
                                confirmButtonColor: '#3085d6',
                            })
                        })
                    } else if (result.isDenied) {
                        Swal.fire('Por favor Tenga Cuidado', '', 'info')
                }
            })

            },
            async editar(item){
                this.setDialog([item,this.page]).then(res => {
                    this.Ondialog(true)
                })

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
	            getDataPatients:'getDataPatients',
	            total_p:'total_p',
                getdialog:'getdialog'
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