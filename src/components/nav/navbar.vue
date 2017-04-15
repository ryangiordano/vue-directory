<template lang="html">
  <nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <router-link to="/" tag="a"><img class="logo" src="/src/assets/images/codigo-logo.png" alt=""></router-link>
      </div>

      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <!-- <ul class="nav navbar-nav">
          <li class="active"><a href="#">Link <span class="sr-only">(current)</span></a></li>
          <li><a href="#">Link</a></li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Dropdown <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
              <li><a href="#">Action</a></li>
              <li><a href="#">Another action</a></li>
              <li><a href="#">Something else here</a></li>
              <li class="divider"></li>
              <li><a href="#">Separated link</a></li>
              <li class="divider"></li>
              <li><a href="#">One more separated link</a></li>
            </ul>
          </li>
        </ul> -->
        <!-- <form class="navbar-form navbar-left" role="search">
          <div class="form-group">
            <input type="text" class="form-control" placeholder="Search">
          </div>
          <button type="submit" class="btn btn-default">Submit</button>
        </form> -->
        <ul class="nav navbar-nav navbar-right">
          <li><router-link to="login" v-if="!loggedIn">Login</router-link></li>

          <li @click="openDropdown" class="dropdown" v-if="loggedIn">
            <a href="#"class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{name}}
            </a>
            <transition >
              <user-drop-down v-if="dropdown" :loggedIn="loggedIn" @closeMe="!dropdown">
              </user-drop-down>
            </transition>
          </li>

        </ul>
      </div>
    </div>
  </nav>
</template>

<script>

import {
    eventBus
} from '../../main';
import userDropDown from './user-dropdown.vue';
export default {
    props: ['loggedIn'],
    data: function() {
        return {
            dropdown: false,
        }
    },
    components: {
        userDropDown: userDropDown
    },
    mixins: [],
    computed: {},
    methods: {
        logOutClicked(e) {
            e.preventDefault();
            this.logout();
        },
        openDropdown(e) {
            e.preventDefault();
            this.dropdown = !this.dropdown;
        },

    },
    computed: {
        name() {
            if (this.$store.getters.user) {
                return `${this.$store.getters.user.firstName} ${this.$store.getters.user.lastName}`;
            }
            return '';

        }
    }
}
</script>

<style scoped>
.navbar {
    padding-bottom: 0;
    margin-bottom: 0;
}

.dropdown-wrapper {
    position: relative;
}

.navbar-brand {
    padding: 10px 15px;
}

.logo {
    height: 40px;
    margin: 10px 0;
}
</style>
