<template>
	<v-container>
		<SalaEspera v-if="isAdmin === false"/>
		<User v-else/>
	</v-container>
</template>
<script>
import { mapGetters, mapActions} from 'vuex'
import SalaEspera from '@/components/especialista/SalaEspera/SalaEspera'
import User from '@/components/Admin/User'
	export default{
		name:'Home',
		components:{
			SalaEspera,
			User
		},
		mounted(){
			console.log(this.isAdmin)
		},
		data: () => ({

		}),
		methods:{

		},
		computed:{
			...mapGetters({
	           	isAdmin:'isAdmin'
        	}),
		}
	}
</script>