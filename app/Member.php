<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Member extends Model
{ 
    use SoftDeletes;

    protected $table = 'members';

    protected $fillable = [
        'fname','mname','lname','email','mobile','mobileLogin', 'phone', 'photo', 'dob', 'dob_time', 'gender', 'maritial_status', 'cur_address', 'per_address', 'status', 'disabled'
    ];

    protected $appends=['photoMedium','photoThumb','shotName','fullName','emailAndMobile','published'];
    
    public function hasChild(){
        $s_name = $this->fname.' '.$this->mname;
        return $s_name;        
    }

    public function getPhotoMediumAttribute(){
        $db_photo = isset($this->attributes['photo'])?$this->attributes['photo']:'';
        if(empty($db_photo))
        return;

        $arr_p = explode('.',$db_photo);
        $new = asset('uploads/profile/'.$arr_p[0].'@medium.'.$arr_p[1]);
        return $new;
    }


    
    public function getPhotoThumbAttribute(){
        $db_photo = isset($this->attributes['photo'])? $this->attributes['photo']:'';
        if(empty($db_photo))
        return;

        $arr_p = explode('.',$db_photo);
        //  $image_path = public_path('uploads/profile/'.$photo_name);
        $new = asset('uploads/profile/'.$arr_p[0].'@thumb.'.$arr_p[1]);
        return $new;
    }

    public function getPhotoAttribute(){
        $db_photo = isset($this->attributes['photo'])?$this->attributes['photo']:'';
        if(empty($db_photo))
        return;      
        return asset('uploads/profile/'.$db_photo);
       
    }

    public function getFullNameAttribute(){
        $full_name = $this->fname.' '.$this->mname.' '.$this->lname;
        return $full_name;        
    }

    public function getShotNameAttribute(){
        $s_name = $this->fname.' '.$this->mname;
        return $s_name;        
    }

    public function getEmailAndMobileAttribute(){
        $em = $this->email.'  '.$this->mobile;
        return $em;        
    }
    
    public function getPublishedAttribute(){
        return Carbon::createFromTimeStamp(strtotime($this->created_at) )->diffForHumans();
    }


    public function scopeOfIDSearch($query, $q)
    {
        if ( $q ) {
            $query->orWhere('id','=',$q);
        }
        return $query;
    }

    public function scopeOfNameSearch($query, $q)
    {
        if ( $q ) {
            $query->orWhere('name', 'LIKE', '%' . $q . '%');
        }
        return $query;
    }

    public function scopeOfFullNameSearch($query, $q)
    {
        if ( $q ) {
           $query->
            orWhereRaw("lower(concat(fname,' ',mname)) like '%".strtolower($q)."%'") 
            ->orWhereRaw("lower(concat(fname,' ',mname,' ',lname)) like '%".strtolower($q)."%'") 
            ->orWhereRaw("lower(concat(fname,' ', lname)) like '%".strtolower($q)."%'") 
            ->orWhereRaw("lower(fname) like '%".strtolower($q)."%'") 
            ->orWhereRaw("lower(mname) like '%".strtolower($q)."%'") 
            ->orWhereRaw("lower(lname) like '%".strtolower($q)."%'"); 
            // ->orWhere('fname', 'LIKE', '%' . $q . '%')
            // ->orWhere('mname', 'LIKE', '%' . $q . '%')
            // ->orWhere('lname', 'LIKE', '%' . $q . '%');
            
        }
        return $query;
    }

    public function scopeOfEmailSearch($query, $q)
    {
        if ( $q ) {
            $query->orWhere('email', 'LIKE', '%' . $q . '%');
        }
        return $query;
    }

    public function scopeOfMobileSearch($query, $q)
    {
        if ( $q ) {
            $query->orWhere('mobile', '=',$q);
        }
        return $query;
    }

    public function scopeOfemailOrMobileSearch($query, $q)
    {
        if ( $q ) {
            $query->orWhere('email','LIKE', '%' . $q . '%')->orWhere('mobile', '=',$q);
        }
        return $query;
    }

    
    

    public function scopeOfSort($query, $sort = [])
    {
        if ( ! empty($sort) ) {
            foreach ( $sort as $column => $direction ) {
                $query->orderBy($column, $direction);
            }
        } 
        else {
            $query->orderBy('created_at','desc'); 
        }

        return $query;
    }

   

    public function parent()
    {
        return $this->belongsTo(self::class , 'parent_id');
        //return $this->hasOne('App\Member', 'id', 'parent_id' );
        //return $this->belongsTo('App\Member','parent_id')->where('parent_id',0);
    }
    public function grandParent()
    {
        return $this->parent()->belongsTo('parent_id');
    }


    // public function children()
    // {
    //     return $this->hasMany('App\CourseModule','parent_id')->with('children');
    // }
 
    public function Children()
    { 
        return $this->hasMany(self::class, 'parent_id', 'Id')->with('Children');
    } 

    public function ascendings()
    {
        $ascendings = collect();
        $user = $this;
        while($user->parent) {
            $ascendings->push($user->parent);
            if ($user->parent) {
                $user = $user->parent;
            }
        }
        return $ascendings;
    }



    public function descendings()
    {
        $descendings = collect();
        $children = $this->children;
        while ($children->count()) {
            $child = $children->shift();
            $descendings->push($child);
            $children = $children->merge($child->children);
        }
        return $descendings;
    }


}
