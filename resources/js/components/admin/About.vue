<template>
  <div>
    <h1 class="mt-5">About Us</h1>
    <div class="form-group">
      <textarea
        class="form-control"
        id="about"
        rows="5"
        v-model="about"
      ></textarea>
      <button
        class="btn btn-primary mt-2"
        @click="updateAbout()"
        :class="{ disabled: uploading }"
      >
        <spinner v-if="uploading"></spinner>
        <span v-else>Update</span>
      </button>
    </div>
  </div>
</template>

<script>
import Spinner from "../Spinner.vue";
export default {
  name: "About",
  components: {
    Spinner,
  },
  data() {
    return {
      about: "",
      uploading: false,
    };
  },
  methods: {
    updateAbout() {
      this.uploading = true;
      axios.post(route("about.update"), { about: this.about }).then(() => {
        this.uploading = false;
      });
    },
  },
  created() {
    axios.get(route("about")).then((response) => {
      this.about = response.data;
    });
  },
};
</script>
