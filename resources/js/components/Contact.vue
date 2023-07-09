<template>
  <section class="bg-light pb-5">
    <span class="anchor" id="contact"></span>
    <div class="container px-5 my-5 px-5">
      <div class="text-center mb-5">
        <h2 class="fw-bolder">Contact Us</h2>
        <p class="lead mb-0">We'd love to hear from you</p>
      </div>
      <div class="row gx-5 justify-content-center">
        <div class="col-lg-6">
          <form id="contactForm" :action="route('contact')">
            <!-- Name input-->
            <div class="form-floating mb-3">
              <input
                class="form-control"
                id="name"
                type="text"
                placeholder="Enter your name..."
                v-model="name"
              />
              <label for="name">Full name</label>
            </div>
            <!-- Email address input-->
            <div class="form-floating mb-3">
              <input
                class="form-control"
                id="email"
                type="email"
                placeholder="name@example.com"
                v-model="email"
              />
              <label for="email">Email address</label>
            </div>
            <!-- Phone number input-->
            <div class="form-floating mb-3">
              <input
                class="form-control"
                id="phone"
                type="tel"
                placeholder="(123) 456-7890"
                v-model="phone"
              />
              <label for="phone">Phone number</label>
            </div>
            <!-- Message input-->
            <div class="form-floating mb-3">
              <textarea
                class="form-control"
                id="message"
                type="text"
                placeholder="Enter your message here..."
                style="height: 10rem"
                v-model="message"
              ></textarea>
              <label for="message">Message</label>
            </div>
            <!-- Submit success message-->
            <div class="d-none" id="submitSuccessMessage">
              <div class="text-center mb-3">
                <div class="fw-bolder">Form submission successful!</div>
              </div>
            </div>
            <!-- Submit Button-->
            <div class="d-grid">
              <button
                :class="{ disabled: !complete }"
                class="btn btn-primary btn-lg"
                id="submitButton"
                type="submit"
              >
                Submit
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
export default {
  data() {
    return {
      name: "",
      email: "",
      phone: "",
      message: "",
    };
  },
  computed: {
    complete() {
      return (
        this.name.length > 0 &&
        this.email.length > 0 &&
        this.phone.length > 0 &&
        this.message.length > 0
      );
    },
  },
};
</script>

<style>
</style>
