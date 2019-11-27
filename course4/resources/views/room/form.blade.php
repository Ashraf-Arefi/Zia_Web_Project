<div class="container">
    <h4 >
        {{isset($panel_title) ?$panel_title :''}}
    </h4>
    <div class="row col-md-10 col-lg-10 ">
        
        <div class="col-md-8 col-md-offset-2">
            <form method="post" id="frm" action="{{isset($room) ?url('room/update/'.$room->room_id):route('room.create')}}" >
                {{isset($room) ?method_field('put') :''}}
                {{csrf_field()}}

                <div class="form-group required" id="form-room_floor-error">
                    <label for="room_floor" class="col-md-4 control-label">طبقه چندم:</label>
                    <div class="col-md-12">
                        <input id="room_floor" type="text" class="form-control required" name="room_floor"
                               value="{{ old('room_floor',isset($room->room_floor)? $room->room_floor:'') }}"
                                                autofocus>
                        <span id="room_floor-error" class="help-block"></span>
                    </div>
                    </div>

                <div class="form-group required" id="form-room_name-error">
                    <label for="room_name" class="col-md-4 control-label"> نام اطاق:</label>
                    <div class="col-md-12">
                        <input id="room_name" type="text" class="form-control required " name="room_name"
                                                value="{{ old('room_name',isset($room->room_name)? $room->room_name:'') }}"
                                                autofocus>
                        <span id="room_name-error" class="help-block"></span>
                    </div>
                    </div>

                <div class="form-group" >
                    <input id="id" type="hidden"  class="form-control" name="id"
                           value="{{ old('room_id',isset($room->room_id)? $room->room_id:'') }}"
                           autofocus>
                    <div class="col-md-6 col-md-offset-4 register" style="margin-top: 2%" >
                        <a href="javascript:ajaxLoad('room')" class="btn btn-danger glyphicon glyphicon-backward">لغو</a>
                        <button type="submit" id="btn_save" class="btn btn-primary glyphicon glyphicon-floppy-disk"> ذخیره</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>