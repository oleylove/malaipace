<?php

//Route สำหรับคนทั่วไปที่ยังไม่ได้เป็นสมาชิก
Route::get('/', 'WelcomeController@index');
Route::get('type-grid', 'WelcomeController@typeGrid')->name('type.grid');//โชว์ประเภทห้อง
Route::get('type-all', 'WelcomeController@typeAll')->name('type.all');//โชว์ประเภทห้องทั้งหมด
Route::get('room-grid/{id}', 'WelcomeController@roomGrid');//โชว์ห้อง-ประเภททั้งหมด
Route::get('room-single/{id}', 'WelcomeController@roomSigle');//โชว์ห้อง
Auth::routes();
Route::get('error/no-page', 'HomeController@errorNoPage');//404 ERROR
Route::get('home', 'HomeController@index')->name('home');
Route::get('apartment', 'HomeController@apartment');
Route::patch('change-password', 'ChangePasswordController@changepassword')->name('change.password');//เปลี่ยนรหัสผ่าน

Route::middleware(['auth', 'role:guest'])->group(function () {
    Route::post('user-booking', 'BookingController@store')->name('user.booking');//สมาชิกจองห้องพัก
    Route::get('status-booking', 'GuestController@statusBooking');//สมาชิกตรวจสอบสถานะการจอง
    Route::get('user-profile', 'GuestController@index');//สมาชิกดูโปรไฟล์
    Route::patch('change-photo', 'GuestController@changePhoto');//สมาชิกเปลี่ยนรูปโปรไฟล์
    Route::get('user-invoice', 'GuestController@invoice');//สมาชิกตรวจสอบใบแจ้งหนี้
    Route::get('user-maintenance', 'GuestController@maintenance');//สมาชิกดูรายการแจ้งซ่อมบำรุง
    Route::post('user-notify-maintenance', 'GuestController@notify_maintenance');//สมาชิกแจ้งซ่อมบำรุง
    Route::delete('user-maintenance/{id}', 'GuestController@maintenance_cancelled');//สมาชิกยกเลิกแจ้งซ่อมบำรุง
    Route::post('user-confirm-invoice', 'GuestController@payInvoice');// สมาชิกแจ้งชำระเงินค่าเช่า
    Route::get('user-notices', 'GuestController@notices'); // ดูปประกาศ
    Route::patch('user-checkout', 'GuestController@checkout'); // สมาชิกแจ้งย้ายออก

    Route::get('user-print/receipt/invoice/{id}', 'PrintController@invoiceReceiptPrint');  // สมาชิกพิมพ์ใบแจ้งหนี้

});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('dashboard', 'HomeController@dashboard')->name('dashboard');

    Route::get('user', 'UserController@index');
    Route::get('user/create', 'UserController@create');
    Route::post('user', 'UserController@store');
    Route::get('user/{id}', 'UserController@show');
    Route::get('user/{id}/edit', 'UserController@edit');
    Route::patch('user/{id}', 'UserController@update');

    Route::get('room', 'RoomController@index');
    Route::get('room/create', 'RoomController@create');
    Route::post('room', 'RoomController@store');
    Route::get('room/{id}', 'RoomController@show');
    Route::get('room/{id}/edit', 'RoomController@edit');
    Route::patch('room/{id}', 'RoomController@update');

    // Route::get('type', 'TypeController@index');
    Route::get('type/create', 'TypeController@create');
    Route::post('type', 'TypeController@store');
    Route::get('type/{id}', 'TypeController@show');
    Route::get('type/{id}/edit', 'TypeController@edit');
    Route::patch('type/{id}', 'TypeController@update');

    Route::get('booking', 'BookingController@index');
    Route::get('booking/{id}', 'BookingController@show');
    Route::patch('re-booking/{id}', 'BookingController@edit');
    Route::patch('booking/{id}', 'BookingController@update');
    Route::get('booking-confirm', 'BookingController@ajaxupdate');
    // Route::patch('re-booking-re-room/{id}', 'BookingController@create');
    Route::delete('booking/{id}', 'BookingController@destroy');

    Route::get('lease', 'LeaseController@index');
    Route::get('lease/create/{id}', 'LeaseController@create');
    Route::post('lease', 'LeaseController@store');
    Route::get('lease/{id}', 'LeaseController@show');
    Route::get('lease/{id}/edit', 'LeaseController@edit');
    Route::patch('lease/{id}', 'LeaseController@update');
    Route::delete('lease/{id}', 'LeaseController@destroy');
    Route::patch('lease/checkout/{id}', 'LeaseController@confirm_checkout');
    Route::patch('lease/checkout/{id}/cencel', 'LeaseController@cancelCheckout');
    Route::patch('lease/checkout/{id}/done', 'LeaseController@checkout');

    Route::get('invoice', 'InvoiceController@index');
    Route::get('invoice/create', 'InvoiceController@create');
    Route::post('invoice', 'InvoiceController@store');
    Route::get('invoice/{id}', 'InvoiceController@show');
    Route::get('invoice/{id}/edit', 'InvoiceController@edit');
    Route::patch('invoice/slip/admin-update/{id}', 'InvoiceController@update_slip');
    Route::patch('invoice/confirm/payment/{id}', 'InvoiceController@confirm_payment');
    Route::patch('invoice/{id}', 'InvoiceController@update');

    Route::get('webconfig', 'WebconfigController@index');
    // Route::get('webconfig/{id}/edit', 'WebconfigController@edit');
    Route::patch('webconfig/{id}', 'WebconfigController@update');

    Route::get('maintenance', 'MaintenanceController@index');
    Route::get('maintenance/create', 'MaintenanceController@create');
    Route::post('maintenance', 'MaintenanceController@store');
    Route::get('maintenance/{id}', 'MaintenanceController@show');
    Route::get('maintenance/{id}/edit', 'MaintenanceController@edit');
    Route::patch('maintenance/{id}', 'MaintenanceController@update');
    Route::patch('maintenance-confirm', 'MaintenanceController@confirm')->name('mtn.confirm');
    Route::delete('maintenance/{id}', 'MaintenanceController@destroy');

    // Route::get('income', 'IncomeController@index');
    // Route::get('income/create', 'IncomeController@create');
    // Route::get('income/{id}', 'IncomeController@show');
    // Route::get('income/{id}/edit', 'IncomeController@edit');
    // Route::patch('income/{id}', 'IncomeController@update');
    // Route::delete('income/{id}', 'IncomeController@destroy');

    Route::get('notice', 'NoticeController@index');
    Route::get('notice/create', 'NoticeController@create');
    Route::post('notice', 'NoticeController@store');
    Route::get('notice/{id}', 'NoticeController@show');
    Route::get('notice/{id}/edit', 'NoticeController@edit');
    Route::patch('notice/{id}', 'NoticeController@update');
    Route::delete('notice/{id}', 'NoticeController@destroy');

    Route::post('income/store', 'IncomeController@store');
    Route::patch('income/update', 'IncomeController@update');
    Route::get('report/income', 'ReportController@incomeReport');
    Route::get('report/lease', 'ReportController@leaseReport');
    Route::get('report/maintenance', 'ReportController@maintenanceReport');
    Route::get('report/invoice', 'ReportController@invoiceReport');

    Route::get('admin-print/receipt/lease/{id}', 'PrintController@leaseReceiptPrint');
    Route::get('admin-print/document/lease/{id}', 'PrintController@leaseDocumentPrint');
    Route::get('admin-print/receipt/lease/{id}/checkout', 'PrintController@leaseReceiptCheckoutPrint');
    Route::get('admin-print/receipt/invoice/{id}', 'PrintController@invoiceReceiptPrint');
    Route::get('admin-print/report/income', 'PrintController@incomeReportPrint');
    Route::get('admin-print/report/invoice', 'PrintController@invoiceReportPrint');
    Route::get('admin-print/report/lease', 'PrintController@leaseReportPrint');
    Route::get('admin-print/report/maintenances', 'PrintController@maintenanceReportPrint');


});
