<div class="container">
    <h3 style="margin-right: 2%" >
        {{isset($panel_title) ?$panel_title :''}}
    </h3>
    <div class="row">
        
        <div class="col-md-8 col-md-offset-2">
            <form method="post" id="frm" action="{{isset($department) ?url('department/update/'.$department->department_id):route('department.create')}}" >
                {{isset($department) ?method_field('put') :''}}
                {{csrf_field()}}

                <div class="form-group{{ $errors->has('department_name') ? ' has-error' : '' }} required" id="form-department_name-error">
                    <label for="department_name" class="col-md-4 control-label">نام دپارتمنت :</label>
                        <input id="department_name" type="text" class="form-control required" name="department_name"
                                                value="{{ old('department_name',isset($department->department_name)? $department->department_name:'') }}"
                                                autofocus>
                
                        @if ($errors->has('department_name'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('department_name') }}</strong>
                                    </span>
                        @endif
                    </div>
                <span id="department_name-error" class="help-block"></span>
                <div class="form-group" >
                    <input id="id" type="hidden"  class="form-control" name="id"
                           value="{{ old('department_id',isset($department->department_id)? $department->department_id:'') }}"
                           autofocus>
                    <div class="col-md-6 col-md-offset-4 register"style="margin-top: 2%" >
                        <button type="submit" id="btn_save" class="btn btn-primary">ذخیره</button>
                        <a href="javascript:ajaxLoad('department')" class="btn btn-danger">برگشت</a>

                    </div>
                </div>

            </form>
        </div>
    </div>
</div>