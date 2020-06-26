    <div class="col-md-12" id="nhanvien" style="height: 200px; overflow: auto;">
        @foreach($nhanvien as $nv)
        <div class="col-md-6">
          {{-- <input type="radio" name="chonnhanvien" class="chonnhanvien checkbox-budget" id="{{$nv->id}}" value="{{$nv->id}}">
          <label class="for-checkbox-budget" for="{{$nv->id}}"><i class="uil uil-line-alt"></i><h2>{{$nv->user->name}}</h2></label> --}}
          <input type="radio" name="chonnhanvien" id="{{$nv->user->name}}" class="chonnhanvien checkbox-tools" value="{{$nv->id}}" />
          <label class="for-checkbox-tools" for="{{$nv->user->name}}"><i class="uil uil-line-alt"></i><h2>{{$nv->user->name}}</h2></label>
        </div>
        @endforeach
    </div>

