<template>
    <v-footer
      app
    >
        <v-col
        class="text-center"
        cols="12"
        color="red"
        >
            {{ new Date().getFullYear() }} — <strong>DR. TULIO PINEDA</strong>
        </v-col>
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