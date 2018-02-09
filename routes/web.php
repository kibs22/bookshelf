<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


//ADMIN

Route::get('/admin','Admincontroller@index');

Route::get('/admin', 'AdminController@showLogin');
Route::post('/adminLogin', 'AdminController@loginAdmin');
Route::get('/dashboard', 'AdminController@showDashbaord');
Route::get('/manageAdmin', 'AdminController@showManageAdmin');
Route::post('/addAdmin', 'AdminController@insertAdmin');
Route::get('/logout', 'AdminController@logout');
Route::get('/adminList', 'AdminController@showAdminList');
Route::get('/profile', 'AdminController@showProfile');
Route::post('/update', 'AdminController@updateProfile');
Route::get('/userList', 'AdminController@showUserList');

Route::get('/ajax', 'AdminController@AJAX');
Route::get('/category', 'AdminController@showCategory');
Route::post('/updateCat', 'AdminController@updateCategory');
Route::post('/createCategory', 'AdminController@createCategory');
Route::post('/deleteCategory', 'AdminController@destroyCategory');
Route::post('/changePassword', 'AdminController@passwordChange');

Route::get('/reportAdmin', 'AdminController@reportAdmin');
Route::post('/addreportAdmin', 'AdminController@addreportAdmin');
Route::get('/viewreportAdmin', 'AdminController@viewreportAdmin');
Route::post('/deletereportAdmin', 'AdminController@destroyreportAdmin');
Route::get('/userReports', 'AdminController@userReport');
Route::post('/blockUser', 'AdminController@userBlock');
Route::post('/unblockUser', 'AdminController@userUnblock');


//ADMIN

Route::get('/', function () {
    return view('welcome');
});


//end

Route::group(['prefix'=> 'api'], function(){
	

	//route nan dili kilangan logged in ang user
	Route::get('/getUsers','UserController@index');
	Route::get('/deletePost/{id}', 'PostedBooksController@destroy');
	Route::post('/Login','LoginController@authenticate');
	Route::get('/getallpost','GetAllBooksController');	
	Route::get('/viewSpecificDetails','PostedBooksController@show');
	Route::resource('register','UserController');
	
	Route::get('/getCategory', 'GetCategoryController');
	Route::post('/search','SearchBookController@get_search');
	Route::post('/trial', 'TrialController@postBook');
	Route::get('/getBook', 'GetBookController');
	
	Route::get('/getRelatedByGoogle','GetRelatedBooksController@google');
	Route::get('/related','GetRelatedBooksController@getRelated');
	
	//sort routes
	Route::post('/sortLow', 'FilterController@filterItemsLow');
	Route::post('/sortHigh', 'FilterController@filterItemsHigh');
	
	
	//category

	// route if user logged in
	Route::group(['middleware' => 'jwt.auth'], function() {

			Route::resource('userUpdate', 'UserController');
		
			Route::resource('/view','PostedBooksController');
			Route::get('/reports', 'TrialController@getreports');
			Route::post('/addUserReport', 'TrialController@addreport');

			//profile

			Route::get('/viewUserItems','UserItemsController');
			
			//post
			Route::resource('post','PostedBooksController');
			Route::put('updatePost/{id}', 'PostedBooksController@update');
			Route::post('/search','SearchBookController@get_search');
			//post and for messaging
			Route::get('/getPostsForFilter',  'PostedBooksController@getTitleAndId');
			
			
			//update for mobile cause walay put ang angular-jwt
			Route::post('MupdatePost/{id}', 'PostedBooksController@Mobileupdate');
			Route::get('/users','LoginController@getUsers');
		
			//JWT AUTH 
			Route::get('auth/user','UserController@show');
			Route::get('auth/refresh', 'RefreshTokenController');
		
			//messaging routes
		
			Route::post('/sendMessage','MessageController@send');
			Route::get('/retrieveMessages','MessageController@retrieveConversation');
			Route::get('/retrieveMessagesDuringChat','MessageController@retrieveChatMessages');
			Route::post('/sell','TransactionController@sell');
			Route::get('/inbox','MessageController@getInboxCount');
			Route::get('/notifaction','MessageController@messageNofication');
			
			//transaction routes
			Route::get('/getTransaction','TransactionController@myTransaction');
			Route::get('/pending','TransactionController@myBought');
			Route::post('/setToComplete','TransactionController@setComplete');
			Route::post('/setToCancel','TransactionController@setCancel');
			
		
			//review
		
			
			Route::post('/makeReview', 'ReviewController@makeReview');
			Route::get('/myReviews', 'ReviewController@myReviews');

			//related
			
			//suggestions
			Route::get('/getSuggestions','SuggestionsController@getSuggestion');

			//charts

			Route::get('/getChartData', 'ChartController');
		});

	
	
});