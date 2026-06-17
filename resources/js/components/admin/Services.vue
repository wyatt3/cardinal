<template>
  <div>
    <h1 class="mt-5">Services</h1>
    <draggable
      class="services-list mt-3 rounded bg-light"
      handle=".service-handle"
      v-model="services"
      group="description"
      ghost-class="ghost"
      @start="drag = true"
      @end="endDrag()"
    >
      <template #item="{ element: service }">
        <div class="service-row d-flex px-3 py-2 align-items-center rounded justify-content-between">
          <div class="service-handle"><i class="bi bi-list"></i></div>
          <div class="service-name" v-text="service.name"></div>
          <button class="btn btn-warning" @click="$refs.EditServiceModal.openModal(service)">
            <i class="bi bi-pencil"></i>
          </button>
        </div>
      </template>
    </draggable>
    <edit-service-modal @serviceUpdate="getServices()" ref="EditServiceModal"></edit-service-modal>
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
      return {};
    },
  },
  methods: {
    endDrag() {
      this.drag = false;
      this.services.forEach((service, index) => {
        service.order = index + 1;
        axios.post(this.route("services.update-order"), {
          id: service.id,
          order: service.order,
        });
      });
    },
    openEditModal(service) {
      this.$refs.EditServiceModal.id = service.id;
      this.$refs.EditServiceModal.name = service.name;
      this.$refs.EditServiceModal.description = service.description;
      this.$refs.EditServiceModal.image = service.image;
      this.$refs.EditServiceModal.open = true;
    },
    getServices() {
      axios.get(this.route("services")).then((response) => {
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

.bi-list {
  font-size: 1.4rem;
}

.service-row {
  border-bottom: solid 1px rgb(222, 226, 230);
}

.service-row:nth-of-type(odd) {
  background-color: rgba(0, 0, 0, 0.05);
}
</style>
