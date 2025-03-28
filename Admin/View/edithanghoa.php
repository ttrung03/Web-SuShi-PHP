<?php
if (isset($_GET['act'])) {
  if ($_GET['act'] == 'edit') {
    $ac = 1;
  }
  if ($_GET['act'] == 'insert' || $_GET['act'] == 'insert_action') {
    $ac = 2;
  }
}
if ($ac == 1) {
  echo '<div class="col-md-4 col-md-offset-4 my-5 text-center"><h3 ><b>CẬP NHẬT SẢN PHẨM</b></h3></div>';
} else if ($ac == 2) {
  echo '<div class="col-md-4 col-md-offset-4 my-5 text-center"><h3><b>THÊM SẢN PHẨM</b></h3></div>';
}
?>


<div class="row col-md-4 col-md-offset-4">
  <?php
  if (isset($_GET['id']) && $ac == 1) {
    $id = $_GET['id'];
    $hh = new hanghoa();
    $result = $hh->getHangHoaId($id);
    $mahh = $result['mahh'];
    $tenhh = $result['tenhh'];
    $dongia = $result['dongia'];
    $giamgia = $result['giamgia'];
    $hinh = $result['hinh'];
    $nhom = $result['Nhom'];
    $maloai = $result['maloai'];
    $soluotxem = $result['soluotxem'];
    $ngaylap = $result['ngaylap'];
    $mota = $result['mota'];
    $soluongton = $result['soluongton'];
    $tinhtrang = $result['tinhtrang'];
  } else {
    $mahh = null;
    $tenhh = null;
    $dongia = 0;
    $giamgia = 0;
    $hinh = null;
    $nhom = null;
    $maloai = null;
    $soluotxem = 0;
    $ngaylap = date('Y-m-d');
    $mota = null;
    $soluongton = 0;
    $tinhtrang = 0;
  }

  if ($ac == 1) {
    echo '<form action="index.php?action=hanghoa&act=edit_action&id=' . $id . '" method="post" enctype="multipart/form-data">';
  }
  if ($ac == 2) {
    echo '<form action="index.php?action=hanghoa&act=insert_action" method="post" enctype="multipart/form-data">';
  }
  ?>


  <table class="table" style="border: 0px;">

    <tr>
      <td>Tên hàng</td>
      <td><input type="text" class="form-control" value="<?php echo $tenhh ?>" name="tenhh" maxlength="100px"></td>
    </tr>
    <tr>
      <td>Đơn giá</td>
      <td><input type="number" class="form-control" value="<?php echo $dongia ?>" name="dongia"></td>
    </tr>
    <tr>
      <td>Giảm giá</td>
      <td><input type="number" class="form-control" value="<?php echo $giamgia ?>" name="giamgia"></td>
    </tr>
    <tr>
      <td>Hình</td>
      <td>
        <?php
        if (isset($hinh))
          echo  "<label><img width='50px' height='50px' name='image' src='../DuAn/Content/img/$hinh' value='$hinh' ></label>";
        ?>
        Chọn file để upload:
        <input type="file" name="image" id="fileupload">
      </td>
    </tr>

    <tr>
      <td>Mã loại</td>
      <td>
        <select name="maloai" class="form-control" style="width:150px;">
          <?php
          $dl = new hanghoa();
          $result = $dl->getLoai();
          while ($set = $result->fetch()) :
          ?>
            <option <?php if ($maloai == $set['maloai']) echo "selected"; ?> value="<?php echo $set['maloai']; ?>">
              <?php echo $set['tenloai']; ?></option>
          <?php
          endwhile;
          ?>
        </select>
      </td>
    </tr>

    <tr>
      <td>Số lượt xem</td>
      <td><input type="number" class="form-control" value="<?php echo $soluotxem ?>" name="slx">
      </td>
    </tr>
    <tr>
      <td>Ngày lập</td>
      <td><input type="date" class="form-control" value="<?php echo $ngaylap ?>" name="ngaylap">
      </td>
    </tr>
    <tr>
      <td>Mô tả</td>
      <td><input type="text" class="form-control" value="<?php echo $mota ?>" name="mota">
      </td>
    </tr>
    <tr>
      <td>Số lượng tồn</td>
      <td><input type="number" class="form-control" value="<?php echo $soluongton ?>" name="slt">
      </td>
    </tr>
    <tr>
      <td>Tình trạng</td>
      <td><input type="number" class="form-control" value="<?php echo $tinhtrang ?>" name="tinhtrang">
      </td>
    </tr>

    <tr>
      <td colspan="2">
        <input type="submit" value="submit">

      </td>
    </tr>

  </table>
  </form>
</div>