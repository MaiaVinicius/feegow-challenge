<template>
	<ul class="professionals-list">
		<professional-card 
			:key="professional.profissional_id"
			v-for="professional in $store.state.professionals" 
			:professional="professional" 
			/>
	</ul>
</template>

<script>
import professionalCard from "@/components/professionalsList/modules/professionalCard/professionalCard.vue";

export default {
  name: 'professionalsList',
  components: {
    professionalCard
  } 
};
</script>

<style lang="sass">
@import './sass/_professionalsList'
</style>
