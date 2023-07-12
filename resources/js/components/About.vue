<template>
  <section class="pb-5 border-bottom">
    <span class="anchor" id="about"></span>
    <div class="container px-5 my-5">
      <div class="text-center mb-5">
        <h2 class="fw-bolder">About Us</h2>
        <p class="text-center" v-text="aboutUsText"></p>
      </div>
    </div>
  </section>
</template>

<script>
import axios from "axios";
export default {
  name: "About",
  data() {
    return {
      aboutUsText: "",
    };
  },
  created() {
    axios.get(route("about")).then((response) => {
      this.aboutUsText = response.data;
    });
  },
};
</script>

<style>
</style>
