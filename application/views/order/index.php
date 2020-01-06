<?php $this->load->view('layouts/header.php'); ?>


<?php $this->load->view('layouts/navbar.php'); ?>

<div class="card">
    <div class="card-header "><h3 class="card-item d-inline-block">Brand List</h3>
    <button onclick="add_order_model_open()" class="pull-right btn btn-primary float-right">Add New</button>
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
<div id="order_create_modal" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Brand Create</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" id="order_create_form">
            <div class="row">
                <div class="col-lg-8">
                    <div class="form-group">
                        <label for="customer_name">Enter Receiver Name</label>
                        <input type="text" name="customer_name" id="customer_name" class="form-control" placeholder="Enter Receiver Name">
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="order_date">Date</label>
                        <input type="date" name="order_date" id="order_date" placeholder="Order Date" class="form-control">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="form-group">
                        <label for="customer_address">Enter Receiver Detail Address</label>
                        <textarea name="customer_address" class="form-control" id="customer_address" cols="30" rows="3" placeholder="Enter Receiver Detail Address"></textarea>
                    </div>
                </div>
            </div>
            <h4>Enter Product Details</h4>
            <div class="row">
                <div class="col-lg-8">
                    <select name="product_id[]" class="form-control">
                    <?php if(count($products) > 0){ foreach($products as $key=>$product){ ?>
                        <option value="<?= $product->id ?>"><?= $product->product_name; ?></option>
                    <?php }} ?>
                        
                    </select>
                </div>
                <div class="col-lg-3">
                    <input type="number" name="quantity[]" class="form-control">
                </div>
                <div class="col-lg-1">
                    <button onclick="add_new_product()" type="button" class="badge badge-success">+</button>
                </div>
            </div><br>
            <div  id="product_details">
            
            
            </div>
            <label for="">&nbsp;</label>
            <label for="">&nbsp;</label>
            <label for="">&nbsp;</label>
            <label for="">&nbsp;</label>
            <div class="row">
                <div class="col-lg-12">
                    <div class="form-group">
                        <label for="payment_status">Payment Status</label>
                        <select name="product_id" class="form-control">
                            <option value="cash">Cash</option>
                            <option value="due">Due</option>
                        </select>
                    </div>
                    
                </div>
            </div>

            
      </div>
      <div class="modal-footer">
      <button onclick="save_brand()" id="save_order_button" class="btn btn-primary" type="button">Save</button>
      <button onclick="update_brand()" id="update_order_button" class="btn btn-warning" type="button">Update</button>
            <button type='reset' class="btn btn-danger">Reset</button>
        </form>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<?php $this->load->view('layouts/footer.php'); ?>
<script>

function deduct_new_row (element) { 
    var new_div_id = $(element).parent("div").parent("div").attr("id");
    // $('#'+new_div_id).css('display','none');
    $('#'+new_div_id).remove();
}

</script>
<script>
    var li = "http://localhost/ci_inventory_management_system/";

    $(document).ready(function(){
        // all_brands();
    });
    var a = 0;
    function add_new_product(){
        $.ajax({
            type : 'post',
            url : li + "order_ctrl/all_products",
            dataType : 'json',
            success : function(data){

               if(data){
                   var html = `
                   <div class="row mb-4" id="${++a}">
                <div class="col-lg-8">
                    <select name="product_id[]" class="form-control">`;
                    var product_count = data.length;
                    for(var i=0; i < product_count; i++){
                        html+= `<option value="${data[i].id}">${data[i].product_name}</option>`;
                    }
                        
                html +=`    </select>
                </div>
                <div class="col-lg-3">
                    <input type="number" name="quantity[]" class="form-control">
                </div>
                <div class="col-lg-1 myClass">
                    <button  type="button" onclick="deduct_new_row(this)" class=" badge badge-danger"><b>-</b></button>
                </div>
            </div>
                   `;
                $('#product_details').append(html);
               }
            }
        });
    }
    $(".myClass").each(function(i,item) {
        //Reset Attribute id with new value
        $(item).attr("id", $(item).attr("id")+(i+1));
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
                        $("#order_create_form").trigger('reset');
                        $('#order_create_modal').modal('hide');
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
                    $('#order_create_modal').modal('show');
                    $('#save_order_button').css('display','none');
                    $('#update_order_button').css('display','block');
                   }
                }
            });
        }
    }


    function add_order_model_open(){
        $("#order_create_form").trigger('reset');
        $('#save_order_button').css('display','block');
        $('#update_order_button').css('display','none');
        $('#order_create_modal').modal('show');
    }



    function save_brand(){
        var category_id = $('#category_id').val();
        var brand_name = $('#brand_name').val();
        var data = {brand_name:brand_name,category_id:category_id};
        if(brand_name && category_id){
           $.ajax({
            type : 'post',
            data : data,
            url : li + "brand_ctrl/save_brand",
            dataType : 'json',
            success : function(data){
                if(data){
                    $("#order_create_form").trigger('reset');
                    $('#order_create_modal').modal('hide');
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