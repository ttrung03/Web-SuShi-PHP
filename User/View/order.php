<section class=" popular section">
    <div class="cart-container ">
        <table class="table">
            <?php
            $hd = new hoadon();
            $result = $hd->getOrder($_SESSION['sohd']);
            $sohdon = $result['masohd'];
            $ngay = $result['ngaydat'];
            $ten = $result['tenkh'];
            $diachi = $result['diachi'];
            $dt = $result['sodienthoai'];

            $d = new DateTime($ngay);
            ?>

            <tr>
                <td colspan="4">
                    <h2 style="color: red; text-align: center; ">HÓA ĐƠN</h2>
                </td>
            </tr>
            <tr>
                <td colspan="2">Số Hóa đơn:<?php echo $sohdon; ?> </td>
                <td colspan="2"> Ngày lập:<?php echo $d->format('d/m/Y'); ?></td>
            </tr>
            <tr>
                <td colspan="2">Họ và tên:</td>
                <td colspan="2"><?php echo $ten ?></td>
            </tr>
            <tr>
                <td colspan="2">Địa chỉ: </td>
                <td colspan="2"><?php echo $diachi ?></td>
            </tr>
            <tr>
                <td colspan="2">Số điện thoại: </td>
                <td colspan="2"><?php echo $dt ?></td>
            </tr>
        </table>

        <!-- Thông tin sản phầm -->
        <table class="table">
            <thead style="background-color: #c3e6cb">
                <tr class="table-success">
                    <th>Số TT</th>
                    <th>Thông Tin Sản Phẩm</th>
                    <th>Tùy Chọn Của Bạn</th>
                    <th>Giá</th>
                </tr>
            </thead>

            <tbody>
                <?php
                $j = 0;
                $result = $hd->getOrderDetail($_SESSION['sohd']);
                while ($set = $result->fetch()) :
                    $j++;
                    $hh = new hanghoa();
                    $tloai = $hh->getTenLoai($set['maloai']);
                    $tenloai = $tloai['tenloai'];
                ?>

                    <tr>
                        <td><?php echo $j; ?></td>
                        <td><?php echo $set['tenhh']; ?></td>
                        <td>Loại: <?php echo $tenloai; ?> </td>
                        <td>Đơn Giá: <span class="total-price popular__price "><?php echo $set['dongia']; ?> $</span>
                            - Số Lượng: <span class="total-price popular__price "><?php echo $set['soluongmua']; ?> </span><br />
                        </td>
                    </tr>
                <?php
                endwhile;

                ?>

                <tr>
                    <td colspan="4">
                        <b>Tổng Tiền:</b>
                        <span style="float: right;" class="total-price popular__price ">
                            <?php
                            $gh = new giohang();
                            echo $gh->getTotal();
                            ?> $
                        </span>
                    </td>

                </tr>
            </tbody>
        </table>
</section>