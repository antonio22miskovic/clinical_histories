<template>
    <v-app
    >
        <div>
            <v-overlay :value="overlay">
                <v-progress-circular
                indeterminate
                size="64"
                />
            </v-overlay>
        </div>
        <router-view name="header"/>
        <v-main>
            <v-container
            class="py-8 px-6"
            fluid
            >
                <router-view/>
            </v-container>
        </v-main>
        </v-container>
        <router-view name="sidebar"/>
        <router-view name="footer"/>
    </v-app>
</template>
<script>
  import { mapGetters } from 'vuex'
  export default {
    name: 'App',
    created(){
    },
    data () {
      return{
      }
    },
      computed: {
      ...mapGetters({
        overlay: 'overlay',
      }),
    },
  }
</script>
