<?php
  $page_title = 'All Product';
  require_once('includes/load.php');
  // Checking What level user has permission to view this page
  page_require_level(2);

  // Fetch products
  $products = join_product_table();

  // Sort products by 'quantity' in descending order
  usort($products, function($a, $b) {
      return $b['quantity'] <=> $a['quantity'];
  });
?>
<?php include_once('layouts/header.php'); ?>
  <div class="row">
     <div class="col-md-12">
       <?php echo display_msg($msg); ?>
     </div>

    <div class="col-md-6">
      <form method="post" autocomplete="off" id="sug-form">
        <div class="form-group">
          <div class="input-group">
            <span class="input-group-btn">
              <button form="sug-form" type="submit" class="btn btn-primary">Find It</button>
            </span>
            <input type="text" id="product_search_input" class="form-control" name="title" placeholder="Search for product name">
        </div>
        <div id="result" class="list-group"></div>
        </div>  
      </form>
    </div>
    
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading clearfix">
         <div class="pull-right">
           <a href="add_product.php" class="btn btn-primary">Add New</a>
         </div>
        </div>
        <div class="product-content-wrap panel-body">

          <!-- popover -->
          <div popover id="popover" class="popup">
            <h2>Delete Item</h2>
            <p>Are you sure you want to delete this item? This action cannot be undone.</p>
            <div class="buttons">
              <button data-bs-toggle="popover" id="cancelButton" class="cancel btn-cancel" data-dismiss="modal">Cancel</button>
              <button id="confirmButton" class="confirm">
                <a class="delete-button">
                  Delete
                </a>
              </button>
            </div>
          </div>
          <!-- popover finish -->

          <table class="table table-bordered product-table">
            <thead>
              <tr>
                <th class="text-center" style="width: 50px;">#</th>
                <th> Product Title </th>
                <th class="text-center" style="width: 10%;"> Categorie </th>
                <th class="text-center" style="width: 10%;"> Instock </th>
                <th class="text-center" style="width: 10%;"> Buying Price (in $) </th>
                <th class="text-center" style="width: 10%;"> Selling Price (in $) </th>
                <th class="text-center" style="width: 10%;"> Product Added </th>
                <th class="text-center" style="width: 100px;"> Actions </th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($products as $product):?>
              <tr data-id="<?php echo (int)$product['id'];?>">
                <td class="text-center"><?php echo count_id();?></td>
                <td class="product-title"> <?php echo remove_junk($product['name']); ?></td>
                <td class="text-center"> <?php echo remove_junk($product['categorie']); ?></td>
                <td class="text-center"> <?php echo remove_junk($product['quantity']); ?></td>
                <td class="text-center"> <?php echo remove_junk($product['buy_price']); ?></td>
                <td class="text-center"> <?php echo remove_junk($product['sale_price']); ?></td>
                <td class="text-center"> <?php echo read_date($product['date']); ?></td>
                <td class="text-center">
                  <div class="btn-group">
                    <a href="edit_product.php?id=<?php echo (int)$product['id'];?>" class="btn btn-info btn-xs"  title="Edit" data-toggle="tooltip">
                      <span class="glyphicon glyphicon-edit"></span>
                    </a>
                    <!-- <a href="delete_product.php?id=<?php #echo (int)$product['id'];?>" class="btn btn-danger btn-xs"  title="Delete" data-toggle="tooltip">
                      <span class="glyphicon glyphicon-trash"></span>
                    </a> -->

                    <button popovertarget="popover" class="trash-button btn btn-danger btn-xs" data-toggle="tooltip" title="Remove">
                      <span class="glyphicon glyphicon-trash"></span>
                    </button>
                  </div>
                </td>
              </tr>
             <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <?php include_once('layouts/footer.php'); ?>

  <script>
    $('.trash-button').on('click', function(){
      let _this = $(this), id = _this.parents('tr').data('id')
      _this.parents('body').find('.delete-button').attr('href', 'delete_product.php?id=' + id )
      _this.parents('body').find('#popover').css({
        display: 'block'
      })
    })
    document.getElementById('cancelButton').addEventListener('click', function() {
        let popover = document.getElementById('popover')
        popover.style.display = 'none';  // Hide the popover
    });
  </script>
