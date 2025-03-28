<div class="mt-5 w-100">
    <h4 class="text-center text-primary">CHI TIẾT HÓA ĐƠN</h4>
    <div>

        <table class="table table-bordered bg-light" border="0">
            <?php
            if (isset($_GET['sohd'])) {
                $sohd = $_GET['sohd'];
                $hd = new hoadon();
                $result = $hd->getChitiethoadon($sohd);
                $ngay = $result['ngaydat'];
                $tongtien = $result['tongtien'];
                $tenkh = $result['tenkh'];
                $diachi = $result['diachi'];
                $dt = $result['sodienthoai'];
            }

            ?>

            <tr>
                <td colspan="4">
                    <h5 style="color: red;" class="text-center">THÔNG TIN KHÁCH HÀNG</h5>
                </td>
            </tr>
            <tr>
                <td colspan="2">Số Hóa đơn: <b><?php echo $sohd; ?></b> </td>
                <td colspan="2"> Ngày lập: <b><?php echo $ngay ?></b></td>
            </tr>
            <tr>
                <td colspan="2">Họ và tên:</td>
                <td colspan="2"><b><?php echo $tenkh ?></b></td>
            </tr>
            <tr>
                <td colspan="2">Địa chỉ: </td>
                <td colspan="2"><b><?php echo $diachi ?></b></td>
            </tr>
            <tr>
                <td colspan="2">Số điện thoại: </td>
                <td colspan="2"><b><?php echo $dt ?></b></td>
            </tr>
        </table>

        <!-- Thông tin sản phầm -->
        <table class="table table-bordered bg-light">
            <h5 style="color: red;" class="text-center">THÔNG TIN SẢN PHẨM</h5>
            <thead>
                <tr class="table-success text-center">
                    <th>Số TT</th>
                    <th>Hình ảnh</th>
                    <th>Thông Tin Sản Phẩm</th>
                    <th>Tùy Chọn Của Bạn</th>
                    <th>Giá</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $j = 0;
                $result = $hd->getOrderDetail($sohd);
                while ($set = $result->fetch()) :
                    $j++;
                ?>
                    <tr class="text-center">
                        <td><?php echo $j; ?></td>
                        <td><img style="width: 50px; border-radius: 100%" src="<?php echo $set['hinh'] ?>" alt=""></td>
                        <td><?php echo $set['tenhh'] ?></td>
                        <td>Số Lượng: <?php echo $set['soluongmua'] ?></td>
                        <td>Đơn Giá: <?php echo number_format($set['dongia']) ?> <sup><u>$</u></sup></td>
                    </tr>
                <?php endwhile; ?>

                <tr>
                    <td colspan="5">
                        <span style="float: right">
                            <b>Tổng tiền: </b>
                            <b>
                                <?php echo number_format($tongtien) ?>
                                <sup><u>$</u></sup>
                            </b>
                        </span>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>