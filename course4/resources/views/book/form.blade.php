<div class="container">

    <h3 style="text-align: right">
        {{isset($panel_title) ?$panel_title :''}}
    </h3>


    <div class="row">

        <div class="col-md-6">
            <form method="post" id="frm"
                  action="{{isset($book) ? route('book.update',$book->book_id): route('book.create')}}">
                {{--{{isset($book) ?method_field('put') :''}}--}}
                {{csrf_field()}}

                <div class="form-group required" id="form-title-error">
                    <label for="title" class="control-label">نام کتاب:</label>
                    <input id="title" type="text" class="form-control required" name="title"
                           value="{{ old('description',isset($book)? $book->book_name:'') }}"
                           autofocus>
                    <span id="title-error" class="help-block"></span>
                </div>
                <div class="form-group required" id="form-version-error">
                    <label for="version" class="col-md-4 control-label"> نسخه کتاب :</label>
                    <input id="version" type="text" class="form-control" name="version"
                           value="{{ old('description',isset($book)? $book->book_edition:'') }}"
                           autofocus>
                    <span id="version-error" class="help-block"></span>
                </div>

                <div class="form-group required" id="form-payment-error">
                    <label for="payment" class="col-md-4 control-label"> قیمت کتاب :</label>
                    <input id="payment" type="text" class="form-control" name="payment"
                           value="{{ old('payment',isset($book)? $book->book_price:'') }}"
                           autofocus>
                    <span id="payment-error" class="help-block"></span>
                </div>
                <div class="form-group{{ $errors->has('department') ? ' has-error' : '' }} required" id="form-department-error">
                    <label for="department" class="col-md-4 control-label">دیپارتمنت:</label>
                    <select name="department" id="department" class="form-control">
                        @foreach( $departments as $de)
                            <option
                                <?php
                                if (isset($book)) {
                                    if ($book->department_id == $de->department_id)
                                        echo " selected ";
                                }
                                ?>
                                value="{{ $de->department_id  }}">
                                {{ $de->department_name }}</option>
                        @endforeach
                    </select>
                    <span id="department-error" class="help-block"></span>
                </div>
                <div class="form-group">
                    <div class="col-md-6 register">
                        <a href="javascript:ajaxLoad('book')"
                           class="glyphicon glyphicon-backward btn btn-danger">لغو</a>
                        <button type="submit" id="btn_save" class="glyphicon glyphicon-floppy-disk btn btn-primary">
                            ذخیره
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

