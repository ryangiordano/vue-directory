<template>
<div id="app">
    <app-nav-bar></app-nav-bar>
    <div class="xp-bar">
        <div class="fill" :style="barFill">

        </div>
    </div>
    <transition @enter="fadeEnter" @leave="fadeLeave" mode="out-in":css="false"><router-view></router-view></transition>
</div>
</template>

<script>
import {
    eventBus
} from './main.js';
import {AnimationMixin} from './mixins/Animations';
import NavBar from './components/nav/navbar.vue';
export default {
    mixins:[AnimationMixin],
    name: 'app',
    components: {
      appNavBar: NavBar,
    },
    data() {
        return {
                duration:.2
        }
    },
    methods: {

    },
    computed:{
      barFill() {
        if(this.loading){
          return {
              width: '100%',
              opacity:1
          }
        }else{
          return {
              width: 0,
              opacity:0
          }
        }

      }
    }
  }
</script>

<style scoped>
input[type="file"] {
    display: block;
}

.xp-bar {
    width: 100%;
    height:3px;
    position:fixed;
    top:64px;
    z-index:999;
}

.xp-bar .fill {
    background-color: #A3C44E;
    height: 100%;
    transition: 2s width ease,.5s opacity ease;
}

@media (min-width: 1920px) {
    .container.main {
        width: 97%;
    }
}
</style>
