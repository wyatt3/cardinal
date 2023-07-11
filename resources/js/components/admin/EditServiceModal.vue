<template>
  <div v-if="open"></div>
</template>

<script>
export default {
  props: ["name", "description"],
  data() {
    return {
      open: false,
    };
  },
};
</script>

<style scoped>
</style>
