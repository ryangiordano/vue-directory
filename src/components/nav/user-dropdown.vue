<template lang="html">

    <ul class="dropdown">
      <li><a href="#" @click="addEmployee">Add Employee</a></li>
      <li><a href="#">Edit Company</a></li>
      <li v-if="loggedIn"><a href="#" @click="logOutClicked">Logout</a></li>
    </ul>

</template>

<script>
import {
    UserHttp
} from '../../mixins/user';

import {
    eventBus
} from '../../main';
export default {
    props: ['loggedIn'],
    mixins:[UserHttp],
    methods: {
        logOutClicked(e) {
            e.preventDefault();
            this.logout();
            this.$emit('closeMe',true);
        },
        addEmployee(e){
          e.preventDefault();
          eventBus.$emit('addEmployeeModal',true);
        }

    },
    created(){
    },
    destroyed(){
    }
}
</script>

<style scoped>
.dropdown {
    padding: 10px;
    background-color: #ffffff;
    -webkit-box-shadow: 0 1px 4px rgba(0, 0, 0, 0.3);
    box-shadow: 0 1px 4px rgba(0, 0, 0, 0.3);
    position: absolute;
    opacity: 1;
    top: 50px;
    left: 10px;
    width: 200px;
}

ul {
    padding: 0;
}
ul li{
  list-style:none;

}

ul li a {
    color: #666666;
}

ul li a:hover {
    text-decoration: none;
}
</style>
