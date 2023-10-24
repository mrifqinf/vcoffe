<?php
include "proses/connect.php";
$query = mysqli_query($conn, "SELECT * FROM tb_daftar_menu
LEFT JOIN tb_kategori_menu ON tb_kategori_menu.id_kat_menu = tb_daftar_menu.kategori
ORDER BY kategori ASC, jenis_menu ASC, nama_menu ASC");
while ($record = mysqli_fetch_array($query)) {
    $result[] = $record;
}

$query2 = mysqli_query($conn, "SELECT * FROM tb_user WHERE username = '$_SESSION[level_vcoffe]'");
$hasil2 = mysqli_fetch_array($query2);

$select_kat_menu = mysqli_query($conn, "SELECT id_kat_menu, kategori_menu FROM tb_kategori_menu");
?>

<div class="col-lg-9 mt-2">
    <div class="card">
        <div class="fw-bold text-white card-header" style="background-color: #85586F;">
            MENU LIST
        </div>
        <div class="card-body" style="background-color: #F8EDE3;">
            <div class="row">
                <div class="col d-flex justify-content-end mb-2">
                    <button class="btn fw-bold text-light" style="background-color: #85586F;" data-bs-toggle="modal" data-bs-target="#ModalTambahMenu" <?php echo ($_SESSION['level_vcoffe'] == "1") ? '' : 'hidden'; ?>><i class="bi bi-plus-circle"></i> Menu</button>
                </div>
            </div>
            <!-- MODAL TAMBAH MENU-->
            <div class="modal fade" id="ModalTambahMenu" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl modal-fullscreen-md-down">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Add Food & Beverage menu</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="proses/p_input_menu.php" class="needs-validation" method="POST" novalidate enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="input-group mb-3">
                                            <input type="file" class="form-control" id="uploadFoto" placeholder="File Menu" name="foto" required>
                                            <label class="input-group-text" for="uploadFoto">Upload Menu Photo</label>
                                            <div class="invalid-feedback mb-2">
                                                Input Menu photo
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="floatingInput" placeholder="Menu Name" name="nama_menu" required>
                                            <label for="floatingInput">Menu Name</label>
                                            <div class="invalid-feedback mb-2">
                                                Input Menu name
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="floatingInput" placeholder="Keterangan" name="keterangan">
                                            <label for="floatingInput">Description (opsional)</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-floating mb-3">
                                            <select class="form-select" aria-label="Default select example" name="kat_menu" required>
                                                <option selected hidden value="">- Choose Menu Category -</option>
                                                <?php
                                                foreach ($select_kat_menu as $value) {
                                                    echo "<option value=" . $value['id_kat_menu'] . ">$value[kategori_menu]</option>";
                                                } ?>
                                            </select>
                                            <label for="floatingInput">Category of Food or Beverage</label>
                                            <div class="invalid-feedback mb-2">
                                                Please choose category for Food or Beverage
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-floating mb-3">
                                            <input type="number" class="form-control" id="floatingInput" placeholder="Harga" name="harga" required>
                                            <label for="floatingInput">Price</label>
                                            <div class="invalid-feedback mb-2">
                                                Input Price
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-floating mb-3">
                                            <input type="number" class="form-control" id="floatingInput" placeholder="Stock" name="stock" required>
                                            <label for="floatingInput">Stock</label>
                                            <div class="invalid-feedback mb-2">
                                                Input Stock
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary" name="input_menu_validate" value="submit">Add</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END MODAL TAMBAH MENU -->
            <?php
            if (empty($result)) {
                echo "<div class='alert alert-danger'>The menu list has not been added, please add the menu list first</div>";
            } else {
                foreach ($result as $row) { ?>
                    <!-- MODAL VIEW -->
                    <div class="modal fade" id="ModalViewMenu<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl modal-fullscreen-md-down">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Menu Details</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="proses/p_input_menu.php" class="needs-validation" method="POST" novalidate enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col d-flex justify-content-center mb-3">
                                                <div style="width: 200px;"><img src="/assets/images/<?php echo $row['foto']; ?>" class="img-fluid" alt="..."></div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" id="floatingInput" value="<?php echo $row['nama_menu']; ?>" readonly>
                                                    <label for="floatingInput">Menu Name</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" id="floatingInput" value="<?php echo $row['keterangan']; ?>" readonly>
                                                    <label for="floatingInput">Description (opsional)</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" id="floatingInput" value="<?php echo $row['kategori_menu']; ?>" readonly>
                                                    <label for="floatingInput">Category of Food or Beverage</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-floating mb-3">
                                                    <input type="number" class="form-control" id="floatingInput" value="<?php echo $row['harga']; ?>" readonly>
                                                    <label for="floatingInput">Price</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-floating mb-3">
                                                    <input type="number" class="form-control" id="floatingInput" value="<?php echo $row['stock']; ?>" readonly>
                                                    <label for="floatingInput">Stock</label>
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
                    <div class="modal fade" id="ModalEditMenu<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl modal-fullscreen-md-down">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Menu</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="proses/p_edit_menu.php" class="needs-validation" method="POST" novalidate enctype="multipart/form-data">
                                        <input type="hidden" value="<?php echo $row['id']; ?>" name="id">
                                        <div class="row">
                                            <div class="col d-flex justify-content-center mb-3">
                                                <div style="width: 200px;"><img src="/assets/images/<?php echo $row['foto']; ?>" class="img-fluid" alt="..."></div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" id="floatingInput" placeholder="Menu Name" name="nama_menu" value="<?php echo $row['nama_menu']; ?>" required>
                                                    <label for="floatingInput">Menu Name</label>
                                                    <div class="invalid-feedback mb-2">
                                                        Input Menu name
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" id="floatingInput" placeholder="Keterangan" name="keterangan" value="<?php echo $row['keterangan']; ?>">
                                                    <label for="floatingInput">Description (opsional)</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="form-floating mb-3">
                                                    <select class="form-select" aria-label="Default select example" name="kat_menu" required>
                                                        <option hidden value="">- Choose Menu -</option>
                                                        <?php
                                                        foreach ($select_kat_menu as $value) {
                                                            if ($row['kategori'] == $value['id_kat_menu']) {
                                                                echo "<option selected value=" . $value['id_kat_menu'] . ">$value[kategori_menu]</option>";
                                                            } else {
                                                                echo "<option value=" . $value['id_kat_menu'] . ">$value[kategori_menu]</option>";
                                                            }
                                                        } ?>
                                                    </select>
                                                    <label for="floatingInput">Category of Food or Beverage</label>
                                                    <div class="invalid-feedback mb-2">
                                                        Please choose category for Food or Beverage
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-floating mb-3">
                                                    <input type="number" class="form-control" id="floatingInput" placeholder="Harga" name="harga" value="<?php echo $row['harga']; ?>" required>
                                                    <label for="floatingInput">Price</label>
                                                    <div class="invalid-feedback mb-2">
                                                        Input Price
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-floating mb-3">
                                                    <input type="number" class="form-control" id="floatingInput" placeholder="Stock" name="stock" value="<?php echo $row['stock']; ?>" required>
                                                    <label for="floatingInput">Stock</label>
                                                    <div class="invalid-feedback mb-2">
                                                        Input Stock
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-success" name="input_menu_validate" value="submit">Save Changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END MODAL EDIT -->
                    <!-- MODAL DELETE -->
                    <div class="modal fade" id="ModalDeleteMenu<?php echo $row['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-md modal-fullscreen-md-down">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Menu</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="proses/p_delete_menu.php" class="needs-validation" method="POST" novalidate>
                                        <input type="hidden" value="<?php echo $row['id']; ?>" name="id">
                                        <input type="hidden" value="<?php echo $row['foto']; ?>" name="foto">
                                        <div class="col-lg-12">
                                            Are you sure you want to delete the menu <b> <?php echo $row['nama_menu']; ?> </b> ?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-danger" name="input_menu_validate" value="submit">Delete</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END MODAL DELETE -->
                <?php } ?>
                <div class=" table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr class="text-nowrap">
                                <th scope="col">No</th>
                                <th scope="col">Menu Picture</th>
                                <th scope="col">Menu Name</th>
                                <th scope="col">Menu Type</th>
                                <th scope="col">Category</th>
                                <th scope="col">Price</th>
                                <th scope="col">Stock</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($result as $row) {
                                $angka = "Rp " . number_format($row['harga'], 2, ",", ".");
                            ?>
                                <tr class="text-nowrap">
                                    <th scope="row"><?php echo $no++ ?></th>
                                    <td>
                                        <div style="width: 80px;"><img src="/assets/images/<?php echo $row['foto']; ?>" class="img-thumbnail" alt="..."></div>
                                    </td>
                                    <td><?php echo $row['nama_menu']; ?></td>
                                    <td><?php echo ($row['jenis_menu'] == 1) ? "Food" : "Beverage"; ?></td>
                                    <td><?php echo $row['kategori_menu']; ?></td>
                                    <td><?php echo $angka; ?></td>
                                    <td><?php echo $row['stock']; ?></td>
                                    <td>
                                        <div class="d-flex">
                                            <button class="btn btn-sm my-1 me-1 text-light" style="background-color: #85586F;" data-bs-toggle="modal" data-bs-target="#ModalViewMenu<?php echo $row['id']; ?>"><i class="bi bi-eye"></i></button>
                                            <div <?php echo ($_SESSION['level_vcoffe'] == "1") ? '' : 'hidden'; ?>>
                                                <button class="btn btn-sm my-1 text-dark" style="background-color: #FFD93D;" data-bs-toggle="modal" data-bs-target="#ModalEditMenu<?php echo $row['id']; ?>"><i class="bi bi-pencil"></i></button>
                                                <button class="btn btn-sm my-1 text-dark" style="background-color: #FF6B6B;" data-bs-toggle="modal" data-bs-target="#ModalDeleteMenu<?php echo $row['id']; ?>"><i class="bi bi-trash"></i></button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            <?php } ?>
        </div>
    </div>
</div>