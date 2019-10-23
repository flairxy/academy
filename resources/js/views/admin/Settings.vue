<template>
  <div class="container">
    <div class="col-6 col-lg-3 mb-4 mt-4">
      <a href="#" class="btn btn-danger" @click="newModal()">
        <em class="fa fa-plus"></em> New Category
      </a>
    </div>

    <div class="row">
      <div class="col-lg-12 mb-3">
        <div class="bottom-category">
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
                    <th class="data-col dt-tnxno sorting_disabled">Name</th>
                    <th class="data-col dt-token sorting_disabled">Duration</th>
                    <th class="data-col dt-amount sorting_disabled">Amount</th>
                    <th class="data-col dt-usd-amount">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr class="odd" role="row" v-for="category in categories" :key="category.id">
                    <td class="data-col dt-tnxno">
                      <div class="fake-class">
                        <span class="lead">{{ category.name }}</span>
                      </div>
                    </td>
                    <td class="data-col dt-token">
                      <span class="lead">{{ category.duration }}</span>
                    </td>
                    <td class="data-col">
                      <span class="lead">${{ category.amount }}</span>
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
                              <a href="#" @click="editModal(category)">
                                <em class="ti ti-check-box"></em> Edit
                              </a>
                            </li>
                            <li>
                              <a href="#" @click="deleteCategory(category.id)">
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
            <h3 class="popup-title" v-if="!editmode">Create Category</h3>
            <h3 class="popup-title" v-if="editmode">Update Category</h3>
            <br />
            <form @submit.prevent="editmode ? updateCategory() : createCategory()">
              <div class="row">
                <div class="col-md-12 col-lg-12">
                  <div class="input-item input-with-label">
                    <label class="input-item-label">Name</label>
                    <input
                      v-model="form.name"
                      class="input-bordered"
                      type="text"
                      placeholder="category name"
                    />
                  </div>
                  <div class="select-wrapper">
                    <select class="input-bordered" v-model="form.duration" required>
                      <option value>Choose duration</option>
                      <option value="1">1 month</option>
                      <option value="2">2 months</option>
                      <option value="3">3 months</option>
                      <option value="4">4 months</option>
                      <option value="5">5 months</option>
                      <option value="6">6 months</option>
                      <option value="7">7 months</option>
                      <option value="8">8 months</option>
                      <option value="9">9 months</option>
                      <option value="10">10 months</option>
                      <option value="11">11 months</option>
                      <option value="12">12 months</option>
                    </select>
                  </div>
                  <div class="input-item input-with-label">
                    <label class="input-item-label">Amount</label>
                    <input
                      v-model="form.amount"
                      class="input-bordered"
                      type="number"
                      placeholder="amount"
                    />
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
      categories: {},
      form: new Form({
        id: "",
        name: "",
        duration: "",
        amount: ""
      })
    };
  },
  methods: {
    newModal() {
      this.form.reset();
      $("#modal-small").modal("show");
    },
    loadCategories() {
      AppRepository.getCategories().then(response => {
        this.categories = response.data;
      });
    },
    createCategory() {
      this.$Progress.start();
      AppRepository.createCategory(this.form)
        .then(response => {
          $("#modal-small").modal("hide");
          toast.fire({
            type: "success",
            title: "Category created successfully"
          });
          this.$Progress.finish();
          Fire.$emit("refresh");
        })
        .catch(err => {
          toast.fire({
            type: "warning",
            title: "Failed to create category"
          });
        });
    },
    editModal(category) {
      this.editmode = true;
      this.form.reset();
      $("#modal-small").modal("show");
      this.form.fill(category);
    },
    updateCategory() {
      this.$Progress.start();
      AppRepository.updateCategory(this.form, this.form.id)
        .then(response => {
          $("#modal-small").modal("hide");
          toast.fire({
            type: "success",
            title: "Category updated successfully"
          });
          this.$Progress.finish();
          Fire.$emit("refresh");
        })
        .catch(err => {
          toast.fire({
            type: "warning",
            title: "Failed to update category"
          });
        });
    },
    deleteCategory(id) {
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
        .then(category => {
          // Send request to the server
          if (category.value) {
            AppRepository.deleteCategory(id)
              .then(response => {
                // const courseIndex = this.categories.findIndex(
                //   p => p.id === category.id
                // );
                // this.categories.splice(courseIndex, 1);
                Fire.$emit("refresh");
                swal.fire(
                  "Deleted!",
                  "Category deleted successfully",
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
    this.loadCategories();
    Fire.$on("refresh", () => {
      this.loadCategories();
    });
  }
};
</script>
