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

$select_menu = mysqli_query($conn, "SELECT id, nama_menu FROM tb_daftar_menu");
?>

<div class="col-lg-9 mt-2">
    <div class="card">
        <div class="fw-bold text-white card-header" style="background-color: #85586F;">
            REPORT ITEM BY ORDER
        </div>
        <div class="card-body" style="background-color: #F8EDE3;">
            <a href="report" class="btn btn-secondary mb-3"><i class="bi bi-arrow-left"></i> Back</a>
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
            </div>
        </div>
    </div>