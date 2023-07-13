<template>
  <div>
    <h1 class="mt-5">Messages</h1>
    <table class="table table-dark table-striped">
      <thead>
        <th>Name</th>
        <th>Email</th>
        <th>Phone #</th>
        <th>Message</th>
        <th>Created At</th>
        <th>Delete</th>
      </thead>
      <tbody>
        <tr v-for="message in messages" :key="message.id">
          <td>{{ message.name }}</td>
          <td>{{ message.email }}</td>
          <td>{{ message.phone }}</td>
          <td>
            <button class="fake-link" @click="showMessage(message)">
              View Message
            </button>
          </td>
          <td>{{ message.created_at }}</td>
          <td>
            <button class="btn btn-danger" @click="deleteMessage(message.id)">
              <i class="bi bi-trash"></i>
            </button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import axios from "axios";
export default {
  name: "Messages",
  data() {
    return {
      messages: [],
      currentMessage: null,
    };
  },
  created() {
    axios.get(route("messages")).then((response) => {
      this.messages = response.data;
    });
  },
  methods: {
    showMessage(message) {
      this.currentMessage = message;
    },
    deleteMessage(id) {
      axios.delete(route("messages.delete", id)).then((response) => {
        this.messages = this.messages.filter((message) => message.id != id);
      });
    },
  },
};
</script>

<style>
.fake-link {
  background: none;
  border: none;
  color: #fff;
  text-decoration: underline;
  cursor: pointer;
}
</style>
