<template>
	<ul class="professionals-list">
		<professional-card 
			v-on:agendar="agendar(professional)"
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
  methods: {
    agendar(professional) {
    	this.$emit('agendar', professional);
    }
  },  
  components: {
    professionalCard
  } 
};
</script>

<style lang="sass">
@import './sass/_professionalsList'
</style>
