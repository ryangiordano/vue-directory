<template lang="html">
<div class="container"style="margin-top:200px">
  <div class="row">
    <div class="col-md-6 col-md-offset-3">
  <h3 class="message" >{{message}}</h3>
      <div class="panel">
        <div class="panel-heading">
          <h3>Login</h3>
        </div>
        <div class="panel-body">
          <fieldset>
              <div class="form-group">
                  <label for="inputEmail" class="col-lg-2 control-label">Email</label>
                  <div class="col-lg-10">
                      <input type="text" class="form-control" v-model="user.email" id="email" placeholder="email">
                  </div>
              </div>
              <div class="form-group">
                  <label for="inputEmail" class="col-lg-2 control-label">Password</label>
                  <div class="col-lg-10">
                      <input type="text" class="form-control" v-model="user.password" id="password" placeholder="password">
                  </div>
              </div>

              <div class="form-group">
                  <div class="col-lg-10 col-lg-offset-2">
                      <button class="btn btn-primary" @click="submit">Submit</button>
                  </div>
              </div>
          </fieldset>
          <p class="error" v-if="errorMessage">{{this.errorMessage}}</p>
        </div>
      </div>
    </div>
  </div>
</div>
</template>

<script>
import {eventBus} from '../../main';
// import {AnimationMixin} from '../../mixins/animations';

export default {
  // mixins:[AnimationMixin],
    data: function() {
        return {
            errorMessage: null,
            user: {
                email: '',
                password: ''
            }
        }
    },
    methods: {

        submit(user) {
            let formData = new FormData();
            formData.append('email', this.user.email);
            formData.append('password', this.user.password);

            this.$http.post('http://localhost/api/routes/auth/login.php',
                formData, {
                    emulateJSON: true
                }).then(response => {
                if (response.status == 204) { //wrong password
                    this.errorMessage = "email or password is incorrect";
                } else { //successful
                    this.user.email = '';
                    this.user.password = '';
                    let responseObj = JSON.parse(response.bodyText);
                    localStorage.setItem("token", responseObj.jwt);
                    this.$store.dispatch('login', true);
                    eventBus.$emit('alert',"Successfully Logged In");
                    this.$router.push({
                        path: '/home'
                    })
                }
            })
        }
    },
    computed:{
      message(){
        eventBus.$on('loggedOut',()=>{
          return "You have successfully logged out.";
        })
      }
    }
}
</script>

<style scoped>
.error{
  color:#ee6a6a;
}
.message{
  color:#85c151;
}
</style>
