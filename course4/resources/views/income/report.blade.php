@extends('layout.master')
@section('content')
    <div class="row">
        <div class="col col-md-12">
            <form action="">
                <div class="col col-md-3">
                    <div class="form-group">
                        <label for="as"> نام مشتری: </label>
                        <input id="as" name="as" class="form-control">
                    </div>


                </div>
                <div class="col col-md-3">
                    <div class="form-group" id="choose">
                        <label for="type">نحوه گزارش:</label>
                        <select id="type" name="type" class="form-control">
                            <option  value="day">روز</option>
                            <option value="week">هفته</option>
                            <option value="month">ماه</option>
                            <option value="year">سال</option>
                            <option value="date">بین تاریخ</option>
                        </select>

                    </div>



                </div>
                <div class="col col-md-3">

                    @include('management.customer.month')
                    @include('management.customer.year')
                    @include('management.customer.bettwen_date')




                </div>
                <div class="col col-md-3">
                    <div class="form-group " id="between_date">
                        <label for="ta">تا تاریخ:</label>
                        <input id="ta" name="ta" class="form-control">
                    </div>


                </div>
            </form>

        </div>
        <div class="col col-md-12">
            <table class="table table-bordered table-responsive">
                <thead>
                <tr>
                    <th>1</th>
                    <th>2</th>
                    <th>3</th>
                    <th>4</th>
                    <th>5</th>
                </tr>
                </thead>
                <tbody>

                </tbody>
                <tfoot>

                </tfoot>
            </table>
        </div>

    </div>

@stop