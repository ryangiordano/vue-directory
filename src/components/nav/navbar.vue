<template lang="html">
<span>  <div class="click-layer" @click="closeDropdown">

  </div>
  <nav class="navbar navbar-default navbar-fixed-top" >
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
          <li><router-link to="/login" v-if="!loggedIn">Login</router-link></li>

          <li @click="openDropdown" class="dropdown" v-if="loggedIn">
            <a href="#"class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{name}}
            </a>

          </li>
          <ul class="dropdown-menu-app" v-if="toggleDropdown">
              <li><a href="#"  @click="addEmployee">Add Employee</a></li>
              <li><a href="#">Edit Company</a></li>
              <li v-if="loggedIn"><a href="#" @click="logOutClicked">Logout</a></li>
            </ul>
        </ul>


      </div>
    </div>


  </nav></span>
</template>

<script>
import {
    eventBus
} from '../../main';
import {
    UserHttp
} from '../../mixins/user';
export default {
    props: ['loggedIn'],
    data: function() {
        return {
            toggleDropdown: false,
        }
    },
    mixins: [UserHttp],
    computed: {},
    methods: {
        logOutClicked(e) {
            e.preventDefault();
            this.logout();
        },
        openDropdown(e) {
            e.preventDefault();
            this.toggleDropdown = !this.toggleDropdown;
        },
        closeDropdown(){
          if(this.toggleDropdown){
            this.toggleDropdown = false;
          }
        },
        logOutClicked(e) {
            e.preventDefault();
            this.logout();
            this.toggleDropdown = false;
        },
        addEmployee(e) {
            e.preventDefault();
            if (this.$route.path.name !== 'home') {
                this.$router.push({
                    path: '/'
                });
                return eventBus.$emit('addEmployeeModal', true);
            }
            eventBus.$emit('addEmployeeModal', true);
        }

    },
    computed: {
        name() {
            if (this.$store.getters.user) {
                return `${this.$store.getters.user.firstName} ${this.$store.getters.user.lastName}`;
            }
            return '';

        }
    },
    created() {
        this.toggleDropdown = false;
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

.dropdown-menu-app {
    padding: 10px;
    background-color: #ffffff;
    -webkit-box-shadow: 0 1px 4px rgba(0, 0, 0, 0.3);
    box-shadow: 0 1px 4px rgba(0, 0, 0, 0.3);
    position: absolute;
    opacity: 1;
    top:50px;
    width: 200px;
    z-index: 1000;
}

.dropdown-menu-app li {
    list-style: none;
}

.dropdown-menu-app li a {
    color: #666666;
}

.dropdown-menu-app li a:hover {
    text-decoration: none;
}
.click-layer{
  position:absolute;
  height:100%;
  width:100%;
  z-index:0;

}
</style>
