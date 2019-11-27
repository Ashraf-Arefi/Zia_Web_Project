<div class="container">
    <h4 class="box-title">
        {{isset($panel_title) ?$panel_title :''}}
    </h4>
    <div class="row col-md-10 col-lg-10" >
        
        <div class="col-md-8 col-md-offset-2">
            <form method="post" id="frm"
                  action="{{isset($book) ? route('book.update',$book->book_id): route('book.create')}}" >
                    {{csrf_field()}}

                <div class="form-group {{ $errors->has('department') ? ' has-error' : '' }}">
                    <label for="subject" class="col-md-4 control-label">مضمون :</label>
                    <select name="subject" id="subject" class="form-control">
                        @foreach( $subjects as $de)
                            <option
                                <?php
                                if (isset($book)){
                                    if ($book->department_id == $de->department_id)
                                        echo " selected ";
                                }
                                ?>
                                value="{{ $de->subject_id  }}">
                                {{ $de->subject_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group{{ $errors->has('department') ? ' has-error' : '' }}">
                    <label for="department" class="col-md-4 control-label">دیپارتمنت:</label>
                    <select name="department" id="department" class="form-control">
                        @foreach( $employees as $de)
                            <option
                                <?php
                                if (isset($book)){
                                    if ($book->department_id == $de->department_id)
                                        echo " selected ";
                                    }
                                ?>
                                value="{{ $de->employee_id  }}">
                                {{ $de->first_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group{{ $errors->has('department') ? ' has-error' : '' }}">
                    <label for="department" class="col-md-4 control-label">اتاق :</label>
                    <select name="department" id="department" class="form-control">
                        @foreach( $rooms as $de)
                            <option
                                <?php
                                if (isset($book)){
                                    if ($book->department_id == $de->department_id)
                                        echo " selected ";
                                }
                                ?>
                                value="{{ $de->room_id  }}">
                                {{ $de->room_name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="version" class="col-md-4 control-label"> تابم :</label>
                    <div class="form-control">
                        <input type="time" name="time" >
                        <input type="time" name="time" >
                    </div>
                </div>

                <div class="form-group">
                    <label for="version" class="col-md-4 control-label"> زمان شروع :</label>
                    <input type="date" id="times" class="form-control" name="start_date" >
                </div>

                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4 register">
                        <a href="javascript:ajaxLoad('create')" class="btn btn-danger">Back</a>
                        <button type="submit" id="btn_save" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>