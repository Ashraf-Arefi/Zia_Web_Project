<div class="container">


            <h3>
                {{isset($panel_title) ?$panel_title :''}}
            </h3>

        <div class="row">
            <form method="post" id="frm" action="{{isset($library) ?route('library.update',$library->book_library_id):route('library.create')}}" >
                {{--{{isset($library) ?method_field('put'):''}}--}}
                {{csrf_field()}}

                <div class="col-sm-12 col-md-4">
                    <div class="form-group required" id="form-book_name-error">
                        <label for="book_name" class=" control-label">نام کتاب:</label>
                        <select id="book_name" type="text" class="form-control" name="book_name" otoufocus>
                            @foreach($book as $b)

                                <option value="{{ $b->book_id }}" {{isset($library->book_id) && $b->book_id == $library->book_id ? 'selected'.'='.'selected':''}}>{{$b->book_name}}</option>

                            @endforeach
                        </select>
                        <span id="book_name-error" class="help-block"></span>
                    </div>
                </div>
                <div class="col-sm-12 col-md-4">
                    <div class="form-group required" id="form-book_quantity-error">
                        <label for="book_quantity" class=" control-label">تعداد کتاب:</label>
                        <input id="book_quantity" type="number" class="form-control required" name="book_quantity" value="{{old('name',isset($library)?$library->quantity:'')}}" autofocus>
                    </div>
                    <span id="book_quantity-error" class="help-block"></span>
                </div>
                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4 register" style="margin-bottom: 20px;">
                        <button type="submit" id="btn_save" class="glyphicon glyphicon-floppy-disk btn btn-primary">ذخیره</button>

                        <a href="javascript:ajaxLoad('library')" class="glyphicon glyphicon-backward btn btn-danger">لغو</a>
                    </div>
                </div>
            </form>
        </div>


</div>