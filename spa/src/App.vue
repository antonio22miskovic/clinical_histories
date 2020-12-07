<template>
    <v-app>
        <router-view name="header"/>
        <v-row>
            <v-col cols="3">
                <router-view name="sidebar"/>
            </v-col>
            <v-col>
                <router-view/>
            </v-col>
            <div>
                <v-overlay :value="overlay">
                    <v-progress-circular
                        indeterminate
                        size="64"
                    />
                </v-overlay>
            </div>
        </v-row>
        <router-view name="footer"/>
    </v-app>
</template>
<script>
  import { mapGetters } from 'vuex'
  export default {
    name: 'App',
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