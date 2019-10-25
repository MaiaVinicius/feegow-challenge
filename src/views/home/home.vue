<template>
	<section>
		<div class="container">
			<professionals-list />
		</div>
	</section>
</template>

<script>
import professionalsList from "@/components/professionalsList/professionalsList.vue";

export default {

  name: 'home',

  data () {
    return {

    }
  },
  components: {
    professionalsList
  } 
};
</script>

<style lang="sass">
@import './sass/_home'
</style>