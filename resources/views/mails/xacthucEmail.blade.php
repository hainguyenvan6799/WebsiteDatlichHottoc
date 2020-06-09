<form action="xacthucEmail" method="post">
	{{csrf_field()}}
	Có<input type="radio" name="xacthucEmail" value="1"><br>
	Không<input type="radio" name="xacthucEmail" value="0"><br>
	<input type="hidden" name="txtEmail" value="{{$email}}">
	<input type="submit" name="submit" value="Xác thực">
</form>
@endif