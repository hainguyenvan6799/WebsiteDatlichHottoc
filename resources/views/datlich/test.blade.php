<?php 
	$sdt = isset($_GET['appointment_sdt']) ? $_GET['appointment_sdt'] : '';
	session()->put('sdt', $sdt);
?>
<title>Đặt lịch cắt tóc nào</title>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" />
<base href="{{asset('')}}">

{{-- public/css/cssformdatlich.css --}}
	<link rel="stylesheet" type="text/css" href="{{URL::to('css/cssformdatlich.css')}}">
{{-- public/css/cssformdatlich.css --}}

<!-- MultiStep Form -->
<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <form id="msform">
            <!-- progressbar -->
            <ul id="progressbar">
                <li class="active">Chọn cửa hàng</li>
                <li>Chọn nhân viên</li>
                <li>Chọn lịch</li>
            </ul>
            <!-- fieldsets -->
            <fieldset>
                <h2 class="fs-title">Chọn cửa hàng</h2>
                <h3 class="fs-subtitle">Chọn cửa hàng gần nhất mà bạn muốn.</h3>
                <div id="Buoc1">
                	<h2>Bạn cần chọn</h2>
                </div>
                <input type="button" name="next" class="next action-button quaBuoc2" value="Next"/>
            </fieldset>
            <fieldset>
                <h2 class="fs-title">Chọn nhân viên</h2>
                <h3 class="fs-subtitle">Nhân viên toàn trai xinh, gái đẹp cả thôi.</h3>

                <div id="Buoc2">
                	
                </div>

                {{-- <div class="nhanvien">
                	<input type="radio" name="chonnhanvien" id="" class="chonnhanvien checkbox-tools" value="abc" />

          <label class="for-checkbox-tools" for=""><i class="uil uil-line-alt"></i><img src="{{URL::to('images/nhanvien/kai-seidler.jpg')}}" alt="123"><h2>abc</h2></label>
                </div> --}}

                <input type="button" name="previous" class="previous action-button-previous" value="Previous"/>
                <input type="button" name="next" class="next action-button quaBuoc3" value="Next"/>
            </fieldset>
            <fieldset>
                <h2 class="fs-title">Chọn lịch</h2>
                <h3 class="fs-subtitle">Chọn lịch mà bạn mong muốn</h3>
                <div id="Buoc3">
                	
                </div>
                <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                <input type="submit" name="submit" class="submit action-button" value="Submit"/>
            </fieldset>
        </form>
        <!-- link to designify.me code snippets -->
        
        <!-- /.link to designify.me code snippets -->
    </div>
</div>
<!-- /.MultiStep Form -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
<script type="text/javascript" src="{{URL::to('js/jsformdatlich1.js')}}"></script>
<script type="text/javascript" src="{{URL::to('js/jsformdatlich2.js')}}"></script>