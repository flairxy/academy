<template>
  <div class="container mt-3 mb-3">
    <div class="row">
      <div class="main-content col-lg-8">
        <div class="content-area bottom-course2">
          <div>
            <div class="card-head mb-3">
              <h4 class="card-title">Profile Details</h4>
            </div>
            <ul class="nav nav-tabs mb-3" role="tablist">
              <li class="nav-item">
                <a
                  class="nav-link active show"
                  data-toggle="tab"
                  href="#personal-data"
                >Personal Data</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#password">Password</a>
              </li>
            </ul>
            <!-- .nav-tabs-line -->
            <div class="tab-content mt-4" id="profile-details">
              <div class="tab-pane fade active show" id="personal-data">
                <form @submit.prevent="updateProfile">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="input-item input-with-label">
                        <label for="full-name" class="input-item-label">Full Name</label>
                        <input
                          class="input-bordered text-white mybg"
                          type="text"
                          :value="form.name"
                        />
                      </div>
                      <!-- .input-item -->
                    </div>
                    <div class="col-md-6">
                      <div class="input-item input-with-label">
                        <label for="email-address" class="input-item-label">Email Address</label>
                        <input
                          class="input-bordered text-white"
                          type="text"
                          :value="user.email"
                          disabled
                        />
                      </div>
                      <!-- .input-item -->
                    </div>
                    <div class="col-md-6">
                      <div class="input-item input-with-label">
                        <label for="mobile-number" class="input-item-label">Mobile Number</label>
                        <input
                          v-model="form.phone"
                          class="input-bordered text-white mybg"
                          type="text"
                        />
                      </div>
                      <!-- .input-item -->
                    </div>
                    <div class="col-md-6">
                      <div class="input-item input-with-label">
                        <label for="date-of-birth" class="input-item-label">Date of Birth</label>
                        <input
                          v-model="form.dob"
                          class="input-bordered date-picker-dob mybg text-white"
                          type="date"
                        />
                      </div>
                      <!-- .input-item -->
                    </div>
                    <!-- .col -->
                    <div class="col-md-6">
                      <div class="input-item input-with-label">
                        <label for="nationality" class="input-item-label">Country</label>
                        <country-select
                          v-model="form.country"
                          :country="form.country"
                          topCountry="US"
                          class="input-bordered"
                        />
                      </div>
                      <!-- .input-item -->
                    </div>
                    <div class="col-md-6">
                      <div class="input-item input-with-label">
                        <label for="nationality" class="input-item-label">State</label>
                        <region-select
                          class="input-bordered"
                          v-model="form.state"
                          :country="form.country"
                          :region="form.state"
                        />
                      </div>
                      <!-- .input-item -->
                    </div>

                    <div class="col-md-6">
                      <div class="input-item input-with-label">
                        <label for="date-of-birth" class="input-item-label">Address</label>
                        <input
                          v-model="form.address"
                          class="input-bordered date-picker-dob mybg text-white"
                          type="text"
                        />
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="input-item input-with-label">
                        <label for="date-of-birth" class="input-item-label">Instagram Handle</label>
                        <input
                          v-model="form.instagram"
                          class="input-bordered date-picker-dob mybg text-white"
                          type="text"
                        />
                      </div>
                    </div>
                    <!-- .col -->
                  </div>
                  <!-- .row -->
                  <div class="gaps-1x"></div>
                  <!-- 10px gap -->
                  <div class="d-sm-flex justify-content-between align-items-center">
                    <button @click.prevent="updateProfile" class="btn btn-danger">Update Profile</button>
                    <div class="gaps-2x d-sm-none"></div>
                  </div>
                </form>
                <!-- form -->
              </div>
              <!-- .tab- password pane -->
              <div class="tab-pane fade" id="password">
                <form @submit.prevent="updatePassword">
                  <div class="row text-center mb-3">
                    <div class="container">
                      <div v-if="errors" class="text-danger">
                        <ul>
                          <li v-for="error in errors">{{error.toString()}}</li>
                        </ul>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="input-item input-with-label">
                        <label for="old-pass" class="input-item-label">Old Password</label>
                        <input
                          class="input-bordered"
                          type="password"
                          v-model="form2.old_password"
                          autocomplete
                        />
                      </div>
                      <!-- .input-item -->
                    </div>
                    <!-- .col -->
                  </div>
                  <!-- .row -->
                  <div class="row">
                    <div class="col-md-6">
                      <div class="input-item input-with-label">
                        <label for="new-pass" class="input-item-label">Password</label>
                        <input
                          class="input-bordered"
                          type="password"
                          v-model="form2.password"
                          autocomplete
                        />
                      </div>
                      <!-- .input-item -->
                    </div>
                    <!-- .col -->
                    <div class="col-md-6">
                      <div class="input-item input-with-label">
                        <label for="confirm-pass" class="input-item-label">Confirm Password</label>
                        <input
                          class="input-bordered"
                          type="password"
                          v-model="form2.password_confirmation"
                          autocomplete
                        />
                      </div>
                      <!-- .input-item -->
                    </div>
                    <!-- .col -->
                  </div>
                  <!-- .row -->
                  <div class="note note-plane note-info pdb-1x">
                    <em class="fas fa-info-circle"></em>
                    <p>Password should be minmum 6 letters.</p>
                  </div>
                  <div class="gaps-1x"></div>
                  <!-- 10px gap -->
                  <div class="d-sm-flex justify-content-between align-items-center">
                    <button type="submit" class="btn btn-danger">Update Password</button>
                    <div class="gaps-2x d-sm-none"></div>
                  </div>
                </form>
              </div>
              <!-- .tab-pane -->
            </div>
            <!-- .tab-content -->
          </div>
        </div>
        <br />
        <!-- .card -->
      </div>
      <!-- .col -->
      <div class="aside sidebar-right col-lg-4">
        <div class="bottom-course">
          <h6 class="card-title card-title-sm caps text-center">My Subscriptions</h6>
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
                    <th class="data-col dt-token sorting_disabled">Category</th>
                    <th class="data-col dt-amount sorting_disabled">Expires</th>
                    <th class="data-col dt-amount sorting_disabled">Amount</th>
                  </tr>
                </thead>
                <tbody>
                  <tr class="odd" role="row" v-for="subscription in subscriptions" :key="subscription.id">
                    <td class="data-col">
                      <div class="fake-class" v-for="category in categories" :key="category.id">
                        <span class="lead" v-if="category.id == subscription.category_id">{{ category.name }}</span>
                      </div>
                    </td>
                    <td class="data-col">
                      <div class="fake-class">
                        <span class="lead">{{ subscription.expires_at }}</span>
                      </div>
                    </td>
                    <td class="data-col">
                      <div class="fake-class" v-for="category in categories" :key="category.id">
                        <span class="lead" v-if="category.id == subscription.category_id">${{ category.amount }}</span>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <!-- .col -->
    </div>
    <!-- .container -->
  </div>
</template>

<script>
import { RepositoryFactory } from "../../repository/RepositoryFactory";

const AppRepository = RepositoryFactory.get("application");
export default {
  data() {
    return {
      form: new Form({
        dob: "",
        instagram: "",
        id: "",
        country: "",
        state: "",
        name: "",
        phone: "",
        address: ""
      }),
      form2: new Form({
        old_password: "",
        password: "",
        password_confirmation: ""
      }),
      user: {},
      errors: {},
      subscriptions: {},
      categories: {}
    };
  },
  methods: {
    loadUser() {
      AppRepository.loggedInUser().then(response => {
        this.user = response.data;
        let user = response.data;
        this.form.country = user.country;
        this.form.state = user.state;
        this.form.instagram = user.instagram;
        this.form.name = user.name;
        this.form.phone = user.phone;
        this.form.dob = user.dob;
        this.form.address = user.address;

        AppRepository.getSubs(user.id).then(response => {
          this.subscriptions = response.data.subscriptions;
          this.categories = response.data.categories;
        });
      });
    },
    updateProfile() {
      this.$Progress.start();
      let data = {
        country: this.country,
        state: this.region,
        instagram: this.form.instagram,
        dob: this.form.dob,
        address: this.form.address
      };
      AppRepository.updateProfile(this.form, this.user.id)
        .then(response => {
          toast.fire({
            type: "success",
            title: "Profile updated successfully"
          });
          this.$Progress.finish();
          Fire.$emit("refresh");
        })
        .catch(err => {
          toast.fire({
            type: "warning",
            title: "Failed to update Profile"
          });
        });
    },
    updatePassword() {
      this.$Progress.start();
      AppRepository.updatePassword(this.form2, this.user.id)
        .then(response => {
          $("#modal-small").modal("hide");
          toast.fire({
            type: response.data.status,
            title: response.data.message
          });
          this.$Progress.finish();
          Fire.$emit("refresh");
        })
        .catch(err => {
          if (err.response.status == 422) {
            this.errors = err.response.data.errors;
          }
          toast.fire({
            type: "warning",
            title: "Failed to update password"
          });
        });
    }
  },
  created() {
    this.loadUser();
    Fire.$on("refresh", () => {
      this.loadUser();
    });
  }
};
</script>

<style scoped>
.mybg {
  background: #0f0e17;
}
</style>
