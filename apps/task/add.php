<?php
if (!isset($_GET['hal'])) {
   return header("location:/todolist/apps?hal=addtask");
}

if ($_SESSION['role_id'] != 2) {
   echo "<script>window.location='/todolist/apps';</script>";
}
?>

<div class="container px-6 mx-auto grid">
   <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
      Add 
   </h2>
   <div class="p-6 bg-white rounded-lg shadow-md dark:bg-gray-800" style="margin-right: 7%; margin-left: 7%; ">
      <form method="POST" enctype="multipart/form-data">
         <label class="block text-sm">
            <span class="text-gray-700 dark:text-gray-400">Gambar</span>
            <input type="file"
               class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
               name="pic" accept="image/*" />
         </label>
         <label class="block text-sm  mt-4">
            <span class="text-gray-700 dark:text-gray-400">Judul Task</span>
            <input type="text"
               class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
               placeholder="Masukkan judul task..." name="task_name" />
         </label>
         <label class="block mt-4 text-sm">
            <span class="text-gray-700 dark:text-gray-400">
               Kategori
            </span>
            <select name="kategori_id"
               class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
               <option value="" selected disabled>Pilih Kategori</option>
               <?php
               $query = mysqli_query($koneksi, "SELECT * FROM kategori WHERE user_id = $_SESSION[user_id]");
               while ($data = mysqli_fetch_array($query)) {
                  ?>
                  <option value="<?= $data['id'] ?>">
                     <?= $data['kategori'] ?>
                  </option>
                  <?php
               }
               ?>
            </select>
            <label class="block text-sm mt-4">
               <span class="text-gray-700 dark:text-gray-400">Deadline</span>
               <input type="date"
                  class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                  name="deadline" />
            </label>
         </label>

         <!-- You should use a button here, as the anchor is only used for the example  -->
         <button type="submit"
            class="block px-4 py-2 mt-6 text-sm font-medium leading-5 text-center text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
            style="float: right;" name="simpan">
            Save
            
        </button>
        <button class="block px-4 py-2 mt-6 text-sm font-medium leading-5 text-center text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
            style="float: left;" name="batal">
        <a href="/todolist/apps?hal=task" class="btn btn-secondary">Batal</a>
        </button>
      </form>
   </div>
</div>

<?php
if (isset($_POST['simpan'])) {
   $pic        = $_FILES['pic'];
   $task       = $_POST['task_name'];
   $kategoriId = $_POST['kategori_id'];
   $deadline   = $_POST['deadline'];

   if (empty($pic)) {
      echo "<script>alert('Gambar tidak boleh kosong!!!')</script>";
   }
   elseif (empty($task)) {
      echo "<script>alert('Task tidak boleh kosong!!!')</script>";
   }
   elseif (empty($kategoriId)) {
      echo "<script>alert('Kategori tidak boleh kosong!!!')</script>";
   }
   elseif (empty($deadline)) {
      echo "<script>alert('Deadline tidak boleh kosong!!!')</script>";
   }
   else {

      $upload_dir = "../uploads/";

      if (!file_exists($upload_dir)) {
         mkdir($upload_dir, 0777, true);
      }

      $allowed_types = ["image/jpeg", "image/png"];
      $gambar_mime   = mime_content_type($pic['tmp_name']);

      if (!in_array($gambar_mime, $allowed_types)) {
         echo "<script>alert('Tipe gambar tidak diizinkan.')</script>";
      }

      $gambar_ext      = pathinfo($pic['name'], PATHINFO_EXTENSION);
      $new_gambar_name = uniqid() . "." . $gambar_ext;

      $destination = $upload_dir . $new_gambar_name;
      if (move_uploaded_file($pic['tmp_name'], $destination)) {
         $query = mysqli_query($koneksi, "INSERT INTO task (pic, task_name, kategori_id, deadline, user_id) VALUES ('$new_gambar_name', '$task', $kategoriId, '$deadline', $_SESSION[user_id])");
         if ($query) {
            session_start();
            echo '<script>
                     alert("Task Berhasil Ditambahkan.");
                     window.location="/todolist/apps/?hal=task";
                  </script>';
         }
         else {
            echo "<script>alert('Terjadi Kesalahan!')</script>";
         }
      }
      else {
         echo "<script>alert('Gambar gagal di upload.')</script>";
      }
   }
}
?>