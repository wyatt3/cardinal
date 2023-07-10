<template>
  <draggable
    handle=".service-handle"
    v-model="services"
    v-bind="dragOptions"
    @start="drag = true"
    @end="endDrag()"
  >
    <transition-group type="transition" :name="drag ? 'flip-list' : null">
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
      drag: false,
    };
  },
  computed: {
    dragOptions() {
      return {
        animation: 200,
        group: "description",
        disabled: false,
        ghostClass: "ghost",
      };
    },
  },
  methods: {
    endDrag() {
      this.drag = false;
      this.services.forEach((service, index) => {
        service.order = index + 1;
      });
    },
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
.flip-list-move {
  transition: transform 0.5s;
}

.no-move {
  transition: transform 0s;
}
</style>
