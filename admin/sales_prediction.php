<?php
$page_title = 'Sales Predictions';
require_once('includes/load.php');
page_require_level(3);

// Fetch Historical Sales Data
function get_sales_data() {
    global $db;
    $query = "
        SELECT 
            s.product_id, 
            p.name AS product_name, 
            SUM(s.qty) AS total_qty, 
            DATE(s.date) AS sale_date
        FROM sales s
        JOIN products p ON s.product_id = p.id
        GROUP BY s.product_id, DATE(s.date)
        ORDER BY s.product_id, sale_date";
    return $db->query($query);
}

// Prediction Logic
function predict_sales($sales_data, $days_ahead = 30) {
    $predictions = [];

    foreach ($sales_data as $product_id => $data) {
        $x = []; // Days (time)
        $y = []; // Sales quantity

        foreach ($data as $record) {
            $x[] = $record['day'];
            $y[] = $record['qty'];
        }

        // Linear regression calculations
        $n = count($x);
        $sum_x = array_sum($x);
        $sum_y = array_sum($y);
        $sum_xx = array_sum(array_map(fn($xi) => $xi * $xi, $x));
        $sum_xy = array_sum(array_map(fn($xi, $yi) => $xi * $yi, $x, $y));

        // Slope (m) and Intercept (b)
        $m = $b = 0;
        if ($n * $sum_xx - $sum_x * $sum_x) {
            $m = ($n * $sum_xy - $sum_x * $sum_y) / ($n * $sum_xx - $sum_x * $sum_x);
            $b = ($sum_y - $m * $sum_x) / $n;
        }

        // Predict future sales
        $future_sales = [];
        $last_day = max($x);

        for ($i = 1; $i <= $days_ahead; $i++) {
            $future_sales[] = [
                'day' => $last_day + $i,
                'predicted_qty' => max(0, $m * ($last_day + $i) + $b),
            ];
        }

        $predictions[$product_id] = $future_sales;
    }

    return $predictions;
}

// Fetch sales data
$sales_data = [];
$raw_data = get_sales_data();

foreach ($raw_data as $row) {
    $product_id = $row['product_id'];
    $sales_data[$product_id][] = [
        'day' => strtotime($row['sale_date']) / 86400, // Convert date to days
        'qty' => $row['total_qty'],
        'product_name' => $row['product_name'],
    ];
}

// Perform sales predictions for the next 30 days
$predictions = predict_sales($sales_data, 30);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales Predictions</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"/>
</head>
<body>
    <div class="container">
        <h1 class="text-center">Sales Predictions</h1>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Day</th>
                    <th>Predicted Sales Quantity</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($predictions as $product_id => $future_sales): ?>
                    <?php foreach ($future_sales as $sale): ?>
                        <tr>
                            <td><?php echo remove_junk($sales_data[$product_id][0]['product_name']); ?></td>
                            <td><?php echo date('Y-m-d', $sale['day'] * 86400); ?></td>
                            <td><?php echo round($sale['predicted_qty'], 2); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
<?php
if (isset($db)) {
    $db->db_disconnect();
}
?>
