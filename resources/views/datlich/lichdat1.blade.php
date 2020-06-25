<div class="row">
		<select name="thanhpho" id="chon_thanhpho" class="tieude col-md-5 m-auto">

			<option selected="">Chọn Tỉnh/TP</option>
			@foreach($thanhpho as $tp)
				<option>{{$tp['thanhpho']}}</option>
			@endforeach
			
		</select>
		<select name="quan" id="chon_quan" class="tieude col-md-5 m-auto">
			<option selected="">Chọn Quận/Huyện</option>
		</select>

		<div id="cuahang" class="col-md-12" style="height: 200px; overflow: auto;">

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