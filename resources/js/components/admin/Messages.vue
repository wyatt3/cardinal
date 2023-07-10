<template>
  <div>
    <div class="message w-100" v-for="message in messages" :key="message.id">
      <button @click="deleteMessage(message.id)"></button>
    </div>
  </div>
</template>

<script>
import axios from "axios";
export default {
  name: "Messages",
  data() {
    return {
      messages: [],
    };
  },
  created() {
    axios.get(route("messages")).then((response) => {
      this.messages = response.data.messages;
    });
  },
  methods: {
    deleteMessage(id) {
      axios.delete(route("messages.delete", id)).then((response) => {
        this.messages = this.messages.filter((message) => message.id != id);
      });
    },
  },
};
</script>

<style>
</style>
