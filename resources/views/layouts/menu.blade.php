<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
	    <div class="container">
	      <a class="navbar-brand" href="index.html"><span class="flaticon-scissors-in-a-hair-salon-badge"></span>Haircare</a>
	      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
	        <span class="oi oi-menu"></span> Menu
	      </button>

	      <div class="collapse navbar-collapse" id="ftco-nav">
	        <ul class="navbar-nav ml-auto">
	        	<li class="nav-item active"><a href="index" class="nav-link">Trang chủ</a></li>
	        	<li class="nav-item"><a href="services" class="nav-link">Dịch vụ</a></li>
	        	<li class="nav-item"><a href="gallery" class="nav-link">Cửa hàng</a></li>
	        	<li class="nav-item"><a href="about" class="nav-link">About</a></li>
	        	<li class="nav-item"><a href="blog" class="nav-link">Blog</a></li>
	          	<li class="nav-item"><a href="contact" class="nav-link">Liên hệ</a></li>
	          	@if(Auth::check())
	          		<li class="nav-item"><a href="logout" class="nav-link btn btn-warning">Đăng xuất</a></li>
	          	@else
	          		<li class="nav-item"><a type="button" class="nav-link btn btn-warning" data-toggle="modal" data-target="#mymodal">Đăng nhập</a></li>
	          	@endif
	          	
	        </ul>
	      </div>
	    </div>
	  </nav>

	  {{-- modal --}}
	  	<div class="modal fade" id="mymodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Đăng nhập nào</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      	<form action="login" method="post">
      		{{csrf_field()}}
      		<label for="dangnhap" class="text-danger">Nhập số điện thoại</label>
      		<input type="tel" name="txtSDT" id="dangnhap"><br>
      		<label for="password" class="text-danger">Nhập mật khẩu</label>
      		<input type="password" name="txtPW" id="password"><br>
      		<input type="submit" name="submitbtn" value="Tiếp tục">
      		<a href="register">Chưa có Tài khoản, đăng ký tại đây.</a>
      	</form>
        
      </div>
    </div>
  </div>
</div>
	  {{-- modal --}}