<template>
    <div>
        <v-container>
            <v-form ref="wl">

                <v-select
                    :items="listSpecialists"
                    item-value="id"
                    item-text="name"
                    label="Especialidades"
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

        mounted(){

            this.getSpecialist()

        },

        data: () => ({
            form:{
                specialist_id:'',
                identification_card:'',
            },
            rules:{
                    requiredSpecialist: value => !!value || 'Debe seleccionar una especialidad.',
                    requiredCedula: value => !!value || 'Debe introducir cédula de identidad.',
                    FormatCI: value => {
                        let letters = /^\d*(\.\d{8})?\d{0,8}$/
                        return letters.test(value) || 'formato inválido'
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
                let value ={identification_card:this.form.identification_card,specialist_id: this.form.specialist_id}
                this.store_wl(value).then(res => {
                    if (res.comfirmacion === false) {
                        this.$swal({
                            icon: 'warning',
                            title: '¡No hay cupos Disponibles pontro se liberara mas cupos!',
                            text:'lo sentimos',
                            confirmButtonColor: '#3085d6',
                        })
                        this.form.specialist_id = null
                        this.form.identification_card = null
                        this.$refs.wl.resetValidation()
                    }else{
                        console.log('la fecha',res.data.quota.date)
                        this.$swal({
                                icon: 'success',
                                title: `¡Se ha Añadido a la lista de espera con exito para la fecha: ${res.data.quota.date}!`,
                                text:'exito',
                                confirmButtonColor: '#3085d6',
                            })
                        this.form.specialist_id = null
                        this.form.identification_card = null
                        this.$refs.wl.resetValidation()
                    }
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