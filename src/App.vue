<template>
<div id="app" >
  <div class="alert-table">
    <transition-group @enter="fadeInDown" @leave="fadeLeave" mode="out-in" :css="false"><alert :message="alert.message":color="alert.color" :id="alert.id" :key="index" v-for="(alert,index) in alerts" ></alert></transition-group>
  </div>

    <app-nav-bar :loggedIn="loggedIn"></app-nav-bar>
    <div class="xp-bar">
        <div class="fill" :style="barFill">

        </div>
    </div>
    <transition @enter="fadeEnter" @leave="fadeLeave" mode="out-in" :css="false">
        <router-view ></router-view>
    </transition>
    <transition @enter="fadeEnter" @leave="fadeLeave" mode="out-in" :css="false">
        <add-employee v-if="showAddEmployeeModal" @close="showAddEmployeeModal=false"></add-employee>
    </transition>

</div>
</template>

<script>
import {
    eventBus
} from './main.js';
import {
    AnimationMixin
} from './mixins/Animations';
import {
    UserHttp
} from './mixins/user';
import NavBar from './components/nav/navbar.vue';
import AddEmployee from './components/employee/add-employee.vue';
import Alert from './components/utility/alert.vue';
export default {
    mixins: [AnimationMixin,UserHttp],
    name: 'app',
    components: {
        appNavBar: NavBar,
        alert: Alert,
        addEmployee:AddEmployee
    },
    data() {
        return {
            duration: .2,
            user:null,
            alerts:[],
            alertCount:0,
            showAddEmployeeModal:false
        }
    },
    methods: {

    },
    computed: {
        barFill() {
            if (this.loading) {
                return {
                    width: '100%',
                    opacity: 1
                }
            } else {
                return {
                    width: 0,
                    opacity: 0
                }
            }

        },
        loggedIn(){
          if(this.$store.getters.loggedIn){
            return true;
          }else{
            return false;
          }
        }
    },
    created() {
      eventBus.$on('alert',(alert)=>{
        this.alertCount++;
        alert.id = this.alertCount;
        this.alerts.unshift(alert);
        // this.alertMessage = message;
        // this.showAlert = true;
      });

      eventBus.$on('removeAlert',(id)=>{
        this.alerts.splice(this.alerts.indexOf(alert.id),1);
      })
      eventBus.$on('addEmployeeModal',(id)=>{

        this.showAddEmployeeModal=true;
      })
      //Handle the login state.
      if(localStorage.getItem('token')){
        this.$store.dispatch('login',true);
        this.getUser();
        console.log('login ='+ this.$store.getters.loggedIn);
      }else{
        console.log("token not set");
      }
    }
}
</script>

<style scoped>
input[type="file"] {
    display: block;
}
.alert-table{
  z-index:999;
  position:absolute;
  top:100px;
  right:100px;
  width:20%;
}
.xp-bar {
    width: 100%;
    height: 3px;
    position: fixed;
    top: 64px;
    z-index: 999;
}

.xp-bar .fill {
    background-color: #A3C44E;
    height: 100%;
    transition: 2s width ease, .5s opacity ease;
}

@media (min-width: 1920px) {
    .container.main {
        width: 97%;
    }
}
</style>
