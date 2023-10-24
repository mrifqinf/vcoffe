<?php
include "proses/connect.php";
date_default_timezone_set('Asia/Jakarta');
$query = mysqli_query($conn, "SELECT tb_order.*,tb_bayar.*,name, SUM(harga*jumlah) AS harganya FROM tb_order
LEFT JOIN tb_user ON tb_user.id = tb_order.pelayan
LEFT JOIN tb_list_order ON tb_list_order.kode_order = tb_order.id_order
LEFT JOIN tb_daftar_menu ON tb_daftar_menu.id = tb_list_order.menu
JOIN tb_bayar ON tb_bayar.id_bayar = tb_order.id_order
GROUP BY id_order ORDER BY waktu_order DESC");
while ($record = mysqli_fetch_array($query)) {
    $result[] = $record;
}

$select_kat_menu = mysqli_query($conn, "SELECT id_kat_menu, kategori_menu FROM tb_kategori_menu");
?>

<div class="col-lg-9 mt-2">
    <div class="card">
        <div class="fw-bold text-white card-header" style="background-color: #85586F;">
            REPORT
        </div>
        <div class="card-body" style="background-color: #F8EDE3;">
            <?php
            if (empty($result)) {
                echo "<div class='alert alert-danger'>Report not yet available</div>";
            } else { ?>
                <!-- TABLE MENU -->
                <div class=" table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr class="text-nowrap">
                                <th scope="col">No</th>
                                <th scope="col">Order Code</th>
                                <th scope="col">Customer Name</th>
                                <th scope="col">Table</th>
                                <th scope="col">Total Price</th>
                                <th scope="col">Waiters</th>
                                <th scope="col">Order Time</th>
                                <th scope="col">Pay Time</th>
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
                                    <td><?php echo $row['waktu_order']; ?></td>
                                    <td><?php echo $row['waktu_bayar']; ?></td>
                                    <td>
                                        <div class="d-flex">
                                            <a class="btn btn-sm me-1 text-light" style="background-color: #85586F;" href="../?x=viewitem&order=<?php echo $row['id_order'] . "&meja=" . $row['meja'] . "&pelanggan=" . $row['pelanggan']; ?>"><i class="bi bi-eye"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            <?php
                                // $total += $row['harganya'];
                                // $keseluruhan = "Rp " . number_format($total, 2, ",", ".");
                            }
                            ?>
                            <!-- <tr class="fw-bold text-nowrap">
                                <td colspan="4">
                                    Omzet
                                </td>
                                <td>
                                    <?php ?> **Tinggal uncomment semua dari baris 62 sampai 73 dan echo $keseluruhan di baris 71**
                                </td>
                            </tr> -->
                        </tbody>
                    </table>
                </div>
                <!-- END TABLE MENU -->
            <?php
            }
            ?>
        </div>
    </div>
</div>