<template>
  <div
    class="file-upload col-12 col-lg-4 d-flex flex-column justify-content-between align-items-center"
  >
    <img
      class="w-100 mb-3 rounded"
      :src="previewImage ?? '/storage/img/hero' + id + '.jpg'"
    />
    <input class="d-none" type="file" ref="slide" @change="updateMastHead()" />
    <button
      class="btn btn-primary mb-3"
      @click="clickFileInput()"
      :class="{ disabled: uploading }"
    >
      <spinner class="text-light" v-if="uploading"></spinner>
      <span v-else>Upload Image</span>
    </button>
  </div>
</template>

<script>
import Spinner from "../Spinner.vue";
export default {
  name: "MastHead",
  props: ["id"],
  components: {
    Spinner,
  },
  data() {
    return {
      previewImage: null,
      uploading: false,
    };
  },
  methods: {
    updateMastHead() {
      this.uploading = true;

      let image = this.$refs.slide.files[0];
      if (!image) {
        return;
      }
      const formData = new FormData();
      formData.append("id", this.id);
      formData.append("image", image);

      axios
        .post(route("masthead.update"), formData, {
          headers: {
            "Content-Type": "multipart/form-data",
          },
        })
        .then(() => {
          this.previewImage = URL.createObjectURL(image);
          this.uploading = false;
        })
        .catch((error) => {
          this.uploading = false;
          alert("Something went wrong. Please try again. \n" + error);
        });
    },
    clickFileInput() {
      this.$refs.slide.click();
    },
  },
};
</script>

<style scoped>
</style>
