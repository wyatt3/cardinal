<template>
  <transition name="fade">
    <div class="edit-modal" v-if="open">
      <div class="modal-background" @click="closeModal()"></div>
      <div
        class="edit-modal-body p-4 rounded d-flex flex-column justify-content-between"
      >
        <div class="modal-header">
          <h5 class="modal-title">Edit Service</h5>
          <button
            type="button"
            class="btn-close"
            @click="closeModal()"
          ></button>
        </div>
        <div class="modal-body">
          <form>
            <div class="mb-3">
              <div class="row">
                <div class="col-12 col-md-6">
                  <span>Current Image</span>
                  <img class="w-100 rounded" :src="'/storage/img/' + image" />
                </div>
                <div class="col-12 col-md-6" v-if="newImage">
                  <span>New Image</span>
                  <img class="w-100 rounded" :src="newImage" />
                </div>
              </div>
              <label for="image" class="form-label">Replace Image</label>
              <input
                type="file"
                class="form-control"
                ref="image"
                id="image"
                @change="previewServiceImage()"
              />
            </div>
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
            :class="{ disabled: uploading }"
            @click="updateService()"
          >
            <spinner v-if="uploading"></spinner>
            <span v-else>Save Changes</span>
          </button>
        </div>
      </div>
    </div>
  </transition>
</template>

<script>
import axios from "axios";
import spinner from "../Spinner.vue";
export default {
  name: "EditServiceModal",
  components: {
    spinner,
  },
  data() {
    return {
      open: false,
      uploading: false,
      id: null,
      name: null,
      description: null,
      image: null,
      newImage: null,
    };
  },
  methods: {
    previewServiceImage() {
      let image = this.$refs.image.files[0];
      if (!image) {
        return;
      }
      this.newImage = URL.createObjectURL(image);
    },
    updateService() {
      this.uploading = true;

      let image = this.$refs.image.files[0];

      const formData = new FormData();
      formData.append("id", this.id);
      formData.append("name", this.name);
      formData.append("description", this.description);
      if (image) {
        formData.append("image", image);
      }

      axios
        .post(route("services.update"), formData, {
          headers: {
            "Content-Type": "multipart/form-data",
          },
        })
        .then((response) => {
          this.uploading = false;
          this.closeModal();
          console.log(response.data);
          this.$emit("serviceUpdate");
        })
        .catch((error) => {
          this.uploading = false;
          alert("Something went wrong. Please try again. \n" + error);
        });
    },
    closeModal() {
      this.open = false;
      this.id = null;
      this.name = null;
      this.description = null;
      this.image = null;
      this.newImage = null;
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
