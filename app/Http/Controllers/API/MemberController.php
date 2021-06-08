<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Member;
use Illuminate\Http\Request;
use Image;
use File;
use DB;
//use Storage;
//use Illuminate\Support\Facades\Storage;
use Guizoxxv\LaravelMultiSizeImage\MultiSizeImage;

class MemberController extends Controller
{
    public $multiSizeImage;
   
    public function __construct()
    {
        $this->multiSizeImage = new MultiSizeImage();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

         $login = auth('api')->user();
         //return $login->id;

        $membr_profile = Member::where('user_id',$login->id)->get();

        if(!empty($membr_profile[0])){
            return $membr_profile[0];
        }
        return;
        //return Member::get();
    }

    public function getAllMembers(Request $request)
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
            isset($searchColumnFilters['fullName'])? $qname = trim($searchColumnFilters['fullName']): $qname = null;
            // isset($searchColumnFilters['email'])? $qemail = trim($searchColumnFilters['email']): $qemail = null;
            // isset($searchColumnFilters['mobile'])? $mobile = trim($searchColumnFilters['mobile']): $mobile = null;
            isset($searchColumnFilters['emailAndMobile'])? $e_m = trim($searchColumnFilters['emailAndMobile']): $e_m = null;
            
            
            $sort = [];
            if (!empty($sortFilters['field']) && (!empty($sortFilters['type']))) {
                if($sortFilters['field'] ==='published'){ $sortFilters['field'] = 'created_at'; }
                
                if($sortFilters['field'] == 'fullName'){ $sortFilters['field']= 'fname'; }
                $sort[$sortFilters['field']] = $sortFilters['type'];
            }
        }
        

        return Member::with("parent")
                ->ofIDSearch($s_id)
                ->ofFullNameSearch($qname)
                ->ofemailOrMobileSearch($e_m) 
                // ->ofMobileSearch($mobile)
                // ->ofEmailSearch($qemail)
                ->ofSort($sort)
                ->paginate($perPage)
                ->toArray();
        
        
        //return Member::all()->toArray();
        // $member = Member::get();
        // dd($member);
        // return ['status'=>'success',
        //         'message'=>'Member infomation updated successfully'];
    }

    
    public function getSearchedMembers(Request $request)
    {
         $q_search = $request->queryParams; 
        
        if(!empty($q_search)){
            $search_result = Member::with("parent")
                ->ofIDSearch($q_search)
                ->ofFullNameSearch($q_search)
                ->ofMobileSearch($q_search)
                ->ofEmailSearch($q_search)
                ->where('relation','s')
                ->orderBy('fname','asc')
                ->get()                
                ->toArray();
        }
       
        
        if(!empty($search_result)){
            return ['status'=>'success',
            'message'=>'Found Members based on your query '.$q_search,
            'data'=> $search_result];
        }else{
            return ['status'=>'error',
            'message'=>'No member found on your query '.$q_search];
        }
        
        
    }

    public function getParentMembers($id)
    {
        
        //return Member::all()->toArray();
        //$member = Member::get();
        $data  = array();
        $member = Member::where('id',$id)->get();
        //echo $member->parent_id; exit;
        $memberMother = Member::where('parent_id',$member[0]->parent_id)->where('relation','w')->get();

        // $data['fathersname'] ='Ganesh Singh Bhandari';
        // $data['mothersname'] = $memberMother[0]->fname.' '.$memberMother[0]->mname.' '.$memberMother[0]->lname;
        // $data['grandfathersname'] ='Udara Bhandari';
        // $data['grandmothersname'] ='Nakhari Devi Bhandari';
        


        //return $data;

        return response()->json($data);

        // $memberFather = Member::where('id',$memberMother)->get();
        // dd($member);
        // return ['status'=>'success',
        //         'message'=>'Member infomation updated successfully id=>'.$id];
    }

    /**
     * Get Parent Tree of Member by ID
     *  Not used funciton 
     */
    function parentTree(array $elements, $parentId = 0) {
        $branch = array();  
        
        foreach ($elements as $element) {
            if ($element['parent_id'] == $parentId) {
                $children = $this->parentTree($elements, $element['id']);
                
                if ($children) {
                    $element['children'] = $children;
                }                
                $branch[] = $element;
                
            }
            unset($element);
        }
        
        return $branch;
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $login_user = auth('api')->user();
         
        $messages = [
            'fname.required' => 'The First name is required.',
            'email.required' => 'We need to know your e-mail address!',
            'size' => 'The :attribute must be exactly :size.',
            'between' => 'The :attribute value :input is not between :min - :max.'
        ];

        $this->validate($request,[
            'fname'=>'required',
            'email'=>'nullable|email|unique:members',
            'mobile'=>'nullable|numeric|digits_between:10,15|',
        ],$messages);
        
        
        $member = new Member();
        $photo_name = '';
        if(!empty($request->photo)){            
            $obj_photo = $request->photo;
            $ext = explode('/', explode(':',substr($obj_photo,0,strpos($obj_photo,';')))[1])[1];
            $uniq = time();
            $photo_name  = $uniq.'.'.$ext;                


            $image_path = public_path('uploads/profile/'.$photo_name);
            Image::make($obj_photo)->save($image_path);
            $this->multiSizeImage->processImage($image_path);
            
            $member->photo = $photo_name;
        }

        $member->fname = $request['fname'];
        $member->mname = $request['mname'];
        $member->lname = $request['lname'];
        $member->email = $request['email'];
        $member->mobile = $request['mobile'];
        $member->phone = $request['phone'];
        $member->mobileLogin = $request['mobileLogin'];       
        $member->dob = $request['dob'];
        $member->dob_time = $request['dob_time'];
        $member->gender = $request['gender'];
        $member->maritial_status = $request['maritial_status'];
        $member->cur_address = $request['cur_address'];
        $member->per_address = $request['per_address'];
        $member->about = $request['about'];

        $member->user_id = $login_user->id;
       
        /**.
         *  success = right icon 
         *  error = cross icon - For error message 
         *  warning = show the ! on image
         *  info   = i info icon
         *  question =  ? icon
         * 
         */
        $result = $member->save();
        if($result){
            return ['status'=>'success',
                    'message'=>'Member infomation updated successfully',
                    'member_id'=>$member->id
                ];
        }
        else{
            return ['status'=>'error',
                    'message'=>'Error on updateting user infomation'];
        }  
        
    }


  
    /**
     * Display the specified resource.
     *
     * @param  \App\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function show(Member $member)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $messages = [
            'fname.required' => 'The First name is required.',
            'email.required' => 'We need to know your e-mail address!',
            'mobile.numeric' => 'Please Valid mobile number only!',
            'mobile.digits_between' => 'Please Valid mobile number only 10 digits!',            
            'size' => 'The :attribute must be exactly :size.',
            'between' => 'The :attribute value :input is not between :min - :max.'
        ];

        $this->validate($request,[
            'fname'=>'required',
            'email'=>'nullable|email|unique:members,email,'.$id.',id',
            'mobile'=>'nullable|numeric|digits_between:10,15',
        ],$messages);

        $member = Member::find($id);
        
        $previous_photo = $member->photo;
        
        if(!empty($request->photo) && $request->photo !=$previous_photo){ 
            $obj_photo = $request->photo;
            $ext = explode('/', explode(':',substr($obj_photo,0,strpos($obj_photo,';')))[1])[1];
          
            $uniq = time();
            $photo_name  = $uniq.'.'.$ext;       
            $image_path = public_path('uploads/profile/'.$photo_name);
            Image::make($obj_photo)->save($image_path);            
            $this->multiSizeImage->processImage($image_path);  
            
            $member->photo = $photo_name;
        }      

        $member->fname = $request['fname'];
        $member->mname = $request['mname'];
        $member->lname = $request['lname'];
        $member->email = $request['email'];
        $member->mobile = $request['mobile'];
        $member->phone = $request['phone'];
        $member->mobileLogin = $request['mobileLogin'];
        
        $member->dob = $request['dob'];
        $member->dob_time = $request['dob_time'];
        $member->gender = $request['gender'];
        $member->maritial_status = $request['maritial_status'];
        $member->cur_address = $request['cur_address'];
        $member->per_address = $request['per_address'];
        $member->about = $request['about'];       

        $result = $member->save();

        if($result){
            return ['status'=>'success',
                    'message'=>'Member infomation updated successfully'];
        }
        else{
            return ['status'=>'error',
                    'message'=>'Error on updateting user infomation'];
        }  
    }

  

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $member = Member::find($id);       
        
        // print_r($user); die();
        if(!empty($member)){
            $member  = $member->delete();
            return ['status'=>'success',
                    'message'=>'Member infomation deleted successfully'];
        }else{
            return ['status'=>'warning',
            'message'=>'Sorry! Member infomation not found'];
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addMember(Request $request)
    {
        $messages = [
            'fname.required' => 'The First name is required.',
            'email.required' => 'We need to know your e-mail address!',
            'size' => 'The :attribute must be exactly :size.',
            'between' => 'The :attribute value :input is not between :min - :max.'
        ];

        $this->validate($request,[
            'fname'=>'required',
            'email'=>'nullable|email|unique:members',
        ],$messages);
      
        $member = new Member();

      
        if(!empty($request->photo)){
            $obj_photo = $request->photo;
            $ext = explode('/', explode(':',substr($obj_photo,0,strpos($obj_photo,';')))[1])[1];
            
            $folder_name ='2'; // $id;
            $uniq = time();
            $photo_name  = $uniq.'.'.$ext;

            $user_path = public_path('uploads/profile/'.$folder_name.'/');
            /**
             *  Create Foler if not exist for member
             *  
             */
        
            if(!File::isDirectory($user_path)){
                File::makeDirectory($user_path, 0777, true, true);        
            }

        
            Image::make($obj_photo)->save($user_path.$photo_name);
            Image::make($obj_photo)->save($user_path.$uniq.'-thumb.'.$ext);
            Image::make($obj_photo)->save($user_path.$uniq.'-medium.'.$ext);
            Image::make($obj_photo)->save($user_path.$uniq.'-slider.'.$ext);          
            Image::make($obj_photo)->save($user_path.$uniq.'-large.'.$ext);

            /**
             *  Resize image with Specified Size in Constraints
             *  
             */
            $thumbnailpath = $user_path.$uniq.'-thumb.'.$ext;
            $img = Image::make($thumbnailpath)->resize(150, 150, function($constraint) {
                $constraint->aspectRatio();
            });
            $img->save($thumbnailpath);

            $medium = $user_path.$uniq.'-medium.'.$ext;
            $img = Image::make($medium)->resize(300, 300, function($constraint) {
                $constraint->aspectRatio();
            });
            $img->save($medium);

            $slider_url = $user_path.$uniq.'-slider.'.$ext;
          
            $imgs = Image::make($slider_url);
            $imgs->fit(1900, 360);           

            $large = $user_path.$uniq.'-large.'.$ext;
            $img = Image::make($large)->resize(1024, 1024, function($constraint) {
                $constraint->aspectRatio();
            });
            $img->save($large);

            $member->photo = $photo_name;
        }


        $member->parent_id = $request['parent_id'];
        $member->relation = $request['relation'];
        
        if($member->relation =='w'){
            $member->maritial_status = '1';
            $member->birth_order = '0';
            $member->gender = 'f';
        }else{
            $member->maritial_status = $request['maritial_status'];
            $member->birth_order = $request['birth_order'];
            $member->gender = $request['gender'];
        }
                
        $member->fname = $request['fname'];
        $member->mname = $request['mname'];
        $member->lname = $request['lname'];
        $member->email = $request['email'];
        $member->mobile = $request['mobile'];
       
        $member->dob = $request['dob'];
        $member->dob_time = $request['dob_time'];        
        
        $member->cur_address = $request['cur_address'];
        $member->per_address = $request['per_address'];
        $member->about = $request['about'];

      
        $result = $member->save();
        if($result){
            return ['status'=>'success',
                    'message'=>'Family Member infomation updated successfully',
                    'member_id'=>$member->id
                ];
        }
        else{
            return ['status'=>'error',
                    'message'=>'Error on updateting user infomation'];
        }  
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addParentChildMember(Request $request)
    {
        $messages = [            
            'fname.required' => 'The First name is required.',
            'parent_id.required' => 'Search Parent or Child and add before submit form.',
            'relation.required' => 'Relation of member is required.',
            'email.required' => 'We need to know your e-mail address!',
            'size' => 'The :attribute must be exactly :size.',
            'between' => 'The :attribute value :input is not between :min - :max.'
        ];

        $this->validate($request,[
            'fname'=>'required',
            'parent_id'=>'required',
            'relation'=>'required',
            'email'=>'nullable|email|unique:members',
        ],$messages);
      
        $member = new Member();

      
        if(!empty($request->photo)){
            $obj_photo = $request->photo;
            $ext = explode('/', explode(':',substr($obj_photo,0,strpos($obj_photo,';')))[1])[1];
            
            //$folder_name ='2'; // $id;
            $uniq = time();
            $photo_name  = $uniq.'.'.$ext;

            $user_path = public_path('uploads/profile/');
            /**
             *  Create Foler if not exist for member
             *  
             */
        
            if(!File::isDirectory($user_path)){
                File::makeDirectory($user_path, 0777, true, true);        
            }

        
            Image::make($obj_photo)->save($user_path.$photo_name);
            Image::make($obj_photo)->save($user_path.$uniq.'-thumb.'.$ext);
            Image::make($obj_photo)->save($user_path.$uniq.'-medium.'.$ext);
            Image::make($obj_photo)->save($user_path.$uniq.'-slider.'.$ext);          
            Image::make($obj_photo)->save($user_path.$uniq.'-large.'.$ext);

            /**
             *  Resize image with Specified Size in Constraints
             *  
             */
            $thumbnailpath = $user_path.$uniq.'-thumb.'.$ext;
            $img = Image::make($thumbnailpath)->resize(150, 150, function($constraint) {
                $constraint->aspectRatio();
            });
            $img->save($thumbnailpath);

            $medium = $user_path.$uniq.'-medium.'.$ext;
            $img = Image::make($medium)->resize(300, 300, function($constraint) {
                $constraint->aspectRatio();
            });
            $img->save($medium);

            $slider_url = $user_path.$uniq.'-slider.'.$ext;
          
            $imgs = Image::make($slider_url);
            $imgs->fit(1900, 360);           

            $large = $user_path.$uniq.'-large.'.$ext;
            $img = Image::make($large)->resize(1024, 1024, function($constraint) {
                $constraint->aspectRatio();
            });
            $img->save($large);

            $member->photo = $photo_name;
        }


       
        $member->relation = $relation_copied = $request['relation'];
        $member->parent_id =  $parent_id_copied = $request['parent_id'];

        if($member->relation =='f'){
            $member->parent_id ='0';
            $member->gender = $request['gender'];
            $member->relation = 's';
            // Update Previous Childs parent to this parent_id when after saving data to database 
        }
        if($member->relation =='w'){
            $member->maritial_status = '1';
            $member->birth_order = '0';
            $member->gender = 'f';
        }else{
            $member->maritial_status = $request['maritial_status'];
            $member->birth_order = $request['birth_order'];
            $member->gender = $request['gender'];
        }
                
        $member->fname = $request['fname'];
        $member->mname = $request['mname'];
        $member->lname = $request['lname'];
        $member->email = $request['email'];
        $member->mobile = $request['mobile'];
       
        $member->dob = $request['dob'];
        $member->dob_time = $request['dob_time'];        
        
        $member->cur_address = $request['cur_address'];
        $member->per_address = $request['per_address'];
        $member->about = $request['about'];

      
        $result = $member->save();

        // If Saved relation entry is father the change the son/Childs relation parent_id  to this id 
        if($relation_copied =='f'){
            $member_parent = Member::find($parent_id_copied);
            $member_parent->parent_id = $member->id; 
            $result = $member_parent->save();
        }
        
        if($result){
            return ['status'=>'success',
                    'message'=>'Family Member infomation updated successfully',
                    'member_id'=>$member->id
                ];
        }
        else{
            return ['status'=>'error',
                    'message'=>'Error on updateting user infomation'];
        }  
        
    }


       /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateParentChildMember(Request $request,$id)
    {
        $messages = [            
            'fname.required' => 'The First name is required.',
            'parent_id.required' => 'Search Parent or Child and add before submit form.',
            'relation.required' => 'Relation of member is required.',
            'email.required' => 'We need to know your e-mail address!',
            'size' => 'The :attribute must be exactly :size.',
            'between' => 'The :attribute value :input is not between :min - :max.'
        ];

        $this->validate($request,[
            'fname'=>'required',
            'parent_id'=>'required',
            'relation'=>'required',
            'email'=>'nullable|email|unique:members',
        ],$messages);
        
        $member = Member::find($id);
        
        //$member = new Member();

        $previous_photo = $member->photo;
        // if($previous_photo)
        // {
        //     $old_photo = explode('/',$previous_photo);
        //     $previous_photo = end($old_photo); 
        // }
        // if(!empty($request->photo) && $request->photo !=$previous_photo){ 
        //     $obj_photo = $request->photo;

        if(!empty($request->photo) && $request->photo !=$previous_photo){
            $obj_photo = $request->photo;
            $ext = explode('/', explode(':',substr($obj_photo,0,strpos($obj_photo,';')))[1])[1];
            
            //$folder_name ='2'; // $id;
            $uniq = time();
            $photo_name  = $uniq.'.'.$ext;

            $user_path = public_path('uploads/profile/');
            /**
             *  Create Foler if not exist for member
             *  
             */
        
            if(!File::isDirectory($user_path)){
                File::makeDirectory($user_path, 0777, true, true);        
            }

        
            Image::make($obj_photo)->save($user_path.$photo_name);
            Image::make($obj_photo)->save($user_path.$uniq.'-thumb.'.$ext);
            Image::make($obj_photo)->save($user_path.$uniq.'-medium.'.$ext);
            Image::make($obj_photo)->save($user_path.$uniq.'-slider.'.$ext);          
            Image::make($obj_photo)->save($user_path.$uniq.'-large.'.$ext);

            /**
             *  Resize image with Specified Size in Constraints
             *  
             */
            $thumbnailpath = $user_path.$uniq.'-thumb.'.$ext;
            $img = Image::make($thumbnailpath)->resize(150, 150, function($constraint) {
                $constraint->aspectRatio();
            });
            $img->save($thumbnailpath);

            $medium = $user_path.$uniq.'-medium.'.$ext;
            $img = Image::make($medium)->resize(300, 300, function($constraint) {
                $constraint->aspectRatio();
            });
            $img->save($medium);

            $slider_url = $user_path.$uniq.'-slider.'.$ext;
          
            $imgs = Image::make($slider_url);
            $imgs->fit(1900, 360);           

            $large = $user_path.$uniq.'-large.'.$ext;
            $img = Image::make($large)->resize(1024, 1024, function($constraint) {
                $constraint->aspectRatio();
            });
            $img->save($large);

            $member->photo = $photo_name;
        }


        $member->parent_id = $request['parent_id'];
        $member->relation = $request['relation'];
        
        if($member->relation =='w'){
            $member->maritial_status = '1';
            $member->birth_order = '0';
            $member->gender = 'f';
        }else{
            $member->maritial_status = $request['maritial_status'];
            $member->birth_order = $request['birth_order'];
            $member->gender = $request['gender'];
        }
                
        $member->fname = $request['fname'];
        $member->mname = $request['mname'];
        $member->lname = $request['lname'];
        $member->email = $request['email'];
        $member->mobile = $request['mobile'];
       
        $member->dob = $request['dob'];
        $member->dob_time = $request['dob_time'];        
        
        $member->cur_address = $request['cur_address'];
        $member->per_address = $request['per_address'];
        $member->about = $request['about'];

      
        $result = $member->save();
        if($result){
            return ['status'=>'success',
                    'message'=>'Family Member infomation updated successfully',
                    'member_id'=>$member->id
                ];
        }
        else{
            return ['status'=>'error',
                    'message'=>'Error on updateting user infomation'];
        }  
        
    }



    
    public function updateMember(Request $request,$id)
    {
        $messages = [
            'fname.required' => 'The First name is required.',
            'email.required' => 'We need to know your e-mail address!',
            'size' => 'The :attribute must be exactly :size.',
            'between' => 'The :attribute value :input is not between :min - :max.'
        ];

        $this->validate($request,[
            'fname'=>'required',
            'email'=>'nullable|email|unique:members,email,'.$id.',id',
            'mobile'=>'nullable|numeric|digits_between:10,15'           
        ],$messages);

        $member = Member::find($id);
        $previous_photo = $member->photo;
      
        if(!empty($request->photo) && $request->photo !=$previous_photo){            
            $obj_photo = $request->photo;
            $ext = explode('/', explode(':',substr($obj_photo,0,strpos($obj_photo,';')))[1])[1];
          
            $uniq = time();
            $photo_name  = $uniq.'.'.$ext;       
            $image_path = public_path('uploads/profile/'.$photo_name);
            
            Image::make($obj_photo)->save($image_path);            
            $this->multiSizeImage->processImage($image_path);  
            
            $member->photo = $photo_name;
        }      

        $member->fname = $request['fname'];
        $member->mname = $request['mname'];
        $member->lname = $request['lname'];
        $member->email = $request['email'];
        $member->mobile = $request['mobile'];
        $member->phone = $request['phone'];
        $member->mobileLogin = $request['mobileLogin'];
        
        $member->dob = $request['dob'];
        $member->dob_time = $request['dob_time'];
        
        $member->relation = $request['relation'];
        if($member->relation =='w'){
            $member->maritial_status = '1';
            $member->birth_order = '0';
            $member->gender = 'f';
        }else{
            $member->maritial_status = $request['maritial_status'];
            $member->birth_order = $request['birth_order'];
            $member->gender = $request['gender'];
        }

        $member->cur_address = $request['cur_address'];
        $member->per_address = $request['per_address'];
        $member->about = $request['about'];

        $result = $member->save();

        if($result){
            return ['status'=>'success',
                    'message'=>'Member infomation updated successfully'];
        }
        else{
            return ['status'=>'error',
                    'message'=>'Error on updateting user infomation'];
        }  
    }   
    
    public function getFamilyMembers()
    {   
        $family_members = '';
        $login = auth('api')->user();

        $get_member_id = Member::select('id')->where('user_id',$login->id)->get();
        
        if(!empty($get_member_id[0]['id'])){
            $family_members = Member::where('parent_id',$get_member_id[0]['id'])->orderBy('birth_order')->get();
        }
       
        return $family_members;
    }

    
    public function getFamilyTree($type=1,$status='Published',$parent_id=0)
    {

        //$members = Member::selectRaw("id,parent_id,CONCAT(fname,' ', mname) as name,'uploads/profile/2/'+photo as photo_url ,relation")->get();
        if($type == '3'){
            $members = Member::selectRaw("id,parent_id,fname as name,CONCAT('uploads/profile/',photo) as image_url")->where('status','Published')->orderBy('birth_order')->get();
        }else if($type =='2'){
            $members = Member::selectRaw("id,parent_id,fname as name,CONCAT('uploads/profile/',photo) as image_url")->where('status','Published')->where('relation','!=','w')->orderBy('birth_order')->get();
        }else{
            $members = Member::selectRaw("id,parent_id,fname as name,CONCAT('uploads/profile/',photo) as image_url")->where('status','Published')->where('relation','=','s')->orderBy('birth_order')->get();
        }

        $result = $this->buildTree($members->toArray(),$parent_id);
        
        return response()->json($result[0]);
    }   

    function buildTree(array $elements, $parentId = 0) {
        $branch = array();  
        
        foreach ($elements as $element) {
            if ($element['parent_id'] == $parentId) {
                $children = $this->buildTree($elements, $element['id']);
                
                if ($children) {
                    $element['children'] = $children;
                }
                
                $branch[] = $element;
                
            }
            unset($element);
        }
        
        return $branch;
    }
    
    


}
