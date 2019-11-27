<div class="col-md-12">

    <div class="row">


        <div class="panel panel-info">
            <div class="panel-heading"><h2>مشخصات</h2></div>
            <div class="panel-body">


                <div class="col-md-3 card">
                    <img src="{{ asset($student->photo) }}" alt="">
                </div>
                <div class="col-md-8">
                    <div class="col-md-3">
                        <div class="list-group">
                            <a href="#" class="list-group-item disabled">نام:  </a>
                            <a href="#" class="list-group-item">تخلض</a>
                            <a href="#" class="list-group-item disabled">نام پدر</a>
                            <a href="#" class="list-group-item">جنسیت :</a>
                            <a href="#" class="list-group-item disabled">سن :  </a>
                            <a href="#" class="list-group-item">تلیفون : </a>
                            <a href="#" class="list-group-item disabled">آدرس : </a>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="list-group">
                            <a href="#" class="list-group-item disabled"> {{ $student->first_name }} </a>
                            <a href="#" class="list-group-item">{{ $student->last_name }}</a>
                            <a href="#" class="list-group-item disabled"> {{ $student->father_name }} </a>
                            <a href="#" class="list-group-item">{{ $student->gender }}</a>
                            <a href="#" class="list-group-item disabled"> {{ $student->age }} </a>
                            <a href="#" class="list-group-item">{{ $student->phone }}</a>
                            <a href="#" class="list-group-item disabled"> {{ $student->address }} </a>

                        </div>
                    </div>

                    <div class="col-md-12">
                        <img src="" alt="">

                        <img id="myImg" src="{{ asset($student->agreement_paper) }}" alt="Trolltunga, Norway" width="300" height="200">

                        <!-- The Modal -->
                        <div id="myModal" class="modal">

                            <!-- The Close Button -->
                            <span class="close">&times;</span>

                            <!-- Modal Content (The Image) -->
                            <img class="modal-content" id="img01">

                            <!-- Modal Caption (Image Text) -->
                            <div id="caption"></div>
                        </div>
                        <a  class="btn btn-info">نمایش قرارداد </a>
                        <a href="javascript:ajaxLoad('student')" class="btn btn-danger">برگشت </a>
                    </div>

                </div>

            </div>
        </div>



    </div>

</div>
