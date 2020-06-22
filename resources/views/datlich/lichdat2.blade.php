    @foreach($nhanvien as $nv)
    <input type="radio" name="chonnhanvien" class="chonnhanvien" value="{{$nv->id}}">{{$nv->user->name}}
    @endforeach

