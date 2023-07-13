<template>
  <section class="px-5 border-bottom">
    <div class="container px-5 my-5 px-5">
      <div class="text-center mb-5">
        <h2 class="fw-bolder">Customer testimonials</h2>
        <p class="lead mb-0">Our customers love working with us</p>
      </div>
      <div class="row gx-5 justify-content-center">
        <div
          class="col-lg-6"
          v-for="testimonial in testimonials"
          :key="testimonial.index"
        >
          <!-- Testimonial 1-->
          <div class="card mb-4">
            <div class="card-body p-4">
              <div class="d-flex">
                <div class="flex-shrink-0">
                  <i class="bi bi-chat-right-quote-fill text-primary fs-1"></i>
                </div>
                <div class="ms-4">
                  <p class="mb-1">
                    Thank you for putting together such a great product. We
                    loved working with you and the whole team, and we will be
                    recommending you to others!
                  </p>
                  <div class="small text-muted">- Client Name, Location</div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
export default {
  name: "Testimonials",
  data() {
    return {
      testimonials: [
        {
          index: 1,
          name: "Client Name",
          location: "Location",
          text: "Thank you for putting together such a great product. We loved working with you and the whole team, and we will be recommending you to others!",
        },
        {
          index: 2,
          name: "Client Name",
          location: "Location",
          text: "Thank you for putting together such a great product. We loved working with you and the whole team, and we will be recommending you to others!",
        },
        {
          index: 3,
          name: "Client Name",
          location: "Location",
          text: "Thank you for putting together such a great product. We loved working with you and the whole team, and we will be recommending you to others!",
        },
      ],
    };
  },
};
</script>

<style>
</style>
