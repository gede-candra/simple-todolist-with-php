<?php
if (!isset($_GET['hal'])) {
   return header("location:/todolist/apps?hal=adduser");
}

if ($_SESSION['role_id'] != 1) {
   echo "<script>window.location='/todolist/apps';</script>";
}
?>

<div class="container px-6 mx-auto grid">
  <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
    Add 
  </h2>
  <main class="h-full pb-16 overflow-y-auto">
    <div class="container px-6 mx-auto grid">

      <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
        <form method="POST">
          <label class="block text-sm">
            <span class="text-gray-700 dark:text-gray-400">Nama Lengkap</span>
            <input type="text" name="nama"
              class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
              placeholder="Masukkan Nama" required class="form-control" />
          </label> 
          <label class="block text-sm">
            <span class="text-gray-700 dark:text-gray-400">Username</span>
            <input type="text" name="username"
              class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
              placeholder="Masukkan Username" required class="form-control" />
          </label> 
          <label class="block text-sm">
            <span class="text-gray-700 dark:text-gray-400">Email</span>
            <input type="text" name="email"
              class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
              placeholder="Masukkan Email" required class="form-control" />
          </label> 
          <label class="block text-sm">
            <span class="text-gray-700 dark:text-gray-400">Password</span>
            <input type="text" name="password"
              class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
              placeholder="Masukkan Password" required class="form-control" />
          </label> 
        <button type="submit"
            class="block px-4 py-2 mt-6 text-sm font-medium leading-5 text-center text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
            style="float: right;" name="simpan">
            Save
            
        </button>
        <button class="block px-4 py-2 mt-6 text-sm font-medium leading-5 text-center text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
            style="float: left;" name="batal">
        <a href="/todolist/apps?hal=users" class="btn btn-secondary">Batal</a>
        </button>
        </form>


        <?php
        if (isset($_POST['simpan'])) { //proses simpan data kategori
          $nama = $_POST['nama'];
          $username = $_POST['username'];
          $email = $_POST['email'];
          $password = password_hash($_POST['password'], PASSWORD_DEFAULT);




          $simpan = mysqli_query($koneksi, 'INSERT INTO users (nama,username,email,password) VALUES  ("' . $nama . '", "' . $username. '","' . $email . '","' . $password . '")');
          if ($simpan) {
            echo "<script>
                    alert('Berhasil Menambah Data Users');
                    window.location='/todolist/apps?hal=users';
                  </script>";
          }
        }
        ?>