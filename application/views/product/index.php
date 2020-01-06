<?php $this->load->view('layouts/header.php'); ?>


<?php $this->load->view('layouts/navbar.php'); ?>

<div class="card">
    <div class="card-header "><h3 class="card-item d-inline-block">Product List</h3>
    <button onclick="add_product_model_open()" class="pull-right btn btn-primary float-right">Add New</button>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Category Name</th>
                    <th>Brand Name</th>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Enter By</th>
                    <th>Status</th>
                    <th>View</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody id="all_products">

            </tbody>
        </table>
    </div>
    <div class="card-footer"></div>
</div>


<!-- modal start -->
<div id="product_create_modal" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Product Create</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" id="product_create_form">
            <div class="form-group">
                <label for="category_id">Category</label>
                <select name="category_id" required id="category_id" class="form-control" onchange="get_brands(this.value)">
                    <option value="">Select Category</option>
                    <?php if(count($categories) > 0){ foreach($categories as $key=>$category){ ?>
                        <option value="<?= $category->id ?>"><?= $category->category_name ?></option>
                    <?php }} ?>
                </select>
            </div>
            <div class="form-group">
                <label for="brand_id">Brand</label>
                <select name="brand_id" id="brand_id" class="form-control" required>
                    <option value="">Select Category First</option>
                   
                </select>
            </div>
            <div class="form-group">
                <label for="product_name">Product Name</label>
                <input type="text" required id="product_name" name="product_name" class="form-control" placeholder="Product Name">
            </div>
            <div class="form-group">
                <label for="product_description">Product Description</label>
                <textarea name="product_description"  id="product_description" cols="30" rows="3" class="form-control" placeholder="Product Description"></textarea>
            </div>
            <div class="form-group">

                <label for="product_quantity">Product Quantity</label>
                <div class="row">
                <div class="col-lg-8">
                <input type="number" required id="product_quantity" name="product_quantity" class="form-control" placeholder="Product Quantity">
                </div>
                <div class="col-lg-4">
                <select name="product_unit" id="product_unit" class="form-control">
                    <option value="">Select Unit</option>
                    <option value="kg">KG</option>
                    <option value="litre">Litre</option>
                    <option value="piece">Piece</option>
                </select>
                </div>
                </div>
                
                
            </div>
            <div class="form-group">
                <label for="product_base_price">Product Base Price</label>
                <input type="number" required id="product_base_price" name="product_base_price" class="form-control" placeholder="Product Base Price">
            </div>
            <div class="form-group">
                <label for="product_tax">Product Tax</label>
                <input type="number" required id="product_tax" name="product_tax" class="form-control" placeholder="Product Tax">
            </div>
            <input type="hidden" id="product_id" name="product_id">
        
            
      </div>
      <div class="modal-footer">
      <button onclick="save_product()" id="save_product_button" class="btn btn-primary" type="button">Save</button>
      <button onclick="update_product()" id="update_product_button" class="btn btn-warning" type="button">Update</button>
            <button type='reset' class="btn btn-danger">Reset</button>
        </form>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- product detail modal -->
<!-- modal start -->
<div id="product_detail_modal" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Product Detail</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table table-bordered table-striped">
            <tr>
                <th>Product Name</th>
                <td id="p_name"></td>
            </tr>
            <tr>
                <th>Product Description</th>
                <td id="p_description"></td>
            </tr>
            <tr>
                <th>Category Name</th>
                <td id="c_id"></td>
            </tr>
            <tr>
                <th>Brand Name</th>
                <td id="b_id"></td>
            </tr>
            
            <tr>
                <th>Available Quantity</th>
                <td id="p_quantity"></td>
            </tr>
            <tr>
                <th>Base Price</th>
                <td id="pb_price"></td>
            </tr>
            <tr>
                <th>Tax(%)</th>
                <td id="p_tax"></td>
            </tr>
            <tr>
                <th>Enter By</th>
                <td id="p_person"></td>
            </tr>
            <tr>
                <th>Status</th>
                <td id="p_status"></td>
            </tr>
        </table>
            
      </div>
        <div class="modal-footer">
     
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<?php $this->load->view('layouts/footer.php'); ?>
<script>
    var li = "http://localhost/ci_inventory_management_system/";

    $(document).ready(function(){
        all_products();
    });

    function get_brands(category_id){
        if(category_id){
            $.ajax({
                type : 'post',
                url : li + "product_ctrl/get_brands/" + category_id,
                dataType : 'json',
                success : function(data){
                    if(data){
                        var brand_count = data.length;
                        var html = `<option>Select Brand</option>`;
                        for(var i = 0; i < brand_count; i++){
                            html += `<option value="${data[i].id}">${data[i].brand_name}</option>`;
                        }
                        $('#brand_id').html(html);
                    }else{
                        $('#brand_id').html(`<option value="">Select Category First</option>`);
                    }
                    
                }
            });
        }else{
            $('#brand_id').html(`<option value="">Select Category First</option>`);
        }
    }

    function update_product(){
        var product_id = $('#product_id').val();
        var category_id = $('#category_id').val();
        var brand_id = $('#brand_id').val();
        var product_name = $('#product_name').val();
        var product_description = $('#product_description').val();
        var product_quantity = $('#product_quantity').val();
        var product_unit = $('#product_unit').val();
        var product_base_price = $('#product_base_price').val();
        var product_tax = $('#product_tax').val();
        var data = {product_id:product_id,brand_id:brand_id,category_id:category_id,product_name:product_name,product_description:product_description,product_quantity:product_quantity,product_unit:product_unit,product_base_price:product_base_price,product_tax:product_tax};
        if(brand_id && category_id && product_name && product_quantity && product_base_price && product_tax){
           $.ajax({
            type : 'post',
            data : data,
            url : li + "product_ctrl/update_product",
            dataType : 'json',
            success : function(data){
                if(data){
                    $("#product_create_form").trigger('reset');
                    $('#product_create_modal').modal('hide');
                    all_products();
                    alert('Product created successfully.');
                }else{
                    alert('Product creation failed!!!');
                }
            }
        }); 
        }else{
            alert('Please insert value');
        }

    }

    function all_products(){
        $.ajax({
            type : 'post',
            url : li + 'product_ctrl/all_products',
            dataType : 'json',
            success : function(data){
                var count_brand = data.length;
                var html = ``;
                for(var i = 0; i < count_brand; i++){
                    html += `<tr>
                        <td>${i+1}</td>
                        <td>${data[i].category_name}</td>
                        <td>${data[i].brand_name}</td>
                        <td>${data[i].product_name}</td>
                        <td>${data[i].product_quantity}</td>
                        <td>${data[i].name}</td>
                        
                        <td>${data[i].product_status == 1 ? 'Active':'Deactive'}</td>
                        <td><button class="btn btn-success" onclick="product_details(${data[i].id})">View</button></td>
                        <td><button onclick="edit_product(${data[i].id})" class="btn btn-warning">Update</button></td>
                        <td><button onclick="change_status(${data[i].id},${data[i].product_status})" class="btn btn-danger">Delete</button></td>
                    </tr>`;
                }
                $('#all_products').html(html);
            }
        });
    }

    function product_details(id){
        if(id){
            $.ajax({
                type : 'post',
                url : li + "product_ctrl/product_details/" + id,
                dataType : 'json',
                success : function(data){
                    if(data){
                        $('#p_name').html(data.product_name);
                        $('#p_description').html(data.product_description);
                        $('#c_id').html(data.category_name);
                        $('#b_id').html(data.brand_name);
                        $('#p_quantity').html(data.product_quantity+' '+data.product_unit);
                        $('#pb_price').html(data.product_base_price);
                        $('#p_tax').html(data.product_tax);
                        $('#p_person').html(data.name);
                        $('#p_status').html(`<span class="badge badge-${data.product_status==1?'success':'danger'}">${data.product_status==1?'Active':'Deactive'}</span>`);
                        $('#product_detail_modal').modal('show');
                    }
                }
            });
        }
        
    }

    function edit_product(id){
        $('#product_id').val(id);
        
        if(id){
            $.ajax({
                type : 'post',
                url : li + "product_ctrl/edit_product/" + id,
                dataType : 'json',
                success : function(data){
                   if(data){
                    $('#category_id').val(data.category_id);
                    $('#brand_id').html(`<option value="${data.brand_id}">aaaa</option>`);
                    $('#product_name').val(data.product_name);
                    $('#product_description').val(data.product_description);
                    $('#product_quantity').val(data.product_quantity);
                    $('#product_unit').val(data.product_unit);
                    $('#product_tax').val(data.product_tax);
                    $('#product_base_price').val(data.product_base_price);
                    $('#product_create_modal').modal('show');
                    $('#save_product_button').css('display','none');
                    $('#update_product_button').css('display','block');
                   }
                   
                   
                }
            });
        }
    }


    function add_product_model_open(){
        $("#product_create_form").trigger('reset');
        $('#save_product_button').css('display','block');
        $('#update_product_button').css('display','none');
        $('#product_create_modal').modal('show');
    }



    function save_product(){
        var category_id = $('#category_id').val();
        var brand_id = $('#brand_id').val();
        var product_name = $('#product_name').val();
        var product_description = $('#product_description').val();
        var product_quantity = $('#product_quantity').val();
        var product_unit = $('#product_unit').val();
        var product_base_price = $('#product_base_price').val();
        var product_tax = $('#product_tax').val();
        var data = {brand_id:brand_id,category_id:category_id,product_name:product_name,product_description:product_description,product_quantity:product_quantity,product_unit:product_unit,product_base_price:product_base_price,product_tax:product_tax};
        if(brand_id && category_id && product_name && product_quantity && product_base_price && product_tax){
           $.ajax({
            type : 'post',
            data : data,
            url : li + "product_ctrl/save_product",
            dataType : 'json',
            success : function(data){
                if(data){
                    $("#product_create_form").trigger('reset');
                    $('#product_create_modal').modal('hide');
                    all_products();
                    alert('Product created successfully.');
                }else{
                    alert('Product creation failed!!!');
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
            url : li + "product_ctrl/change_product_status/" + id,
            dataType : 'json',
            success : function(data){
                if(data){
                    all_products();
                }
            }
        });
    }
}
</script>