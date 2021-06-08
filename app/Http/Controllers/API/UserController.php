<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        $obj = $request->queryParams;
        $perPage = '10'; // Default per page if not requested
        $qname = '';
        $qemail = '';
        $mobile = '';
        $s_id  = '';
        $sort = '';
        
        if(!empty($obj)){
            $objQuery =  json_decode($obj);
            $perPage = $objQuery->perPage; 

            $searchColumnFilters = get_object_vars($objQuery->columnFilters);
            $sortFilters = get_object_vars($objQuery->sort);
          
            isset($searchColumnFilters['id'])? $s_id = trim($searchColumnFilters['id']): $s_id = null;
            isset($searchColumnFilters['name'])? $qname = trim($searchColumnFilters['name']): $qname = null;
            isset($searchColumnFilters['email'])? $qemail = trim($searchColumnFilters['email']): $qemail = null;
            isset($searchColumnFilters['mobile'])? $mobile = trim($searchColumnFilters['mobile']): $mobile = null;
             
            $sort = [];
            if (!empty($sortFilters['field']) && (!empty($sortFilters['type']))) {
                if($sortFilters['field'] ==='published'){ $sortFilters['field'] = 'created_at'; }
                $sort[$sortFilters['field']] = $sortFilters['type'];
            }
        }
        return User::ofIDSearch($s_id)
                ->ofNameSearch($qname)
                ->ofMobileSearch($mobile)
                ->ofEmailSearch($qemail)
                ->ofSort($sort)
                ->paginate($perPage)
                ->toArray();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required|max:191',
            'email' =>'required_without:mobile|nullable|email|max:255|unique:users',           
            'mobile' =>'required_without:email|nullable|numeric|digits_between:10,15|unique:users',
            // 'email'=>'required|email|unique:users',
            // 'mobile' => 'sometimes|required|unique:users',
            'password'=>'required|min:8|max:191'
        ]);

        $user = User::create(
            ['name'=>$request['name'],
            'email'=>$request['email'],
            'mobile'=>$request['mobile'],
            'password'=>Hash::make($request['password'])
            ]              
        );

        /**.
         *  success = right icon 
         *  error = cross icon - For error message 
         *  warning = show the ! on image
         *  info   = i info icon
         *  question =  ? icon
         * 
         */
        return ['status'=>'success',
                'message'=>'New user created successfully'];
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  return recent login user
     * @return \Illuminate\Http\Response
     */
    public function recent()
    {
        $login_user = auth('api')->user();
        $prefill = [];
        if(!empty($login_user)){
            // print_r($login_user);
            // exit;
            $n = explode(" ",$login_user['name']);
            if(is_array($n) && count($n)>2){
                $prefill = ['fname' =>$n[0],
                'mname'=>$n[1],
                'lname'=>$n[2],
                'email'=>$login_user['email']];

            }else{
                $prefill = ['fname' =>$n[0],
                    'lname'=>$n[1],
                    'email'=>$login_user['email']];
            }

            return $prefill;
        }
        
        return $prefill;
        // return ['status'=>'success',
        // 'message'=>'User infomation updated successfully'];
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name'=>'required|max:191',
            // 'email' => 'required|email|unique:users,email,'.$id.',id',
            // 'mobile' => 'sometimes|required|unique:users,mobile,'.$id.',id',
            'email' =>'required_without:mobile|nullable|email|max:255|unique:users,email,'.$id.',id',           
            'mobile' =>'required_without:email|nullable|numeric|digits_between:10,15|unique:users,mobile,'.$id.',id',

            'password'=>'sometimes|nullable|between:8,30'
        ]);

        $user = User::find($id);

        $user->name = $request['name'];
        $user->email = $request['email'];
        $password = $request['password'];
        $user->mobile = $request['mobile'];


        if(!empty($user->password)){
            $user->password = Hash::make($password);
        }

        $result = $user->save();

        if($result){
            return ['status'=>'success',
                    'message'=>'User infomation updated successfully'];
        }
        else{
            return ['status'=>'error',
                    'message'=>'Error on updateting user infomation'];
        }  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);       
        
        // print_r($user); die();
        if(!empty($user)){
            $result  = $user->delete();
            return ['status'=>'success',
                    'message'=>'User infomation deleted successfully'];
        }else{
            return ['status'=>'warning',
            'message'=>'Sorry! User infomation not found'];
        }

    }
}
