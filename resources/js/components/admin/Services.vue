<template>
  <div>
    <h1 class="mt-5">Services</h1>
    <draggable
      class="services-list mt-3 rounded bg-dark"
      handle=".service-handle"
      v-model="services"
      v-bind="dragOptions"
      @start="drag = true"
      @end="endDrag()"
    >
      <transition-group type="transition" :name="drag ? 'flip-list' : null">
        <div
          class="service-row d-flex px-3 py-2 align-items-center rounded justify-content-between"
          v-for="service in services"
          :key="service.id"
        >
          <div class="service-handle"><i class="bi bi-list"></i></div>
          <div class="service-name" v-text="service.name"></div>
          <button class="btn btn-warning" @click="openEditModal(service)">
            <i class="bi bi-pencil"></i>
          </button>
        </div>
      </transition-group>
    </draggable>
    <edit-service-modal
      @serviceUpdate="getServices()"
      ref="EditServiceModal"
    ></edit-service-modal>
  </div>
</template>

<script>
import draggable from "vuedraggable";
import EditServiceModal from "./EditServiceModal.vue";
export default {
  name: "Services",
  components: {
    EditServiceModal,
    draggable,
  },
  data() {
    return {
      services: [],
      drag: false,
      id: null,
      name: null,
      description: null,
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
        axios.post(route("services.update-order"), {
          id: service.id,
          order: service.order,
        });
      });
    },
    openEditModal(service) {
      this.$refs.EditServiceModal.id = service.id;
      this.$refs.EditServiceModal.name = service.name;
      this.$refs.EditServiceModal.description = service.description;
      this.$refs.EditServiceModal.open = true;
    },
    getServices() {
      axios.get(route("services")).then((response) => {
        this.services = response.data;
      });
    },
  },
  created() {
    this.getServices();
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

.bi-list {
  font-size: 1.4rem;
}

.service-row {
  color: #fff;
  border-bottom: 1px solid #272c31;
}

.service-row:last-of-type {
  border-bottom: none;
}
.service-row:nth-of-type(even) {
  background-color: #343a40;
}
</style>
