<template>
  <div>
    <h1 class="text-center mt-5">Header Images</h1>
    <div class="row">
      <div
        class="file-upload col-12 col-lg-4 d-flex flex-column justify-content-between align-items-center"
        v-for="slide in slides"
        :key="slide"
      >
        <img
          class="w-100 mb-3 rounded"
          :src="previewImage[slide] ?? '/storage/img/hero' + slide + '.jpg'"
        />
        <input
          class="d-none"
          type="file"
          ref="slide"
          @change="updateMastHead(slide)"
        />
        <input
          class="btn btn-primary"
          type="button"
          value="Upload Image"
          @click="clickFileInput(slide)"
        />
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "MastHead",
  data() {
    return {
      slides: [1, 2, 3],
      previewImage: {
        1: null,
        2: null,
        3: null,
      },
      uploading: false,
    };
  },
  methods: {
    updateMastHead(id) {
      this.uploading = true;

      let image = this.$refs.slide[id - 1].files[0];
      const formData = new FormData();
      formData.append("id", id);
      formData.append("image", image);

      axios
        .post(route("masthead.update"), formData, {
          headers: {
            "Content-Type": "multipart/form-data",
          },
        })
        .then((response) => {
          if (response.status === 200) {
            this.previewImage[id] = URL.createObjectURL(image);
            this.uploading = false;
          } else {
            this.uploading = false;
            alert("Something went wrong. Please try again.");
          }
        });
    },
    clickFileInput(id) {
      this.$refs.slide[id - 1].click();
    },
  },
};
</script>

<style scoped>
</style>
