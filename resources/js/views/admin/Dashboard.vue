<template>
  <div class="container">
    <div class="row" v-if="subs.length < 1">There are no subscriptions</div>
    <div v-else class="row">
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
                    <th class="data-col dt-token sorting_disabled">Email</th>
                    <th class="data-col dt-token sorting_disabled">Transaction ID</th>
                    <th class="data-col dt-amount sorting_disabled">Expires</th>
                    <th class="data-col dt-amount sorting_disabled">Category</th>
                    <th class="data-col dt-usd-amount">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr class="odd" role="row" v-for="sub in subs" :key="sub.id">
                    <td class="data-col">
                      <div class="fake-class" v-for="user in users" :key="user.id">
                        <span class="lead" v-if="user.id == sub.user_id">{{ user.email }}</span>
                      </div>
                    </td>
                    <td class="data-col">
                      <div class="fake-class">
                        <span class="lead">{{ sub.transaction_id }}</span>
                      </div>
                    </td>
                    <td class="data-col">
                      <div class="fake-class">
                        <span class="lead">{{ sub.expires_at }}</span>
                      </div>
                    </td>
                    <td class="data-col">
                      <div class="fake-class" v-for="cat in cats" :key="cat.id">
                        <span class="lead" v-if="cat.id == sub.category_id">{{ cat.name }}</span>
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
                              <a href="#" @click="deleteSub(sub.id)">
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
  </div>
</template>

<script>
import { RepositoryFactory } from "../../repository/RepositoryFactory";

const AppRepository = RepositoryFactory.get("application");
export default {
  data() {
    return {
      users: {},
      subs: {},
      cats: {}
    };
  },
  methods: {
    loadSubscriptions() {
      AppRepository.getAllSubs().then(response => {
        this.subs = response.data.subscriptions;
        this.cats = response.data.categories;
      });
    },
    loadUsers() {
      AppRepository.getUsers().then(response => {
        this.users = response.data;
      });
    },
    deleteSub(id) {
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
        .then(sub => {
          // Send request to the server
          if (sub.value) {
            AppRepository.deleteSubscription(id)
              .then(response => {
                Fire.$emit("refresh");
                swal.fire(
                  "Deleted!",
                  "Subscription deleted successfully",
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
    this.loadUsers();
    this.loadSubscriptions();
    Fire.$on("refresh", () => {
      this.loadUsers();
      this.loadSubscriptions();
    });
  }
};
</script>
