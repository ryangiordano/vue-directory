<template lang="html">
<div class="container"style="margin-top:200px">
  <div class="row">
    <div class="col-md-6 col-md-offset-3">
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
        </div>
      </div>
    </div>
  </div>
</div>
</template>

<script>
export default {
  data:function(){
    return{
      user:{
        email:'',
        password:''
      }
    }
  },
  methods:{
    submit(user){
      let formData = new FormData();
      formData.append('email',this.user.email);
      formData.append('password',this.user.password);

      this.$http.post('http://localhost/api/routes/auth/login.php',
    formData,{
      emulateJSON:true
    }).then(response=>{
      if(response.ok){
        this.user.email = '';
        this.user.password = '';
        this.$router.push({
            path: '/home'
        })
        console.log(response);
      }else{
        console.log(response.statusText);
      }
    })
    }
  }
}
</script>

<style lang="css">
</style>
