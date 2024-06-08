<?php
require_once('./config/konfigurasi.php');
session_start();
if (isset($_SESSION['status_login']) && $_SESSION['status_login'] == true) {
   return header("location: /todolist/apps");
}

$title = '';
$page  = '';

if (isset($_GET['hal']) && $_GET['hal'] == 'register') {
   $title = 'Register';
   $page  = 'register.php';

   if (isset($_POST['btn_register'])) {
      $username        = $_POST['username'];
      $nama            = $_POST['nama'];
      $email           = $_POST['email'];
      $password        = $_POST['password'];
      $confirmPassword = $_POST['confirm_password'];

      if (empty($username)) {
         echo "<script>alert('Username tidak boleh kosong!!!')</script>";
      }
      elseif (empty($email)) {
         echo "<script>alert('Email tidak boleh kosong!!!')</script>";
      }
      elseif (empty($password)) {
         echo "<script>alert('Password tidak boleh kosong!!!')</script>";
      }
      elseif ($confirmPassword != $password) {
         echo "<script>alert('Konfirmasi password tidak sama!!!')</script>";
      }
      else {


         $password = md5($password);

         $query = mysqli_query($koneksi, "INSERT INTO users (username, nama, email, password, role_id) VALUES ('$username', '$nama', '$email', '$password', 2)");
         if ($query) {
            session_start();
            echo "<script>
                     alert('Akun berhasil dibuat.');
                     window.location='/todolist';
                  </script>";
         }
         else {
            echo "<script>alert('Username atau Password salah!')</script>";
         }
      }
   }
}
else {
   $title = 'Login';
   $page  = 'login.php';

   if (isset($_POST['btn_login'])) {
      $username = $_POST['username'];
      $password = $_POST['password'];

      if (empty($username)) {
         echo "<script>alert('Username tidak boleh kosong!!!')</script>";
      }
      elseif (empty($password)) {
         echo "<script>alert('Password tidak boleh kosong!!!')</script>";
      }
      else {


         $query = mysqli_query($koneksi, "SELECT * FROM users WHERE username = '" . $username . "' AND password = '" . md5($password) . "'");
         if (mysqli_num_rows($query) > 0) {
            $data_login = mysqli_fetch_array($query);

            // membuat sesi
            session_start();
            $_SESSION['status_login'] = true;
            $_SESSION['user_id']      = $data_login['id'];
            $_SESSION['role_id']      = $data_login['role_id'];
            $_SESSION['username']     = $data_login['username'];
            $_SESSION['nama']         = $data_login['nama'];
            $_SESSION['email']        = $data_login['email'];

            header("location:/todolist/apps");
         }
         else {
            echo "<script>alert('Username atau Password salah!')</script>";
         }
      }
   }
}
?>

<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">

<head>
   <meta charset="UTF-8" />
   <meta name="viewport" content="width=device-width, initial-scale=1.0" />
   <title>
      <?= $title ?> - Todolist
   </title>
   <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
   <link rel="stylesheet" href="assets/css/tailwind.output.css" />
   <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
   <script src="assets/js/init-alpine.js"></script>
</head>

<body>
   <div class="flex items-center min-h-screen p-6 bg-gray-50 dark:bg-gray-900">
      <div class="flex-1 h-full max-w-4xl mx-auto overflow-hidden bg-white rounded-lg shadow-xl dark:bg-gray-800">
         <button class="mt-4 ml-4 absolute rounded-md focus:outline-none focus:shadow-outline-purple dark:text-gray-200"
            @click="toggleTheme" aria-label="Toggle color mode">
            <template x-if="!dark">
               <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                  <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
               </svg>
            </template>
            <template x-if="dark">
               <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd"
                     d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"
                     clip-rule="evenodd"></path>
               </svg>
            </template>
         </button>
         <?php
         include($page);
         ?>
      </div>
   </div>
</body>

</html>