<template>
  <draggable handle=".service-handle">
    <transition-group>
      <div class="services" v-for="service in services" :key="service.id">
        <div class="service-row d-flex">
          <div class="service-handle"><i class="bi bi-list"></i></div>
          <div class="service-name" v-text="service.name"></div>
        </div>
      </div>
    </transition-group>
  </draggable>
</template>

<script>
import draggable from "vuedraggable";
export default {
  name: "Services",
  components: {
    draggable,
  },
  data() {
    return {
      services: [],
    };
  },
  created() {
    axios.get(route("services")).then((response) => {
      this.services = response.data;
    });
  },
};
</script>

<style scoped>
.service-handle {
  cursor: ns-resize;
}
</style>
