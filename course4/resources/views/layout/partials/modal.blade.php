<!-- Modal -->
{{--
<div class="modal fade" id="boostrapModal-1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Modal title</h4>
            </div>
            <div class="modal-body">
                <form method="post" id="frm" action="{{isset($country) ?url('country/update/'.$country->id):route('country.create')}}" >
                    {{isset($country) ?method_field('put') :''}}
                    {{csrf_field()}}
                    <div class="form-group required" id="form-country-code-error">
                        <label for="country-code">Country Code:*</label>
                        <input type="text" class="form-control" id="country-code" name="country-code" value="{{old('country_code',isset($country) ?$country->country_code :'')}}">
                        <span id="country-code-error" class="help-block"></span>
                    </div>
                    <div class="form-group required" id="form-country-name-error">
                        <label for="country-name">Country Name:*</label>
                        <input type="text" class="form-control" id="country-name" name="country-name" value="{{old('country_name',isset($country)? $country->country_name:'')}}">
                        <span class="help-block" id="country-name-error"></span>
                    </div>
                    <div class="form-group">
                        <a href="javascript:ajaxLoad('country')" class="btn btn-danger">Back</a>
                        <button type="submit" id="btn_save" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-sm waves-effect waves-light" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary btn-sm waves-effect waves-light">Save changes</button>
            </div>
        </div>
    </div>
</div>
--}}


