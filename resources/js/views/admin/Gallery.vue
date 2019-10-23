<template>
  <div class="container">
    <div class="col-6 col-lg-3 mb-4 mt-4">
      <a href="#" class="btn btn-danger" @click="newModal()">
        <em class="fa fa-plus"></em> New Image
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
                    <th class="data-col dt-token sorting_disabled">Name</th>
                    <th class="data-col dt-token sorting_disabled">Date</th>
                    <th class="data-col dt-usd-amount">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr class="odd" role="row" v-for="image in images" :key="image.id">
                    <td class="data-col dt-tnxno">
                      <div class="fake-class">
                        <span class="lead" @click="viewImage(image.id)">{{ image.name }}</span>
                      </div>
                    </td>
                    <td class="data-col dt-tnxno">
                      <div class="fake-class">
                        <span class="lead">{{ image.created_at }}</span>
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
                              <a href="#" @click="deleteImage(image.id)">
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
            <h3 class="popup-title">Upload Images(multiple)</h3>
            <br />
            <form enctype="multipart/form-data" @submit.prevent="onUpload">
              <div class="row">
                <div class="col-md-12 col-lg-12">
                  <div class="input-item input-with-label">
                    <b-form-file multiple @change="onFileChanged" accept=".jpeg, .jpg, .png, .pdf">
                      <template slot="file-name" slot-scope="{ names }">
                        <b-badge variant="dark">{{ names[0] }}</b-badge>
                        <b-badge
                          v-if="names.length > 1"
                          variant="dark"
                          class="ml-1"
                        >+ {{ names.length - 1 }} More files</b-badge>
                      </template>
                    </b-form-file>
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

    <div class="modal fade" id="modal-small1" tabindex="-1">
      <div class="modal-dialog modal-dialog-sm modal-dialog-centered">
        <div class="modal-content">
          <a href="#" class="modal-close" data-dismiss="modal" aria-label="Close">
            <em class="ti ti-close"></em>
          </a>
          <div class="popup-body">
            <div class="container">
              <div class="modal-body mb-0 p-0 mt-3">
                <img :src="location + image.name" alt="..." />
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
      location: "/gallery/",
      images: {},
      image: {},
      userFiles: [],
      files: [],
      form: new Form({
        id: "",
        title: ""
      })
    };
  },
  methods: {
    viewImage(id) {
      $("#modal-small1").modal("show");
      let images = this.images;
      images.map(image => {
        if (image.id == id) {
          this.image = image;
        }
      });
    },
    onFileChanged(event) {
      let uploadedFiles = event.target.files;
      for (let i = 0; i < uploadedFiles.length; i++) {
        this.files.push(uploadedFiles[i]);
      }
    },
    onUpload() {
      const formData = new FormData();
      for (let i = 0; i < this.files.length; i++) {
        let filename = this.files[i];
        formData.append("filename[" + i + "]", filename);
      }
      AppRepository.uploadFiles(formData)
        .then(() => {
          Fire.$emit("refresh");
          $("#modal-small").modal("hide");
          toast.fire({
            type: "success",
            title: "File upload successful"
          });
        })
        .catch(() => {
          toast({
            type: "warning",
            title: "Failed to upload file"
          });
        });
    },
    newModal() {
      this.form.reset();
      $("#modal-small").modal("show");
    },
    loadImages() {
      AppRepository.getImages().then(response => {
        this.images = response.data;
      });
    },
    uploadImages() {
      this.$Progress.start();
      AppRepository.uploadImages(this.form)
        .then(response => {
          $("#modal-small").modal("hide");
          toast.fire({
            type: "success",
            title: "Images Uploaded successfully"
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
    deleteImage(id) {
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
            AppRepository.deleteFile(id)
              .then(response => {
                Fire.$emit("refresh");
                swal.fire("Deleted!", "Image deleted successfully", "success");
              })
              .catch(error => {
                swal("Failed!", "There was something wrong.", "warning");
              });
          }
        });
    }
  },

  created() {
    this.loadImages();
    Fire.$on("refresh", () => {
      this.loadImages();
    });
  }
};
</script>
