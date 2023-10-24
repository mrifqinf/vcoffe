<?php
include "proses/connect.php";
$query = mysqli_query($conn, "SELECT *, SUM(harga*jumlah) AS harganya FROM tb_list_order
LEFT JOIN tb_order ON tb_order.id_order = tb_list_order.kode_order
LEFT JOIN tb_daftar_menu ON tb_daftar_menu.id = tb_list_order.menu
LEFT JOIN tb_bayar ON tb_bayar.id_bayar = tb_order.id_order
GROUP BY id_list_order
HAVING tb_list_order.kode_order = $_GET[order]");

$kodeorder = $_GET['order'];
$nomormeja = $_GET['meja'];
$namapelanggan = $_GET['pelanggan'];

while ($record = mysqli_fetch_array($query)) {
    $result[] = $record;
    // $kodeorder = $record['id_order'];
    // $nomormeja = $record['meja'];
    // $namapelanggan = $record['pelanggan'];
}

$select_menu = mysqli_query($conn, "SELECT id, nama_menu FROM tb_daftar_menu ORDER BY kategori ASC, nama_menu ASC");
?>

<div class="col-lg-9 mt-2">
    <div class="card">
        <div class="fw-bold text-white card-header" style="background-color: #85586F;">
            Add items here
        </div>
        <div class="card-body" style="background-color: #F8EDE3;">
            <a href="order" class="btn btn-secondary mb-3"><i class="bi bi-arrow-left"></i> Back</a>
            <div class="row">
                <div class="col-lg-3">
                    <div class="form-floating mb-3">
                        <input readonly type="text" class="form-control" id="kodeOrder" value="<?php echo $kodeorder; ?>">
                        <label for="floatingInput">Order Code</label>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-floating mb-3">
                        <input readonly type="text" class="form-control" id="noMeja" value="<?php echo $nomormeja; ?>">
                        <label for="floatingInput">Table Number</label>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-floating mb-3">
                        <input readonly type="text" class="form-control" id="namaPelanggan" value="<?php echo $namapelanggan; ?>">
                        <label for="floatingInput">Customer Name</label>
                    </div>
                </div>

                <!-- MODAL TAMBAH ITEM-->
                <div class="modal fade" id="ModalTambahItem" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-fullscreen-md-down">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Add Items</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="proses/p_input_orderitem.php" class="needs-validation" method="POST" novalidate>
                                    <input type="hidden" name="kodeorder" value="<?php echo $kodeorder; ?>">
                                    <input type="hidden" name="meja" value="<?php echo $nomormeja; ?>">
                                    <input type="hidden" name="pelanggan" value="<?php echo $namapelanggan; ?>">
                                    <div class=" row">
                                        <div class="col-lg-8">
                                            <div class="form-floating mb-3">
                                                <select class="form-select" aria-label="Default select example" name="menu" required>
                                                    <option selected hidden value="">- Choose Menu -</option>
                                                    <?php
                                                    foreach ($select_menu as $value) {
                                                        echo "<option value=$value[id]>$value[nama_menu]</option>";
                                                    } ?>
                                                </select>
                                                <label for="menu">Menu Food & Beverage</label>
                                                <div class="invalid-feedback mb-2">
                                                    Choose menu
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-floating mb-3">
                                                <input type="number" class="form-control" id="floatingInput" placeholder="Jumlah Porsi" name="jumlah" required>
                                                <label for="floatingInput">Number of servings</label>
                                                <div class="invalid-feedback mb-2">
                                                    Input Number of servings
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="floatingInput" placeholder="Catatan" name="catatan_item">
                                                <label for="floatingInput">Description (opsional)</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary" name="input_orderitem_validate" value="submit">Add</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END MODAL TAMBAH ITEM -->

                <?php
                if (empty($result)) {
                    echo "<div class='alert alert-danger'>The item has not been added, Please add the item first</div>";
                } else {
                    foreach ($result as $row) { ?>

                        <!-- MODAL EDIT -->
                        <div class="modal fade" id="ModalEditItem<?php echo $row['id_list_order']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-fullscreen-md-down">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Item</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="proses/p_edit_orderitem.php" class="needs-validation" method="POST" novalidate>
                                            <input type="hidden" name="id" value="<?php echo $row['id_list_order']; ?>">
                                            <input type="hidden" name="kodeorder" value="<?php echo $kodeorder; ?>">
                                            <input type="hidden" name="meja" value="<?php echo $nomormeja; ?>">
                                            <input type="hidden" name="pelanggan" value="<?php echo $namapelanggan; ?>">
                                            <div class=" row">
                                                <div class="col-lg-8">
                                                    <div class="form-floating mb-3">
                                                        <select class="form-select" aria-label="Default select example" name="menu" required>
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
                                                        <label for="menu">Menu Food & Beverage</label>
                                                        <div class="invalid-feedback mb-2">
                                                            Choose menu
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-floating mb-3">
                                                        <input type="number" class="form-control" id="floatingInput" placeholder="Jumlah Porsi" name="jumlah" value="<?php echo $row['jumlah']; ?>" required>
                                                        <label for="floatingInput">Number of servings</label>
                                                        <div class="invalid-feedback mb-2">
                                                            Input Number of servings
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-floating mb-3">
                                                        <input type="text" class="form-control" id="floatingInput" placeholder="Catatan" name="catatan_item" value="<?php echo $row['catatan_item']; ?>">
                                                        <label for="floatingInput">Description (opsional)</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-success" name="edit_orderitem_validate" value="submit">Save Changes</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END MODAL EDIT -->

                        <!-- MODAL DELETE -->
                        <div class="modal fade" id="ModalDeleteItem<?php echo $row['id_list_order'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-md modal-fullscreen-md-down">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Item</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="proses/p_delete_orderitem.php" class="needs-validation" method="POST" novalidate>
                                            <input type="hidden" value="<?php echo $row['id_list_order'] ?>" name="id">
                                            <input type="hidden" name="kodeorder" value="<?php echo $kodeorder; ?>">
                                            <input type="hidden" name="meja" value="<?php echo $nomormeja; ?>">
                                            <input type="hidden" name="pelanggan" value="<?php echo $namapelanggan; ?>">
                                            <div class="col-lg-12">
                                                Do you want to remove the menu <b> <?php echo $row['nama_menu']; ?> </b> ?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-danger" name="delete_orderitem_validate" value="submit">Delete</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END MODAL DELETE -->

                        <!-- MODAL DELETE ALL ITEMS-->
                        <div class="modal fade" id="ModalDeleteAllItem<?php echo $row['kode_order'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-md modal-fullscreen-md-down">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Item</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="proses/p_deleteall_orderitem.php" class="needs-validation" method="POST" novalidate>
                                            <input type="hidden" value="<?php echo $row['kode_order'] ?>" name="id">
                                            <input type="hidden" name="kodeorder" value="<?php echo $kodeorder; ?>">
                                            <input type="hidden" name="meja" value="<?php echo $nomormeja; ?>">
                                            <input type="hidden" name="pelanggan" value="<?php echo $namapelanggan; ?>">
                                            <div class="col-lg-12">
                                                Do you want to delete all orders in order number<b> <?php echo $row['kode_order']; ?></b> by name <b> <?php echo $row['pelanggan']; ?></b> ?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-danger" name="delete_orderitem_validate" value="submit">Delete</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END MODAL DELETE ALL ITEMS-->

                    <?php } ?>
                    <!-- MODAL BAYAR ITEM-->
                    <div class="modal fade" id="ModalBayar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-fullscreen-md-down">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Payment</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class=" table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr class="text-nowrap">
                                                    <th scope="col">Menu</th>
                                                    <th scope="col">Price</th>
                                                    <th scope="col">Qty</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Description</th>
                                                    <th scope="col">Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $total = 0;
                                                foreach ($result as $row) {
                                                    $harga = "Rp " . number_format($row['harga'], 2, ",", ".");
                                                    $harganya = "Rp " . number_format($row['harganya'], 2, ",", "."); ?>
                                                    <tr>
                                                        <td><?php echo $row['nama_menu']; ?></td>
                                                        <td><?php echo $harga; ?></td>
                                                        <td><?php echo $row['jumlah']; ?></td>
                                                        <td><?php echo $row['status']; ?></td>
                                                        <td><?php echo $row['catatan_item']; ?></td>
                                                        <td><?php echo $harganya; ?></td>
                                                    </tr>
                                                <?php
                                                    $total += $row['harganya'];
                                                    $keseluruhan = "Rp " . number_format($total, 2, ",", ".");
                                                }
                                                ?>
                                                <tr class="fw-bold">
                                                    <td colspan="5">
                                                        Total Price
                                                    </td>
                                                    <td>
                                                        <?php echo $keseluruhan; ?>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <form action="proses/p_bayar.php" class="needs-validation" method="POST" novalidate>
                                        <input type="hidden" name="kodeorder" value="<?php echo $kodeorder; ?>">
                                        <input type="hidden" name="meja" value="<?php echo $nomormeja; ?>">
                                        <input type="hidden" name="pelanggan" value="<?php echo $namapelanggan; ?>">
                                        <input type="hidden" name="total" value="<?php echo $total; ?>">
                                        <div class=" row">
                                            <div class="col-lg-12">
                                                <div class="form-floating mb-2">
                                                    <input type="number" class="form-control" id="floatingInput" placeholder="Total Pembayaran" name="uang" required>
                                                    <label for="floatingInput">Money denomination</label>
                                                    <div class="invalid-feedback mb-2">
                                                        Input Money denomination
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <span class="text-danger fs-6">Are you sure you want to make a payment?</span>
                                        <div class="modal-footer mt-2">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary" name="bayar_validate" value="submit">Pay</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END MODAL BAYAR ITEM -->

                    <!-- TABLE MENU -->
                    <div class=" table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr class="text-nowrap">
                                    <th scope="col">Menu</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Qty</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $total = 0;
                                foreach ($result as $row) {
                                    $harga = "Rp " . number_format($row['harga'], 2, ",", ".");
                                    $harganya = "Rp " . number_format($row['harganya'], 2, ",", "."); ?>
                                    <tr class="text-nowrap">
                                        <td><?php echo $row['nama_menu']; ?></td>
                                        <td><?php echo $harga; ?></td>
                                        <td><?php echo $row['jumlah']; ?></td>
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
                                        <td><?php echo $row['catatan_item']; ?></td>
                                        <td><?php echo $harganya; ?></td>
                                        <td>
                                            <div class="d-flex">
                                                <button class="<?php echo (!empty($row['id_bayar']) || $row['status'] >= 1) ? "btn text-dark btn-sm me-1 disabled" : "btn text-dark btn-sm me-1"; ?>" style="background-color: #FFD93D;" data-bs-toggle="modal" data-bs-target="#ModalEditItem<?php echo $row['id_list_order']; ?>"><i class="bi bi-pencil"></i></button>
                                                <button class="<?php echo (!empty($row['id_bayar']) || $row['status'] >= 1) ? "btn text-dark btn-sm me-1 disabled" : "btn text-dark btn-sm me-1"; ?>" style="background-color: #FF6B6B;" data-bs-toggle="modal" data-bs-target="#ModalDeleteItem<?php echo $row['id_list_order']; ?>"><i class="bi bi-trash"></i></button>
                                            </div>
                                        </td>
                                    </tr>
                                <?php
                                    $total += $row['harganya'];
                                    $keseluruhan = "Rp " . number_format($total, 2, ",", ".");
                                }
                                ?>
                                <tr class="fw-bold text-nowrap">
                                    <td colspan="5">
                                        Total Price
                                    </td>
                                    <td>
                                        <?php echo $keseluruhan; ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- END TABLE MENU -->
                <?php } ?>
            </div>
            <div>
                <button class="<?php echo (!empty($row['id_bayar'])) ? "btn fw-bold text-light disabled" : "btn fw-bold text-light"; ?>" style="background-color: #85586F;" data-bs-toggle="modal" data-bs-target="#ModalTambahItem"><i class=" bi bi-plus-circle"></i> Item</button>
                <button class="<?php echo (!empty($row['id_bayar'])) ? "btn fw-bold text-light disabled" : "btn fw-bold text-light"; ?>" style="background-color: #85586F;" data-bs-toggle="modal" data-bs-target="#ModalBayar"><i class="bi bi-cash-coin"></i> Pay</button>
                <?php
                if ($_SESSION['level_vcoffe'] == 1) {
                ?>
                    <button class="<?php echo (!empty($row['id_bayar'])) ? "btn fw-bold text-light btn-danger disabled" : "btn fw-bold text-light bg-danger"; ?>" data-bs-toggle="modal" data-bs-target="#ModalDeleteAllItem<?php echo $row['kode_order']; ?>"><i class="bi bi-trash"></i> Delete All</button>
                <?php
                }
                ?>
            </div>
        </div>
    </div>