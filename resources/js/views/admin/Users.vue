<template>
  <div class="container">
    <div class="row">
      <div class="col-lg-12 mb-3">
        <div class="bottom-course2">
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
                    <th class="data-col dt-token sorting_disabled">Name</th>
                    <th class="data-col dt-token sorting_disabled">Email</th>
                    <th class="data-col dt-token sorting_disabled">Phone</th>
                    <th class="data-col dt-amount sorting_disabled">Email Status</th>
                    <th class="data-col dt-usd-amount">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr class="odd" role="row" v-for="user in users" :key="user.id">
                    <td class="data-col">
                      <div class="fake-class">
                        <span class="lead">{{ user.name }}</span>
                      </div>
                    </td>
                    <td class="data-col">
                      <div class="fake-class">
                        <span class="lead">{{ user.email }}</span>
                      </div>
                    </td>
                    <td class="data-col">
                      <div class="fake-class">
                        <span class="lead" v-if="user.phone != null">{{ user.phone }}</span>
                        <span class="lead" v-else>N/A</span>
                      </div>
                    </td>
                    <td class="data-col">
                      <span
                        class="badge badge-danger"
                        v-if="user.email_verified_at === null"
                      >Unverified</span>
                      <span class="badge badge-success" v-else>Verified</span>
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
                              <a href="#" @click="editModal(user.id)">
                                <em class="ti ti-eye"></em> View
                              </a>
                            </li>
                            <li>
                              <a href="#" @click="deleteUser(user.id)">
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
            <!-- <h3 class="popup-title">Add Content</h3> -->
            <br />
            <div>
              <div class="row">
                <div class="col-md-12 col-lg-12">
                  <div class="input-item input-with-label">
                    <label class="input-item-label">Instagram Handle</label>
                    <input
                      v-if="user.instagram != null"
                      class="input-bordered"
                      :value="user.instagram"
                      type="text"
                      disabled
                    />
                    <input v-else class="input-bordered" value="N/A" type="text" disabled />
                  </div>
                  <div class="input-item input-with-label">
                    <label class="input-item-label">Date of birth</label>
                    <input
                      v-if="user.dob != null"
                      class="input-bordered"
                      :value="user.dob"
                      type="text"
                      disabled
                    />
                    <input v-else class="input-bordered" value="N/A" type="text" disabled />
                  </div>
                  <div class="input-item input-with-label">
                    <label class="input-item-label">Country</label>

                    <country-select
                      v-if="user.country != null"
                      v-model="user.country"
                      :country="user.country"
                      topCountry="US"
                      class="input-bordered"
                    />
                    <input v-else class="input-bordered" value="N/A" type="text" disabled />
                  </div>
                  <div class="input-item input-with-label">
                    <label class="input-item-label">State</label>
                    <region-select
                      v-if="user.state != null"
                      class="input-bordered"
                      v-model="user.state"
                      :country="user.country"
                      :region="user.state"
                    />
                    <input v-else class="input-bordered" value="N/A" type="text" disabled />
                  </div>
                  <div class="input-item input-with-label">
                    <label class="input-item-label">Address</label>
                    <input
                      v-if="user.address != null"
                      class="input-bordered"
                      :value="user.address"
                      type="text"
                      disabled
                    />
                    <input v-else class="input-bordered" value="N/A" type="text" disabled />
                  </div>
                  <!-- <div class="input-item input-with-label">
                    <label class="input-item-label">Subscription Status</label>
                    <div class="select-wrapper">
                      <select class="input-bordered">
                        <option value="option-one">Activate</option>
                        <option value="option-one">Deactivate</option>
                      </select>
                    </div>
                  </div>-->
                  <div class="input-item input-with-label">
                    <a href="#" class="btn btn-danger">submit</a>
                  </div>
                </div>
              </div>
            </div>
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
      avatar: "/images/user.jpg",
      users: {},
      user: {}
    };
  },
  methods: {
    newModal() {
      $("#modal-small").modal("show");
    },
    loadUsers() {
      AppRepository.getUsers().then(response => {
        this.users = response.data;
      });
    },
    editModal(id) {
      AppRepository.getUser(id).then(response => {
        this.user = response.data;
      });
      $("#modal-small").modal("show");
    },
    deleteUser(id) {
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
            AppRepository.deleteUser(id)
              .then(response => {
                Fire.$emit("refresh");
                swal.fire("Deleted!", "User deleted successfully", "success");
              })
              .catch(error => {
                swal("Failed!", "There was something wrong.", "warning");
              });
          }
        });
    }
  },

  created() {
    this.loadUsers();
    Fire.$on("refresh", () => {
      this.loadUsers();
    });
  }
};
</script>
