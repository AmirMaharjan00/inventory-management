<?php
  $page_title = 'All sale';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(3);
?>
<?php
$products = get_all_products( $_SESSION['user_id'] );
?>
<?php include_once('layouts/header.php'); ?>
<div class="row">
  <div class="col-md-6">
    <?php echo display_msg($msg); ?>
  </div>
</div>
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading clearfix">
          <strong>
            <span class="glyphicon glyphicon-th"></span>
            <span>All Orders</span>
          </strong>
          <div class="pull-right">
            <a href="add_sale.php" class="btn btn-primary">Add an Order</a>
          </div>
        </div>
        <div class="panel-body">

        <!-- popover -->
        <div popover id="popover" class="popup">
          <h2>Delete Item</h2>
          <p>Are you sure you want to delete this item? This action cannot be undone.</p>
          <div class="buttons">
            <button data-bs-toggle="popover" id="cancelButton" class="cancel btn-cancel" data-dismiss="modal">Cancel</button>
            <button id="confirmButton" class="confirm">
              <a class="delete-button" data-toggle="tooltip" title="Remove">
                Delete
              </a>
            </button>
          </div>
        </div>
        <!-- popover finish -->
          
          <table class="table table-bordered table-striped">
            <thead>
              <tr>
                <th class="text-center" style="width: 50px;">#</th>
                <th> Product name </th>
                <th class="text-center" style="width: 15%;"> Quantity</th>
                <th class="text-center" style="width: 15%;"> Total (in $) </th>
                <th class="text-center" style="width: 15%;"> Date </th>
                <th class="text-center" style="width: 100px;"> Actions </th>
             </tr>
            </thead>
           <tbody>
             <?php
             foreach ($products as $product):?>                
             <tr data-id="<?php echo (int)$product['id'];?>">
               <td class="text-center"><?php echo count_id();?></td>
               <td><?php echo remove_junk($product['name']); ?></td>
               <td class="text-center"><?php echo (int)$product['qty']; ?></td>
               <td class="text-center"><?php echo remove_junk($product['price']); ?></td>
               <td class="text-center"><?php echo $product['date']; ?></td>
               <td class="text-center">
                  <div class="btn-group">
                     <a href="edit_sale.php?id=<?php echo (int)$product['id'];?>" class="btn btn-warning btn-xs"  title="Edit" data-toggle="tooltip">
                       <span class="glyphicon glyphicon-edit"></span>
                     </a>
                     <button popovertarget="popover" class="trash-button btn btn-danger btn-xs" data-toggle="tooltip" title="Remove">
                      <span class="glyphicon glyphicon-trash"></span>
                    </button>
                  </div>
               </td>
             </tr>
             <?php endforeach;?>
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
      _this.parents('body').find('.delete-button').attr('href', 'delete_sale.php?id=' + id )
      _this.parents('body').find('#popover').css({
        display: 'block'
      })
    })
    document.getElementById('cancelButton').addEventListener('click', function() {
        let popover = document.getElementById('popover')
        popover.style.display = 'none';  // Hide the popover
    });
  </script>