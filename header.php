<?php
include "proses/connect.php";
$query = mysqli_query($conn, "SELECT * FROM tb_user WHERE username = '$_SESSION[username_vcoffe]'");
$record = mysqli_fetch_array($query);
?>

<nav class="navbar navbar-expand-lg sticky-top" style="background-color: #85586F;">
    <div class="container-lg">
        <a class="text-white navbar-brand" href="."><i class="bi bi-cup-hot-fill"></i> V~Coffe</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="text-light"><i class="bi bi-list"></i></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="text-light nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <?php echo $hasil['name']; ?>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#ModalUbahProfile"><i class="bi bi-person-circle"></i> Profile</a></li>
                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#ModalUbahPassword"><i class=" bi bi-gear"></i> Change Password</a></li>
                        <li><a class="dropdown-item" href="logout"><i class="bi bi-box-arrow-left"></i> Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="modal fade" id="ModalUbahPassword" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-fullscreen-md-down">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Change Password</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="proses/p_ubah_password.php" class="needs-validation" method="POST" novalidate>
                    <input type="hidden" value="<?php echo $row['id']; ?>" name="id">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-floating mb-3">
                                <input readonly type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="username" value="<?php echo $_SESSION['username_vcoffe']; ?>">
                                <label for="floatingInput">Username</label>
                                <div class="invalid-feedback mb-2">
                                    Username Invalid
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-floating mb-3">
                                <input required type="password" class="form-control" id="floatingPassword" name="passwordlama">
                                <label for="floatingInput">Old Pasword</label>
                                <div class="invalid-feedback mb-2">
                                    Please Input Old Pasword First
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-floating mb-3">
                                <input required type="password" class="form-control" id="floatingPassword" name="passwordbaru">
                                <label for="floatingInput">New Password</label>
                                <div class="invalid-feedback mb-2">
                                    Please Input New Password
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-floating mb-3">
                                <input required type="password" class="form-control" id="floatingPassword" name="repasswordbaru">
                                <label for="floatingInput">Verify New Password</label>
                                <div class="invalid-feedback mb-2">
                                    Verify New Password
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success" name="ubah_password_validate" value="submit">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="ModalUbahProfile" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-fullscreen-md-down">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Profile</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="proses/p_ubah_profile.php" class="needs-validation" method="POST" novalidate>
                    <!-- <div class="row">
                        <div class="col d-flex justify-content-center mb-3">
                            <div style="width: 200px;"><img src="/assets/images/605019-progress_pict.png" class="img-fluid" alt="..."></div>
                        </div>
                    </div> -->
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="floatingInput" placeholder="Your Name" name="nama" value="<?php echo $record['name']; ?>" required>
                                <label for="floatingInput">Name</label>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-floating mb-3">
                                <input readonly type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="username" value="<?php echo $record['username']; ?>">
                                <label for="floatingInput">Username</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="floatingInput" placeholder="08xxxxxxxxxx" name="nohp" value="<?php echo $record['nohp']; ?>" required>
                                <label for="floatingInput">Phone Number</label>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-floating mb-3">
                                <select disabled class="form-select" aria-label="Default select example" name="level" required>
                                    <?php
                                    $data = array("Admin", "Cashier", "Waiter", "Kitchen", "Guest");
                                    foreach ($data as $key => $value) {
                                        if ($record['level'] == $key + 1) {
                                            echo "<option selected value='$key' > $value </option>";
                                        }
                                    }
                                    ?>
                                </select>
                                <label for="floatingInput">User Level</label>
                            </div>
                        </div>
                    </div>
                    <b>NOTE : Username dan User Level tidak dapat diubah <i class="bi bi-exclamation-triangle"></i></b>
                    <p> Ingin mengubah Username atau Level anda? Silahkan email admin kami <a class="link-offset-3 link-underline link-underline-opacity-0 link-opacity-10-hover" href="mailto:developervcafe@gmail.com?subject=REQUEST DATA CHANGES&body=Silahkan berikan Username lama dan Username Baru, Jika ingin mengubah level silahkan tulisahkan level diantara (Cashier, Waiter, Kitchen, or Guest).">developervcafe@gmail.com</a></p>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success" name="ubah_profile_validate" value="submit">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>