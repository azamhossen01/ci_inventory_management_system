<?php $this->load->view('layouts/header.php'); ?>


<?php $this->load->view('layouts/navbar.php'); ?>

<div class="card">
    <div class="card-header "><h3 class="card-item d-inline-block">Brand List</h3>
    <button onclick="add_brand_model_open()" class="pull-right btn btn-primary float-right">Add New</button>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Category Name</th>
                    <th>Brand Name</th>
                    <th>Status</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody id="all_brands">

            </tbody>
        </table>
    </div>
    <div class="card-footer"></div>
</div>


<!-- modal start -->
<div id="brand_create_modal" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Brand Create</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" id="brand_create_form">
            <div class="form-group">
                <label for="category_id">Category</label>
                <select name="category_id" id="category_id" class="form-control">
                    <option value="">Select Category</option>
                    <?php if(count($categories) > 0){ foreach($categories as $key=>$category){ ?>
                        <option value="<?= $category->id ?>"><?= $category->category_name ?></option>
                    <?php }} ?>
                </select>
            </div>
            <div class="form-group">
                <label for="brand_name">Brand Name</label>
                <input type="text" required id="brand_name" name="brand_name" class="form-control" placeholder="Brand Name">
            </div>
            <input type="hidden" name="brand_id" id="brand_id">
            
      </div>
      <div class="modal-footer">
      <button onclick="save_brand()" id="save_brand_button" class="btn btn-primary" type="button">Save</button>
      <button onclick="update_brand()" id="update_brand_button" class="btn btn-warning" type="button">Update</button>
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
        all_brands();
    });

    function update_brand(){
        var brand_id = $('#brand_id').val();
        var brand_name = $('#brand_name').val();
        var category_id = $('#category_id').val();
        var data = {brand_id:brand_id,brand_name:brand_name,category_id:category_id};
        if(brand_name){
            $.ajax({
                type : 'post',
                data : data,
                url : li + "brand_ctrl/update_brand",
                success : function(data){
                    if(data){
                        $("#brand_create_form").trigger('reset');
                        $('#brand_create_modal').modal('hide');
                        alert('Brand updated successfully.');
                        all_brands();
                        
                    }
                }
            });
        }

    }

    function all_brands(){
        $.ajax({
            type : 'post',
            url : li + 'brand_ctrl/all_brands',
            dataType : 'json',
            success : function(data){
                 console.log(data);
                var count_brand = data.length;
                var html = ``;
                for(var i = 0; i < count_brand; i++){
                    html += `<tr>
                        <td>${i+1}</td>
                        <td>${data[i].category_name}</td>
                        <td>${data[i].brand_name}</td>
                        <td>${data[i].brand_status == 1 ? 'Active':'Deactive'}</td>
                        <td><button onclick="edit_brand(${data[i].id})" class="btn btn-warning">Update</button></td>
                        <td><button onclick="change_status(${data[i].id},${data[i].brand_status})" class="btn btn-danger">Delete</button></td>
                    </tr>`;
                }
                $('#all_brands').html(html);
            }
        });
    }

    function edit_brand(id){
        $('#brand_id').val(id);
        if(id){
            $.ajax({
                type : 'post',
                url : li + "brand_ctrl/edit_brand/" + id,
                dataType : 'json',
                success : function(data){
                   if(data){
                    $('#brand_name').val(data.brand_name);
                    $('#category_id').val(data.category_id);
                    $('#brand_create_modal').modal('show');
                    $('#save_brand_button').css('display','none');
                    $('#update_brand_button').css('display','block');
                   }
                }
            });
        }
    }


    function add_brand_model_open(){
        $("#brand_create_form").trigger('reset');
        $('#save_brand_button').css('display','block');
        $('#update_brand_button').css('display','none');
        $('#brand_create_modal').modal('show');
    }



    function save_brand(){
        var category_id = $('#category_id').val();
        var brand_name = $('#brand_name').val();
        alert(brand_name);
        var data = {brand_name:brand_name,category_id:category_id};
        if(brand_name && category_id){
           $.ajax({
            type : 'post',
            data : data,
            url : li + "brand_ctrl/save_brand",
            dataType : 'json',
            success : function(data){
                if(data){
                    $("#brand_create_form").trigger('reset');
                    $('#brand_create_modal').modal('hide');
                    all_brands();
                    alert('Brand created successfully.');
                }else{
                    alert('Brand creation failed!!!');
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
            url : li + "brand_ctrl/change_brand_status/" + id,
            dataType : 'json',
            success : function(data){
                if(data){
                    all_brands();
                }
            }
        });
    }
}
</script>