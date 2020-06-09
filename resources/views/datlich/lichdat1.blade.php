<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
</head>
<body>
	<form action="lichdat2" method="post" id="formlichdat2">
		{{csrf_field()}}
		<h2>Chọn salon gần bạn</h2>
		<select name="thanhpho" id="chon_thanhpho">

			<option selected="">Chọn Tỉnh/TP</option>
			@foreach($thanhpho as $tp)
				<option>{{$tp['thanhpho']}}</option>
			@endforeach
			
		</select>
		<select name="quan" id="chon_quan">
			<option selected="">Chọn Quận/Huyện</option>
		</select>

		<h2>Các cửa hàng</h2>
		<div id="cuahang">

		</div>

		<input type="submit" name="tieptheo" value="Tiếp theo">
	</form>
</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		if(navigator.geolocation){
			navigator.geolocation.getCurrentPosition(function(position){
				var pos = {
					lat: position.coords.latitude,
					lng: position.coords.longitude
				};

				$('#chon_thanhpho').on('change', function(){
			//alert($(this).val());
			$.get('ajax/chonthanhpho/'+$(this).val(), function(text){
				$('#chon_quan').append(text);
			});
		});

		$('#chon_quan').on('change', function(){
			$.get('ajax/choncuahang/'+$('#chon_thanhpho').val()+'/'+$(this).val()+'/'+pos.lat+'/'+pos.lng,function(text){
				$('#cuahang').html(text);
			});
		});
			});
		}

		
	});
</script>
</html>