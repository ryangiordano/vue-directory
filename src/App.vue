<template>
<div id="app">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-2" style="margin-top:100px">
<add-employee></add-employee>
            </div>
        </div>
        <!-- <button type="button" name="button" @click="seedDB">Seed DB</button> -->
        <div class="row">

            <div class="col-md-3" v-for="entry in data">
                <button type="button" name="button" class="btn btn-default" @click="deleteEmployee(entry)">Delete</button> {{entry.firstName}} {{entry.lastName}}

                <br /><img :src="`/api/src/assets/images/ryan/${entry.img}`" alt="" style="height:150px;">
            </div>
        </div>

    </div>
</div>
</template>

<script>
import AddEmployee from './components/add-employee.vue';
export default {
    name: 'app',
    components:{addEmployee:AddEmployee},
    data() {
      return{
                data: null,
      }
    },
    methods: {
        deleteEmployee(employee) {
            let formData = new FormData();
            formData.append('img', employee.img);
            formData.append('id', employee.id);
            this.$http.post('http://localhost:151/api/routes/employees/delete.php', formData, {
                    emulateJSON: true
                })
                .then(response => {
                    if (response.ok) {
                      console.log(response.bodyText);
                        this.get();
                        console.log("Employee removed successfully");
                    } else {
                        console.error('there was an error')
                    }
                })
        },
        seedDB() {
            // this.$http.get('http://www.gocodigo.com/temporarypages/giordano/vue-directory/api/routes/employees.php')
            this.$http.get('http://localhost:151/api/routes/employees/seed-employees.php') //codigo local host
                // this.$http.get('http://localhost/api/routes/employees/seed.employees.php') //home local host
                .then(response => {
                    console.log(response.bodyText);
                    this.get();
                    this.data = JSON.parse(response.bodyText);
                })
        },
        get() {
            // this.$http.get('http://www.gocodigo.com/temporarypages/giordano/vue-directory/api/routes/employees.php')
            this.$http.get('http://localhost:151/api/routes/employees/get-post.php')
                // this.$http.get('http://localhost/api/routes/employees/get-post.php')
                .then(response => {
                    console.log(response.body);
                    this.data = JSON.parse(response.bodyText);
                })
        },

    },
    mounted() {
        this.get();

    }

}
</script>

<style>
input[type="file"] {
    display: block;
}
</style>
