<template>
    <v-container>
        <v-card>
            <v-container>
                <v-card-title>
                    {{patient.first_name}}  {{patient.last_name }}
                    <v-spacer/>
                    {{patient.sex}}
                </v-card-title>
                <v-list-item-subtitle class="text-center">
                    describa el diagnostico del paciente
                </v-list-item-subtitle>
                <v-card-text>
                    <v-container class="">
                        <v-form>

                            <v-text-field
                                label="nombre del diagnostico"
                                auto-grow
                                outlined
                                rows="1"
                                row-height="15"
                                v-model="form.diagnostico"
                            ></v-text-field>

                            <v-textarea
                                label="Descripcion"
                                auto-grow
                                outlined
                                rows="3"
                                row-height="25"
                                prepend-icon="mdi-comment"
                                v-model="form.descripcion"
                            ></v-textarea>
                            <v-card-actions>
                                <v-btn
                                    elevation="3"
                                    @click="diagnistico">
                                    Diagnosticar
                                </v-btn>
                            </v-card-actions>

                        </v-form>
                    </v-container>
                </v-card-text>
            </v-container>
        </v-card>
    </v-container>
</template>
<script>
    import { mapGetters, mapActions} from 'vuex'
    export default{
        name:'ConsultaPatient',
        data:()=>({
            form:{
                diagnostico:'',
                'description':''
            },
            hospitalization:'',
            enabled: false,
        }),
        mounted(){
            console.log('paciente desde la url',this.patient_url)
            console.log('paciente',this.patient.id)
            if (this.patient.id === null) {
                console.log('dentro del if del paciente')
                this.show_p(this.patient_url).then(res => {
                    console.log('paciente en turno',res)
                    if (res.medical_record !== null) {
                        this.store_mr(res.id).then(res => {
                            console.log('la historia clinica del paciente   ',res)
                        })
                    }
                });

            }

        },
        methods:{

            ...mapActions({
                store_mc:'store_mc',
                show_mc:'show_mc',
                show_p:'show_p',
                store_mr:'store_mr'
            }),

           async diagnistico(){
                console.log(this.form)
                this.store_mc(this.form).then(res => {

                })

            },

        },
        computed:{

            ...mapGetters({
                Getpatient:'Getpatient'
            }),

            patient(){
                return this.Getpatient
            },
            patient_url(){
                return this.$route.params.id
            },
        }
    }
</script>