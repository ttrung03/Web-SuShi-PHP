<div class="mt-5 w-100 mb-5">
    <h4 class="text-center">Hóa đơn</h4>
    <div class="row row-cols-1 row-cols-md-4 g-4">
        <?php
        $hh = new hoadon();
        $result = $hh->getHoadon();
        while ($set = $result->fetch()) {
        ?>
            <div class="col p-3">
                <a href="index.php?action=hoadon&act=chitiethoadon&sohd=<?php echo $set['masohd']; ?>">
                    <div class="card">
                        <div class="row p-4">
                            <div class="col-4 m-auto">
                                <h1 class="m-auto"><?php echo $set['masohd']; ?></h1>
                            </div>
                            <div class="col-8 m-auto">
                                <h5 class="card-text">Ngày đặt: <?php echo $set['ngaydat'] ?></h5>
                                <h5 class="card-text">Tổng tiền: <?php echo (number_format($set['tongtien'])) ?></h5>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

        <?php } ?>
    </div>


</div>