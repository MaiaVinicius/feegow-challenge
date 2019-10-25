<template>
	<li class="professional-card" :id="'professional_' + this.professional.profissional_id">
		<div class="professional-card-inner">
			<div 
				v-if="this.professional.foto"
				:style="{ backgroundImage: 'url(' + this.professional.foto + ')' }" 
				class="thumbnail"></div>
			<div class="card-info">
				<h2>{{this.professional.nome}} <small v-if="this.professional.conselho &&  this.professional.documento_conselho">{{this.professional.conselho + ' ' + this.professional.documento_conselho}}</small></h2>

				<md-button class="md-raised md-accent" @click="agendar">Agendar</md-button>
			</div>
		</div>
	</li>
</template>

<script>
export default {
  name: 'professionalCard',
  props: ['professional'],
  methods: {
    agendar() {
      this.$emit('agendar', this.professional);  
    }
  },  
  data () {
    return {

    }
  }
};
</script>

<style lang="sass">
@import './sass/_professionalCard'
</style>
