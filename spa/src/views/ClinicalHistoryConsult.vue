<template>
    <v-container>

        <div class="text-center">
            <v-dialog
              v-model="dialog"
              width="500"
            >
              <v-card>
                <v-card-title class="headline grey lighten-2">
                    Detalles
                </v-card-title>

                <v-card-text>
                    <v-row>
                      <strong> medicamentos: {{medicamentos}} </strong>
                    </v-row>
                    <v-row>
                      <strong> descripcion: {{descriptionMedicamentos}} </strong>
                    </v-row>
                </v-card-text>

                <v-divider></v-divider>

                <v-card-actions>
                  <v-spacer></v-spacer>
                  <v-btn
                    color="primary"
                    text
                    @click="dialog = false"
                  >
                    cerrar
                  </v-btn>
                </v-card-actions>
              </v-card>
            </v-dialog>
        </div>



        <v-card>
            <v-card-title>
                        {{Getpatient.first_name}}
                        {{Getpatient.last_name}}
            </v-card-title>
             <v-card-subtitle>
                <v-row>
                    <v-col>
                        Genero: {{Getpatient.sex}}
                    </v-col>
                    <v-col>
                        Cedula: {{Getpatient.ci}}
                    </v-col>
                    <v-col>
                        Telefono: {{Getpatient.phone}}
                    </v-col>
                </v-row>
                <v-row>
                    <v-col>
                        Estado Civil: {{Getpatient.civil_status}}
                    </v-col>
                    <v-col>
                        Fecha de Nacimiento: {{Getpatient.birthdate}}
                    </v-col>
                    <v-col>
                        Peso Kg: {{Getpatient.weight}}
                    </v-col>
                </v-row>
            </v-card-subtitle>
            <v-card-text>
                <v-row>
                    <v-col>
                        <v-simple-table>
                            <template>
                                <thead>
                                    <tr>
                                        <th class="text-center">
                                        Name
                                        </th>
                                        <th class="text-center">
                                        description
                                        </th>
                                        <th class="text-center">
                                            detalles
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr
                                    v-for="item in getdiseases"
                                    :key="item.name"
                                    >   
                                        <td class="text-center"> {{item.name}}</td>
                                        <td class="text-center">  {{item.description}}</td>
                                        <td class="text-center">
                                            <v-btn 
                                                @click="modal(item)"
                                                color="primary"
                                            >
                                               <v-icon>mdi-eye</v-icon>
                                            </v-btn>
                                        </td>
                                          
                                    </tr>
                                </tbody>
                            </template>
                        </v-simple-table>
                    </v-col>
                </v-row>
            </v-card-text>
        </v-card>
    </v-container>
</template>
<script>
    import { mapGetters, mapActions} from 'vuex'
    export default{
        name:'ClinicalHistoryConsult',
        mounted(){
            this.verificar()
          },
        data:() => ({
            dialog:false,
            medicamentos:'',
            descriptionMedicamentos:''

        }),
        computed:{
            ...mapGetters({
                Getpatient:'Getpatient',
                getMedical_consultation:'getMedical_consultation',
                getmedicamentos:'getmedicamentos',
                getdiseases:'getdiseases',
            }),
            consulta(){
                return this.$route.params.id
            },
        },
        methods:{

            ...mapActions({
                show_mc:'show_p',
                setvalue_mr:'setvalue_mr',
                all_mc:'all_mc',
                show_clinical_mc:'show_clinical_mc',
                show_clinical_p:'show_clinical_p'
            }),
            async modal(item){
 
                this.filtroArray(item).then(res => {
                    this.medicamentos = res.medicine
                    this.descriptionMedicamentos = res.description
                })
            
                this.dialog = true
            },

            async filtroArray(item){

                for (var i = 0; i <= this.getmedicamentos.length; i++) {
                    if (this.getmedicamentos[i].disease === item.id) {
                       return this.getmedicamentos[i]
                    }
                }   

            },
            async verificar(){
                if (this.Getpatient !== null) {
                    this.show_clinical_p(this.consulta).then(res =>{
                        this.show_clinical_mc(this.consulta)
                    })                  
                }
                
               
            },

            async infoData(){
                
            }
        }
    }
</script>