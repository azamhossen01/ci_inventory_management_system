<?php $this->load->view('layouts/header.php'); ?>


<?php $this->load->view('layouts/navbar.php'); ?>

<div class="card">
    <div class="card-header "><h3 class="card-item">Category List</h3>
    <button onclick="add_category_model_open()" class="pull-right btn btn-primary">Add New</button>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Category Name</th>
                    <th>Status</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody id="all_categories">

            </tbody>
        </table>
    </div>
    <div class="card-footer"></div>
</div>


<!-- modal start -->
<div id="category_create_modal" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Category Create</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" id="category_create_form">
            <div class="form-group">
                <label for="category_name">Category Name</label>
                <input type="text" id="category_name" name="category_name" class="form-control" placeholder="Category Name">
            </div>
            
      </div>
      <div class="modal-footer">
      <button onclick="save_category()" class="btn btn-primary" type="button">Save</button>
            <button type='reset' class="btn btn-danger">Reset</button>
        </form>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<?php $this->load->view('layouts/footer.php'); ?>
<script>
    var li = "http://localhost/ci_inventory_management_system/";

    $(document).ready(function(){
        all_categories();
    });

    function all_categories(){
        $.ajax({
            type : 'post',
            url : li + 'category_ctrl/all_categories',
            dataType : 'json',
            success : function(data){
                var count_category = data.length;
                var html = ``;
                for(var i = 0; i < count_category; i++){
                    html += `<tr>
                        <td>${i+1}</td>
                        <td>${data[i].category_name}</td>
                        <td>${data[i].category_status == 1 ? 'Active':'Deactive'}</td>
                        <td><button class="btn btn-warning">Update</button></td>
                        <td><button class="btn btn-danger">Delete</button></td>
                    </tr>`;
                }
                $('#all_categories').html(html);
            }
        });
    }


    function add_category_model_open(){
        $('#category_create_modal').modal('show');
    }



    function save_category(){
        var category_name = $('#category_name').val();
        var data = {category_name:category_name};
        $.ajax({
            type : 'post',
            data : data,
            url : li + "category_ctrl/save_category",
            dataType : 'json',
            success : function(data){
                if(data){
                    $("#category_create_form").trigger('reset');
                    $('#category_create_modal').modal('hide');
                    all_categories();
                    alert('Category created successfully.');
                }else{
                    alert('Category creation failed!!!');
                }
            }
        });
    }
</script>