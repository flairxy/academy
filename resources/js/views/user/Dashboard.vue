<template>
  <div class="container mt-3 mb-3">
    <div class="row">
      <div class="col-lg-4 mb-3" v-for="course in courses" :key="course.id" @click="visit(course.id)">
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
      courses: {}
    };
  },
  methods: {
    visit(id) {
      this.$router.push({ name: "user-course", params: { id: id } });
      // this.$router.push({ name: 'adminClearances', params: { id: id } })
    },

    loadCourses() {
      AppRepository.getCourses().then(response => {
        this.courses = response.data;
      });
    }
  },

  created() {
    this.loadCourses();
  }
};
</script>
