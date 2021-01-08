<template>
    <v-footer
      app
    >   
        <v-row>
            <v-col
            class="text-center"
            cols="12"
            color="deep-purple lighten-2"
            >
                {{ new Date().getFullYear() }} — <strong>DR. TULIO PINEDA</strong>
            </v-col>
        </v-row>
    </v-footer>
</template>

<script>
  // import { mapGetters } from 'vuex'
  export default {
    name: 'CoreFooter',
    computed: {
      // ...mapGetters({
      //   overlay: 'config/overlay',
      // }),
    },
  }
</script>

<style>

</style>