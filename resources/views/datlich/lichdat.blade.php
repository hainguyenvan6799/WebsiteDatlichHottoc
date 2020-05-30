<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<form action="lichdat1" method="post">
		
		<h2>Chọn salon gần bạn</h2>
		<select name="thanhpho" id="chon_thanhpho">

			<option selected="">Chọn Tỉnh/TP</option>
			@foreach($thanhpho as $tp)
				<option value="{{$tp['thanhpho']}}">{{$tp['thanhpho']}}</option>
			@endforeach
			
		</select>
		<select name="quan" id="chon_quan">
			<option selected="">Chọn Quận/Huyện</option>
		</select>
		<input type="submit" name="tieptheo" value="Tiếp theo">
	</form>
</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$('#chon_thanhpho').on('change', function(){
			//alert($(this).val());
			$.get('ajax/chonthanhpho/'+$(this).val(), function(text){
				$('#chon_quan').append(text);
			});
		});
	});
</script>
</html>