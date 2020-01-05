<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Navbar</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="<?= base_url('user_ctrl/user') ?>">User</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?= base_url('category_ctrl/category') ?>">Category</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?= base_url('brand_ctrl/brand') ?>">Brand</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?= base_url('product_ctrl/product'); ?>">Product</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Order</a>
      </li>
      
    </ul>
    <ul class="navbar-nav mr-auto">
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <?= $this->Common_model->anyName('users',['id'=>$this->session->userdata('id')],'name'); ?>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="<?= base_url('logout_ctrl/profile') ?>">Profile</a>
          <a class="dropdown-item" href="<?= base_url('logout_ctrl/logout'); ?>">Logout</a>
        </div>
      </li>
      </ul>
  </div>
</nav>