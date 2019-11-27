<div class="container">
    <h3 >
        {{isset($panel_title) ?$panel_title :''}}
    </h3>
    <div class="row col-md-10 col-lg-10">
        
        <div class="col-md-8 col-md-offset-2">
            <form method="post" id="frm" action="{{isset($subject) ?url('subject/update/'.$subject->subject_id):route('subject.create')}}" >
                {{isset($subject) ?method_field('put') :''}}
                {{csrf_field()}}

                <div class="form-group required" id="form-subject_name-error">
                    <label for="subject_name" class="col-md-4 control-label"> نام مضمون :</label>
                    <div class="col-md-12">
                        <input id="subject_name" type="text" class="form-control required" name="subject_name"
                                                value="{{ old('subject_name',isset($subject->subject_name)? $subject->subject_name:'') }}"
                                                autofocus>
                        <span id="subject_name-error" class="help-block"></span>
                    </div>
                    </div>
                <div class="form-group required" id="form-subject_payment-error">
                    <label for="subject_payment" class="col-md-4 control-label"> فیس مضمون :</label>
                    <div class="col-md-12">
                        <input id="subject_payment" type="number" class="form-control required" name="subject_payment"
                                                value="{{ old('subject_payment',isset($subject->subject_payment)? $subject->subject_payment:'') }}"
                                                autofocus>
                        <span id="subject_payment-error" class="help-block"></span>
                    </div>
                    </div>
                <div class="form-group required " id="form-department-error">
                    <label for="department" class="col-md-4 control-label">دپارتمنت مربوطه:</label>
                    <div class="col-md-12">
                        <select name="department" id="department" class="form-control required">
                            @foreach($departments as $department)
                                <option value="{{ $department->department_id}}" {{isset($subject->department_id) && $department->department_id == $subject->department_id ? 'selected'.'='.'selected':''}}>{{$department->department_name}}</option>
                            @endforeach
                        </select>
                        <span id="department-error" class="help-block"></span>
                    </div>
                </div>
                
                <div class="form-group required" id="form-subject_id-error" >
                    <input id="subject_id" type="hidden"  class="form-control" name="subject_id"
                           value="{{ old('subject_id',isset($subject->subject_id)? $subject->subject_id:'') }}"
                           autofocus>
                    <div class="col-md-6 col-md-offset-4 register" style="margin-top: 2%">
                        <a href="javascript:ajaxLoad('subject')" class="btn btn-danger glyphicon glyphicon-backward">لغو</a>
                        <button type="submit" id="btn_save" class="btn btn-primary glyphicon glyphicon-backward"> ذخیره</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>