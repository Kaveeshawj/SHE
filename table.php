<?php
$con  = mysqli_connect("localhost", "root", "Princess@18", "she", "3306");
if (!$con) {
    echo "Problem in database connection! Contact administrator!";
} else {
    $sql = "SELECT * FROM invoice INNER JOIN `product` ON product.id=invoice.product_id";
    $result = mysqli_query($con, $sql);
    $chart_data = "";
    while ($row = mysqli_fetch_array($result)) {
        $productname[]  = $row['title'];
        $sales[] = $row['total'];
    }
}

echo "<pre>";
print_r($productname);
print_r($sales);
echo "</pre>";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Graph</title>
</head>

<body>
    <div style="width:60%;height:20%;text-align:center">
        <h2 class="page-header">Analytics Reports </h2>
        <div>Product </div>
        <canvas id="chartjs_bar"></canvas>
    </div>
</body>
<script src="https://code.jquery.com/jquery-1.9.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
<script type="text/javascript">
    var ctx = document.getElementById("chartjs_bar").getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: <?php echo json_encode($productname); ?>,
            datasets: [{
                backgroundColor: [
                    "#5969ff", "#ff407b", "#25d5f2", "#ffc750", "#2ec551", "#7040fa",
                    "#ff004e", "#C8B6FF", "#262626", "#5969ff", "#ff407b", "#25d5f2",
                    "#ffc750", "#2ec551", "#7040fa", "#ff004e", "#C8B6FF", "#262626",
                    "#5969ff", "#ff407b", "#25d5f2", "#ffc750", "#2ec551", "#7040fa",
                    "#ff004e", "#C8B6FF", "#262626", "#5969ff", "#ff407b", "#25d5f2",
                    "#ffc750", "#2ec551", "#7040fa", "#ff004e", "#C8B6FF", "#262626",
                ],
                data: <?php echo json_encode($sales); ?>,
            }]
        },
        options: {
                        legend: {
                            display: true,
                            position: 'bottom',
                            labels: {
                                fontColor: '#71748d',
                                fontFamily: 'Circular Std Book',
                                fontSize: 14,
                            }
                        },
                        plugins: {
                            title: {
                                display: true,
                                text: 'Products'
                            }
                        }
                    }
    });
</script>

</html>
