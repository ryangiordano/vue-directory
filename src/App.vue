<template>
<div id="app">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-2" style="margin-top:100px">
                <form class="form-horizontal">
                    <fieldset>
                        <div class="form-group">
                            <label for="inputEmail" class="col-lg-2 control-label">First Name</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" v-model="entry.firstName" id="firstName" placeholder="First Name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail" class="col-lg-2 control-label">Last Name</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" v-model="entry.lastName" id="lastName" placeholder="lastName">
                            </div>
                        </div>
                        <!--This is where the image happens  -->
                        <div class="form-group">
                            <label for="image" class="col-lg-2 control-label">Image Link</label>
                            <div class="col-lg-10">
                                <div class="" v-if="image">
                                    <img :src="image" height="150px;" />
                                    <button type="button" name="button" @click="removeImage">Remove Image</button>
                                </div>
                                <div v-show="!image">
                                    <form action="post" id="image-form" v-if="!reset" enctype="multipart/form-data">
                                        <input id="image-input" style="display:block" :ref="" type="file" @change="onFileChange" name="file">
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!--  End image happenings -->

                        <div class="form-group">
                            <div class="col-lg-10 col-lg-offset-2">
                                <button class="btn btn-default" @click="">Cancel</button>
                                <button class="btn btn-primary" @click="submit">Submit</button>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
        <!-- <button type="button" name="button" @click="seedDB">Seed DB</button> -->
        <div class="row">

            <div class="col-md-3" v-for="entry in data">
                <button type="button" name="button" class="btn btn-default" @click="deleteEmployee(entry)">Delete</button> {{entry.firstName}} {{entry.lastName}}

                <br /><img  :src="`/api/src/assets/images/ryan/${entry.img}`" alt="" style="height:150px;">
            </div>
        </div>

    </div>
</div>
</template>

<script>
export default {
    name: 'app',
    data() {
        return {
            entry: {
                firstName: '',
                lastName: '',
                img: ''
            },
            data: null,
            image: '',
            reset:false
        }
    },
    methods: {
        onFileChange(e) {
            //takes the base 64 string of the file
            var files = e.target.files || e.dataTransfer.files;
            if (!files.length)
                return;
            console.log(files[0]);
            this.createImage(files[0]);
        },
        createImage(file) {
            var image = new Image();
            var reader = new FileReader();
            reader.readAsDataURL(file);
            reader.onload = (e) => {
                this.image = e.target.result;
            };
        },
        removeImage: function(e) {
            this.image = false;
            this.resetImageField();
        },
        resetImageField(){
          this.reset = true;
          setTimeout(()=>{
            this.reset=false;
            //Wipes the images input field clean.  Without this, the filename still remains.
          },.500)
        },
        submitImage(employee) {
            return new Promise((resolve, reject) => {
                let formData = new FormData($('image-form')[0]);
                formData.append('file', $('#image-input')[0].files[0]);
                formData.append('uniqueId', employee.uniqueId);
                formData.append('firstName', employee.firstName);
                formData.append('lastName', employee.lastName);
                formData.append('id', employee.id);
                this.$http.post('http://localhost:151/api/routes/images/upload.php', formData, {
                        emulateJSON: true
                    })
                    .then(response => {
                        if (response.ok) {

                            resolve()
                        } else {
                            reject(response);
                        }
                    });
            })

        },
        submit(e) {
            e.preventDefault();
            this.$http.post('http://localhost:151/api/routes/employees/get-post.php', this.entry, {
                    emulateJSON: true
                })
                .then(response => {
                    if (response.ok) {
                        let submittedEmployee = response.body; //returns the employee just posted
                        console.log(submittedEmployee);
                        this.submitImage(submittedEmployee).then(data => {
                            this.get();
                        });
                        this.resetImageField();
                        this.entry.firstName = '';
                        this.entry.lastName = '';
                        this.entry.img = '';

                    } else {
                        console.error('there was an error')
                    }

                })
        },
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
