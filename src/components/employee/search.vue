<template lang="html">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="search-box">
      <input type="text" class="search-bar" :value="searchQuery">
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
.search-box {
    background-color: #ffffff;
    padding: 20px;
    -webkit-box-shadow: 0 1px 4px rgba(0, 0, 0, 0.3);
    box-shadow: 0 1px 4px rgba(0, 0, 0, 0.3);
    margin-top: -50px;
}

.search-bar {
    width: 100%;
    border: 1px solid #8b8b8b;
    padding: 20px;
}
</style>
