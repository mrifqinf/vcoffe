<?php
include "proses/connect.php";

$query = mysqli_query($conn, "SELECT * FROM tb_list_order
LEFT JOIN tb_order ON tb_order.id_order = tb_list_order.kode_order
LEFT JOIN tb_daftar_menu ON tb_daftar_menu.id = tb_list_order.menu
LEFT JOIN tb_bayar ON tb_bayar.id_bayar = tb_order.id_order
ORDER BY waktu_order DESC");

while ($record = mysqli_fetch_array($query)) {
    $result[] = $record;
}

$select_menu = mysqli_query($conn, "SELECT id, nama_menu FROM tb_daftar_menu");
?>

<div class="col-lg-9 mt-2">
    <div class="card">
        <div class="fw-bold text-white card-header" style="background-color: #85586F;">
            KITCHEN
        </div>
        <div class="card-body" style="background-color: #F8EDE3;">
            <?php
            if (empty($result)) {
                echo "<div class='alert alert-danger'>Kitchen is empty</div>";
            } else {
                foreach ($result as $row) { ?>

                    <!-- MODAL TERIMA PESANAN-->
                    <div class="modal fade" id="Terima<?php echo $row['id_list_order']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-fullscreen-md-down">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Accept Orders for the Menu below?</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="proses/p_terima_orderitem.php" class="needs-validation" method="POST" novalidate>
                                        <input type="hidden" name="id" value="<?php echo $row['id_list_order']; ?>">
                                        <div class=" row">
                                            <div class="col-lg-8">
                                                <div class="form-floating mb-3">
                                                    <select disabled class="form-select" aria-label="Default select example" name="menu" required>
                                                        <option hidden value="">- Choose Menu -</option>
                                                        <?php
                                                        foreach ($select_menu as $value) {
                                                            if ($row['menu'] == $value['id']) {
                                                                echo "<option selected value=$value[id]>$value[nama_menu]</option>";
                                                            } else {
                                                                echo "<option value=$value[id]>$value[nama_menu]</option>";
                                                            }
                                                        } ?>
                                                    </select>
                                                    <label for="menu">Menu Food or Beverage</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-floating mb-3">
                                                    <input readonly type="number" class="form-control" id="floatingInput" placeholder="Jumlah Porsi" name="jumlah" value="<?php echo $row['jumlah']; ?>" required>
                                                    <label for="floatingInput">Number of servings</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-floating mb-3">
                                                    <input readonly type="text" class="form-control" id="floatingInput" placeholder="Catatan" name="catatan_item" value="<?php echo $row['catatan_item']; ?>">
                                                    <label for="floatingInput">Description (opsional)</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-success" name="terima_orderitem_validate" value="submit">Accept</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END MODAL TERIMA PESANAN-->

                    <!-- MODAL SIAP SAJI-->
                    <div class="modal fade" id="siapSaji<?php echo $row['id_list_order']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-fullscreen-md-down">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Ready to Serve?</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="proses/p_siapsaji_orderitem.php" class="needs-validation" method="POST" novalidate>
                                        <input type="hidden" name="id" value="<?php echo $row['id_list_order']; ?>">
                                        <div class=" row">
                                            <div class="col-lg-8">
                                                <div class="form-floating mb-3">
                                                    <select disabled class="form-select" aria-label="Default select example" name="menu" required>
                                                        <option hidden value="">- Choose Menu -</option>
                                                        <?php
                                                        foreach ($select_menu as $value) {
                                                            if ($row['menu'] == $value['id']) {
                                                                echo "<option selected value=$value[id]>$value[nama_menu]</option>";
                                                            } else {
                                                                echo "<option value=$value[id]>$value[nama_menu]</option>";
                                                            }
                                                        } ?>
                                                    </select>
                                                    <label for="menu">Menu Food or Beverage</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-floating mb-3">
                                                    <input readonly type="number" class="form-control" id="floatingInput" placeholder="Jumlah Porsi" name="jumlah" value="<?php echo $row['jumlah']; ?>" required>
                                                    <label for="floatingInput">Number of servings</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-floating mb-3">
                                                    <input readonly type="text" class="form-control" id="floatingInput" placeholder="Catatan" name="catatan_item" value="<?php echo $row['catatan_item']; ?>">
                                                    <label for="floatingInput">Description (opsional)</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-success" name="siapsaji_orderitem_validate" value="submit">Ready</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END MODAL SIAP SAJI-->

                <?php } ?>

                <!-- TABLE MENU -->
                <div class=" table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr class="text-nowrap">
                                <th scope="col">No</th>
                                <th scope="col">Order Code</th>
                                <th scope="col">Order Time</th>
                                <th scope="col">Menu</th>
                                <th scope="col">Qty</th>
                                <th scope="col">Description</th>
                                <th scope="col">Status</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($result as $row) {
                                if ($row['status'] != 2) {
                            ?>
                                    <tr class="text-nowrap">
                                        <td><?php echo $no++; ?></td>
                                        <td><?php echo $row['kode_order']; ?></td>
                                        <td><?php echo $row['waktu_order']; ?></td>
                                        <td><?php echo $row['nama_menu']; ?></td>
                                        <td><?php echo $row['jumlah']; ?></td>
                                        <td><?php echo $row['catatan_item'] ?></td>
                                        <td><?php
                                            if ($row['status'] == null) {
                                                echo "<span class='bagde rounded bg-danger p-1 text-light'>WL</span>";
                                            } elseif ($row['status'] == 1) {
                                                echo "<span class='bagde rounded p-1 bg-warning text-light'>OP</span>";
                                            } elseif ($row['status'] == 2) {
                                                echo "<span class='bagde rounded p-1 bg-success text-light'>RS</span>";
                                            } else {
                                                echo "Error";
                                            }
                                            ?></td>
                                        <td>
                                            <div class="d-flex">
                                                <button class="<?php echo (!empty($row['status'])) ? "btn text-light btn-sm me-1 disabled" : "btn text-light btn-sm me-1"; ?>" style="background-color: #85586F;" data-bs-toggle="modal" data-bs-target="#Terima<?php echo $row['id_list_order']; ?>">Accept</button>
                                                <button class="<?php echo (empty($row['status']) || $row['status'] != 1) ? "btn text-dark btn-sm me-1 disabled" : "btn text-dark btn-sm me-1"; ?>" style="background-color: #6BCB77;" data-bs-toggle="modal" data-bs-target="#siapSaji<?php echo $row['id_list_order']; ?>">Ready to Serve</button>
                                            </div>
                                        </td>
                                    </tr>
                            <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <!-- END TABLE MENU -->
            <?php } ?>
        </div>
    </div>
</div>