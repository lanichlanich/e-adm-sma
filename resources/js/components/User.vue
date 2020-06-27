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
                <th>ID</th>
                <th>Nama Lengkap</th>
                <th>Email</th>
                <th>Jenis Akun</th>
                <th>Tanggal Registrasi</th>
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
          <div class="modal-body">
            <div class="form-group">
              <input type="email" class="form-control" id="name" placeholder="Masukan Nama Lengkap" />
            </div>

            <div class="form-group">
              <input
                type="email"
                class="form-control"
                id="email"
                aria-describedby="emailHelp"
                placeholder="Masukan Email"
              />
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-primary">Tambah</button>
          </div>
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
  mounted() {
    console.log("Component mounted.");
  }
};
</script>
