 <template>
  <div
    id="wrap"
    :class="[
      ($route.meta.slug !== undefined) ? 'pg-' + $route.meta.slug : '',
      this.$route.meta.slug && this.$route.meta.slug !== 'home' ? 'pg-interna' : ''
    ]"
  >
    <scroll-area @handle-scroll="handleScroll" ref="vs">
      <app-header />
      <main class="main">
        <transition name="fade" mode="out-in">
          <router-view />
        </transition>
      </main>
    </scroll-area>
  </div>
</template>

<script>
import Vue from 'vue';
import router from "@/router";
import VueMaterial from 'vue-material';
import NProgress from 'nprogress';
import vuescroll from 'vuescroll';
import appHeader from "@/components/header/header.vue";
import axios from 'axios';
import VueAxios from 'vue-axios';
import store from "@/store";
import 'vue-material/dist/vue-material.min.css';
import 'vue-material/dist/theme/default-dark.css';
import '../node_modules/nprogress/nprogress.css';

Vue.use(VueAxios, axios);

Vue.use(VueMaterial);

Vue.use(vuescroll, {
  ops: {
    vuescroll: {
      wheelScrollDuration: 500,
      detectResize: true
    },
    scrollPanel: {
      scrollingX: false,
      scrollingY: true,
      speed: 1500,
      easing: 'easeInOutCubic'
    },
    rail: {
      keepShow: true,
      specifyBorderRadius: '0px'
    },
    bar: {
      onlyShowBarOnScroll: false,
      keepShow: true,
      background: '#599bb3',
      specifyBorderRadius: '0px'
    }
  },
  name: 'scrollArea' // customize component name, default -> vueScroll
});

export default {
  name: 'App',
  watch: {
    isLoading(value) {
      if (value) {
        NProgress.start();
      } else {
        NProgress.done();
      }
    }
  },
  mounted() {
    store.state.isLoading = true;

    axios.all([
        axios.get(`${store.state.api.url}specialties/list`,  {
        headers: {
          'x-access-token': store.state.api.token
        } 
      }), axios.get(`${store.state.api.url}professional/list`,  {
        headers: {
          'x-access-token': store.state.api.token
        } 
      }), axios.get(`${store.state.api.url}patient/list-sources`,  {
        headers: {
          'x-access-token': store.state.api.token
        } 
      })
    ])
    .then(response => {
      store.state.specialties = response[0].data.content;
      store.state.sources = response[2].data.content;

      for (const [key, value] of Object.entries(response[1].data.content)) {
        if(value.nome !== null) {
          if(store.state.professionals.some(item => item.profissional_id === value.profissional_id) === false){
            store.state.professionals.push(value);
          }            
        }
      }

      store.state.isLoading = false; 
    });  
  },
  methods: {
    handleScroll(vertical, horizontal, nativeEvent) {
    } 
  },
  computed: {
    isLoading() {
      return this.$store.state.isLoading;
    }
  },
  components: {
    appHeader
  } 
};
</script>

<style lang="sass">
@import './_style';
</style>