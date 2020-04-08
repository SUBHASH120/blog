<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
// Route::get('students', 'ApiController@getAllStudent');
// Route::post('students', 'ApiController@createStudent');
// Route::get('students/{id}', 'ApiController@getStudent');
// Route::put('students/{id}', 'ApiController@updateStudent');
// Route::delete('students/{id}', 'ApiController@deleteStudent');

Route::post('login','UserController@login');
Route::post('register','UserController@register');
Route::get('listing','UserController@listing');
Route::put('update/{id}','UserController@update');
Route::delete('delete/{id}','UserController@delete');
Route::get('listingbyid/{id}','UserController@listingbyid');



// customer
Route::post('customeradd','CustomerController@customeradd');
Route::get('customerlist','CustomerController@customerlist');
Route::get('customerbyid/{id}','CustomerController@customerbyid');
Route::put('customerupdate/{id}','CustomerController@customerupdate');
Route::delete('customerdelete/{id}','CustomerController@customerdelete');


//employee 

Route::post('employeeadd','EmployeeController@employeeadd');
Route::get('employeelist','EmployeeController@employeelist');
Route::get('employeebyid/{id}','EmployeeController@employeebyid');
Route::put('employeeupdate/{id}','EmployeeController@employeeupdate');
Route::delete('employeedelete/{id}','EmployeeController@employeedelete');

//category 

Route::post('categoryadd','CategoryController@categoryadd');
Route::get('categorylist','CategoryController@categorylist');
Route::get('categorybyid/{id}','CategoryController@categorybyid');
Route::put('categoryupdate/{id}','CategoryController@categoryupdate');
Route::delete('categorydelete/{id}','CategoryController@categorydelete');

// shipper 

Route::post('shipperadd','ShipperController@shipperadd');
Route::get('shipperlist','ShipperController@shipperlist');
Route::get('shipperbyid/{id}','ShipperController@shipperbyid');
Route::put('shipperupdate/{id}','ShipperController@shipperupdate');
Route::delete('shipperdelete/{id}','ShipperController@shipperdelete');

//supplier 

Route::post('supplieradd','SupplierController@supplieradd');
Route::get('supplierlist','SupplierController@supplierlist');
Route::get('supplierbyid/{id}','SupplierController@supplierbyid');
Route::put('supplierupdate/{id}','SupplierController@supplierupdate');
Route::delete('supplierdelete/{id}','SupplierController@supplierdelete');

//product 

Route::post('productadd','ProductController@productadd');
Route::get('productlist','ProductController@productlist');
Route::get('productbyid/{id}','ProductController@productbyid');
Route::put('productupdate/{id}','ProductController@productupdate');
Route::delete('productdelete/{id}','ProductController@productdelete');

//orderdetail 

Route::post('orderdetailadd','OrderdetailController@orderdetailadd');
Route::get('orderdetaillist','OrderdetailController@orderdetaillist');
Route::get('orderdetailbyid/{id}','OrderdetailController@orderdetailbyid');
Route::put('orderdetailupdate/{id}','OrderdetailController@orderdetailupdate');
Route::delete('orderdetaildelete/{id}','OrderdetailController@orderdetaildelete');

//order 

Route::post('orderadd','OrderController@orderadd');
Route::get('orderlist','OrderController@orderlist');
Route::get('orderbyid/{id}','OrderController@orderbyid');
Route::put('orderupdate/{id}','OrderController@orderupdate');
Route::delete('orderdelete/{id}','OrderController@orderdelete');