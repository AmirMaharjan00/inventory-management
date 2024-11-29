<?php
$page_title = 'Sales Report';
$results = '';
require_once('includes/load.php');
page_require_level(3);

if (isset($_POST['submit']) || isset($_POST['download'])) {
    $req_dates = array('start-date', 'end-date');
    validate_fields($req_dates);

    if (empty($errors)) {
        $start_date = remove_junk($db->escape($_POST['start-date']));
        $end_date = remove_junk($db->escape($_POST['end-date']));
        $results = find_sale_by_dates($start_date, $end_date);
        // var_dump ($results);
        ob_start(); // Start output buffering
?>
<!doctype html>
<html lang="en-US">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Sales Report</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"/>
</head>
<body>
<?php if ($results): ?>
    <div class="page-break">
        <div class="container">
            <div class="sale-head pull-right">
                <h1>Sales Report</h1>
                <strong><?php echo $start_date; ?> To <?php echo $end_date; ?></strong>
            </div>
            <table class="table table-border">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Product Title</th>
                        <th>Buying Price (in $)</th>
                        <th>Selling Price (in $)</th>
                        <th>Total Qty</th>
                        <th>TOTAL (in $)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($results as $result): ?>
                    <tr>
                        <td><?php echo remove_junk($result['date']); ?></td>
                        <td><?php echo remove_junk(ucfirst($result['name'])); ?></td>
                        <td><?php echo remove_junk($result['buy_price']); ?></td>
                        <td><?php echo remove_junk($result['sale_price']); ?></td>
                        <td><?php echo remove_junk($result['total_sales']); ?></td>
                        <td><?php echo remove_junk($result['total_selling_price']); ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="4"></td>
                        <td>Grand Total</td>
                        <td>$<?php echo number_format(total_price($results)[0], 2); ?></td>
                    </tr>
                    <tr>
                        <td colspan="4"></td>
                        <td>Profit</td>
                        <td>$<?php echo number_format(total_price($results)[1], 2); ?></td>
                    </tr>
                </tfoot>
            </table>
            <div class="text-right" style="margin-top: 20px; margin-bottom: 20px;">
                <form method="post" action="">
                    <input type="hidden" name="start-date" value="<?php echo $start_date; ?>">
                    <input type="hidden" name="end-date" value="<?php echo $end_date; ?>">
                    <button type="submit" name="download" class="btn btn-success">Download Report</button>
                </form>
                <a href="http://localhost/inventory-management/admin/sales_report.php" class="btn btn-primary">Go Back</a>
            </div>
        </div>
    </div>
<?php else: ?>
    <p>Sorry, no sales have been found.</p>
<?php endif; ?>
</body>
</html>
<?php
        $content = ob_get_clean(); // Capture the buffer content

        if (isset($_POST['download'])) {
            $filename = "sales_report_" . date('Ymd') . ".html";

            header("Content-Type: text/html");
            header("Content-Disposition: attachment; filename=\"$filename\"");
            echo $content; // Output the report for download
            exit();
        } else {
            echo $content; // Display the report on the page
        }
    } else {
        $session->msg("d", $errors);
        redirect('sales_report.php', false);
    }
} else {
    $session->msg("d", "Select dates");
    redirect('sales_report.php', false);
}
?>
