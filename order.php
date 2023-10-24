<?php
include "proses/connect.php";
date_default_timezone_set('Asia/Jakarta');
$query = mysqli_query($conn, "SELECT tb_order.*,tb_bayar.*,name, SUM(harga*jumlah) AS harganya FROM tb_order
LEFT JOIN tb_user ON tb_user.id = tb_order.pelayan
LEFT JOIN tb_list_order ON tb_list_order.kode_order = tb_order.id_order
LEFT JOIN tb_daftar_menu ON tb_daftar_menu.id = tb_list_order.menu
LEFT JOIN tb_bayar ON tb_bayar.id_bayar = tb_order.id_order
GROUP BY id_order ORDER BY waktu_order DESC");
while ($record = mysqli_fetch_array($query)) {
    $result[] = $record;
}

$select_kat_menu = mysqli_query($conn, "SELECT id_kat_menu, kategori_menu FROM tb_kategori_menu");
?>

<div class="col-lg-9 mt-2">
    <div class="card">
        <div class="fw-bold text-white card-header" style="background-color: #85586F;">
            ORDER LIST
        </div>
        <div class="card-body" style="background-color: #F8EDE3;">
            <div class="row">
                <div class="col d-flex justify-content-end mb-2">
                    <button class="btn fw-bold text-light" style="background-color: #85586F;" data-bs-toggle="modal" data-bs-target="#ModalTambahMenu"><i class="bi bi-plus-circle"></i> Order</button>
                </div>
            </div>
            <!-- MODAL TAMBAH ORDERAN-->
            <div class="modal fade" id="ModalTambahMenu" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-fullscreen-md-down">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">New Order</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="proses/p_input_order.php" class="needs-validation" method="POST" novalidate>
                                <div class="row">
                                    <div class="col-lg-3">
                                        <div class="form-floating mb-3">
                                            <input type="number" class="form-control" id="floatingInput" placeholder="" name="kodeorder" value="<?php echo date('Hidm') . rand(100, 999) ?>" readonly>
                                            <label for="kodeorder">Order Code</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-floating mb-3">
                                            <input type="number" class="form-control" id="floatingInput" placeholder="Nomor Meja" name="meja" required>
                                            <label for="meja">Table Number</label>
                                            <div class="invalid-feedback mb-2">
                                                Input Table Number
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="floatingInput" placeholder="Nama Pelanggan" name="pelanggan" required>
                                            <label for="pelanggan">Customer Name</label>
                                            <div class="invalid-feedback mb-2">
                                                Input Customer Name
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="floatingInput" placeholder="Catatan" name="catatan">
                                            <label for="catatan">Catatan (opsional)</label>
                                        </div>
                                    </div>
                                </div> -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary" name="input_order_validate" value="submit">Add</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END MODAL TAMBAH ORDERAN -->
            <?php
            if (empty($result)) {
                echo "<div class='alert alert-danger'>The order has not been added, please add the order first</div>";
            } else {
                foreach ($result as $row) { ?>
                    <!-- MODAL EDIT -->
                    <div class="modal fade" id="ModalEditOrder<?php echo $row['id_order']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-fullscreen-md-down">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Menu Makanan/Minuman</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="proses/p_edit_order.php" class="needs-validation" method="POST" novalidate>
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <div class="form-floating mb-3">
                                                    <input type="number" class="form-control" id="floatingInput" placeholder="" name="kodeorder" value="<?php echo $row['id_order']; ?>" readonly>
                                                    <label for="kodeorder">Order Code</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-floating mb-3">
                                                    <input type="number" class="form-control" id="floatingInput" placeholder="Nomor Meja" name="meja" value="<?php echo $row['meja']; ?>" required>
                                                    <label for="meja">Table Number</label>
                                                    <div class="invalid-feedback mb-2">
                                                        Input Table Number
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" id="floatingInput" placeholder="Nama Pelanggan" name="pelanggan" value="<?php echo $row['pelanggan']; ?>" required>
                                                    <label for="pelanggan">Customer Name</label>
                                                    <div class="invalid-feedback mb-2">
                                                        Input Customer Name
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" id="floatingInput" placeholder="Catatan" name="catatan" value="<?php echo $row['catatan']; ?>">
                                                    <label for="catatan">Catatan (opsional)</label>
                                                </div>
                                            </div>
                                        </div> -->
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-success" name="edit_order_validate" value="submit">Save Changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END MODAL EDIT -->

                    <!-- MODAL DELETE -->
                    <div class="modal fade" id="ModalDeleteOrder<?php echo $row['id_order'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-md modal-fullscreen-md-down">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Order</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="proses/p_delete_order.php" class="needs-validation" method="POST" novalidate>
                                        <input type="hidden" value="<?php echo $row['id_order']; ?>" name="kodeorder">
                                        <div class="col-lg-12">
                                            Do you want to delete an order with an order code <b> <?php echo $row['id_order']; ?> </b> on behalf of <b> <?php echo $row['pelanggan']; ?> </b> ?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-danger" name="delete_order_validate" value="submit">Delete</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END MODAL DELETE -->

                <?php } ?>
                <!-- TABLE MENU -->
                <div class=" table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr class="text-nowrap">
                                <th scope="col">No</th>
                                <th scope="col">Order Code</th>
                                <th scope="col">Customer</th>
                                <th scope="col">Table</th>
                                <th scope="col">Price Total</th>
                                <th scope="col">Waiters</th>
                                <th scope="col">Status</th>
                                <th scope="col">Order Time</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($result as $row) { ?>
                                <tr class="text-nowrap">
                                    <th scope="row"><?php echo $no++ ?></th>
                                    <td><?php echo $row['id_order']; ?></td>
                                    <td><?php echo $row['pelanggan']; ?></td>
                                    <td><?php echo $row['meja']; ?></td>
                                    <td><?php echo "Rp " . number_format((int)$row['harganya'], 2, ',', '.') ?></td>
                                    <td><?php echo $row['name']; ?></td>
                                    <td><?php echo (!empty($row['id_bayar'])) ? "<span class='bagde rounded bg-success p-1 text-light'>Paid</span>" : "<span class='bagde rounded bg-danger p-1 text-light'>Not yet Paid</span>"; ?></td>
                                    <td><?php echo $row['waktu_order']; ?></td>
                                    <td>
                                        <div class="d-flex">
                                            <a class="btn btn-sm me-1 text-light" style="background-color: #85586F;" href="../?x=orderitem&order=<?php echo $row['id_order'] . "&meja=" . $row['meja'] . "&pelanggan=" . $row['pelanggan']; ?>"><i class="bi bi-eye"></i></a>
                                            <button class="<?php echo (!empty($row['id_bayar'])) ? "btn btn-sm me-1 text-dark disabled" : "btn btn-sm me-1 text-dark"; ?>" style="background-color: #FFD93D;" data-bs-toggle="modal" data-bs-target="#ModalEditOrder<?php echo $row['id_order']; ?>"><i class="bi bi-pencil"></i></button>
                                            <button class="<?php echo (!empty($row['id_bayar'])) ? "btn btn-sm me-1 text-dark disabled" : "btn btn-sm me-1 text-dark"; ?>" style="background-color: #FF6B6B;" data-bs-toggle="modal" data-bs-target="#ModalDeleteOrder<?php echo $row['id_order']; ?>"><i class="bi bi-trash"></i></button>
                                        </div>
                                    </td>
                                </tr>
                            <?php
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