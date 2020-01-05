<?php $this->load->view('layouts/header.php'); ?>


<?php $this->load->view('layouts/navbar.php'); ?>

<div class="card">
    <div class="card-header "><h3 class="card-item">User Profile</h3>
    </div>
    <div class="card-body">
       <form action="">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" value="<?= $user->name ?>" name="name" id="name" class="form-control">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" value="<?= $user->email ?>" name="email" id="email" class="form-control">
            </div>
       <p>Leave Password Blank If You Do Not Want Change</p>
            <div class="form-group">
                <label for="new_password">New Password</label>
                <input type="password" onkeyup="get_new_password(this.value)" name="new_password" id="new_password" class="form-control">
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirm Password</label>
                <input type="password" onkeyup="get_confirm_password(this.value)" disabled name="confirm_password" id="confirm_password" class="form-control">
            </div>
            <button type="button" id="update_profile_button" onclick="update_profile()" class="btn btn-primary">Update</button>
       </form>
       
    </div>
    <div class="card-footer"></div>
</div>




<?php $this->load->view('layouts/footer.php'); ?>
<script>
    var li = "http://localhost/ci_inventory_management_system/";
    function update_profile(){
        var name = $('#name').val();
        var email = $('#email').val();
        var new_password = $('#new_password').val();
        if(new_password){
            var data = {name,email,new_password};
        }else{
            var data = {name,email};
        }
        
        
            $.ajax({
                type : 'post',
                data : data,
                url : li + "logout_ctrl/update_profile",
                success : function(data){
                   
                    if(data == 1){
                        alert('Profile updated successfully');
                        window.location.href = li + "logout_ctrl/profile";
                    }
                }
            });
        
        
    }

    function get_new_password(v){
        var counter = v.length;
        if(counter !== 0){
            $('#confirm_password').prop("disabled",false);
            $('#update_profile_button').prop("disabled",true);
        }else{
            $('#confirm_password').prop("disabled",true);
            $('#update_profile_button').prop("disabled",false);
        }
    }

    function get_confirm_password(v){
        var new_password = $('#new_password').val();
        if(v === new_password){
            $('#update_profile_button').prop("disabled",false);
        }else{
            $('#update_profile_button').prop("disabled",true);
        }
    }
</script>