<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Member;
use Illuminate\Http\Request;
use Image;
use File;
use DB;
//use Storage;
use Illuminate\Support\Facades\Storage;
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
        //  echo"<pre>";
        //  print_r($membr_profile);
        //  exit;
        if(!empty($membr_profile[0])){
            return $membr_profile[0];
        }
        return;

        


        //return Member::get();
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
        
        if(!empty($request->photo)){
            
            $obj_photo = $request->photo;
            $ext = explode('/', explode(':',substr($obj_photo,0,strpos($obj_photo,';')))[1])[1];
            
            $uniq = time();
            $photo_name  = $uniq.'.'.$ext;           
            //$multiSizeImage = new MultiSizeImage();


            //Storage::put('uploads/profile/'.$photo_name, fopen($request->photo, 'r+'));
            $image_path = public_path('uploads/profile/'.$photo_name);
            Image::make($obj_photo)->save($image_path);
            
            // Storage::path('folder/file.png');
            //$filePath = public_path('uploads/profile/'.$photo_name); // $request->photo; //public_path('uploads/profile/'); //Storage::path('folder/file.png');
            //$outputPath = public_path('uploads/profile/');
            $this->multiSizeImage->processImage($image_path);
            
        }

        /*
        if(!empty($request->photo)){
            $obj_photo = $request->photo;
            $ext = explode('/', explode(':',substr($obj_photo,0,strpos($obj_photo,';')))[1])[1];
            
            $folder_name ='2'; 
            $uniq = time();
            $photo_name  = $uniq.'.'.$ext;

            $user_path = public_path('uploads/profile/'.$folder_name.'/');
          
            if(!File::isDirectory($user_path)){
                File::makeDirectory($user_path, 0777, true, true);        
            }
          
            Image::make($obj_photo)->save($user_path.$photo_name);
            Image::make($obj_photo)->save($user_path.$uniq.'-thumb.'.$ext);
            Image::make($obj_photo)->save($user_path.$uniq.'-medium.'.$ext);
            Image::make($obj_photo)->save($user_path.$uniq.'-slider.'.$ext);          
            Image::make($obj_photo)->save($user_path.$uniq.'-large.'.$ext);
            
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
        */


        $member->fname = $request['fname'];
        $member->mname = $request['mname'];
        $member->lname = $request['lname'];
        $member->email = $request['email'];
        $member->mobile = $request['mobile'];
        $member->phone = $request['phone'];
        $member->mobileLogin = $request['mobileLogin'];
        $member->photo = $photo_name;
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


    public function BK__store(Request $request)
    {
        $login_user = auth('api')->user();
        // echo $login_user->id;
        // exit;
        
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
        
        /*
        $arry_member = Array(['fname'=>$request['fname'],
        'mname'=>$request['mname'],
        'lname'=>$request['lname'],
        'email'=>$request['email'],
        'mobile'=>$request['mobile'],
        'phone'=>$request['phone'],
        //'mobileLogin'=>$request['mobileLogin'],
        'photo'=>$request['photo'],
        'dob'=>$request['dob'],
        'dob_time'=>$request['dob_time'],
        // 'gender'=>$request['gender'],
        // 'maritial_status'=>$request['maritial_status'],
        'cur_address'=>$request['cur_address'],
        'per_address'=>$request['per_address']
        ]);
        */
        $member = new Member();

        // if($request['photo']){
        //     $photo_name = 'prakash.jpg';
        // }

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
            // if(!File::exists($user_path)) { 
            //     //path does not exist 
            // }

            if(!File::isDirectory($user_path)){

                File::makeDirectory($user_path, 0777, true, true);
        
            }

           /* $resizes =  [{
                'size'=>'thumb',
                'width'=>150,
                'height'=>150,
                'aspect'=>true
            },
            {
                'size'=>'medium',
                'width'=>300,
                'height'=>200,
                'aspect'=>true
            },
            {
                'size'=>'large',
                'width'=>1024,
                'height'=>600,
                'aspect'=>true
            }];
            */
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
            //$slider = Image::make($slider_url)->fit(1900, 400);
            // $slider->fit(1900,400);           
            //$img->save($slider);
           
            // $slider = Image::make($slider_url)->fit(1900, 400, function ($constraint) {
            //     $constraint->upsize();
            // });
            

            // $slider = Image::make($slider_url);
            // $slider->crop(1900, 400, 25, 25);
            //$img->save($slider);


         
            $imgs = Image::make($slider_url);
            $imgs->fit(1900, 360);



            

            $large = $user_path.$uniq.'-large.'.$ext;
            $img = Image::make($large)->resize(1024, 1024, function($constraint) {
                $constraint->aspectRatio();
            });
            $img->save($large);

            
            // Storage::put('uploads/profile/'.$folder_name.'/'.$photo_name, fopen($request->photo, 'r+'));
            // Storage::put('uploads/profile/'.$folder_name.'/thumb-'.$photo_name, fopen($request->photo, 'r+'));
            // $server_path = public_path('uploads/profile/'.$folder_name.'/thumb-'.$photo_name);


            // $img = Image::make($server_path)->resize(400, 150, function($constraint) {
            //     $constraint->aspectRatio();
            // });
            // $img->save($obj_photo);
            $member->photo = $photo_name;

        }


        //$data = $request->all();
        $member->fname = $request['fname'];
        $member->mname = $request['mname'];
        $member->lname = $request['lname'];
        $member->email = $request['email'];
        $member->mobile = $request['mobile'];
        $member->phone = $request['phone'];
        $member->mobileLogin = $request['mobileLogin'];
        $member->photo = $photo_name;
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
        //print_r($result);
        //echo"---".$result['id'];
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
            'size' => 'The :attribute must be exactly :size.',
            'between' => 'The :attribute value :input is not between :min - :max.'
        ];

        $this->validate($request,[
            'fname'=>'required',
            'email' => 'required|email|unique:members,email,'.$id.',id',
            'mobile'=>'required',
        ],$messages);

        $member = Member::find($id);
        
        $previous_photo = $member->photo;
        

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
    public function destroy(Member $member)
    {
        //
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


    public function addMemberBackUP(Request $request)
    {
        //$login_user = auth('api')->user();
        // echo $login_user->id;
        // exit;
        
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

        // if($request['photo']){
        //     $photo_name = 'prakash.jpg';
        // }

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
            // if(!File::exists($user_path)) { 
            //     //path does not exist 
            // }

            if(!File::isDirectory($user_path)){
                File::makeDirectory($user_path, 0777, true, true);        
            }

           /* $resizes =  [{
                'size'=>'thumb',
                'width'=>150,
                'height'=>150,
                'aspect'=>true
            },
            {
                'size'=>'medium',
                'width'=>300,
                'height'=>200,
                'aspect'=>true
            },
            {
                'size'=>'large',
                'width'=>1024,
                'height'=>600,
                'aspect'=>true
            }];
            */
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
            //$slider = Image::make($slider_url)->fit(1900, 400);
            // $slider->fit(1900,400);           
            //$img->save($slider);
           
            // $slider = Image::make($slider_url)->fit(1900, 400, function ($constraint) {
            //     $constraint->upsize();
            // });
            

            // $slider = Image::make($slider_url);
            // $slider->crop(1900, 400, 25, 25);
            //$img->save($slider);


         
            $imgs = Image::make($slider_url);
            $imgs->fit(1900, 360);



            

            $large = $user_path.$uniq.'-large.'.$ext;
            $img = Image::make($large)->resize(1024, 1024, function($constraint) {
                $constraint->aspectRatio();
            });
            $img->save($large);

            
            // Storage::put('uploads/profile/'.$folder_name.'/'.$photo_name, fopen($request->photo, 'r+'));
            // Storage::put('uploads/profile/'.$folder_name.'/thumb-'.$photo_name, fopen($request->photo, 'r+'));
            // $server_path = public_path('uploads/profile/'.$folder_name.'/thumb-'.$photo_name);


            // $img = Image::make($server_path)->resize(400, 150, function($constraint) {
            //     $constraint->aspectRatio();
            // });
            // $img->save($obj_photo);
            $member->photo = $photo_name;
        }


        //$data = $request->all();
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

        // $member->user_id = $login_user->id;
       
        /**.
         *  success = right icon 
         *  error = cross icon - For error message 
         *  warning = show the ! on image
         *  info   = i info icon
         *  question =  ? icon
         * 
         */
        $result = $member->save();
        //print_r($result);
        //echo"---".$result['id'];
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
            // 'email' => 'sometimes|email|unique:members,email,'.$id.',id',
        ],$messages);

        $member = Member::find($id);
        // print_r($request->photo);
        $previous_photo = $member->photo;
        //exit;
        // exit;
        /*
        if(!empty($request->photo) && $request->photo !=$previous_photo){
            $obj_photo = $request->photo;
            $ext = explode('/', explode(':',substr($obj_photo,0,strpos($obj_photo,';')))[1])[1];
            
            $folder_name ='2'; // $id;
            $uniq = time();
            $photo_name  = $uniq.'.'.$ext;

            $user_path = public_path('uploads/profile/'.$folder_name.'/');
           
          

            if(!File::isDirectory($user_path)){
                File::makeDirectory($user_path, 0777, true, true);        
            }

            Image::make($obj_photo)->save($user_path.$photo_name);
            Image::make($obj_photo)->save($user_path.$uniq.'-thumb.'.$ext);
            Image::make($obj_photo)->save($user_path.$uniq.'-medium.'.$ext);
            Image::make($obj_photo)->save($user_path.$uniq.'-slider.'.$ext);          
            Image::make($obj_photo)->save($user_path.$uniq.'-large.'.$ext);

          
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
        */

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
        // $member->gender = $request['gender'];
        // $member->maritial_status = $request['maritial_status'];
        // $member->birth_order = $request['birth_order'];
        
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

       

        //$password = $request['password'];
        // if(!empty($member->password)){
        //     $member->password = Hash::make($password);
        // }

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
        //$family_members = [];

        $login = auth('api')->user();

        $get_member_id = Member::select('id')->where('user_id',$login->id)->get();
        //return $get_member_id[0]['id'];

        if(!empty($get_member_id[0]['id'])){
            $family_members = Member::where('parent_id',$get_member_id[0]['id'])->orderBy('birth_order')->get();
        }
        // echo"<pre";
        // print_r($family_members);
        // exit;
       

        return $family_members;

        // if(!empty($membr_profile[0])){
        //     return $membr_profile[0];
        // }
        // return;

        


        //return Member::get();
    }

    
    public function getFamilyTree($type=1,$status='Published',$parent_id=0)
    {

        //$members = Member::selectRaw("id,parent_id,CONCAT(fname,' ', mname) as name,'uploads/profile/2/'+photo as photo_url ,relation")->get();
        if($type == '3'){
            $members = Member::selectRaw("id,parent_id,fname as name,CONCAT('uploads/profile/2/',photo) as image_url")->where('status','Published')->orderBy('birth_order')->get();
        }else if($type =='2'){
            $members = Member::selectRaw("id,parent_id,fname as name,CONCAT('uploads/profile/2/',photo) as image_url")->where('status','Published')->where('relation','!=','w')->orderBy('birth_order')->get();
        }else{
            $members = Member::selectRaw("id,parent_id,fname as name,CONCAT('uploads/profile/2/',photo) as image_url")->where('status','Published')->where('relation','=','s')->orderBy('birth_order')->get();
        }

        $result = $this->buildTree($members->toArray(),$parent_id);
        //return $result;
        return response()->json($result[0]);
        //json_encode
        //return json_encode ($result);
        // echo"<pre>";
        // print_r($result);
        // exit;

    
    }   

    // function buildTree_11(array &$elements, $parentId = 0) {

    //     $branch = array();
    
    //     foreach ($elements as &$element) {
    
    //         if ($element['parent_id'] == $parentId) {
    //             $children = buildTree($elements, $element['id']);
    //             if ($children) {
    //                 $element['children'] = $children;
    //             }
    //             $branch[$element['id']] = $element;
    //             unset($element);
    //         }
    //     }
    //     return $branch;
    // }

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
    
   // $tree = buildTree($rows);
    


}
