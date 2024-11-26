<?php
  $page_title = 'All categories';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(1);
  
  $all_categories = find_all('categories')
?>
<?php
 if(isset($_POST['add_cat'])){
   $req_field = array('categorie-name');
   validate_fields($req_field);
   $cat_name = remove_junk($db->escape($_POST['categorie-name']));
   if(empty($errors)){
      $sql  = "INSERT INTO categories (name)";
      $sql .= " VALUES ('{$cat_name}')";
      if($db->query($sql)){
        $session->msg("s", "Successfully Added Categorie");
        redirect('categorie.php',false);
      } else {
        $session->msg("d", "Sorry Failed to insert.");
        redirect('categorie.php',false);
      }
   } else {
     $session->msg("d", $errors);
     redirect('categorie.php',false);
   }
 }
?>
<?php include_once('layouts/header.php'); ?>

  <div class="row">
     <div class="col-md-12">
       <?php echo display_msg($msg); ?>
     </div>
  </div>
   <div class="row">
    <div class="col-md-5">
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong>
            <span class="glyphicon glyphicon-th"></span>
            <span>Add New Categorie</span>
         </strong>
        </div>

        <div class="panel-body">
          <form method="post" action="categorie.php">
            <div class="form-group">
                <input type="text" class="form-control" name="categorie-name" placeholder="Categorie Name">
            </div>
            <button type="submit" name="add_cat" class="btn btn-primary">Add categorie</button>
        </form>
        </div>
      </div>
    </div>

    <div class="col-md-7">
    <div class="panel panel-default">
      <div class="panel-heading">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span>All Categories</span>
       </strong>
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

          <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th class="text-center" style="width: 50px;">#</th>
                    <th>Categories</th>
                    <th class="text-center" style="width: 100px;">Actions</th>
                </tr>
            </thead>
            <tbody>
              <?php foreach ($all_categories as $cat):?>
                <tr data-id="<?php echo (int)$cat['id'];?>">
                    <td class="text-center"><?php echo count_id();?></td>
                    <td><?php echo remove_junk(ucfirst($cat['name'])); ?></td>
                    <td class="text-center">
                      <div class="btn-group">
                        <a href="edit_categorie.php?id=<?php echo (int)$cat['id'];?>"  class="btn btn-xs btn-warning" data-toggle="tooltip" title="Edit">
                          <span class="glyphicon glyphicon-edit"></span>
                        </a>
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
  </div>
  <?php include_once('layouts/footer.php'); ?>
  <script>
    $('.trash-button').on('click', function(){
      let _this = $(this), id = _this.parents('tr').data('id')
      _this.parents('body').find('.delete-button').attr('href', 'delete_categorie.php?id=' + id )
      _this.parents('body').find('#popover').css({
        display: 'block'
      })
    })
    document.getElementById('cancelButton').addEventListener('click', function() {
        let popover = document.getElementById('popover')
        popover.style.display = 'none';  // Hide the popover
    });
  </script>