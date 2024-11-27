<?php
var_dump (($_POST));
  $page_title = 'Add Sale';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(3);
?>
<?php
  if(isset($_POST['add_sale'])){
    $user_id = $_SESSION['user_id'];
    $req_fields = array('s_id','quantity','price','total', 'date' );
    validate_fields($req_fields);
        if(empty($errors)){
          $p_id      = $db->escape((int)$_POST['s_id']);
          $s_qty     = $db->escape((int)$_POST['quantity']);
          $s_total   = $db->escape($_POST['total']);
          $date      = $db->escape($_POST['date']);
          $s_date    = make_date();

          $sql  = "INSERT INTO sales (";
          $sql .= " product_id,qty,price,date,user_id";
          $sql .= ") VALUES (";
          $sql .= "'{$p_id}','{$s_qty}','{$s_total}','{$s_date}', '{$user_id}'";
          $sql .= ")";

                if($db->query($sql)){
                  update_product_qty($s_qty,$p_id);
                  $session->msg('s',"Sale added. ");
                  redirect('add_sale.php', false);
                } else {
                  $session->msg('d',' Sorry failed to add!');
                  redirect('add_sale.php', false);
                }
        } else {
           $session->msg("d", $errors);
           redirect('add_sale.php',false);
        }
  }

?>
<?php include_once('layouts/header.php'); ?>
<div class="row">
  <div class="col-md-6">
    <?php echo display_msg($msg); ?>
    <!-- <form method="post" autocomplete="off" id="sug-form">
        <div class="form-group">
          <div class="input-group">
            <span class="input-group-btn">
              <button form="sug-form" type="submit" class="btn btn-primary">Find It</button>
            </span>
            <input type="text" id="sug_input" class="form-control" name="title"  placeholder="Search for product name">
         </div>
         <div id="result" class="list-group"></div>
        </div>
    </form> -->
  </div>
</div>
<div class="row">

  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading clearfix">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span>Sale Edit</span>
       </strong>
      </div>
      <div class="panel-body">
        <form method="post" action="add_sale.php" id="sale-form">
         <table class="table table-bordered">
           <thead>
            <th> Item </th>
            <th> Price </th>
            <th> Qty </th>
            <th> Total </th>
            <th> Date</th>
            <th> Action</th>
           </thead>
             <tbody id="product_info">
              <?Php

                global $db;
                $order_query = 'SELECT * FROM products';
                $order_result = $db->query( $order_query );
                if ( $order_result->num_rows > 0 ) {
                  while($row = $order_result->fetch_assoc()) {
                    ?>
                      <tr>
                        <td id="s_name"><?php echo $row['name']?></td>
                        <input type="hidden" name="s_id" value="<?php echo $row['id']; ?>">
                        <input type="hidden" name="total" value="<?php echo $row['sale_price']; ?>">
                        <td><input type="number" min="0" class="form-control" name="price" value="<?php echo $row['sale_price']; ?>"></td>
                        <td id="s_qty"><input type="number" min="1" max="<?php echo $row['quantity']; ?>" class="form-control" name="quantity" value="1"></td>
                        <td><input type="number" min="0" class="form-control" name="total_indicator" value="<?php echo $row['sale_price']; ?>" disabled></td>
                        <td><input type="date" class="form-control datePicker" name="date" data-date data-date-format="yyyy-mm-dd"></td>
                        <td><button form="sale-form" type="submit" name="add_sale" class="btn btn-primary">Add sale</button></td>
                      </tr>
                    <?php   
                  }
                } else {
                  echo "0 results";
                }
              ?>
             </tbody>
         </table>
       </form>
      </div>
    </div>
  </div>

</div>

<?php include_once('layouts/footer.php'); ?>
