<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tables - Admin</title>

    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="style.css" />
    <link rel="icon" href="resources/she-logos_black.png" />
</head>

<body style="background-color: #C8B6FF;background-image: linear-gradient(90deg,#C8B6FF 0%,#F191AC 100%);">

    <div class="container-fluid">
        <div class="col-12 pt-4 pb-5">
            <?php
            $con  = mysqli_connect("localhost", "root", "Princess@18", "she", "3306");
            if (!$con) {
                # code...
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

            // $sql =Database::search( "SELECT * FROM `invoice`");
            // $result = $sql->num_rows;
            // $chart_data = "";
            // $row = $result->fetch_assoc();
            // while ($row) {

            //     $productname[]  = $row['product_id'];
            //     $sales[] = $row['total'];
            // }
            ?>


            <div class="offset-3" style="width:60%;height:30%;text-align:center">
                <h2 class="page-header fw-bold fs-1 mt-3">Analytics Reports</h2>

                <div class="col-12 btn-toolbar justify-content-end">
                    <button class="btn btn-dark me-2" onclick="PrintInvoice4();"><i class="bi bi-printer-fill"></i> Print</button>
                </div>
                <div id="print4">
                <div class="fw-bold fs-3 mt-3 mb-4">Product </div>

<div style="background-color: #fefdff" class="pt-3"><canvas id="chartjs_bar"></canvas></div>
                </div>
            </div>


            <script src="//code.jquery.com/jquery-1.9.1.js"></script>
            <script src="//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
            <script type="text/javascript">
                var ctx = document.getElementById("chartjs_bar").getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: <?php echo json_encode($productname); ?>,
                        datasets: [{
                            label: 'Products',
                            backgroundColor: [
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


        </div>
    </div>

    <div class="col-12">
        <hr class="border border-2 border-dark">
    </div>
    
    <?php
$con  = mysqli_connect("localhost", "root", "Princess@18", "she", "3306");
if (!$con) {
    echo "Problem in database connection! Contact administrator!";
} else {
    $sql = "SELECT DISTINCT `user_email`,`fname`,`lname`,`mobile`,total FROM invoice INNER JOIN `user` ON invoice.user_email=user.email";
    $result = mysqli_query($con, $sql);
    $chart_data = "";
    while ($row = mysqli_fetch_array($result)) {
        $productname1[]  = $row['fname'];
        $sales1[] = $row['total'];
    }
}
?>

<div class="offset-3" style="width:60%;height:30%;text-align:center">
    <div class="fw-bold fs-3 mt-3 mb-4">Users' Expenditures</div>
    <div style="background-color: #fefdff" class="pt-3"><canvas id="chartjs_pie" class="mb-5"></canvas></div>
</div>

<script src="//code.jquery.com/jquery-1.9.1.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
<script type="text/javascript">
    var ctx = document.getElementById("chartjs_pie").getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: <?php echo json_encode($productname1); ?>,
            datasets: [{
                backgroundColor: [
                    "#5969ff",
                    "#ff407b",
                    "#25d5f2",
                    "#ffc750",
                    "#2ec551",
                    "#7040fa",
                    "#ff004e",
                    "#C8B6FF",
                    "#262626",
                    "#5969ff",
                    "#ff407b",
                    "#25d5f2",
                    "#ffc750",
                    "#2ec551",
                    "#7040fa",
                    "#ff004e",
                    "#C8B6FF",
                    "#262626",
                ],
                data: <?php echo json_encode($sales1); ?>,
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
                    text: 'Users\' Expenditures'
                }
            }
        }
    });
</script>

    </div>

    <?php
$con = mysqli_connect("localhost", "root", "Princess@18", "she", "3306");
if (!$con) {
    echo "Problem in database connection! Contact administrator!";
} else {
    $sql = "SELECT DISTINCT `user_email`, `fname`, `lname`, `mobile`, total FROM invoice INNER JOIN `user` ON invoice.user_email=user.email";
    $result = mysqli_query($con, $sql);
    $chart_data = "";
    while ($row = mysqli_fetch_array($result)) {
        $productname1[] = $row['fname'];
        $sales1[] = $row['total'];
    }
}
?>


<!-- monthly -->

<div class="offset-3" style="width:60%;height:30%;text-align:center">
    <div class="fw-bold fs-3 mt-3 mb-4">Monthly Expenditures</div>

    <div style="background-color: #fefdff" class="pt-3">
        <canvas id="chartjs_line1" class="mb-5"></canvas>
    </div>
</div>


<?php
$con = mysqli_connect("localhost", "root", "Princess@18", "she", "3306");
if (!$con) {
    echo "Problem in database connection! Contact administrator!";
} else {
    $sql = "SELECT DATE_FORMAT(date, '%Y-%m') AS month, total AS total_income FROM invoice GROUP BY month ORDER BY month";
    $result = mysqli_query($con, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $months[] = $row['month'];
        $incomes[] = $row['total_income'];
    }
}
?>

<script src="//code.jquery.com/jquery-1.9.1.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        var ctx = document.getElementById("chartjs_line1").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: <?php echo json_encode($months); ?>,
                datasets: [{
                    label: 'Monthly Income',
                    backgroundColor: "rgba(89,105,255,0.2)",
                    borderColor: "#5969ff",
                    data: <?php echo json_encode($incomes); ?>,
                    fill: true,
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
                scales: {
                    x: {
                        display: true,
                        title: {
                            display: true,
                            text: 'Month'
                        }
                    },
                    y: {
                        display: true,
                        title: {
                            display: true,
                            text: 'Income'
                        }
                    }
                }
            }
        });
    });
</script>



    </div>


    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
    </div>
    </div>

</body>

</html>