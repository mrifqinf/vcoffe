<?php
include "proses/connect.php";
$query = mysqli_query($conn, "SELECT * FROM tb_kategori_menu
ORDER BY jenis_menu ASC");
while ($record = mysqli_fetch_array($query)) {
    $result[] = $record;
}
?>

<div class="col-lg-9 mt-2">
    <div class="card">
        <div class="fw-bold text-white card-header" style="background-color: #85586F;">
            CATEGORY
        </div>
        <div class="card-body" style="background-color: #F8EDE3;">
            <div class="row">
                <div class="col d-flex justify-content-end mb-2">
                    <button class="btn fw-bold text-light" style="background-color: #85586F;" data-bs-toggle="modal" data-bs-target="#ModalTambahKategori"><i class="bi bi-plus-circle"></i> Category</button>
                </div>
            </div>
            <!-- MODAL TAMBAH KATEGORI-->
            <div class="modal fade" id="ModalTambahKategori" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl modal-fullscreen-md-down">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Add Category</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="proses/p_input_katmenu.php" class="needs-validation" method="POST" novalidate>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-floating mb-3">
                                            <select class="form-select" aria-label="Default select example" name="jenismenu" required>
                                                <option selected hidden value="">- Choose menu type -</option>
                                                <option value="1">Food</option>
                                                <option value="2">Beverage</option>
                                            </select>
                                            <label for="floatingInput">Menu Type</label>
                                            <div class="invalid-feedback mb-2">
                                                Choose menu type
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="floatingInput" placeholder="Kategori Menu" name="katmenu" required>
                                            <label for="floatingInput">Category</label>
                                            <div class="invalid-feedback mb-2">
                                                Input category
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary" name="input_katmenu_validate" value="submit">Add</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END MODAL TAMBAH KATEGORI -->
            <?php
            if (empty($result)) {
                echo "<div class='alert alert-danger'>The category has not been added, please add a category first</div>";
            } else {
                foreach ($result as $row) { ?>
                    <!-- MODAL EDIT -->
                    <div class="modal fade" id="ModalEditKategori<?php echo $row['id_kat_menu'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl modal-fullscreen-md-down">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Category</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="proses/p_edit_katmenu.php" class="needs-validation" method="POST" novalidate>
                                        <input type="hidden" value="<?php echo $row['id_kat_menu']; ?>" name="id_kat_menu">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-floating mb-3">
                                                    <select class="form-select" aria-label="Default select example" name="jenismenu" required>
                                                        <?php
                                                        $data = array("Food", "Beverage");
                                                        // $key = $key++;
                                                        foreach ($data as $key => $value) {
                                                            if ($row['jenis_menu'] == $key + 1) {
                                                                echo "<option selected value=" . ($key + 1) . ">$value</option>";
                                                            } else {
                                                                echo "<option value=" . ($key + 1) . ">$value</option>";
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                    <label for="floatingInput">Menu Type</label>
                                                    <div class="invalid-feedback mb-2">
                                                        Choose menu type
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-floating mb-3">
                                                    <input required type="text" class="form-control" id="floatingInput" placeholder="Kategori Menu" name="katmenu" value="<?php echo $row['kategori_menu']; ?>">
                                                    <label for="floatingInput">Category</label>
                                                    <div class="invalid-feedback mb-2">
                                                        Input category
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-success" name="input_katmenu_validate" value="submit">Save Changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END MODAL EDIT -->

                    <!-- MODAL DELETE -->
                    <div class="modal fade" id="ModalDeleteKategori<?php echo $row['id_kat_menu'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-md modal-fullscreen-md-down">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Category</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="proses/p_delete_katmenu.php" class="needs-validation" method="POST" novalidate>
                                        <input type="hidden" value="<?php echo $row['id_kat_menu']; ?>" name="id_kat_menu">
                                        <div class="col-lg-12">
                                            Do you want to delete the category <b> <?php echo $row['kategori_menu']; ?> </b> ?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-danger" name="input_katmenu_validate" value="submit">Delete</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END MODAL DELETE -->

                <?php } ?>
                <!-- TABLE KATEGORI -->
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr class="text-nowrap">
                                <th scope="col">No</th>
                                <th scope="col">Menu Type</th>
                                <th scope="col">Category Menu</th>
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
                                    <td><?php echo ($row['jenis_menu'] == 1) ? "Food" : "Beverage"; ?></td>
                                    <td><?php echo $row['kategori_menu']; ?></td>
                                    <td>
                                        <div class="d-flex">
                                            <button class="btn btn-sm me-1 text-dark" style="background-color: #FFD93D;" data-bs-toggle="modal" data-bs-target="#ModalEditKategori<?php echo $row['id_kat_menu']; ?>"><i class="bi bi-pencil"></i></button>
                                            <button class="btn btn-sm text-dark" style="background-color: #FF6B6B;" data-bs-toggle="modal" data-bs-target="#ModalDeleteKategori<?php echo $row['id_kat_menu']; ?>"><i class="bi bi-trash"></i></button>
                                        </div>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <!-- END TABLE KATEGORI -->
            <?php } ?>
        </div>
    </div>
</div>