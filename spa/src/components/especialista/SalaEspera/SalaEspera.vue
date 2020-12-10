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
                        Pacientes del dia: 
<!--                         <v-spacer /> -->
<!--                         <v-btn  color="primary" large>Agregar Garantia</v-btn> -->
                    </v-card-title>
                    <v-data-table
                        :headers="headers"
                        :items="warranties.data"
                        :sort-by="['attributes.date']"
                        class="elevation-1"
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
import { mapGetters, mapActions } from 'vuex'
export default {
    name: 'SalaEspera',
    data: () => ({
        headers: [
        { text: 'nombre', align: 'start', value: 'balance.balance_amount' },
        { text: 'cedula', value: 'warrantable_type' },
        // { text: 'Nombre', value: 'warrantable.name' },
        // { text: 'Fecha de garantia', value: 'created_at' },
        // { text: 'Estatus', value: 'warranty_statu.status' },
        { text: 'atender', value: 'actions', sortable: false },
        { text: 'no aisitio', value: 'no_asistio', sortable: false },
        ],

// warranties
warranties: { data: [
{
  monto: '2000',
  tipo_venta:'venta',
  nombre: 'carro de lujo',
  fecha: '22/06/2020',
  estado: 'activo',
  acciones: 'acción' ,
},
], links: {}, meta: {} },
search: ''
}),
    created () {
        // this.loadQuota()
    },
    computd:{

    },
    methods: {
        ...mapActions({
            quotas: 'quotas'
        }),
        async no_asistio (id) {

        },

        async atender (id) {

        },

        async loadQuota () {

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
transform_date (datetime) {
    let date = new Date(datetime);
    date = `${date.getDay()}/${date.getMonth()}/${date.getFullYear()}`;
    return date;
},
transform_type (type) {
    if(type == 'App\\Models\\Auction'){
        return "Remate";
    }else if(type == 'App\\Models\\Product'){
        return "Venta Directa";
    }
}
},
}
</script>

<style>

</style>