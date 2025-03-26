 <meta charset="UTF-8">
 <!--Load the AJAX API-->
 <script type="text/javascript" src="https://www.google.com/jsapi"></script>
 <script type="text/javascript">
   google.load('visualization', '1.0', {
     'packages': ['corechart']
   });
   google.setOnLoadCallback(drawVisualization);

   function drawVisualization() {
     //thống kê số lượng bán hàng theo mặt hàng vẽ bieu do tron
     // B1: tạo bảng
     var data = new google.visualization.DataTable();
     // + lấy dữ liệu từ database ra để tạo dòng
     var tenhh = new Array();
     var soluongban = new Array();
     var dataten = 0;
     var slb = 0;
     var rows = new Array();

    <?php
    $hh =  new hanghoa();
    $result = $hh->getThongKeMatHang($option, $day, $month, $year, $quarter);
    while ($set = $result->fetch()) {
      $tenhh = $set['tenhh'];
      $soluong = $set['soluong'];
      echo "tenhh.push('" . $tenhh . "');";
      echo "soluongban.push('" . $soluong . "');";
    }
    ?>

     // + tạo dòng
     for (var i = 0; i < tenhh.length; i++) {
       dataten = tenhh[i]; //Dép Quai Chữ V Đan Chéo Vân Cá Sấu
       slb = parseInt(soluongban[i]); //117
       rows.push([dataten, slb]);
       // + tạo cột
     }

     data.addColumn('string', 'Hàng hóa');
     data.addColumn('number', 'số lượng bán');
     data.addRows(rows);
     // b2: tạo options
     var options = {
       'width': 600,
       title: 'Thống kê mặt hàng đã bán',
       'height': 400,
       'backgroundColor': '#ffffff',
       is3D: true
     };
     // b3: tiến hành vẽ khi có dữ liệu (datatable) và options // Pie, Column, Bar, Line
     var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
     chart.draw(data, options);
   }
 </script>

<div class="w-100" style="margin-top: 5rem">
  <!-- Button to Open the Modal -->
  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Thống kê theo ngày</button>
  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal1">Thống kê theo tháng</button>
  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal2">Thống kê theo quý</button>

  <!-- Thống kê theo ngày -->
  <div class="modal" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Thống Kê Theo Ngày</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <!-- Modal body -->
        <div class="modal-body text-center">
          <form class="m-auto" action="<?php htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <input type="hidden" name="optionTK" value="1">
            <input class="inputTK" type="date" name="dateTK" placeholder="Ngày">
            <button type="submit" class="btn btn-dark text-light">Enter</button>
          </form>
        </div>

      </div>
    </div>
  </div>

  <!-- Thống kê theo tháng -->
  <div class="modal" id="myModal1">
    <div class="modal-dialog">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Thống Kê Theo Tháng</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <!-- Modal body -->
        <div class="modal-body m-auto">
          <form class="d-flex modal-tk m-auto" action="<?php htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <input type="hidden" name="optionTK" value="2">
            <input class="m-2" type="number" name="month" max="12" min="1" maxlength="2" placeholder="Tháng" value="<?php echo $month ?>"> <br>
            <input class="m-2" type="number" name="year" placeholder="Năm" value="<?php echo $year ?>"> <br>
            <button type="submit" class="btn btn-dark text-light m-2">Enter</button>
          </form>
        </div>

      </div>
    </div>
  </div>

  <!-- Theo Qúy -->
  <div class="modal" id="myModal2">
    <div class="modal-dialog">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Thống Kê Theo Quý</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <!-- Modal body -->
        <div class="modal-body text-center m-auto ">
          <form class="d-flex modal-tk" action="<?php htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <input type="hidden" name="optionTK" value="3">
            <input class="m-2" type="number" name="quarter" max="4" min="1" maxlength="1" placeholder="Quí" value="<?php echo $quarter ?>"> <br>
            <input class="m-2" type="number" name="year" placeholder="Năm" value="<?php echo $year ?>"> <br>
            <button type="submit" class="btn btn-dark text-light m-2">Enter</button>
          </form>
        </div>

      </div>
    </div>
  </div>
</div>


<div class="m-auto">
  <div style=" width:50%;  float: left;" id="chart_div"></div>
</div>

 <!-- <div class="thongke">
   <div class="mt-5 bg-secondary p-2">
     <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
       <input type="number" name="day" placeholder="Ngày" value="<?php echo $day ?>">
       <input type="number" name="month" placeholder="Tháng" value="<?php echo $month ?>">
       <input type="number" name="year" placeholder="Năm" value="<?php echo $year ?>">
       <input type="number" name="quarter" placeholder="Quí" value="<?php echo $quarter ?>">
       <button type="submit">Thống Kê</button>
     </form>
   </div>
   
   <div style=" width:50%;  float: left;" id="chart_div">dfsf</div>
   <div style=" width:50%;  float: right" id="chart_div1">dsfd</div>
 </div> -->