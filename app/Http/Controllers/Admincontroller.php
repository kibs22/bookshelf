<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;
use Auth;
use DB;
use Carbon\Carbon;
use App\Category;
use App\Coffee;
use App\User;
use App\PostedBook;
use App\Report; 
use App\PostedCategory;



class Admincontroller extends Controller
{
    public function showLogin(){
        return view('admin.adminLogin');
    }

    public function loginAdmin(Request $request){

        $this->validate($request, [
            'email' => [
                'required',
                Rule::exists('users')->where(function($q){ 
                    $q->whereIn('role_type', ['ADMIN', 'SUPERADMIN']);
                })
            ],
            'password' => 'required'
        ]);

        // $creds = $request->only(['email', 'password']);
        $creds = ['email' => $request->email, 'password' => $request->password];
        
        if(Auth::attempt($creds)){
            if(Auth::user()->role_type =='SUPERADMIN'){
                
                return redirect('/dashboard');
                // echo(Auth::User()->id);
            }
            return redirect('/dashboard');
        }else{
            // return \Redirect::back()->withErrors(['loginError' => 'Incorrect username or password']);
            return redirect('admin')->with('loginError', 'Incorrect username or password');
        }

    }

    public function showDashbaord(){
        $totalNormal = User::where('role_type', 'NORMAL')->count();
        $totalAdmin = User::where('role_type', 'ADMIN')->count();
        $totalBook = PostedBook::count();
        
        return view('admin.dashboard', ['totalNormal' => $totalNormal, 'totalAdmin' => $totalAdmin, 'totalBook' => $totalBook]);
    } 

    public function showCategory(){
        $category = Category::all();
        //return response()->json($category);
        return view('admin.manageCategory',['data'=> $category ]);
    }

    public function AJAX(){
        $categories = Category::with(['postedCategory.postedBook' => function($q){
                $q->whereAvailability(1);  
        }])->get();

        $item_count = $categories->map(function($c){
            return collect($c->postedCategory)->count();
        });
       
        $category = $categories->map(function($r){
            return $r->name;    
        });

        $areaChartData = User::select('created_at')
        ->where('role_type', 'NORMAL')
        ->get()
        ->groupBy(function($date){
            return Carbon::parse($date->created_at)->format('Y'); 
        })
        ->mapWithKeys(function($item, $year)
        {
            return [$year=>$item->count()];
        });

        return response()->json(['wee' => $category, 'items' => $item_count, 'areaChart' => $areaChartData]);
        //return view('admin.manageCategory',['data'=> $category ]);
    }

    public function getDate(){
        $memDate = Auth::user()->created_at;
        
        return response()->json(['date'=> \Carbon\Carbon::parse($memDate)->format('m-d-Y')]);
    }

    public function insert(Request $c){
        $cate = $c->all();
        Category::create($cate);
        return view('admin.dashboard');
    }

    public function createCategory(Request $request)
    {
        $this->validate($request, [
            'name' => 'required'
            ]);

        $category = $request->all();
        $data = Category::create($category);

        return redirect('/category')->with('status', 'Category has been Added');
    }

    public function showManageAdmin(){

        return view('admin.manageAdmin', ['sample' => true]);
    }

    public function showAdminList(){
        $users = User::where('role_type', 'ADMIN')->get();
       
       
        $users = $users->filter(function($val){
            return $val->id != Auth::User()->id;
        });

        return view('admin.listAdmin', ['data'=>$users]);

    }

    public function showProfile(){
        return view('admin.profileAdmin');
    }

    public function showUserList(){
        $users = User::where('role_type', 'NORMAL')->latest()->get();

        return view('admin.userList', ['data'=>$users]);
    }

    public function userReport(){
        
        // $userReports = User::with('Reports');

        // $unblock = $unblock->filter(function($u) {
        //     return collect($u->Reports)->count() == 3 ? $u : '';
        // });

        $blockable = User::with('Reports')->withReportCount()->get()->where('reports_count', '>=', 3);
        $unblockable =  User::where('blocked_at','!=', null)->get()->where('unblock_eligibility', true);

      
        return view('admin.userReport', ['data' => $blockable, 'unblockable' => $unblockable]);

    }

    public function insertAdmin(Request $request){
        
        $this->validate($request, [
            'firstname' => 'required',
            'MI' => 'required',
            'lastname' => 'required',
            'mobile' => 'required|unique:users',
            'address' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required|confirmed'
        ]);

        // dd($request->all());
    
        $admin = $request->all();
        $admin['password'] = bcrypt($request->password);
        $admin['role_type'] = 'ADMIN';
        $data = User::create($admin);

        return redirect('manageAdmin')->with('status', 'Admin has been added');

    }

    public function updateProfile(Request $request){
        // dd($request->all());
        $this->validate($request, [
            'firstname' => 'required',
            'MI' => 'required',
            'lastname' => 'required',
            'mobile' => 'required',
            'address' => 'required',
            'email' => 'required'

            
        ]);

        $updatedata = array_except($request->all(), ['_token', 'password_confirmation']);
        
        User::where('id', Auth::user()->id)->update($updatedata);

        return redirect('profile')->with('status', 'User Profile has been updated');

    }

    public function passwordChange(Request $request){
        $this->validate($request, [
            'password' => 'required|confirmed',
        ]);

        $updatepassword = array_except($request->all(), ['_token', 'password_confirmation']);
        $updatepassword['password'] = bcrypt($request->password);

        User::where('id', Auth::user()->id)->update($updatepassword);

        return redirect('profile')->with('status', 'User Password has been updated');
    }

    public function destroyCategory(Request $req)
    {
        // dd($req->id);
      $delete = Category::find($req->id);
      $delete->delete();

      return redirect('/category');
    }

    public function logout(){
        Auth::logout();
        return redirect('admin');
    }

    public function updateCategory(Request $request){
    //   echo($request->value);
 
    $validator = Validator::make($request->all(), [
        'value' => 'required',
    ]);

    if($validator->fails()){
        return response()->json(['errors' =>  $validator->errors()]);
    }

    $updatecategory['name'] = $request->value;
    Category::where('id', $request->pk)->update($updatecategory);
    
    return response()->json(['data' => 'success']);
    }

    public function reportAdmin()
    {
        return view('admin.reportAdmin');
    }
    public function addreportAdmin(Request $req)
    {
        $this->validate($req, ['name' => 'required', 'description' => 'required']);
        $data = $req->all();
        Report::create($data);
        return redirect('/reportAdmin')->with('status', 'Report Filed!');

    }
    public function viewreportAdmin()
    {
        $report = Report::all();

        return view('admin.viewreportAdmin', ['data'=>$report]);
    }
    public function destroyreportAdmin(Request $req)
    {
        // dd($req->id);
        $delete = Report::find($req->id);
        $delete->delete();

        return redirect('/viewreportAdmin');
    }
    public function userBlock(Request $request)
    {   
        //return response()->json($request->all());

        $user = User::find($request->user_id);
        
        User::where('id', $user->id)->update(['blocked_at'=>Carbon::now()]); 

        return response()->json(['success' => true]);
        // return redirect('/userReports')->with('status', 'User Has been Block!');
    }

    public function userUnblock(Request $r)
    {
        
        $user = User::find($r->userid);
        
        $user->update(['blocked_at' => NULL]);
        $user->Reports()->update(['cleared_at' => Carbon::now()]);


        return response()->json(['success' => true]);
        // return response()->json($user);

        // $reports = userReports::whereReportedTo($user->id)->get();

        // $res = $reports->each(function($r){

        // })
    }
}
