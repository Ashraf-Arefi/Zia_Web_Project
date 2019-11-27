<div class="container">
    <div class="row col-md-10 col-lg-10">
        <h3 style="margin-right: 1%">
            {{isset($panel_title) ?$panel_title :''}}
        </h3>
        <div class="col-md-8 col-md-offset-2">
            <form method="post" id="frm" action="{{isset($reason_pay) ?url('reason_pay/update/'.$reason_pay->expense_reason_id):route('reason_pay.create')}}" >
                {{isset($reason_pay) ?method_field('put') :''}}
                {{csrf_field()}}
                <div class="form-group required" id="form-reason_pay-code-error">
                    <label for="title">نوع مصرف:</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{old('title',isset($reason_pay) ?$reason_pay->title :'')}}">
                    <span id="reason_pay-code-error" class="help-block"></span>
                </div>
           
                <div class="form-group">
                    <a href="javascript:ajaxLoad('reason_pay')" class="btn btn-danger glyphicon glyphicon-backward">لغو</a>
                    <button type="submit" id="btn_save" class="btn btn-primary glyphicon glyphicon-floppy-disk"> ذخیره</button>
                </div>
            </form>

        </div>
    </div>
</div>