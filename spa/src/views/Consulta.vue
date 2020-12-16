<template>
    <v-container>
        <p> atendiendo </p>
    </v-container>
</template>
<script>
    export default{
        name:'Consulta',
        data:()=> ({
            
        }),
        computed:{
            paciente(){
                return this.$router.params.id
            }
        }
    }
</script>