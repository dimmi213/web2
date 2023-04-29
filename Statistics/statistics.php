<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <title>Document</title>
</head>
<body>
<form class="ms-auto my-3 my-lg-0">
  <?php
  include_once("./dbconnect.php");
  $dbcon = new dbconnect();
  $conn = $dbcon->connect();
  if (isset($_GET["fromdate"], $_GET["todate"])) {
    $fromdate = $_GET["fromdate"];
    $todate = $_GET["todate"];
  }
  ?>
        <div class="w-25">
            <input type="hidden" name="chon" value="statistics">
            <label for="startdate">From:</label>
            <input type="date" name="fromdate" id="fromdate" class="form-control" value="<?php
                if (isset($_GET["fromdate"]))
                    echo $_GET["fromdate"];
                ?>">
            <label for="totdate">To:</label>
            <input type="date" name="todate" id="todate" class="form-control" value="<?php
                if (isset($_GET["todate"]))
                    echo $_GET["todate"];
                ?>">
        </div>
        <label for="searchkey">Category:</label>
        <div class="w-25 d-flex">
        <select class="form-select" aria-label="Default select example" id="DCategory" name="Category">
                                    <?php
                                    $query = "select * from category";
                                    $result = mysqli_query($conn, $query);
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<option value=" . $row["ID"] . ">" . $row["Name"] . "</option>";
                                    }
                                    echo "<option value='all'> ALL </option>";
                                    ?>
                                </select>
            <button class="btn btn-primary" type="submit">
                <i class="bi bi-search"></i>
            </button>
        </div>
  </form>
<?php

// $sql = "";
// if(isset($_GET['Category']) && $_GET['Category'] == 'all'){
//   $sql = "";
// }
// else if(isset($_GET['Category'])){
//   $Category = $_GET['Category'];
//   $sql = " SELECT a.ID,(b.total_quantity*a.Price) as total_price,b.total_quantity  FROM 
//   (SELECT p.ID,p.Price FROM category c INNER JOIN product p on c.ID=p.Category_ID WHERE c.id=$Category) a LEFT JOIN 
//   (SELECT od.Product_ID,SUM(od.Quantity) as total_quantity FROM 
//   orders o INNER JOIN order_detail od on o.ID=od.Order_ID WHERE BuyDate BETWEEN '$fromdate' AND '$todate' GROUP BY od.Product_ID) b on a.ID=b.Product_ID";
// }


// $result = mysqli_query($conn, $sql);
// if (!$result) {
//     die('Invalid query: ' . mysqli_error($conn));
// }

// while($row = mysqli_fetch_assoc($result)){
//     $ID[] = $row['ID'];
//     $total_price[] = $row['total_price'];
// }

//----------------------------------
$sql = "";
if(isset($_GET['Category']) && $_GET['Category'] == 'all'){
  $sql = "";
}
else if(isset($_GET['Category'])){
  $Category = $_GET['Category'];
  $sql = "SELECT p.ID, (SUM(od.Quantity) * p.Price) as total_price, SUM(od.Quantity) as total_quantity 
          FROM category c 
          INNER JOIN product p ON c.ID = p.Category_ID 
          LEFT JOIN order_detail od ON p.ID = od.Product_ID 
          INNER JOIN orders o ON o.ID = od.Order_ID 
          WHERE c.ID = $Category 
          AND o.BuyDate BETWEEN '$fromdate' AND '$todate' 
          GROUP BY p.ID";
}
$result = mysqli_query($conn, $sql);
if (!$result) {
    die('Invalid query: ' . mysqli_error($conn));
}

while($row = mysqli_fetch_assoc($result)){
    $ID[] = $row['ID'];
    $total_price[] = $row['total_price'];
}

//---------------------------------

?>
 <div>
  <canvas id="myChart"></canvas>
</div>
 
<script>
  const ctx = document.getElementById('myChart');

  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: <?php echo json_encode($ID) ?>,
      datasets: [{
        label: 'Total $',
        data: <?php echo json_encode($total_price) ?>,
        borderWidth: 1
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
  
</body>
</html>