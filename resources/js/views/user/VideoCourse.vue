<template>
  <div class="container mt-3 mb-4">
    <div class="text-center">
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
          <!-- <video class="vid-player" controls>
            <source :src="course" type="video/mp4" />
          </video>-->
          <iframe
            id="vid_frame"
            class="vid-player"
            :src="course"
            frameborder="1"
            allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
            allowfullscreen
          ></iframe>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-2 col-md-12 col-sm-12"></div>
      <div class="col-md-12 col-lg-8 col-sm-12 mt-5">
        <div class="mb-5 text-center" v-if="!subscribe">
          <div class="container">
            <h5>
              Click
              <a href="#" @click="checkout" class="cl1">here</a> to subscribe to one of our packages
            </h5>
          </div>
        </div>
        <div class="float-right" id="dashboard" @click="back()"><< back to dashboard</div>
        <div class="col-lg-12 top-course2">
          <h6 class="card-title card-title-sm caps">{{ course_title }}</h6>
        </div>
        <div class="playlist-container2" id="my-scroll">
          <div class="table-wrap">
            <table
              class="data-table dt-init user-tnx dataTable no-footer"
              id="DataTables_Table_0"
              role="grid"
            >
              <tbody>
                <tr
                  class="course-item odd"
                  role="row"
                  v-for="content in course_contents"
                  :key="content.id"
                  @click="loadVideo(content.url)"
                >
                  <td class="data-col dt-tnxno">
                    <div class="d-flex align-items-center">
                      <div class="data-state">
                        <em class="course-play fa fa-play-circle fa-2x"></em>
                      </div>
                      <div class="fake-class">
                        <span class="lead tnx-id">
                          {{ content.description }} ({{ content.duration }})
                          <em
                            v-if="!content.url"
                            class="fa fa-lock"
                          ></em>
                        </span>
                      </div>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
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
      course_id: this.$route.params.id,
      course: "https://www.youtube.com/embed/5djYD8rkHZM",
      course_title: "",
      course_contents: {},
      courses: {},
      subscribe: true
    };
  },
  methods: {
    loadVideo(url) {
      if (url) {
        document.getElementById("vid_frame").src = url + "?autoplay=1";
        document.getElementById("vid_frame");
      }
    },
    loadContents() {
      AppRepository.loggedInUser().then(response => {
        let user = response.data;
        AppRepository.getCourseContents(this.course_id, user.id).then(
          response => {
            this.course_contents = response.data;
            let contents = response.data;
            if (contents[0].url == null) {
              this.subscribe = false;
            }
          }
        );
      });
    },
    back() {
      this.$router.push({ name: "user-dashboard" });
      // this.$router.push({ name: 'adminClearances', params: { id: id } })
    },

    checkout() {
      window.location = "/checkout";
    },

    loadCourses() {
      AppRepository.getCourses().then(response => {
        let courses = response.data;
        // courses.forEach(course => {
        //     if(course.id == this.course_id){
        //         this.course_title = course.title
        //     }
        // });success
        courses.map(course => {
          if (course.id == this.course_id) {
            this.course_title = course.title;
          }
        });
      });
    }
  },

  created() {
    this.loadCourses();
    this.loadContents();
  }
};
</script>
<style>
    #dashboard{
        cursor:pointer
    }
</style>
