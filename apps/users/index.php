<?php
if (!isset($_GET['hal'])) {
  return header("location:/todolist/apps?hal=users");
}

if ($_SESSION['role_id'] != 1) {
  echo "<script>window.location='/todolist/apps';</script>";
}
?>

<div class="container px-6 mx-auto grid">
  <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
    Users
  </h2>
  <div class="mb-8">
         <a href="?hal=adduser" style="width: fit-content;"
            class="flex items-center px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
            <svg class="w-4 h-4 mr-2 -ml-1" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
               <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
               <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
               <g id="SVGRepo_iconCarrier">
                  <path
                     d="M11 8C11 7.44772 11.4477 7 12 7C12.5523 7 13 7.44771 13 8V11H16C16.5523 11 17 11.4477 17 12C17 12.5523 16.5523 13 16 13H13V16C13 16.5523 12.5523 17 12 17C11.4477 17 11 16.5523 11 16V13H8C7.44772 13 7 12.5523 7 12C7 11.4477 7.44771 11 8 11H11V8Z"
                     fill="#f4f5f7"></path>
                  <path fill-rule="evenodd" clip-rule="evenodd"
                     d="M23 4C23 2.34315 21.6569 1 20 1H4C2.34315 1 1 2.34315 1 4V20C1 21.6569 2.34315 23 4 23H20C21.6569 23 23 21.6569 23 20V4ZM21 4C21 3.44772 20.5523 3 20 3H4C3.44772 3 3 3.44772 3 4V20C3 20.5523 3.44772 21 4 21H20C20.5523 21 21 20.5523 21 20V4Z"
                     fill="#f4f5f7"></path>
               </g>
            </svg>
            <span>Add</span>
         </a>
      </div>
    <div class="w-full overflow-hidden rounded-lg shadow-xs">
      <div class="w-full overflow-x-auto">
        <table class="w-full whitespace-no-wrap">
          <thead>
            <tr
              class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
              <th class=text-center class="px-4 py-3">No</th>
              <th class="px-4 py-3">Username</th>
              <th class="px-4 py-3">Email</th>
              <th class="px-4 py-3">Roles</th>
              <th class="px-4 py-3">Actions</th>



            </tr>
          </thead>
          <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
            <tr class="text-gray-700 dark:text-gray-400">

              <?php
              $no = 1;
              $tampil = mysqli_query($koneksi, "SELECT * FROM users");
              while ($data = mysqli_fetch_array($tampil)) {


                ?>

              <tr style="text-transform:capitalize;"
                class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                <th class="text-center">
                  <?php echo $no++ ?>
                </th>

                <td>
                  <p class="px-4 py-3 text-sm">
                    <?php echo $data['username']; ?>
                  </p>
                </td>
                <td>
                  <p class="px-4 py-3 text-sm">
                    <?php echo $data['email']; ?>
                  </p>
                </td>
                <td>
                  <p class="px-4 py-3 text-sm">
                    <?php echo $data['role_id']; ?>
                  </p>
                </td>


                <td>
                  <?php
                  if ($data['id'] != $_SESSION['user_id']):
                    ?>
                    <div class="flex items-center space-x-1 text-sm">
                      <a href="/todolist/apps/?hal=edituser&id=<?= $data['id'] ?>">
                        <button
                          class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                          aria-label="Edit">
                          <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                            <path
                              d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z">
                            </path>
                          </svg>
                        </button>
                      </a>




                      <form action="?hal=deluser" method="post">
                                 <input type="hidden" name="id" value="<?= $data["id"] ?>">
                                 <button type="submit" name="hapus"
                                    onclick="return confirm('Yakin ingin menghapus user <?= $data['id'] ?>?');"
                                    class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                                    aria-label="Delete">
                                    <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                       <path fill-rule="evenodd"
                                          d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                          clip-rule="evenodd"></path>
                                    </svg>
                                 </button>
                              </form>
                      <?php
                  endif;
                  ?>
                </td>
              </tr>
              <?php
              }
              ?>

            </tr>
          </tbody>
        </table>
      </div>
    </div>

</div>