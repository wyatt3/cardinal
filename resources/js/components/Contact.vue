<template>
  <section class="bg-light pb-5">
    <span class="anchor" id="contact"></span>
    <div class="container px-5 my-5 px-5">
      <div class="text-center mb-5">
        <h2 class="fw-bolder">Interested?</h2>
        <p class="lead mb-0">Leave us a message!</p>
      </div>
      <div class="row gx-5 justify-content-center">
        <div class="col-lg-6">
          <form
            class="position-relative"
            id="contactForm"
            :action="route('contact')"
            method="POST"
            @submit.prevent="submitContactForm"
          >
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
            <div v-if="checkRecaptcha" class="text-danger">
              Please check the reCAPTCHA
            </div>
            <div class="g-recaptcha mb-3" :data-sitekey="siteKey"></div>
            <!-- Submit Button-->
            <div class="d-grid">
              <button
                :class="{ disabled: !complete }"
                class="btn btn-primary btn-lg"
                id="submitButton"
                type="submit"
                v-html="loading ? 'Loading...' : 'Submit'"
              ></button>
            </div>
            <!-- Submit success message-->
            <transition name="fade">
              <div id="submitSuccessMessage" v-if="showSuccessMessage">
                <div class="notification-body">
                  <div class="text-center">
                    <div class="fw-bolder">Thank you for contacting us!</div>
                    We'll get back to you as soon as we can
                  </div>
                </div>
              </div>
            </transition>
            <transition name="fade">
              <div id="submitFailMessage" v-if="showFailMessage">
                <div class="notification-body">
                  <div class="text-center">
                    <div class="fw-bolder">An Error Occurred.</div>
                    Please try again later.
                  </div>
                </div>
              </div>
            </transition>
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
      loading: false,
      name: "",
      email: "",
      phone: "",
      message: "",
      showSuccessMessage: false,
      showFailMessage: false,
      checkRecaptcha: false,
      siteKey: process.env.MIX_RECAPTCHA_SITE_KEY,
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
  methods: {
    submitContactForm() {
      if (this.complete) {
        if (grecaptcha.getResponse?.().length == 0) {
          this.checkRecaptcha = true;
          setTimeout(() => {
            this.checkRecaptcha = false;
          }, 3000);
          return;
        }
        this.loading = true;
        axios
          .post(route("contact"), {
            name: this.name,
            email: this.email,
            phone: this.phone,
            message: this.message,
            recaptchaResponse: grecaptcha.getResponse(),
          })
          .then((response) => {
            this.loading = false;
            if (response.status === 200 && response.data.success == true) {
              this.name = "";
              this.email = "";
              this.phone = "";
              this.message = "";
              grecaptcha.reset();
              this.showSuccessMessage = true;
              setTimeout(() => {
                this.showSuccessMessage = false;
              }, 3000);
            } else {
              this.showFailMessage = true;
              setTimeout(() => {
                this.showFailMessage = false;
              }, 3000);
            }
          });
      }
    },
  },
};
</script>

<style scoped>
@media screen and (max-width: 500px) {
  .g-recaptcha {
    margin: auto;
    transform: scale(0.8);
    transform-origin: 0 0;
  }
}
#submitFailMessage,
#submitSuccessMessage {
  position: fixed;
  z-index: 1031;
  top: 0;
  left: 0;
  background: rgba(0, 0, 0, 0.2);
  width: 100vw;
  height: 100vh;
}

.notification-body {
  position: fixed;
  z-index: 1032;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  background: #fff;
  padding: 2rem;
  border-radius: 0.5rem;
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
