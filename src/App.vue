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
                        <div class="form-group">
                            <label for="image" class="col-lg-2 control-label">Image Link</label>
                            <div class="col-lg-10">
                                <div class="" v-if="image">
                                    <img :src="image" height="150px;" />
                                    <button type="button" name="button" @click="removeImage">Remove Image</button>
                                    <button type="button" name="button" @click="submitImage">Submit Image</button>
                                </div>
                                <div v-if="!image"><input type="file" @change="onFileChange"></div>
                                <!-- <input type="text" class="form-control" v-model="entry.img"id="img" placeholder="img"> -->
                            </div>
                        </div>

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
            <button type="button" name="button" @click="get">Get</button>
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
            var files = e.target.files || e.dataTransfer.files;
            if (!files.length)
                return;
            this.createImage(files[0]);
        },
        createImage(file) {
            var image = new Image();
            var reader = new FileReader();
            var vm = this;

            reader.onload = (e) => {
                vm.image = e.target.result;
            };

            reader.readAsDataURL(file);
        },
        removeImage: function(e) {
            this.image = '';
        },
        submitImage(e){
          let formData = new FormData();
          formData.append('image',(this.image));
          this.$http.post('http://localhost:151/api/routes/image.php', formData,{
                  emulateJSON: true
              })
              .then(response => {
                  if (response.ok) {
                    console.log(response);
                  } else {
                      console.error('there was an error')
                  }

              })
        },
        submit(e) {
            e.preventDefault();
            let myHeaders = new Headers();
            myHeaders.append('Content-Type', 'application/json');
            // this.$http.post('http://www.gocodigo.com/temporarypages/giordano/vue-directory/api/routes/entries.php',this.entry,[{headers:myHeaders}])
            this.$http.post('http://localhost:151/api/routes/entries.php', this.entry, {
                    emulateJSON: true
                })
                .then(response => {
                    if (response.ok) {
                        this.entry.firstName = '';
                        this.entry.lastName = '';
                        this.entry.img = '';
                    } else {
                        console.error('there was an error')
                    }

                })
            // $.post('http://www.gocodigo.com/temporarypages/giordano/vue-directory/api/routes/entries.php',this.entry,(response)=>{
            //   console.log(response);
            // });
        },
        get() {
            // this.$http.get('http://www.gocodigo.com/temporarypages/giordano/vue-directory/api/routes/entries.php')
            this.$http.get('http://localhost:151/api/routes/entries.php')
                .then(response => {

                    this.data = JSON.parse(response.bodyText)
                    console.log(this.data);
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
