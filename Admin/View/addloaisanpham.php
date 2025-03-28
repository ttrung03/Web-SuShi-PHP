<div class="card mt-3">
  <div class="card-header info">
  Import CSV Loại
  </div>
  <div class="card-body">
    <form action="index.php?action=loai&act=loai_action" method="post" enctype="multipart/form-data">
      <input type="file" name="file" />
      <input type="submit" name="submit_file" value="Submit">
    </form>
  </div>

  <div class="card-header info">
  Import CSV Sản Phẩm
  </div>
  <div class="card-body">
    <form action="index.php?action=hanghoa&act=hanghoa_import" method="post" enctype="multipart/form-data">
      <input type="file" name="file" />
      <input type="submit" name="submit_file" value="Submit">
    </form>
  </div>
</div>