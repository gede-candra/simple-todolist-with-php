<?php
if (!isset($_GET['hal'])) {
  return header("location:/todolist/apps?hal=deluser");
}

if ($_SESSION['role_id'] != 2) {
  echo "<script>window.location='/todolist/apps';</script>";
}
?>


<div class="row">
  <div class="col-sm-12">
    <div class="white-box">

      <?php
      $id     = $_GET['id'];
      $tampil = mysqli_query($koneksi, "SELECT * FROM users WHERE id='$id'");
      $data   = mysqli_fetch_array($tampil);
      ?>

      <main class="h-full pb-16 overflow-y-auto">
        <div class="container px-6 mx-auto grid">
          <h4 class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300"> <br>
            Hapus Data User
          </h4>
          <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
            <form method="POST">
              <div class="form-group">
                <div class="alert alert-danger" role="alert">
                  <h6>Yakin Akan Menghapus Data User <b>
                      <?php echo $data['username'] ?>
                    </b> ?</h6>
                  <br>
                  <input type="hidden" name="id" value="<?php echo $id ?>" required class="form-control">
                  <button type="submit" name="hapus"
                    class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">


                    Hapus

                    <path
                      d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z">
                    </path>
                    </svg>
                  </button>
                  <a href="apps?hal=users" class="btn btn-secondary">Batal</a>
                </div>
              </div>
            </form>
          </div>

          <?php
          if (isset($_POST['hapus'])) { //proses hapus data user
            $id = $_POST['id'];

            $hapus = mysqli_query($koneksi, 'DELETE FROM users WHERE id="' . $id . '"');
            if ($hapus) {
              echo '
        <script>
        alert("Berhasil Menghapus Data User");
        window.location="?hal=users"; //menuju ke halaman user
        </script>
        ';
            }
          }
          ?>
        </div>
    </div>
  </div>