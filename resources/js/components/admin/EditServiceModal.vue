<template>
  <transition name="fade">
    <div class="edit-modal" v-if="open">
      <div class="modal-background" @click="open = false"></div>
      <div
        class="edit-modal-body p-4 rounded d-flex flex-column justify-content-between"
      >
        <div class="modal-header">
          <h5 class="modal-title">Edit Service</h5>
          <button
            type="button"
            class="btn-close"
            @click="open = false"
          ></button>
        </div>
        <div class="modal-body">
          <form>
            <div class="mb-3">
              <label for="name" class="form-label">Name</label>
              <input
                type="text"
                class="form-control"
                id="name"
                v-model="name"
              />
            </div>
            <div class="mb-3">
              <label for="description" class="form-label">Description</label>
              <textarea
                class="form-control"
                id="description"
                v-model="description"
              ></textarea>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button
            type="button"
            class="btn btn-primary"
            @click="updateService()"
          >
            Save changes
          </button>
        </div>
      </div>
    </div>
  </transition>
</template>

<script>
export default {
  name: "EditServiceModal",
  data() {
    return {
      open: false,
      id: null,
      name: null,
      description: null,
    };
  },
  methods: {
    updateService() {
      axios
        .post(route("services.update"), {
          id: this.id,
          name: this.name,
          description: this.description,
        })
        .then((response) => {
          this.open = false;
          this.$emit("serviceUpdate");
        });
    },
  },
};
</script>

<style scoped>
.edit-modal {
  position: fixed;
  top: 0;
  left: 0;
  z-index: 999;
}

.modal-background {
  position: fixed;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5);
}

.edit-modal-body {
  position: fixed;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  background-color: white;
  width: 80%;
  height: 80%;
}

.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.2s;
}

.fade-enter,
.fade-leave-to {
  opacity: 0;
}
</style>
