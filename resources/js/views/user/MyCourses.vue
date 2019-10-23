<template>
  <div class="container mt-3 mb-3">
    <div v-if="courses.length == 0">
      <div class="container">
        <h1 class="text-center">
          You have no active subscription
          <br />
          <h5>Click
          <a href="#" @click="checkout" class="cl1">here</a> to subscribe to one of our packages</h5>
        </h1>
      </div>
    </div>
    <div class="row" v-else>
      <div
        class="col-lg-4 mb-3"
        v-for="course in courses"
        :key="course.id"
        @click="visit(course.id)"
      >
        <div class="top-course">
          <h6 class="card-title card-title-sm caps">{{ course.title }}</h6>
          <p class="course-description">{{ course.description }}</p>
        </div>
        <div class="bottom-course">
          <div class="row">
            <div class="col-lg-12">
              <div class="float-left text-left">
                <a class="toggle-tigger active" href="#">
                  <img :src="avatar" alt class="author-image" />
                </a>
                <span class="author">Billonaires Code</span>
              </div>
              <span class="float-right text-right amount">${{ course.amount }}</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { RepositoryFactory } from "../../repository/RepositoryFactory";

const AppRepository = RepositoryFactory.get("application");
export default {
  data() {
    return {
      avatar: "/images/user.jpg",
      courses: {},
      user: {}
    };
  },
  methods: {
    visit(id) {
      this.$router.push({ name: "user-course", params: { id: id } });
      // this.$router.push({ name: 'adminClearances', params: { id: id } })
    },

    checkout(){
        window.location = "/checkout"
    },

    loadCourses() {
      AppRepository.loggedInUser().then(response => {
        let user = response.data;
        AppRepository.getMyCourses(user.id).then(response => {
          this.courses = response.data;
        });
      });
    }
  },

  created() {
    this.loadCourses();
  }
};
</script>
