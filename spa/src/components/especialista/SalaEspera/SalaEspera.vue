<template>
    <v-container class="fill-height fliut">
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
                        Pacientes del dia:{{getquotas.quota}}
                        <v-spacer />
                        {{getquotas.date}}
                    </v-card-title>
                    <v-data-table
                        :headers="headers"
                        :items="paginate"
                        :sort-by="['attributes.date']"
                        class="elevation-3"
                        locale="es-CL"
                    >
                        <template v-slot:item.actions="{ item }">
                            <v-btn
                            color="primary"
                            small
                            @click="atender(item.id)"
                            >
                                <v-icon>mdi-account-arrow-right</v-icon>
                            </v-btn>
                        </template>
                        <template v-slot:item.no_asistio="{ item }">
                            <v-btn
                            color="red"
                            small
                            @click="no_asistio(item.id)"
                            >
                                <v-icon>mdi-account-off</v-icon>
                            </v-btn>
                        </template>
                    </v-data-table>
                </v-card>
            </v-col>
        </v-row>
    </v-container>
</template>

<script>
import { mapGetters, mapActions} from 'vuex'
import axios from 'axios'
export default {
    name: 'SalaEspera',
    data: () => ({

        headers: [
            { text: 'N° ', align: 'start', value: '' },
            { text: 'Cedula', value: 'cedula' },
            { text: 'Atender', value: 'actions', sortable: false },
            { text: 'No atendido', value: 'no_asistio', sortable: false },
        ],
        paginate:[],
        
}),
    mounted () {
        this.loadQuota(1)
    },
    computed:{
        ...mapGetters({
            getquotas:'getquotas',
        })
    },
    methods: {
        ...mapActions({
            quotas: 'quotas',
        }),

        async no_asistio (id) {

        },

        async atender (id) {

        },

        async loadQuota (page) {
            console.log('estoy dentro')
            try{
                const {data} = await axios.get(`/api/doctor/waiting_list?page=${page}`)
                this.paginate = data.data
                console.log('el resultado de la busqueda:', this.paginate)
            }catch(err){
                return console.log(err)
            }

        },

        async reintegro (id) {
            try {
                const { data } = await axios.patch(`api/warranty_statu_refund_requested`,{"id":id})
                this.$swal({
                    icon: 'success',
                    title: 'Excelente',
                    text: data.message,
                    showConfirmButton: false,
                    timer: 2000,
                    onClose: () => {},
                })
            } catch (e) {
                console.log(e)
            }
        },
        async loadWarranties () {
            try {
                const { data } = await axios.get(`/api/warranties/${this.$store.state.auth.user.id}`)
                data.data.forEach(
                    item => {
                        item.warrantable_type = this.transform_type(item.warrantable_type)
                        item.created_at = this.transform_date(data.data[0].created_at)
                        item.balance.balance_amount = `$${new Intl.NumberFormat("de-DE").format(item.balance.balance_amount)}`
                    });
                this.warranties = data;
            } catch (e) {
//
            }
        },
    }
}
</script>