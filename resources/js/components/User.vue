<template>
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card card-primary card-outline">
          <div class="card-header">
            <h3 class="card-title">Daftar Pengguna / Akun</h3>

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
                Tambah Pengguna
              </button>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Lengkap</th>
                  <th>Email</th>
                  <th>Jenis Akun</th>
                  <th>Tgl Terdaftar</th>
                  <th>Tgl Perubahan</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(user, index) in users" :key="user.id">
                  <td>{{index+1}}</td>
                  <td>{{user.name | capitalize}}</td>
                  <td>{{user.email}}</td>
                  <td>
                    <span class="badge badge-dark">{{user.type | capitalize}}</span>
                  </td>
                  <td>
                    <span class="badge badge-secondary">{{user.created_at | tanggal}}</span>
                  </td>
                  <td>
                    <span class="badge badge-secondary">{{user.updated_at | tanggal}}</span>
                  </td>
                  <td>
                    <button class="btn btn-sm btn-success" @click="editModal(user)">
                      <i class="fas fa-edit fa-fw"></i>
                      Edit
                    </button>
                    <button class="btn btn-sm btn-danger" @click="deleteUser(user.id)">
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
          <form @submit.prevent="editmode ? updateUser() : tambahUser()">
            <div class="modal-body">
              <div class="form-group">
                <input
                  v-model="form.name"
                  type="text"
                  name="name"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('name') }"
                  placeholder="Masukan Nama"
                />
                <has-error :form="form" field="name"></has-error>
              </div>

              <div class="form-group">
                <input
                  v-model="form.email"
                  type="email"
                  name="email"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('email') }"
                  placeholder="Masukan Email"
                />
                <has-error :form="form" field="email"></has-error>
              </div>

              <div class="form-group">
                <input
                  v-model="form.password"
                  type="password"
                  name="password"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('password') }"
                  placeholder="Masukan Password"
                />
                <has-error :form="form" field="password"></has-error>
              </div>

              <div class="form-group">
                <label for="type">Tipe Akun</label>
                <select
                  class="form-control"
                  v-model="form.type"
                  name="type"
                  :class="{ 'is-invalid': form.errors.has('type') }"
                >
                  <option class="font-italic" value>Pilih jenis akun</option>
                  <option value="admin">Admin</option>
                  <option value="user">User</option>
                </select>
                <has-error :form="form" field="type"></has-error>
              </div>

              <div class="form-group">
                <textarea
                  v-model="form.bio"
                  name="bio"
                  :class="{ 'is-invalid': form.errors.has('bio') }"
                  class="form-control"
                  id="bio"
                  rows="3"
                  placeholder="Isikan Biodata/Keterangan (Opsional)"
                ></textarea>
                <has-error :form="form" field="bio"></has-error>
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
      users: {},
      form: new Form({
        id: "",
        name: "",
        email: "",
        password: "",
        type: "",
        bio: "",
        photo: ""
      })
    };
  },
  methods: {
    newModal() {
      this.editmode = false;
      this.form.reset();
      $("#addNew").modal("show");
    },
    editModal(user) {
      this.editmode = true;
      this.form.reset();
      $("#addNew").modal("show");
      this.form.fill(user);
    },
    loadUsers() {
      this.$Progress.start();
      axios.get("api/user").then(({ data }) => (this.users = data.data));
      this.$Progress.finish();
    },
    tambahUser() {
      this.$Progress.start();
      this.form
        .post("api/user")
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
    updateUser() {
      this.$Progress.start();
      this.form
        .put("api/user/" + this.form.id)
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
    deleteUser(id) {
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
            .delete("api/user/" + id)
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
    this.loadUsers();
    this.$on("afterSubmit", () => {
      this.loadUsers();
    });
  }
};
</script>
