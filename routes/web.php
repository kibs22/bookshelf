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

Route::get('/admin', 'Admincontroller@showLogin');
Route::post('/adminLogin', 'Admincontroller@loginAdmin');
Route::get('/dashboard', 'Admincontroller@showDashbaord');
Route::get('/manageAdmin', 'Admincontroller@showManageAdmin');
Route::post('/addAdmin', 'Admincontroller@insertAdmin');
Route::get('/logout', 'Admincontroller@logout');
Route::get('/adminList', 'Admincontroller@showAdminList');
Route::get('/profile', 'Admincontroller@showProfile');
Route::post('/update', 'Admincontroller@updateProfile');
Route::get('/userList', 'Admincontroller@showUserList');

Route::get('/ajax', 'Admincontroller@AJAX');
Route::get('/category', 'Admincontroller@showCategory');
Route::post('/updateCat', 'Admincontroller@updateCategory');
Route::post('/createCategory', 'Admincontroller@createCategory');
Route::post('/deleteCategory', 'Admincontroller@destroyCategory');
Route::post('/changePassword', 'Admincontroller@passwordChange');

Route::get('/reportAdmin', 'Admincontroller@reportAdmin');
Route::post('/addreportAdmin', 'Admincontroller@addreportAdmin');
Route::get('/viewreportAdmin', 'Admincontroller@viewreportAdmin');
Route::post('/deletereportAdmin', 'Admincontroller@destroyreportAdmin');
Route::get('/userReports', 'Admincontroller@userReport');
Route::post('/blockUser', 'Admincontroller@userBlock');
Route::post('/unblockUser', 'Admincontroller@userUnblock');


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