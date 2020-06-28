<template>
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card card-primary card-outline">
          <div class="card-header">
            <h3 class="card-title">Daftar Surat Keluar</h3>

            <div class="card-tools">
              <button class="btn btn-outline-danger" data-toggle="modal" data-target="#addNew">
                <i class="fas fa-fw fa-file-pdf"></i>
                Rekap PDF/Print
              </button>
              <button class="btn btn-outline-success" data-toggle="modal" data-target="#addNew">
                <i class="fas fa-fw fa-file-excel"></i>
                Export Excel
              </button>
              <button class="btn btn-primary" @click="newModal">
                <i class="fas fa-fw fa-user-plus"></i>
                Tambah Surat
              </button>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
              <thead>
                <tr>
                  <th>No</th>
                  <th>No Surat</th>
                  <th>Judul</th>
                  <th>Tujuan</th>
                  <th>Tanggal Surat</th>
                  <th>Softfile</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(s_keluar, index ) in s_keluars" :key="s_keluar.id">
                  <td>{{index+1}}</td>
                  <td>{{s_keluar.no_surat}}</td>
                  <td>{{s_keluar.judul}}</td>
                  <td>{{s_keluar.tujuan}}</td>
                  <td>
                    <span class="badge badge-secondary">{{s_keluar.tgl_surat | tanggal}}</span>
                  </td>
                  <td>
                    <span class="btn btn-sm btn-outline-primary">
                      <i class="fas fa-download fa-fw"></i> Download
                    </span>
                  </td>
                  <td>
                    <button class="btn btn-sm btn-success" @click="editModal(s_keluar)">
                      <i class="fas fa-edit fa-fw"></i>
                      Edit
                    </button>
                    <button class="btn btn-sm btn-danger" @click="deleteSurat(s_keluar.id)">
                      <i class="fas fa-trash fa-fw"></i>
                      Delete
                    </button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
    </div>
    <div
      class="modal fade"
      id="addNew"
      tabindex="-1"
      role="dialog"
      aria-labelledby="addNewLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="addNewLabel">Tambah Pengguna / Akun</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form @submit.prevent="editmode ? updateSurat() : tambahSurat()">
            <div class="modal-body">
              <div class="form-group">
                <input
                  v-model="form.no_surat"
                  type="text"
                  name="no_surat"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('no_surat') }"
                  placeholder="Masukan Nomor Surat"
                />
                <has-error :form="form" field="no_surat"></has-error>
              </div>

              <div class="form-group">
                <input
                  v-model="form.judul"
                  type="text"
                  name="judul"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('judul') }"
                  placeholder="Masukan judul"
                />
                <has-error :form="form" field="judul"></has-error>
              </div>

              <div class="form-group">
                <input
                  v-model="form.tujuan"
                  type="text"
                  name="tujuan"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('tujuan') }"
                  placeholder="Masukan tujuan"
                />
                <has-error :form="form" field="tujuan"></has-error>
              </div>

              <div class="form-group">
                <input
                  v-model="form.tgl_surat"
                  type="date"
                  name="tgl_surat"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('tgl_surat') }"
                  placeholder="Masukan tgl_surat"
                />
                <has-error :form="form" field="tgl_surat"></has-error>
              </div>
              <div class="form-group">
                <textarea
                  v-model="form.keterangan"
                  name="keterangan"
                  :class="{ 'is-invalid': form.errors.has('keterangan') }"
                  class="form-control"
                  id="keterangan"
                  rows="3"
                  placeholder="Isikan Keterangan (Opsional)"
                ></textarea>
                <has-error :form="form" field="keterangan"></has-error>
              </div>

              <!-- <div class="form-group">
              <label for="photo">Foto Profil</label>
              <input type="file" class="form-control-file" id="photo" />
              </div>-->
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">
                <i class="fas fa-fw fa-ban"></i> Cancel
              </button>
              <button type="submit" v-show="editmode" class="btn btn-success">
                <i class="fas fa-fw fa-edit"></i> Update
              </button>
              <button type="submit" v-show="!editmode" class="btn btn-primary">
                <i class="fas fa-fw fa-user-plus"></i> Tambah
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      editmode: false,
      s_keluars: {},
      form: new Form({
        id: "",
        no_surat: "",
        judul: "",
        tujuan: "",
        keterangan: "",
        tgl_surat: "",
        softfile: ""
      })
    };
  },
  methods: {
    newModal() {
      this.editmode = false;
      this.form.reset();
      $("#addNew").modal("show");
    },
    editModal(s_keluar) {
      this.editmode = true;
      this.form.reset();
      $("#addNew").modal("show");
      this.form.fill(s_keluar);
    },
    loadSurat() {
      this.$Progress.start();
      axios
        .get("api/s_keluar")
        .then(({ data }) => (this.s_keluars = data.data));
      this.$Progress.finish();
    },
    tambahSurat() {
      this.$Progress.start();
      this.form
        .post("api/s_keluar")
        .then(() => {
          $("#addNew").modal("hide");
          this.$emit("afterSubmit");
          this.$Progress.finish();
          toastr.success(
            "Pengguna Berhasil di tambahkan",
            "Berhasil di daftarkan"
          );
        })
        .catch(() => {
          this.$Progress.fail();
        });
    },
    updateSurat() {
      this.$Progress.start();
      this.form
        .put("api/s_keluar/" + this.form.id)
        .then(() => {
          $("#addNew").modal("hide");
          this.$emit("afterSubmit");
          this.$Progress.finish();
          toastr.success("Data Berhasil di update", "Berhasil di update");
        })
        .catch(() => {
          this.$Progress.fail();
        });
    },
    deleteSurat(id) {
      Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
      }).then(result => {
        if (result.value) {
          this.form
            .delete("api/s_keluar/" + id)
            .then(() => {
              Swal.fire("Deleted!", "Your file has been deleted.", "success");
              this.$emit("afterSubmit");
            })
            .catch(() => {
              Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Something went wrong!",
                footer: "<a href>Why do I have this issue?</a>"
              });
            });
        }
      });
    }
  },
  created() {
    this.loadSurat();
    this.$on("afterSubmit", () => {
      this.loadSurat();
    });
  }
};
</script>
