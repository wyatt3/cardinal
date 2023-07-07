<template>
  <header class="carousel" id="home"></header>
</template>

<script>
export default {};
</script>

<style>
.carousel {
  background-image: url("/img/hero1.jpg");
  background-size: cover;
  height: 75vh;
  width: 100%;
  background-position: center;
}

@media screen and (min-width: 768px) {
  .carousel {
    background-position: center;
  }
}
</style>
