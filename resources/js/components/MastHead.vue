<template>
  <header class="carousel" id="home">
    <transition name="fade" v-for="slide in slides" :key="slide.index">
      <img
        class="carousel-image"
        :style="{ backgroundImage: 'url(' + slide + ')' }"
        v-if="currentSlide === slides.indexOf(slide)"
      />
    </transition>
  </header>
</template>

<script>
export default {
  name: "MastHead",
  data() {
    return {
      currentSlide: 0,
      interval: 10000,
      slides: [
        "/storage/img/hero1.jpg",
        // "/storage/img/hero2.jpg",
        // "/storage/img/hero3.jpg",
      ],
    };
  },
  mounted() {
    setInterval(() => {
      this.currentSlide =
        this.currentSlide + 1 === this.slides.length
          ? 0
          : this.currentSlide + 1;
    }, this.interval);
  },
};
</script>

<style scoped>
.carousel {
  position: relative;
  overflow: hidden;
  height: 75vh;
  width: 100%;
}
.carousel-image {
  position: absolute;
  top: 0;
  background-size: cover;
  height: 75vh;
  width: 100%;
  background-position: center;
}

.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.5s ease-in-out;
}

.fade-enter,
.fade-leave-to {
  opacity: 0;
}
</style>
