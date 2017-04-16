<template lang="html">
  <div class="overlay">
    <div class="modal">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Modal title</h4>
          </div>
          <div class="modal-body">
            <p>One fine body…</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
}
</script>

<style scoped>
.overlay{
  background-color:rgba(0,0,0,.5);
  display:flex;
  position:absolute;
  z-index:2000;
  height:100%;
  width:100%;
  top:0;
  left:0;
  justify-content:center;
  align-items:center;
}
</style>
