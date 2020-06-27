<template>
  <div class="container">
    <div class="w-auto">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Daftar Pengguna / Akun</h3>

          <div class="card-tools">
            <button class="btn btn-primary" data-toggle="modal" data-target="#addNew">
              <i class="fas fa-edit fa-fw"></i>
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
              <tr>
                <td>183</td>
                <td>John Doe</td>
                <td>11-7-2014</td>
                <td>
                  <span class="tag tag-success">Approved</span>
                </td>
                <td>Bacon ipsumfatback doner.</td>
                <td>Bacon ipsumfatback doner.</td>
                <td>
                  <button class="btn btn-sm btn-success">
                    <i class="fas fa-edit fa-fw"></i>
                    Edit
                  </button>
                  <button class="btn btn-sm btn-danger">
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
          <form @submit.prevent="tambahUser">
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
                <select
                  class="form-control"
                  v-model="form.type"
                  name="type"
                  :class="{ 'is-invalid': form.errors.has('type') }"
                >
                  <option>- pilih tipe User -</option>
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
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-primary">Tambah</button>
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
      form: new Form({
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
    tambahUser() {
      this.form.post("api/user");
    }
  },
  mounted() {
    console.log("Component mounted.");
  }
};
</script>
