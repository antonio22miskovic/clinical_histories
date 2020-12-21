<template>
    <v-container>
        <v-container>
            <v-card 
                elevation="10"
                outlined
                shaped
            >
                <transition name="slide" mode="out-in">
                    <ConsultaPatient v-if="componet"/>
                    <NewConsulta v-else/>
                </transition>
            </v-card>
        </v-container>
    </v-container>
</template>
<script>
    import { mapGetters, mapActions } from 'vuex'
    import ConsultaPatient from '@/components/especialista/SalaEspera/ConsultaPatient.vue'
    import NewConsulta from '@/components/especialista/SalaEspera/NewConsulta.vue'
    export default{
        name:'Consulta',
        data:()=> ({
            patient_shift:'',
            result:{},
        }),
        components:{
            ConsultaPatient,
            NewConsulta
        },
        mounted(){

           this.filterPatient()

        },
        methods:{

            ...mapActions({
                detectPatient:'detectPatient'
            }),

           async filterPatient(){
                if (this.getDateItems.length < 1){
                    this.$router.push({name:'home'})
                }
                else{
                    let array = this.data.filter(item => item.id === this.patient)
                    for (var i = 0; i <= array.length; i++) {
                        this.patient_shift = array[0]
                    }
                    this.detectPatient(this.patient_shift.cedula)                   
                }

            },

        },
        computed:{

            ...mapGetters({
                getDateItems: 'getDateItems',
                getPatient:   'getPatient',
                Getcomponet:  'Getcomponet'
            }),

            patient(){
                return this.$route.params.id
            },
            data(){
                return this.getDateItems
            },
            componet(){
                return this.Getcomponet
            }
        }
    }
</script>
<style>
   .slide-enter-active,
   .slide-leave-active{
        transition: opacity 1s, transform 1s;
   }
   .slide-enter,
   .slide-leave-to {
    opacity: 0;
    transform: translateX(-30%);
   }
</style>