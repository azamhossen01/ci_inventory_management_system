<?php $this->load->view('layouts/header.php'); ?>


<?php $this->load->view('layouts/navbar.php'); ?>

<div class="card">
    <div class="card-header d-inline-block"><h3>User List
        <button class="btn btn-success float-right" onclick="add_user_modal_open()">Add</button>
    </h3>
    </div>
    <div class="card-body">
       <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Email</th>
                    <th>Name</th>
                    <th>Status</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody id="all_users">
                
            </tbody>
       </table>
    </div>
    <div class="card-footer"></div>
</div>



<!-- modal start here -->
<div class="modal" id="add_user_modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="" id="add_user_form">
            <div class="form-group">
                <label for="role">Select User Role</label>
                <select name="role" required id="role" class="form-control">
                    <option value="" disabled selected>Choose one</option>
                    <option value="1">Admin</option>
                    <option value="2">User</option>
                </select>
            </div>
            <div class="form-group">
                <label for="name">Name</label>
                <input required type="text" name="name" id="name" class="form-control">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input required type="email" name="email" id="email" class="form-control">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input required type="password" name="password" id="password" class="form-control">
            </div>
            <input type="hidden" name="user_id" id="user_id">
      
      </div>
      <div class="modal-footer">
        <button type="button" style="display:none" onclick="save_user()" id="save_user_button" class="btn btn-primary">Save</button>
        <button type="button" style="display:none" onclick="update_user()" id="update_user_button" class="btn btn-primary">Update</button>
        <button type="reset" class="btn btn-danger">Clear</button>
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
    all_users();
});

function update_user(){
    var user_id = $('#user_id').val();
    var role = $('#role').val();
    var name = $('#name').val();
    var email = $('#email').val();
    var password = $('#password').val();
    if(password !== null){
        var data = {user_id,role,name,email,password};
    }else{
        var data = {user_id,role,name,email};
    }
    $.ajax({
        type : 'post',
        data : data,
        url : li + "user_ctrl/update_user",
        dataType : 'json',
        success : function(data){
            if(data){
                alert('User updated successfully');
                all_users();
                $('#add_user_form')[0].reset();
                $('#add_user_modal').modal('hide');
                $('#user_id').val("");
            }
        }
    });
}

function add_user_modal_open(){
    $('#add_user_form')[0].reset();
    $('#save_user_button').css('display','block');
    $('#update_user_button').css('display','none');
    $('#add_user_modal').modal('show');
}

function all_users(){
    $.ajax({
        type : 'post',
        url : li + 'user_ctrl/all_users',
        dataType : 'json',
        success : function(data){
            var user_count = data.length;
            var html = ``;
            for(var i = 0; i < user_count; i++){
                html+= `<tr>
                    <td>${i+1}</td>
                    <td>${data[i].name}</td>
                    <td>${data[i].email}</td>
                    <td>${data[i].user_status == 1 ? 'Active':'Deactive'}</td>
                    <td><button onclick="update_user_modal_open(${data[i].id})" class="btn btn-warning">Edit</button></td>
                    <td><button onclick="change_status(${data[i].id},${data[i].user_status})" class="btn btn-danger">Delete</button></td>
                </tr>`;
            }
            $('#all_users').html(html);
        }
    });
}

function change_status(id,status){
    if(id){
        $.ajax({
            type : 'post',
            data : {status},
            url : li + "user_ctrl/change_user_status/" + id,
            dataType : 'json',
            success : function(data){
                if(data){
                    all_users();
                }
            }
        });
    }
}

function update_user_modal_open(id){
    $('#user_id').val(id);
    $('#save_user_button').css('display','none');
    $('#update_user_button').css('display','block');
    if(id){
        $.ajax({
            type : 'post',
            url : li + "user_ctrl/get_update_user/" + id,
            dataType : 'json',
            success : function(data){
                $('#role').val(data.role);
                $('#name').val(data.name);
                $('#email').val(data.email);
            }
        });
    }
    $('#add_user_modal').modal('show');
}

function save_user(){
    var name = $('#name').val();
    var email = $('#email').val();
    var password = $('#password').val();
    var role = $('#role').val();
    var data = {role,name,email,password};
    console.log(data);
    $.ajax({
        type : 'post',
        data : data,
        url : li + "user_ctrl/save_user",
        success : function(data){
            if(data){
                alert('User inserted successfully');
                $('#add_user_modal').modal('hide');
                $('#add_user_form')[0].reset();
                all_users();
            }else{
                alert('User insert failed');
            }
        }
    });
}

</script>