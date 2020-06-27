<style type="text/css">
	.selected-option{
		font-size: 15px;
		background-color: pink;
		color: black;
	}
</style>
<div class="row">
		<select name="thanhpho" id="chon_thanhpho" class="tieude">

			<option selected="" class="selected-option">Chọn Tỉnh/TP</option>
			@foreach($thanhpho as $tp)
				<option class="selected-option">{{$tp['thanhpho']}}</option>
			@endforeach
			
		</select>
		<select name="quan" id="chon_quan" class="tieude">
			<option selected="">Chọn Quận/Huyện</option>
		</select>

		
		<div id="cuahang" class="col-md-12">

		</div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		if(navigator.geolocation){
			navigator.geolocation.getCurrentPosition(function(position){
				var pos = {
					lat: position.coords.latitude,
					lng: position.coords.longitude
				};
				$.get('ajax/choncuahang/0/0/'+pos.lat+'/'+pos.lng, function(data)
				{
					$('#cuahang').html(data);
				});

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