<template>
    <div>
        <v-container>
            <v-form ref="wl">

                <v-select
                    :items="listSpecialists"
                    item-value="id"
                    item-text="name"
                    label="Especialidad"
                     :rules="[rules.requiredSpecialist]"
                    v-model="form.specialist_id"
                    append-icon="mdi-clipboard-account-outline"
                ></v-select>

                <v-text-field
                    name="login"
                    label="Cedula Identidad"
                    type="text"
                    :rules="[rules.requiredCedula, rules.FormatCI]"
                    v-model="form.identification_card"
                     append-icon="mdi-key-variant"
                />

                <v-card-actions>
                    <v-btn block color="blue darken-2" @click="solicitar">Solicitar</v-btn>
                    <br>
                </v-card-actions>
            </v-form>
            <div class="text-center font-italic">
                <v-btn  text color="blue darken-2" :to="{name:'auth-login'}">iniciar session  <v-icon>mdi-arrow-right-bold-circle</v-icon> </v-btn>
            </div>
            
        </v-container>
    </div> 
</template>
<script>

    import { mapGetters, mapActions } from 'vuex'

    export default{

        name:'WitingList',

        created(){

            this.getSpecialist()
            
        },

        data: () => ({
            form:{
                specialist_id:null,
                identification_card:null,
            },
            rules:{ 
                    requiredSpecialist: value => !!value || 'Debe Elegir una Especialidad.',
                    requiredCedula: value => !!value || 'Debe Introducir una Cedula.',
                    FormatCI: value => {
                        let letters = /^\d*(\.\d{8})?\d{0,8}$/
                        return letters.test(value) || 'formato invalido'
                    },
                  
            },
            menu: false,  
        }),
    
        methods:{

            ...mapActions({

                getSpecialist: 'getSpecialist',
                specialistSet:'specialistSet',
                store_wl:'store_wl'

            }),

            solicitar(){
                if (!this.$refs.wl.validate()) {
                    return
                }
    
                this.store_wl(this.form).then(res => {
                    this.$swal({
                            icon: 'success',
                            title: '¡Se ah Añadido a la lista de espera con exito!',
                            text:'exito',
                            confirmButtonColor: '#3085d6',
                        })
                    this.form.specialist_id = null
                    this.form.identification_card = null
                    this.$refs.wl.resetValidation()
                    console.log(res)
                })
                
            }

        },

        computed:{

            ...mapGetters({

                listSpecialists: 'listSpecialists'

            }),
        }
    }
</script>