<template>
  <section class="bg-light pb-5 border-bottom" id="services">
    <div class="container px-5 my-5">
      <div class="text-center mb-5">
        <h2 class="fw-bolder">Services</h2>
      </div>
      <div class="row justify-content-center">
        <div
          v-for="service in services"
          :key="service.id"
          class="col-12 col-md-4"
        >
          <div class="card mb-5">
            <div class="card-body p-3">
              {{ service.name }}
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
import axios from "axios";
export default {
  name: "Services",
  data() {
    return {
      services: [],
    };
  },
  methods: {},
  created() {
    axios.get(route("services")).then((response) => {
      this.services = response.data;
    });
  },
};
</script>

<style>
</style>
