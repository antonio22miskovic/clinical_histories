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
                        Garantias
                        <v-spacer />
                        <v-btn  color="primary" large :to="{name: 'admin-warranties-new'}" >Agregar Garantia</v-btn>
                    </v-card-title>
                    <v-data-table
                        v-if="warranties"
                        :headers="headers"
                        :items="warranties.data"
                        :sort-by="['attributes.date']"
                        class="elevation-1"
                        locale="es-CL"
                    >
                        <template v-slot:item.actions="{ item }">
                            <v-btn
                            color="secondary"
                            small
                            :disabled="item.status === 3"
                            @click="reintegro(item.id)"
                            >Solicitar Reintegro</v-btn>
                        </template>
                    </v-data-table>
                </v-card>
            </v-col>
        </v-row>
    </v-container>
</template>

<script>
import axios from 'axios'
export default {
    name: 'AdminWarranties',
    middleware: ['auth', 'admin'],
    data: () => ({
        headers: [
        { text: 'Monto', align: 'start', value: 'balance.balance_amount' },
        { text: 'Tipo de garantia', value: 'warrantable_type' },
        { text: 'Nombre', value: 'warrantable.name' },
        { text: 'Fecha de garantia', value: 'created_at' },
        { text: 'Estatus', value: 'warranty_statu.status' },
        { text: 'Acciones', value: 'actions', sortable: false },
        ],

// warranties
warranties: { data: [
// {
//   monto: '2000',
//   tipo_venta:'venta',
//   nombre: 'carro de lujo',
//   fecha: '22/06/2020',
//   estado: 'activo',
//   acciones: 'acción' ,
// },
], links: {}, meta: {} },
search: ''
}),
    created () {
        this.loadWarranties()
    },
    methods: {
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