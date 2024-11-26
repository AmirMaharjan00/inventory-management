<?php
  $page_title = 'All User';
  require_once('includes/load.php');
?>
<?php
// Checkin What level user has permission to view this page
 page_require_level(1);
//pull out all user form database
 $all_users = find_all_user();
?>
<?php include_once('layouts/header.php'); ?>
<div class="row">
   <div class="col-md-12">
     <?php echo display_msg($msg); ?>
   </div>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading clearfix">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span>Users</span>
       </strong>
         <a href="add_user.php" class="btn btn-info pull-right">Add New User</a>
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
            <th>Name </th>
            <th>Username</th>
            <th class="text-center" style="width: 15%;">User Role</th>
            <th class="text-center" style="width: 10%;">Status</th>
            <th style="width: 20%;">Last Login</th>
            <th class="text-center" style="width: 100px;">Actions</th>
          </tr>
        </thead>
        <tbody>
        <?php foreach($all_users as $a_user): ?>
          <tr>
           <td class="text-center"><?php echo count_id();?></td>
           <td><?php echo remove_junk(ucwords($a_user['name']))?></td>
           <td><?php echo remove_junk(ucwords($a_user['username']))?></td>
           <td class="text-center"><?php echo remove_junk(ucwords($a_user['group_name']))?></td>
           <td class="text-center">
           <?php if($a_user['status'] === '1'): ?>
            <span class="label label-success"><?php echo "Active"; ?></span>
          <?php else: ?>
            <span class="label label-danger"><?php echo "Deactive"; ?></span>
          <?php endif;?>
           </td>
           <td><?php echo read_date($a_user['last_login'])?></td>
           <td class="text-center">
             <div class="btn-group">
                <a href="edit_user.php?id=<?php echo (int)$a_user['id'];?>" class="btn btn-xs btn-warning" data-toggle="tooltip" title="Edit">
                  <i class="glyphicon glyphicon-pencil"></i>
                </a>
                <!-- <a href="delete_user.php?id=<?php #echo (int)$a_user['id'];?>" class="btn btn-xs btn-danger" data-toggle="tooltip" title="Remove">
                  <i class="glyphicon glyphicon-remove"></i>
                </a> -->
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
      _this.parents('body').find('.delete-button').attr('href', 'delete_user.php?id=' + id )
      _this.parents('body').find('#popover').css({
        display: 'block'
      })
    })
    document.getElementById('cancelButton').addEventListener('click', function() {
        let popover = document.getElementById('popover')
        popover.style.display = 'none';  // Hide the popover
    });
  </script>