<div class="container">
    <div class="panel panel-info col-md-10 col-lg-10">
    <h3 style="margin-right: 3%">
        {{isset($panel_title) ?$panel_title :''}}
    </h3>
    <div class="row col-md-12 col-lg-12" >

        <div class="col-md-8 col-md-offset-2">
            <form method="post" id="frm" action="{{isset($card) ?url('card/update/'.$card->card_id):route('card.create')}}" >
                {{isset($card) ?method_field('put') :''}}
                {{csrf_field()}}

                <div class="form-group required" id="form-card_name-error">
                    <label for="card_name" class="col-md-4 control-label"> نام کارت :</label>
                    <div class="col-md-12">
                        <input id="card_name" type="text" class="form-control required" name="card_name"
                                                value="{{ old('card_name',isset($card->card_name)? $card->card_name:'') }}"
                                                autofocus>
                        <span id="card_name-error" class="help-block"></span>
                    </div>
                    </div>

                <div class="form-group required" id="form-card_price-error">
                    <label for="card_price" class="col-md-4 control-label"> قیمت کارت:</label>
                    <div class="col-md-12">
                        <input id="card_price" type="number" class="form-control required" name="card_price"
                                                value="{{ old('card_price',isset($card->card_price)? $card->card_price:'') }}"
                                                autofocus>
                        <span id="card_price-error" class="help-block"></span>
                    </div>
                    </div>
                <div class="form-group required" id="form-department-error">
                    <label for="department" class="col-md-4 control-label">دپارتمنت مربوطه :</label>
                    <div class="col-md-12">
                        <select name="department" id="department" class="form-control required">
                            @foreach($departments as $department)
                                <option value="{{ $department->department_id}}" {{isset($card->department_id) && $department->department_id == $card->department_id ? 'selected'.'='.'selected':''}}>{{$department->department_name}}</option>
                            @endforeach
                        </select>
                        <span id="department-error" class="help-block"></span>
                    </div>
                </div>

                <div class="form-group" >
                    <input id="id" type="hidden"  class="form-control" name="id"
                           value="{{ old('card_id',isset($card->card_id)? $card->card_id:'') }}"
                           autofocus>
                    <div class="col-md-8 col-lg-8 col-md-offset-4 register" style="margin: 3%">
                        <a href="javascript:ajaxLoad('card')" class="btn btn-danger glyphicon glyphicon-backward">لغو</a>
                        <button type="submit" id="btn_save" class="btn btn-primary glyphicon glyphicon-floppy-disk"> ذخیره </button>
                    </div>
                </div>

            </form>
        </div>
    </div>
    </div>
</div>