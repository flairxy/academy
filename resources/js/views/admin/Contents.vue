<template>
  <div class="container">
    <div class="col-6 col-lg-3 mb-4 mt-4">
      <a href="#" class="btn btn-danger" @click="newModal()">
        <em class="fa fa-plus"></em> New Content
      </a>
    </div>
    <div class="row">
      <div class="col-lg-12 mb-3">
        <div class="bottom-Content">
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
                    <th class="data-col dt-token sorting_disabled">Description</th>
                    <th class="data-col dt-tnxno sorting_disabled">Content Category</th>
                    <th class="data-col dt-amount sorting_disabled">Duration</th>
                    <th class="data-col dt-usd-amount">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr class="odd" role="row" v-for="content in contents" :key="content.id">
                    <td class="data-col dt-tnxno">
                      <div class="fake-class">
                        <span class="lead">{{ content.description }}</span>
                      </div>
                    </td>
                    <td class="data-col dt-token">
                      <div v-for="course in courses" :key="course.id">
                        <span class="lead" v-if="course.id == content.course_id">{{ course.title }}</span>
                      </div>
                    </td>
                    <td class="data-col">
                      <span class="lead">{{ content.duration }}</span>
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
                              <a href="#" @click="editModal(content)">
                                <em class="ti ti-check-box"></em> Edit
                              </a>
                            </li>
                            <li>
                              <a href="#" @click="deleteContent(content.id)">
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
            <h3 v-if="!editmode" class="popup-title">Add Content</h3>
            <h3 v-if="editmode" class="popup-title">Edit Content</h3>
            <br />
            <form @submit.prevent="editmode ? updateContent() : createContent()">
              <div class="row">
                <div class="col-md-12 col-lg-12">
                  <div class="input-item input-with-label">
                    <label class="input-item-label">Description</label>
                    <input
                      v-model="form.description"
                      class="input-bordered"
                      type="text"
                      placeholder="content description"
                      required
                    />
                  </div>
                  <div class="input-item input-with-label">
                    <label class="input-item-label">Content Category</label>
                    <div class="select-wrapper">
                      <select class="input-bordered" v-model="form.course_id" required>
                        <option value>Choose category</option>
                        <option
                          v-for="course in courses"
                          :key="course.id"
                          :value="course.id"
                        >{{ course.title }}</option>
                      </select>
                    </div>
                  </div>
                  <div class="input-item input-with-label">
                    <label class="input-item-label">Content URL</label>
                    <input
                      v-model="form.url"
                      class="input-bordered"
                      type="text"
                      placeholder="https://youtube.com/..."
                    />
                  </div>
                  <div class="input-item input-with-label">
                    <label class="input-item-label">Duration</label>
                    <input
                      class="input-bordered"
                      type="text"
                      v-model="form.duration"
                      placeholder="video duration (eg. 10:51)"
                    />
                  </div>
                  <div class="input-item input-with-label">
                    <button type="submit" class="btn btn-danger">submit</button>
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
      contents: {},
      form: new Form({
        id: "",
        description: "",
        course_id: "",
        url: "",
        duration: ""
      })
    };
  },
  methods: {
    newModal() {
      this.form.reset();
      $("#modal-small").modal("show");
    },
    loadCourses() {
      AppRepository.getCourses().then(response => {
        this.courses = response.data;
      });
    },
    loadContents() {
      AppRepository.getContents().then(response => {
        this.contents = response.data;
      });
    },
    createContent() {
      this.$Progress.start();
      AppRepository.createContent(this.form)
        .then(response => {
          $("#modal-small").modal("hide");
          toast.fire({
            type: "success",
            title: "Content created successfully"
          });
          this.$Progress.finish();
          Fire.$emit("refresh");
        })
        .catch(err => {
          toast.fire({
            type: "warning",
            title: "Failed to create Content"
          });
        });
    },
    editModal(Content) {
      this.editmode = true;
      this.form.reset();
      $("#modal-small").modal("show");
      this.form.fill(Content);
    },
    updateContent() {
      this.$Progress.start();
      AppRepository.updateContent(this.form, this.form.id)
        .then(response => {
          $("#modal-small").modal("hide");
          toast.fire({
            type: "success",
            title: "Content updated successfully"
          });
          this.$Progress.finish();
          Fire.$emit("refresh");
        })
        .catch(err => {
          toast.fire({
            type: "warning",
            title: "Failed to update Content"
          });
        });
    },
    deleteContent(id) {
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
        .then(Content => {
          // Send request to the server
          if (Content.value) {
            AppRepository.deleteContent(id)
              .then(response => {
                Fire.$emit("refresh");
                swal.fire(
                  "Deleted!",
                  "Content deleted successfully",
                  "success"
                );
              })
              .catch(error => {
                swal("Failed!", "There was something wrong.", "warning");
              });
          }
        });
    }
  },

  created() {
    this.loadContents();
    this.loadCourses();
    Fire.$on("refresh", () => {
      this.loadContents();
      this.loadCourses();
    });
  }
};
</script>
