<?php
  $page_title = 'ABC Analysis';
  require_once('includes/load.php');
  
  // Checking user level to view this page
  page_require_level(3);
  
  // Get all products and their sales data
  $products = get_abc_analysis_data();

  // Calculate the total annual usage value
  $total_value = array_sum(array_column($products, 'annual_usage_value'));

  // Classify products into A, B, and C
  $category_a = [];
  $category_b = [];
  $category_c = [];
  $cumulative_value = 0;
  
  foreach ($products as $product) {
    $cumulative_value += $product['annual_usage_value'];
    
    // 70-80% for Category A
    if ($cumulative_value <= 0.8 * $total_value) {
      $category_a[] = $product;
    } 
    // 15-25% for Category B
    elseif ($cumulative_value <= 0.95 * $total_value) {
      $category_b[] = $product;
    } 
    // Remaining for Category C
    else {
      $category_c[] = $product;
    }
  }
  
  include_once('layouts/header.php');
?>

<div class="row">
  <div class="col-md-12">
    <h2>ABC Analysis</h2>
    <p>Classifying products based on their annual usage value.</p>
    
    <!-- Category A -->
    <h3>Category A (High Value, Low Volume)</h3>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Product Name</th>
          <th>Quantity Sold</th>
          <th>Annual Usage Value ($)</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($category_a as $product): ?>
        <tr>
          <td><?php echo remove_junk($product['name']); ?></td>
          <td><?php echo (int)$product['total_qty_sold']; ?></td>
          <td><?php echo number_format($product['annual_usage_value'], 2); ?></td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>

    <!-- Category B -->
    <h3>Category B (Moderate Value, Moderate Volume)</h3>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Product Name</th>
          <th>Quantity Sold</th>
          <th>Annual Usage Value ($)</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($category_b as $product): ?>
        <tr>
          <td><?php echo remove_junk($product['name']); ?></td>
          <td><?php echo (int)$product['total_qty_sold']; ?></td>
          <td><?php echo number_format($product['annual_usage_value'], 2); ?></td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>

    <!-- Category C -->
    <h3>Category C (Low Value, High Volume)</h3>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Product Name</th>
          <th>Quantity Sold</th>
          <th>Annual Usage Value ($)</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($category_c as $product): ?>
        <tr>
          <td><?php echo remove_junk($product['name']); ?></td>
          <td><?php echo (int)$product['total_qty_sold']; ?></td>
          <td><?php echo number_format($product['annual_usage_value'], 2); ?></td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>

<?php include_once('layouts/footer.php'); ?>
