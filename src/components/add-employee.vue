<template lang="html">
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
                      <img :src="image" id="target"  />
                      <button type="button" name="button" @click="removeImage">Remove Image</button>
                  </div>
                  <div v-show="!image">
                      <form action="post" id="image-form" v-if="!reset" enctype="multipart/form-data">
                          <input id="image-input" style="display:block" :ref="" type="file" @change="onFileChange" name="file">
                      </form>
                  </div>
              </div>
              <div class="col-lg-10" v-show="false">
                <!-- display the cropped image -->
                <canvas id="canvas"></canvas>
                <input id="png" type="hidden" />
              </div>
              <!-- (x:{{crop.x}},y:{{crop.y}},x2:{{crop.x2}},y2:{{crop.y2}},h:{{crop.h}},w:{{crop.w}}) -->
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
</template>

<script>
import {eventBus} from '../main.js';
export default {
    data() {
        return {
            crop_max_width: 300,
            crop_max_height: 300,
            imageObj:'',
            entry: {
                firstName: '',
                lastName: '',
                img: ''
            },
            crop: {
                x: '',
                y: '',
                x2: '',
                y2: '',
                h: '',
                w: ''
            },
            image: '',
            reset: false
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
                setTimeout(() => {
                  $("#target, #preview").html("").append("<img src=\""+e.target.result+"\" alt=\"\" />");
                    $('#target').Jcrop({
                        trackDocument: true,
                        aspectRatio: 1,
                        setSelect: [0, 0, 200, 200],
                        onSelect: this.updateCoords,
                        onChange: this.updateCoords,
                        boxWidth: this.crop_max_width,
                        boxHeight: this.crop_max_height
                    });
                }, .500)
            };

        },
        updateCoords(c){
          this.crop.x = c.x,
          this.crop.y = c.y,
          this.crop.y2 = c.y2,
          this.crop.x2 = c.x2,
          this.crop.w = c.w,
          this.crop.h = c.h
        },
        drawCanvas(c) {
            this.imageObj = $("#target")[0];
            var canvas = $("#canvas")[0];
            canvas.width = this.crop.w;
            canvas.height = this.crop.h;

            var context = canvas.getContext("2d");
            context.drawImage(this.imageObj, this.crop.x, this.crop.y, this.crop.w, this.crop.h, 0, 0, canvas.width, canvas.height);
        },
        removeImage: function(e) {
            this.image = false;
            this.resetImageField();
        },
        resetImageField() {
            this.reset = true;
            setTimeout(() => {
                this.reset = false;
                //Wipes the images input field clean.  Without this, the filename still remains.
            }, .500)
        },
        submitImage(employee) {
            return new Promise((resolve, reject) => {

                let formData = new FormData($('image-form')[0]);
                // formData.append('file', this.imageObj);
                // this.image = this.imageObj;
                // this.image = $("#canvas")[0].toDataURL('image/jpeg');
                // console.log(this.image);
                // console.log($('#image-input')[0].files[0]);
                // $('#target').attr('src', this.imageObj);
                formData.append('file', $("#canvas")[0].toDataURL('image/jpeg'));
                formData.append('uniqueId', employee.uniqueId);
                formData.append('firstName', employee.firstName);
                formData.append('lastName', employee.lastName);
                formData.append('id', employee.id);
                this.$http.post('http://localhost/api/routes/images/upload.php', formData, {
                        emulateJSON: true
                    })
                    .then(response => {
                        if (response.ok) {
                          console.log(JSON.parse(response.bodyText));
                            resolve()
                        } else {
                            reject(response.statusText);
                        }
                    });
            })

        },
        submit(e) {
            e.preventDefault();
            this.$http.post('http://localhost/api/routes/employees/get-post.php', this.entry, {
                    emulateJSON: true
                })
                .then(response => {
                    if (response.ok) {
                        let submittedEmployee = response.body; //returns the employee just posted
                        console.log(submittedEmployee);
                        this.drawCanvas();
                        setTimeout(()=>{
                          this.submitImage(submittedEmployee).then(data => {

                          });
                          this.resetImageField();
                          this.entry.firstName = '';
                          this.entry.lastName = '';
                          this.entry.img = '';
                        },1000)


                    } else {
                        console.error('there was an error')
                    }

                })
        },
    }
}
</script>

<style lang="css">
</style>
