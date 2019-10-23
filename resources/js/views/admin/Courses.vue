<template>
  <div class="container">
    <div class="col-6 col-lg-3 mb-4 mt-4">
      <a href="#" class="btn btn-danger" @click="newModal()">
        <em class="fa fa-plus"></em> New Course
      </a>
    </div>

    <div class="row">
      <div class="col-lg-12 mb-3">
        <div class="bottom-course">
          <div id="DataTables_Table_0_wrapper" class="dt-bootstrap4 no-footer">
            <div class="table-wrap">
              <table
                class="data-table dt-init user-tnx dataTable no-footer"
                id="DataTables_Table_0"
                role="grid"
                aria-describedby="DataTables_Table_0_info"
              >
                <thead>
                  <tr class="data-head" role="row">
                    <th class="data-col dt-tnxno sorting_disabled">Title</th>
                    <th class="data-col dt-token sorting_disabled">Description</th>
                    <th class="data-col dt-amount sorting_disabled">Category</th>
                    <th class="data-col dt-usd-amount">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr class="odd" role="row" v-for="course in courses" :key="course.id">
                    <td class="data-col dt-tnxno">
                      <div class="fake-class">
                        <span class="lead">{{ course.title }}</span>
                      </div>
                    </td>
                    <td class="data-col dt-token">
                      <span class="lead">{{ course.description }}</span>
                    </td>
                    <td class="data-col">
                      <div v-for="category in categories" :key="category.id">
                        <span
                          class="lead"
                          v-if="category.id == course.category_id"
                        >{{ category.name }}</span>
                      </div>
                    </td>
                    <td class="data-col text-left">
                      <div class="relative d-inline-block">
                        <a
                          href="#"
                          class="cl1 btn btn-lighter-alt btn-outline btn-xs btn-icon toggle-tigger"
                        >
                          <em class="ti ti-more-alt"></em>
                        </a>
                        <div class="toggle-class dropdown-content dropdown-content-top-left">
                          <ul class="dropdown-list">
                            <li>
                              <a href="#" @click="editModal(course)">
                                <em class="ti ti-check-box"></em> Edit
                              </a>
                            </li>
                            <li>
                              <a href="#" @click="deleteCourse(course.id)">
                                <em class="ti ti-trash"></em> Delete
                              </a>
                            </li>
                          </ul>
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

    <div class="modal fade" id="modal-small" tabindex="-1">
      <div class="modal-dialog modal-dialog-sm modal-dialog-centered">
        <div class="modal-content">
          <a href="#" class="modal-close" data-dismiss="modal" aria-label="Close">
            <em class="ti ti-close"></em>
          </a>
          <div class="popup-body">
            <h3 class="popup-title" v-if="!editmode">Create Course</h3>
            <h3 class="popup-title" v-if="editmode">Update Course</h3>
            <br />
            <form @submit.prevent="editmode ? updateCourse() : createCourse()">
              <div class="row">
                <div class="col-md-12 col-lg-12">
                  <div class="input-item input-with-label">
                    <label class="input-item-label">Title</label>
                    <input
                      v-model="form.title"
                      class="input-bordered"
                      type="text"
                      placeholder="course title"
                    />
                  </div>
                  <div class="input-item input-with-label">
                    <div class="input-item input-with-label">
                      <label class="input-item-label">Description</label>
                      <textarea
                        class="input-bordered input-textarea"
                        v-model="form.description"
                        placeholder="Course Description..."
                      ></textarea>
                    </div>
                  </div>
                  <div class="input-item input-with-label">
                    <label class="input-item-label">Category</label>
                    <div class="select-wrapper">
                      <select class="input-bordered" v-model="form.category_id" required>
                        <option value>Choose category</option>
                        <option
                          v-for="category in categories"
                          :key="category.id"
                          :value="category.id"
                        >{{ category.name }}</option>
                      </select>
                    </div>
                  </div>
                  <div class="input-item input-with-label">
                    <button type="submit" v-if="!editmode" class="btn btn-danger">submit</button>
                    <button type="submit" v-if="editmode" class="btn btn-danger">update</button>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
        <!-- .modal-content -->
      </div>
      <!-- .modal-dialog -->
    </div>
  </div>
</template>

<script>
import { RepositoryFactory } from "../../repository/RepositoryFactory";

const AppRepository = RepositoryFactory.get("application");
export default {
  data() {
    return {
      editmode: false,
      courses: {},
      categories: {},
      form: new Form({
        id: "",
        title: "",
        description: "",
        category_id: ""
      })
    };
  },
  methods: {
    loadCategories() {
      AppRepository.getCategories().then(response => {
        this.categories = response.data;
      });
    },
    newModal() {
      this.form.reset();
      $("#modal-small").modal("show");
    },
    loadCourses() {
      AppRepository.getCourses().then(response => {
        this.courses = response.data;
      });
    },
    createCourse() {
      this.$Progress.start();
      AppRepository.createCourse(this.form)
        .then(response => {
          $("#modal-small").modal("hide");
          toast.fire({
            type: "success",
            title: "Course created successfully"
          });
          this.$Progress.finish();
          Fire.$emit("refresh");
        })
        .catch(err => {
          toast.fire({
            type: "warning",
            title: "Failed to create course"
          });
        });
    },
    editModal(course) {
      this.editmode = true;
      this.form.reset();
      $("#modal-small").modal("show");
      this.form.fill(course);
    },
    updateCourse() {
      this.$Progress.start();
      AppRepository.updateCourse(this.form, this.form.id)
        .then(response => {
          $("#modal-small").modal("hide");
          toast.fire({
            type: "success",
            title: "Course updated successfully"
          });
          this.$Progress.finish();
          Fire.$emit("refresh");
        })
        .catch(err => {
          toast.fire({
            type: "warning",
            title: "Failed to update course"
          });
        });
    },
    deleteCourse(id) {
      swal
        .fire({
          title: "Are you sure?",
          text: "You won't be able to revert this!",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Yes, delete it!"
        })
        .then(course => {
          // Send request to the server
          if (course.value) {
            AppRepository.deleteCourse(id)
              .then(response => {
                // const courseIndex = this.courses.findIndex(
                //   p => p.id === course.id
                // );
                // this.courses.splice(courseIndex, 1);
                Fire.$emit("refresh");
                swal.fire("Deleted!", "Course deleted successfully", "success");
              })
              .catch(error => {
                swal("Failed!", "There was something wrong.", "warning");
              });
          }
        });
    }
  },

  created() {
    this.loadCourses();
    this.loadCategories();
    Fire.$on("refresh", () => {
      this.loadCourses();
    });
  }
};
</script>
