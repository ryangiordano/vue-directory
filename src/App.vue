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
                                    <form action="post" id="image-form" enctype="multipart/form-data">
                                        <input id="image-input" type="file" @change="onFileChange" name="file">
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
        <div class="row">
            <!-- <button type="button" name="button" @click="seedDB">Seed DB</button> -->
            <div class="col-md-6 col-md-offset-2">
                <ul>
                    <li v-for="entry in data">{{entry.firstName}} {{entry.lastName}} <img :src="entry.img" alt="" style="height:150px"></li>
                </ul>
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
            this.image = '';
        },
        submitImage(employee) {
            return new Promise((resolve, reject) => {
                let formData = new FormData($('image-form')[0]);
                formData.append('file', $('#image-input')[0].files[0]);
                for(let prop in employee){
                  formData.append(prop,employee[prop]);
                }
                this.$http.post('http://localhost/api/routes/images/upload.php', formData, {
                        emulateJSON: true
                    })
                    .then(response => {
                        if (response.ok) {
                          console.log(response.body);
                            resolve()
                        } else {
                            reject(response);
                        }
                    });
            })

        },
        submit(e) {
            e.preventDefault();
            let myHeaders = new Headers();
            myHeaders.append('Content-Type', 'application/json');
            // this.$http.post('http://www.gocodigo.com/temporarypages/giordano/vue-directory/api/routes/employees.php',this.entry,[{headers:myHeaders}])
            this.$http.post('http://localhost/api/routes/employees/get-post.php', this.entry, {
                    emulateJSON: true
                })
                .then(response => {
                    if (response.ok) {
                        let submittedEmployee = response.body;

                        this.submitImage(submittedEmployee);
                        this.entry.firstName = '';
                        this.entry.lastName = '';
                        this.entry.img = '';

                    } else {
                        console.error('there was an error')
                    }

                })
            // $.post('http://www.gocodigo.com/temporarypages/giordano/vue-directory/api/routes/employees.php',this.entry,(response)=>{
            //   console.log(response);
            // });
        },
        seedDB() {
            // this.$http.get('http://www.gocodigo.com/temporarypages/giordano/vue-directory/api/routes/employees.php')
            // this.$http.get('http://localhost:151/api/routes/seed.employees.php')//codigo local host
            this.$http.get('http://localhost/api/routes/employees/seed.employees.php') //home local host
                .then(response => {
                    this.data = JSON.parse(response.bodyText);
                    console.log(this.data);
                })
        },
        get() {
            // this.$http.get('http://www.gocodigo.com/temporarypages/giordano/vue-directory/api/routes/employees.php')//codigo local host
            this.$http.get('http://localhost/api/routes/employees/get-post.php')
                .then(response => {
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

</style>
