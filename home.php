<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<?php
include "proses/connect.php";
$query = mysqli_query($conn, "SELECT nama_menu, tb_daftar_menu.id, SUM(tb_list_order.jumlah) AS total_jumlah FROM tb_daftar_menu
LEFT JOIN tb_list_order ON tb_daftar_menu.id = tb_list_order.menu
GROUP BY tb_daftar_menu.id
ORDER BY total_jumlah DESC LIMIT 7");
// $result = array();
while ($row = mysqli_fetch_array($query)) {
    $result[] = $row;
}

$array_menu = array_column($result, 'nama_menu');
$array_menu_quote = array_map(function ($menu) {
    return "'" . $menu . "'";
}, $array_menu);
$string_menu = implode(', ', $array_menu_quote);
$array_jumlah = array_column($result, 'total_jumlah');
$string_jumlah = implode(',', $array_jumlah);
?>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<div class="col-lg-9 mt-2">
    <!-- CAROUSEL -->
    <div id="carouselExampleCaptions" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="5000">
        <div class="carousel-inner rounded">
            <div class="carousel-item active">
                <img src="assets/images/carousel-test-pict-1.png" class="img-fluid" style="height: 300px; width: 10000px; object-fit: cover;" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5>First slide Picture test</h5>
                    <p>Some representative placeholder content for the first slide.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="assets/images/carousel-test-pict-2.png" class="img-fluid" style="height: 300px; width: 10000px; object-fit: cover;" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Second slide Picture test</h5>
                    <p>Some representative placeholder content for the second slide.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="assets/images/carousel-test-pict-3.png" class="img-fluid" style="height: 300px; width: 10000px; object-fit: cover;" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Third slide Picture test</h5>
                    <p>Some representative placeholder content for the third slide.</p>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon visually-hidden" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon visually-hidden" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <!-- END CAROUSEL -->
    <div class="card mt-3 border-0">
        <div class="card-body rounded text-center" style="background-color: #F8EDE3;">
            <h5 class="card-title">Welcome to V-Coffe</h5>
            <p class="card-text">Help me to find what insights I should include on this website<br>Send Your Ideas to Email <b> <a class="link-offset-3 link-underline link-underline-opacity-0 link-opacity-10-hover" href="mailto:developervcafe@gmail.com?subject=MY IDEAS">developervcafe@gmail.com</a></b><br>Please include Whatsapp or Instagram Username to be rewarded if the idea is interesting</p>
            <a href="menu" class="btn fw-bold text-light" style="background-color: #85586F;">See all Menu</a>
        </div>
    </div>
    <div class="card mt-3 border-0">
        <div class="card-body rounded text-center" style="background-color: #F8EDE3;">
            <div>
                <canvas id="ChartBestSeller"></canvas>
            </div>
            <script>
                const ctx = document.getElementById('ChartBestSeller');

                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: [<?php echo $string_menu ?>],
                        datasets: [{
                            label: '#7 Best Seller',
                            data: [<?php echo $string_jumlah ?>],
                            borderWidth: 1,
                            backgroundColor: [
                                'rgba(133, 88, 111, 0.5)',
                            ]
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            </script>
        </div>
    </div>
</div>