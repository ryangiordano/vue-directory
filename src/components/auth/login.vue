<template lang="html">
<div class="container"style="margin-top:200px">
  <div class="row">
    <div class="col-md-6 col-md-offset-3">
  <h3 class="message" >{{message}}</h3>
      <div class="panel" style="padding:20px;">
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
                      <button class="btn btn-primary" @click="submit" :disabled="!valid" >Submit</button>
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
import {
    eventBus
} from '../../main';
// import {AnimationMixin} from '../../mixins/animations';
import {UserHttp} from '../../mixins/user';
export default {
    mixins:[UserHttp],
    data: function() {
        return {
            errorMessage: null,
            user: {
                email: 'ryancodigo@gmail.com',
                password: 'password'
            }
        }
    },
    methods: {

        submit() {
          this.login();//included in the UserHttp mixin's methods
        }
    },
    computed: {
        valid() {
            if (this.user.email.length > 0 && this.user.password.length > 0) {
                return true;
            } else {
                return false;
            }

        },
        message() {
            eventBus.$on('loggedOut', () => {
                return "You have successfully logged out.";
            })
        }
    }
}
</script>

<style scoped>
.error {
    color: #ee6a6a;
}

.message {
    color: #85c151;
}

.panel {
    padding: 30px;
}

.btn {
    margin-top: 10px;
    width: 100%;
}
</style>
