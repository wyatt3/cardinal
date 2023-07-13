<template>
  <transition name="fade" v-if="open">
    <div class="message-modal">
      <div class="message-modal-background" @click="open = false"></div>
      <div class="message-modal-body">
        <div class="message-modal-header">
          <h3>Message from {{ message.name }}</h3>
          <button class="bg-transparent border-0" @click="open = false">
            &times;
          </button>
        </div>
        <div class="message-modal-content">
          <p>Email: {{ message.email }}</p>
          <p>Phone #: {{ message.phone }}</p>
          <p>{{ message.message }}</p>
          <div class="d-flex justify-content-end">
            <div
              class="btn btn-danger me-3 delete-button"
              @click="
                open = false;
                $emit('deleteMessage');
              "
            >
              <i class="bi bi-trash"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </transition>
</template>

<script>
export default {
  name: "MessageModal",
  props: ["message"],
  data() {
    return {
      open: false,
    };
  },
};
</script>

<style scoped>
.message-modal {
  position: fixed;
  top: 0;
  left: 0;
  z-index: 1000;
  width: 100vw;
  height: 100vh;
}

.message-modal-background {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5);
}

.message-modal-body {
  position: fixed;
  top: 50%;
  left: 50%;
  width: 80vw;
  transform: translate(-50%, -50%);
  background-color: #fff;
  border-radius: 5px;
  padding: 20px;
}

.message-modal-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.bg-transparent.border-0 {
  font-size: 1.5rem;
}

.delete-button {
  font-size: 1.15rem;
}

.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.2s ease;
}

.fade-enter,
.fade-leave-to {
  opacity: 0;
}
</style>
