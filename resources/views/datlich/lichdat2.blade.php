    <style type="text/css">
      #nhanvien .nhanvien{
        width: 48.5%;
        height: auto;
        float: left;
        border-radius: 5px;
        font-size: 15px;
        font-family: montserrat;
      } 
    </style>
    <div id="nhanvien">
        @foreach($nhanvien as $nv)
        <div class="nhanvien">
          {{-- <input type="radio" name="chonnhanvien" class="chonnhanvien checkbox-budget" id="{{$nv->id}}" value="{{$nv->id}}">
          <label class="for-checkbox-budget" for="{{$nv->id}}"><i class="uil uil-line-alt"></i><h2>{{$nv->user->name}}</h2></label> --}}
          {{-- <input type="radio" name="chonnhanvien" id="" class="chonnhanvien checkbox-tools" value="abc" />
          <label class="for-checkbox-tools" for=""><i class="uil uil-line-alt"></i><h2>abc</h2></label> --}}


          <input type="radio" name="chonnhanvien" id="{{$nv->user->name . '-' . $nv->id}}" class="chonnhanvien checkbox-tools" value="{{$nv->id}}" />
          <label class="for-checkbox-tools" for="{{$nv->user->name . '-' . $nv->id}}"><i class="uil uil-line-alt"></i><h2>{{$nv->user->name}}</h2></label>
        </div>
        @endforeach
    </div>

