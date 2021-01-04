<template>
    <v-container>
        <p> paciente {{Getpatient.first_name}}  {{Getpatient.last_name}}</p>
    </v-container>
</template>
<script>
    import { mapGetters, mapActions} from 'vuex'
    export default{
        name:'ClinicHistory',
        mounted(){
            console.log(this.patient_url)
            this.verificar()
        },
        data:()=>({

        }),
        computed:{
            ...mapGetters({
                Getpatient:'Getpatient',
                getMedical_record:'getMedical_record'
            }),
            patient_url(){
                return this.$route.params.id
            },
            patient(){
                return this.Getpatient
            },
        }, 
        methods:{
            ...mapActions({
                show_p:'show_p',
                setvalue_mr:'setvalue_mr',
            }),
            async verificar(){
                this.show_p(this.patient_url).then(res => {
                    this.setvalue_mr(res.medical_record)
                }).catch(err =>{
                    console.log(err)
                })            
            }
        }
    }
</script>