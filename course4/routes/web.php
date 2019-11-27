<?php


Auth::routes();
Route::group(['middleware' => 'auth'], function () {

    Route::get('/', function () {


        if (Auth::user()->user_level == \App\Models\User::ADMIN)

            return view('layout.home');
        else {
            return view('layout.home_user');
            //return redirect('error');
        }

    });

    Route::get('error', function () {

        return "sorry you can not access to this page";

    });

});
if(version_compare(PHP_VERSION, '7.2.0', '>=')) {
    error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
}

Route::group(['prefix' => 'home'], function () {
    Route::get('/', 'HomeController@index')->name('home.list');
    Route::match(['get', 'post'], 'create', 'HomeController@create')->name('home.create');
    Route::match(['get', 'put'], 'update/{id}', 'CountryController@update')->name('home.update');
    Route::delete('delete', 'HomeController@delete')->name('home.delete');

});

Route::group(['prefix' => 'backup'], function () {

    Route::get('/', 'BackupController@index')->name('backup.index');
    Route::get('/create', 'BackupController@create')->name('backup.create');
    Route::get('/download/{file_name}', 'BackupController@download')->name('backup.download');
    Route::delete('/delete', 'BackupController@delete')->name('backup.delete');
    Route::get('/getBackup', 'BackupController@getBackup')->name('backup.getBackup');
});

// User routes
Route::group(['prefix' => 'user'], function () {
    Route::get('/', 'UsersController@index')->name('user.list');
    Route::match(['get', 'post'], 'create', 'UsersController@create')->name('user.create');
    Route::match(['get', 'put'], 'update/{id}', 'UsersController@update')->name('user.update');
    Route::match(['get', 'put'], 'doLogout', 'UsersController@doLogout')->name('user.doLogout');
    Route::delete('delete/{id}', 'UsersController@delete')->name('user.delete');


    Route::match(['get', 'put'], 'editUserPublicInfoUpdate/{id}', 'UsersController@editUserPublicInfo')->name('user.editUserPublicInfoUpdate');
    Route::match(['get', 'put'], 'editUserSecurityInfoUpdate/{id}', 'UsersController@editUserSecurityInfo')->name('user.editUserSecurityInfoUpdate');
});


// department routes
Route::group(['prefix' => 'department'], function () {
    Route::get('/', 'DepartmentsController@index')->name('department.list');
    Route::match(['get', 'post'], 'create', 'DepartmentsController@create')->name('department.create');
    Route::match(['get', 'put'], 'update/{id}', 'DepartmentsController@update')->name('department.update');
    Route::delete('delete/{id}', 'DepartmentsController@delete')->name('department.delete');
});
// card routes
Route::group(['prefix' => 'card'], function () {
    Route::get('/', 'CardsController@index')->name('card.list');
    Route::match(['get', 'post'], 'create', 'CardsController@create')->name('card.create');
    Route::match(['get', 'post'], 'studentCardCreate', 'CardsController@studentCardCreate')->name('card.studentCardCreate');
    Route::match(['get', 'post'], 'studentCardList', 'CardsController@studentCardList')->name('card.studentCardList');
    Route::match(['get', 'post'], 'studentCardUpdate{id}', 'CardsController@studentCardUpdate')->name('card.studentCardUpdate');
    Route::delete('studentCardDelete/{id}', 'CardsController@studentCardDelete')->name('card.studentCardDelete');
    Route::match(['get', 'put'], 'update/{id}', 'cardsController@update')->name('card.update');
    Route::delete('delete/{id}', 'CardsController@delete')->name('card.delete');

    Route::get('getCardNumber/{id}','CardsController@getCardNumber')->name('card.getCardNumber');
});

// subject routes
Route::group(['prefix' => 'subject'], function () {
    Route::get('/', 'SubjectsController@index')->name('subject.list');
    Route::match(['get', 'post'], 'create', 'SubjectsController@create')->name('subject.create');
    Route::match(['get', 'put'], 'update/{id}', 'SubjectsController@update')->name('subject.update');
    Route::delete('delete/{id}', 'SubjectsController@delete')->name('subject.delete');
});
// room routes
Route::group(['prefix' => 'room'], function () {
    Route::get('/', 'RoomsController@index')->name('room.list');
    Route::match(['get', 'post'], 'create', 'RoomsController@create')->name('room.create');
    Route::match(['get', 'put'], 'update/{id}', 'RoomsController@update')->name('room.update');
    Route::delete('delete/{id}', 'RoomsController@delete')->name('room.delete');
});
// employee routes
Route::group(['prefix' => 'employee'], function () {
    Route::get('/', 'EmployeeController@index')->name('employee.list');
    Route::match(['get', 'post'], 'create', 'EmployeeController@create')->name('employee.create');
    Route::match(['get', 'put'], 'update/{id}', 'EmployeeController@update')->name('employee.update');
    Route::delete('delete/{id}', 'EmployeeController@delete')->name('employee.delete');

});
Route::group(['prefix' => 'employeereport'], function () {
    Route::get('/', 'EmployeeReportsController@index')->name('employeereport.list');
    Route::match(['get', 'post'], 'create', 'EmployeeReportsController@create')->name('employeereport.create');
    Route::match(['get', 'put'], 'update/{id}', 'EmployeeReportsController@update')->name('employeereport.update');
    Route::match(['get', 'put'], 'payment/{id}', 'EmployeeReportsController@payment')->name('employeereport.payment');
    Route::delete('delete/{id}', 'EmployeeReportsController@delete')->name('employeereport.delete');

    Route::get('getSalary/{id}', 'EmployeeReportsController@getSalary')->name('employeereport.getSalary');
    Route::get('getHourlySalary/{id}', 'EmployeeReportsController@getHourlySalary')->name('employeereport.getHourlySalary');
    Route::get('showPayedSalary', 'EmployeeReportsController@showPayedSalary')->name('employeereport.showPayedSalary');
    //percentage  routes
    Route::get('percentageBorrowList', 'EmployeeReportsController@percentageBorrowList')->name('employeereport.percentageBorrowList');
    Route::get('showPayedPercentageSalary', 'EmployeeReportsController@showPayedPercentageSalary')->name('employeereport.showPayedPercentageSalary');
    Route::get('teachersPercentage/{id}', 'EmployeeReportsController@teachersPercentage')->name('employeereport.teachersPercentage');

    //
    Route::get('getEmployee/{id}', 'EmployeeReportsController@getEmployee')->name('employeereport.getEmployee');


    Route::match(['get', 'post'], 'percentageSalaryCreate', 'EmployeeReportsController@percentageSalaryCreate')->name('employeereport.percentageSalaryCreate');
    Route::match(['get', 'put'], 'percentageSalaryUpdate/{id}', 'EmployeeReportsController@percentageSalaryUpdate')->name('employeereport.percentageSalaryUpdate');
    Route::delete( 'percentageSalaryDelete/{id}', 'EmployeeReportsController@percentageSalaryDelete')->name('employeereport.percentageSalaryDelete');

    Route::post('PayBorrow','EmployeeReportsController@PayBorrow')->name('employeereport.PayBorrow');

    Route::match(['get', 'post'], 'hourlySalaryCreate', 'EmployeeReportsController@hourlySalaryCreate')->name('employeereport.hourlySalaryCreate');
});
// employee reports routes

// reason_pay routes
Route::group(['prefix' => 'reason_pay'], function () {
    Route::get('/', 'Reason_paysController@index')->name('reason_pay.list');
    Route::match(['get', 'post'], 'create', 'Reason_paysController@create')->name('reason_pay.create');
    Route::match(['get', 'put'], 'update/{id}', 'Reason_paysController@update')->name('reason_pay.update');
    Route::delete('delete/{id}', 'Reason_paysController@delete')->name('reason_pay.delete');
});
// expense routes
Route::group(['prefix' => 'expense'], function () {
    Route::get('/', 'ExpensesController@index')->name('expense.list');
    Route::get('/report', 'ExpensesController@report')->name('expense.report');
    Route::get('/get_report', 'ExpensesController@get_report')->name('expense.get_report');
    Route::get('/report_data', 'ExpensesController@report_data')->name('expense.report_data');
    Route::match(['get', 'post'], 'create', 'ExpensesController@create')->name('expense.create');
    Route::match(['get', 'put'], 'update/{id}', 'ExpensesController@update')->name('expense.update');
    Route::delete('delete/{id}', 'ExpensesController@delete')->name('expense.delete');
});


//    library routes
Route::group(['prefix' => 'library'], function () {
    Route::get('/', 'LibraryController@index')->name('library.list');
    Route::match(['get', 'post'], 'create', 'LibraryController@create')->name('library.create');
    Route::match(['get', 'post'], 'update/{id}', 'LibraryController@update')->name('library.update');

});


// Books routes
Route::group(['prefix' => 'book'], function () {
    Route::get('/', 'BooksController@index')->name('book.list');
    Route::match(['get', 'post'], 'create', 'BooksController@create')->name('book.create');
    Route::match(['get', 'post'], 'update/{id}', 'BooksController@update')->name('book.update');
    Route::delete('delete/{id}', 'BooksController@delete')->name('book.delete');
});


// Course routes

Route::group(['prefix' => 'course'], function () {
    Route::get('/', 'CoursesController@index')->name('course.list');
    Route::get('certificateClass', 'CoursesController@certificateClass')->name('course.certificateClass');
    Route::get('getCertificateClass', 'CoursesController@getCertificateClass');
    Route::match(["get", "post"], '/filter/{id}', 'CoursesController@filterClass')->name('course.filter');
    Route::get('/change_status', 'CoursesController@change_status')->name('course.change_status');
    Route::match(["get", "post"], '/student/{id}', 'CoursesController@student')->name('course.student');
    Route::match(['get', 'post'], 'create', 'CoursesController@create')->name('course.create');
    Route::match(['get', 'put'], 'update/{id}', 'CoursesController@update')->name('course.update');
    Route::delete('delete/{id}', 'CoursesController@delete')->name('course.delete');


});
// Student routes
Route::group(['prefix' => 'student'], function () {
    Route::get('/', 'StudentsController@index')->name('student.list');
    Route::match(['get', 'post'], 'create', 'StudentsController@create')->name('student.create');
    Route::match(['get', 'post'], 'update/{id}', 'StudentsController@update')->name('student.update');
    Route::match(["get", "post"], '/student/{id}', 'StudentsController@student')->name('course.student');
    Route::delete('delete/{id}', 'StudentsController@delete')->name('student.delete');
    Route::match(['get', 'post'], 'showDetail/{id}', 'StudentsController@showDetail')->name('student.showDetail');

    //list of students who have certificate of no routes
    Route::match(["get", "post"], '/studentWithCertificate/{id}', 'StudentsController@studentWithCertificate')->name('student.studentWithCertificate');
    Route::match(["get", "post"], '/studentWithNoCertificate/{id}', 'StudentsController@studentWithNoCertificate')->name('student.studentWithNoCertificate');

});
// give score routes
Route::group(['prefix' => 'giveScore'], function () {
    Route::get('/', 'GiveScoresController@index')->name('giveScore.list');
    Route::get('fetch_data', 'GiveScoresController@fetch_data');
    Route::match(['get', 'post'], 'create', 'GiveScoresController@create')->name('giveScore.create');
    Route::match(['get', 'post'], 'update/{id}', 'GiveScoresController@update')->name('giveScore.update');
    Route::delete('delete/{id}', 'GiveScoresController@delete')->name('giveScore.delete');

});
// give certificate routes
Route::group(['prefix' => 'giveCertificate'], function () {
    Route::get('/', 'GiveCertificatesController@index')->name('giveCertificate.list');
    Route::match(['get', 'post'], 'create', 'GiveCertificatesController@create')->name('giveCertificate.create');
    Route::match(['get', 'post'], 'update/{id}', 'GiveCertificatesController@update')->name('giveCertificate.update');
    Route::delete('delete/{id}', 'GiveCertificatesController@delete')->name('giveCertificate.delete');

});
// Employee routes
Route::group(['prefix' => 'employee'], function () {
    Route::get('/', 'EmployeesController@index')->name('employee.list');
    Route::match(['get', 'post'], 'create', 'EmployeesController@create')->name('employee.create');
    Route::match(['get', 'post'], 'update/{id}', 'EmployeesController@update')->name('employee.update');
    Route::delete('delete/{id}', 'EmployeesController@delete')->name('employee.delete');
    Route::match(['get', 'post'], 'showDetail/{id}', 'EmployeesController@showDetail')->name('employee.showDetail');
    Route::match(['get', 'post'], 'show_agreement_paper/{id}', 'EmployeesController@show_agreement_paper')->name('employee.show_agreement_paper');
});
//employee position routes
Route::group(['prefix'=>'position'],function(){


    Route::get('/','EmployeePositionsController@index')->name('position.list');

    Route::match(['get','post'],'create','EmployeePositionsController@create')->name('position.create');
    Route::match(['get','put'],'update/{id}','EmployeePositionsController@update')->name('position.update');
    Route::delete('delete/{id}','EmployeePositionsController@delete')->name('position.delete');


});
//management
Route::group(['prefix' => 'management'], function () {

    //Class Management
    Route::get('/class', 'ManagementsController@indexClass')->name('classmanage');

    Route::get('/classList', 'ManagementsController@classList')->name('management.classList');
    Route::match(['get', 'post'], 'classUpdate{id}', 'ManagementsController@classUpdate')->name('management.classUpdate');
    Route::delete('classDelete/{id}', 'ManagementsController@classDelete')->name('management.classDelete');

    Route::match(["get", "post"], "/class/create", 'ManagementsController@classCreate')->name('classmanage.create');
    Route::get("/class/search/{id}", 'ManagementsController@classSearch')->name('classmanage.search');
    Route::get("/class/feesChoice/{id}", 'ManagementsController@feesChoice')->name('classmanage.feesChoice');


    //Book Management
    Route::get('/book', 'ManagementsController@indexBook')->name('bookManage');
    Route::match(["get", "post"], "bookCreate", 'ManagementsController@bookCreate')->name('bookCreate.create');
    Route::get("/book/search/{id}", 'ManagementsController@bookSearch')->name('bookManage.search');
    Route::get("/book/bookPaymentChoice/{id}", 'ManagementsController@bookPaymentChoice')->name('classmanage.bookPaymentChoice');


    Route::match(["get", "post"], '/barrowclass', 'ManagementsController@barrowclass')->name('barrowclass');

    Route::post('/barrowclass/pay', 'ManagementsController@payclass')->name('barrowclass.pay');
    Route::match(['get', "post"], '/barrowbook', 'ManagementsController@barrowbook')->name('barrowbook');

    Route::get('/report_student', 'ManagementsController@report')->name('report_student');

    Route::get('/bookAddManagementList', 'ManagementsController@bookAddManagementList')->name('management.bookAddManagementList');
    Route::match(['get', 'post'], 'barrowBookUpdate{id}', 'ManagementsController@barrowBookUpdate')->name('management.barrowBookUpdate');
    Route::delete('barrowBookDelete/{id}', 'ManagementsController@barrowBookDelete')->name('management.barrowBookDelete');
    Route::get('/report_data', 'ManagementsController@report_data')->name('report_data');

});

// change languages routes
Route::group(['prefix'=> 'changeLanguage'],function (){
    Route::get('changeLang/{language}','HomeController@changeLanguage')->name('changeLanguage.lang');
});
Route::get("/b", ['as' => "prfile", "uses" => "BooksController@index"]);




