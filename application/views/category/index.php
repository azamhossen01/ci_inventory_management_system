<?php $this->load->view('layouts/header.php'); ?>


<?php $this->load->view('layouts/navbar.php'); ?>

<div class="card">
    <div class="card-header "><h3 class="card-item d-inline-block">Category List</h3>
    <button onclick="add_category_model_open()" class="pull-right btn btn-primary float-right">Add New</button>
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
                <input type="text" required id="category_name" name="category_name" class="form-control" placeholder="Category Name">
            </div>
            <input type="hidden" name="category_id" id="category_id">
            
      </div>
      <div class="modal-footer">
      <button onclick="save_category()" id="save_category_button" class="btn btn-primary" type="button">Save</button>
      <button onclick="update_category()" id="update_category_button" class="btn btn-warning" type="button">Update</button>
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

    function update_category(){
        var category_id = $('#category_id').val();
        var category_name = $('#category_name').val();
        var data = {category_id:category_id,category_name:category_name};
        if(category_name){
            $.ajax({
                type : 'post',
                data : data,
                url : li + "category_ctrl/update_category",
                success : function(data){
                    if(data){
                        $("#category_create_form").trigger('reset');
                        $('#category_create_modal').modal('hide');
                        alert('Category updated successfully.');
                        all_categories();
                        
                    }
                }
            });
        }

    }

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
                        <td><button onclick="edit_category(${data[i].id})" class="btn btn-warning">Update</button></td>
                        <td><button onclick="change_status(${data[i].id},${data[i].category_status})" class="btn btn-danger">Delete</button></td>
                    </tr>`;
                }
                $('#all_categories').html(html);
            }
        });
    }

    function edit_category(id){
        $('#category_id').val(id);
        if(id){
            $.ajax({
                type : 'post',
                url : li + "category_ctrl/edit_category/" + id,
                dataType : 'json',
                success : function(data){
                   if(data){
                    $('#category_name').val(data.category_name);
                    $('#category_create_modal').modal('show');
                    $('#save_category_button').css('display','none');
                    $('#update_category_button').css('display','block');
                   }
                }
            });
        }
    }


    function add_category_model_open(){
        $("#category_create_form").trigger('reset');
        $('#save_category_button').css('display','block');
        $('#update_category_button').css('display','none');
        $('#category_create_modal').modal('show');
    }



    function save_category(){
        var category_name = $('#category_name').val();
        var data = {category_name:category_name};
        if(category_name){
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
        }else{
            alert('Please insert value');
        }
        
    }


    function change_status(id,status){
    if(id){
        $.ajax({
            type : 'post',
            data : {status},
            url : li + "category_ctrl/change_category_status/" + id,
            dataType : 'json',
            success : function(data){
                if(data){
                    all_categories();
                }
            }
        });
    }
}
</script>