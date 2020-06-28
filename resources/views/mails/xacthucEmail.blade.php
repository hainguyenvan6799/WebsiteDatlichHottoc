<base href="{{asset('')}}">
<form action="xacthucEmail/{{$email}}" method="post">
	{{csrf_field()}}
	Có<input type="radio" name="xacthucEmail" value="1"><br>
	Không<input type="radio" name="xacthucEmail" value="0"><br>
	<input type="submit" name="submit" value="Xác thực">
</form>