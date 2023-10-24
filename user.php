<?php
include "proses/connect.php";
$query = mysqli_query($conn, "SELECT * FROM tb_user");
while ($record = mysqli_fetch_array($query)) {
    $result[] = $record;
}
?>

<div class="col-lg-9 mt-2">
    <div class="card">
        <div class="fw-bold text-white card-header" style="background-color: #85586F;">
            USER LIST
        </div>
        <div class="card-body" style="background-color: #F8EDE3;">
            <div class="row">
                <div class="col d-flex justify-content-end mb-2">
                    <button class="btn fw-bold text-light" style="background-color: #85586F;" data-bs-toggle="modal" data-bs-target="#ModalTambahUser"><i class="bi bi-plus-circle"></i> Users</button>
                </div>
            </div>
            <!-- MODAL TAMBAH USER-->
            <div class="modal fade" id="ModalTambahUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl modal-fullscreen-md-down">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Add User</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="proses/p_input_user.php" class="needs-validation" method="POST" novalidate>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="floatingInput" placeholder="Your Name" name="nama" required>
                                            <label for="floatingInput">Name</label>
                                            <div class="invalid-feedback mb-2">
                                                Input name
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-floating mb-3">
                                            <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="username" required>
                                            <label for="floatingInput">Username</label>
                                            <div class="invalid-feedback mb-2">
                                                Input valid username
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-8">
                                        <div class="form-floating mb-3">
                                            <input type="number" class="form-control" id="floatingInput" placeholder="08xxxxxxxxxx" name="nohp" required>
                                            <label for="floatingInput">Phone Number</label>
                                            <div class="invalid-feedback mb-2">
                                                Input phone number
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-floating mb-3">
                                            <select class="form-select" aria-label="Default select example" name="level" required>
                                                <option selected hidden></option>
                                                <option value="1">Admin</option>
                                                <option value="2">Cashier</option>
                                                <option value="3">Waiter</option>
                                                <option value="4">Kitchen</option>
                                                <option value="5">Guest</option>
                                            </select>
                                            <label for="floatingInput">User Level</label>
                                            <div class="invalid-feedback mb-2">
                                                Choose level
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-floating">
                                            <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password" required>
                                            <label for="floatingPassword">Password</label>
                                            <div class="invalid-feedback mb-2">
                                                Input password
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary" name="input_user_validate" value="submit">Add</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END MODAL TAMBAH USER -->
            <?php
            if (empty($result)) {
                echo "<div class='alert alert-danger'>Users have not been added, please add users first</div>";
            } else {
                foreach ($result as $row) { ?>
                    <!-- MODAL VIEW -->
                    <div class="modal fade" id="ModalView<?php echo $row['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl modal-fullscreen-md-down">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">User Details</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="proses/p_input_user.php" class="needs-validation" method="POST" novalidate>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-floating mb-3">
                                                    <input readonly type="text" class="form-control" id="floatingInput" placeholder="Your Name" name="nama" value="<?php echo $row['name']; ?>">
                                                    <label for="floatingInput">Name</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-floating mb-3">
                                                    <input readonly type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="username" value="<?php echo $row['username']; ?>">
                                                    <label for="floatingInput">Username</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-8">
                                                <div class="form-floating mb-3">
                                                    <input readonly type="text" class="form-control" id="floatingInput" placeholder="08xxxxxxxxxx" name="nohp" value="<?php echo $row['nohp']; ?>">
                                                    <label for="floatingInput">Phone Number</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-floating mb-3">
                                                    <select disabled class="form-select" aria-label="Default select example" name="level" required>
                                                        <?php
                                                        $data = array("Admin", "Cashier", "Waiter", "Kitchen", "Guest");
                                                        foreach ($data as $key => $value) {
                                                            if ($row['level'] == $key + 1) {
                                                                echo "<option selected value='$key' > $value </option>";
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                    <label for="floatingInput">User Level</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END MODAL VIEW -->

                    <!-- MODAL EDIT -->
                    <div class="modal fade" id="ModalEdit<?php echo $row['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl modal-fullscreen-md-down">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit User</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="proses/p_edit_user.php" class="needs-validation" method="POST" novalidate>
                                        <input type="hidden" value="<?php echo $row['id']; ?>" name="id">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-floating mb-3">
                                                    <input required type="text" class="form-control" id="floatingInput" placeholder="Your Name" name="nama" value="<?php echo $row['name']; ?>">
                                                    <label for="floatingInput">Name</label>
                                                    <div class="invalid-feedback mb-2">
                                                        Input name
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-floating mb-3">
                                                    <input readonly type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="username" value="<?php echo $row['username']; ?>">
                                                    <label for="floatingInput">Username</label>
                                                    <div class="invalid-feedback mb-2">
                                                        Input valid username
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-8">
                                                <div class="form-floating mb-3">
                                                    <input required type="text" class="form-control" id="floatingInput" placeholder="08xxxxxxxxxx" name="nohp" value="<?php echo $row['nohp']; ?>">
                                                    <label for="floatingInput">Phone Number</label>
                                                    <div class="invalid-feedback mb-2">
                                                        Input phone number
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-floating mb-3">
                                                    <select class="form-select" aria-label="Default select example" name="level" required>
                                                        <?php
                                                        $data = array("Admin", "Cashier", "Waiter", "Kitchen", "Guest");
                                                        // $key = $key++;
                                                        foreach ($data as $key => $value) {
                                                            if ($row['level'] == $key + 1) {
                                                                echo "<option selected value=" . ($key + 1) . ">$value</option>";
                                                            } else {
                                                                echo "<option value=" . ($key + 1) . ">$value</option>";
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                    <label for="floatingInput">User Level</label>
                                                    <div class="invalid-feedback mb-2">
                                                        Choose level
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button <?php echo ($row['username'] == $_SESSION['username_vcoffe']) ? 'disabled' : ''; ?> type="submit" class="btn btn-success" name="input_user_validate" value="submit">Save Changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END MODAL EDIT -->

                    <!-- MODAL DELETE -->
                    <div class="modal fade" id="ModalDelete<?php echo $row['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-md modal-fullscreen-md-down">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Delete User</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="proses/p_delete_user.php" class="needs-validation" method="POST" novalidate>
                                        <input type="hidden" value="<?php echo $row['id']; ?>" name="id">
                                        <div class="col-lg-12">
                                            <?php
                                            if ($row['username'] == $_SESSION['username_vcoffe']) {
                                                echo "<div class='alert alert-danger'> You cannot delete a user that is currently in use</div>";
                                            } else {

                                                echo "<div class='alert alert-light'>Are you sure you want to delete user <b> $row[username]</b> ?</div>";
                                            }
                                            ?>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-danger" name="input_user_validate" value="submit" <?php echo ($row['username'] == $_SESSION['username_vcoffe']) ? 'disabled' : ''; ?>>Delete</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END MODAL DELETE -->

                    <!-- MODAL RESET PASSWORD -->
                    <div class="modal fade" id="ModalResetPassword<?php echo $row['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-md modal-fullscreen-md-down">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Reset Password User</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="proses/p_reset_password.php" class="needs-validation" method="POST" novalidate>
                                        <input type="hidden" value="<?php echo $row['id']; ?>" name="id">
                                        <div class="col-lg-12">
                                            <?php
                                            if ($row['username'] == $_SESSION['username_vcoffe']) {
                                                echo "<div class='alert alert-danger'> You cannot reset the password for the user that is currently in use</div>";
                                            } else {

                                                echo "<div class='alert alert-light'>Are you sure you want to reset the user password <b> $row[username]</b> to <b>#lakukeras</b> as the default password ?</div>";
                                            }
                                            ?>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn" style="background-color: #FFD93D;" name="input_user_validate" value="submit" <?php echo ($row['username'] == $_SESSION['username_vcoffe']) ? 'disabled' : ''; ?>>Reset Password</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END MODAL RESET PASSWORD -->
                <?php } ?>
                <!-- TABLE USER -->
                <div class=" table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr class="text-nowrap">
                                <th scope="col">No</th>
                                <th scope="col">Name</th>
                                <th scope="col">Username</th>
                                <th scope="col">User Level</th>
                                <th scope="col">Phone Number</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($result as $row) {
                            ?>
                                <tr class="text-nowrap">
                                    <th scope="row"><?php echo $no++ ?></th>
                                    <td><?php echo $row['name']; ?></td>
                                    <td><?php echo $row['username']; ?></td>
                                    <td><?php
                                        if ($row['level'] == 1) {
                                            echo "Admin";
                                        } elseif ($row['level'] == 2) {
                                            echo "Cashier";
                                        } elseif ($row['level'] == 3) {
                                            echo "Waiter";
                                        } elseif ($row['level'] == 4) {
                                            echo "Kitchen";
                                        } else {
                                            echo "Guest";
                                        }
                                        ?></td>
                                    <td><?php echo $row['nohp']; ?></td>
                                    <td>
                                        <div class="d-flex">
                                            <button class="btn text-light btn-sm me-1" style="background-color: #85586F;" data-bs-toggle="modal" data-bs-target="#ModalView<?php echo $row['id']; ?>"><i class="bi bi-eye"></i></button>
                                            <button class="btn text-dark btn-sm me-1" style="background-color: #FFD93D;" data-bs-toggle="modal" data-bs-target="#ModalEdit<?php echo $row['id']; ?>"><i class="bi bi-pencil"></i></button>
                                            <button class="btn text-dark btn-sm me-1" style="background-color: #FF6B6B;" data-bs-toggle="modal" data-bs-target="#ModalDelete<?php echo $row['id']; ?>"><i class="bi bi-trash"></i></button>
                                            <button class="btn btn-dark btn-sm" data-bs-toggle="modal" data-bs-target="#ModalResetPassword<?php echo $row['id']; ?>"><i class="bi bi-key-fill"></i></button>
                                        </div>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <!-- END TABLE USER -->
            <?php } ?>
        </div>
    </div>
</div>