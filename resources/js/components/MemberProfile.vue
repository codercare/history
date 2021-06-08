<template>
   <div class="content-wrapper" style="min-height: 1074px;">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>My Profile</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">My Profile</li>
            </ol>
          </div>
        </div>
      </div>
    </section>
    <section class="content">
      <div class="container-fluid">       
        <div class="row">
          <div class="col-md-3">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">About Me</h3>
              </div>
              <div class="card-body">
                <strong><i class="fas fa-book mr-1"></i> Education</strong>
                <p class="text-muted">
                  B.S. in Computer Science from the University of Tennessee at Knoxville
                </p>
                <hr>
                <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>
                <p class="text-muted">Malibu, California</p>
                <hr>
                <strong><i class="fas fa-pencil-alt mr-1"></i> Skills</strong>
                <p class="text-muted">
                  <span class="tag tag-danger">UI Design</span>
                  <span class="tag tag-success">Coding</span>
                  <span class="tag tag-info">Javascript</span>
                  <span class="tag tag-warning">PHP</span>
                  <span class="tag tag-primary">Node.js</span>
                </p>
                <hr>
                <strong><i class="far fa-file-alt mr-1"></i> Notes</strong>
                <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>
              </div>
            </div>
          </div>
          <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link" href="#activity" data-toggle="tab">Activity</a></li>
                  <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Family Members</a></li>
                  <li class="nav-item"><a class="nav-link active" href="#settings" data-toggle="tab">Settings</a></li>
                </ul>
              </div>
              <div class="card-body">
                <div class="tab-content">
                  <div class="tab-pane" id="activity">
                    Member Posts
                  </div>
                  <div class="tab-pane" id="timeline">
                    <button type="button" class="col-md-4 btn btn-block btn-info" @click="createModel()">
                    <i class="fa fa-user-plus" aria-hidden="true"></i> Add Member</button>
                    <br/>
                     <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th width="5%">#</th>
                  <th width="32%">Name</th>
                  <th width="7%">Photo</th> 
                  <th width="15%">Email and Mobile</th>                   
                  <th width="15%">Entry</th>
                  <th width="18%">Modify</th>
                </tr>
                </thead>
              <tbody>
                <tr  v-for="(member,index) in members" :key="member.id" :class="member.relation === 'w' ? 'wifeBg' : ''" >                 
                  <td width="10px">{{index+1}}</td>
                  <td> {{displayStringLimit((member.fname || " ")+' '+(member.mname || " ")+' '+(member.lname || " "),'18')}} 
                    <span v-if="member.relation === 'w'" class="badge bg-danger">Wife</span>
                    <span v-else-if="member.relation === 'd'" class="badge bg-success">Doughter</span>
                    <span v-else-if="member.relation === 's'" class="badge bg-primary">Son</span></td>
                  <td>                     
                      <div v-if="member.expiry"  class="nomore-ribbon-wrapper">
                        <div class="nomore-ribbon bg-warning">
                          No More
                        </div>
                      </div>
                      <img @click.prevent="viewLarge(member)" v-show="member.photo" :src="`${member.photo}`"  class="member_profile_thumbnail">
                    </td>
                  <td>{{member.email}}<br/> {{member.mobile}}</td>
                  <td> {{member.created_at | humanDate}}</td>
                  <td>
                    <a class="btn btn-info btn-sm" @click.prevent="editModel(member)" href="#"><i class="fas fa-pencil-alt" title="Edit"></i></a>
                    &nbsp; <a class="btn btn-danger btn-sm" @click.prevent="deleteUser(member.id)" href="#">
                        <i class="fas fa-trash" title="Delete"></i></a></td>
                </tr>
              </tbody>
                <tfoot>
                <tr>
                  <th>#</th>
                  <th>Name</th>
                  <th>Photo</th> 
                  <th>Email and Mobile</th>                   
                  <th>Entry</th>
                  <th>Modify</th>
                </tr>
                </tfoot>
              </table>
                  </div>

                  <div class="tab-pane active" id="settings">
                    <form class="form-horizontal" @submit.prevent="edit_mode ?updateProfile():createProfile()" enctype="multipart/form-data">
                        <div id="copy_info" class="alert alert-info alert-dismissible" style="display: none;">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h5><i class="icon fas fa-info"></i> Information Copied from your Account!</h5>
                        Please fill/edit complete form to save your information.
                        </div>
                        <div class="form-group row">                        
                        <label for="inputName" class="col-sm-2 col-md-2 col-form-label">Name</label>
                        <div class="col-sm-4 col-md-4">
                          <input v-model="form.fname" type="text" name="fname" placeholder="First"
                          class="form-control" :class="{ 'is-invalid': form.errors.has('fname') }">
                          <has-error :form="form" field="fname"></has-error>
                        </div>
                        <div class="col-sm-3 col-md-3">
                          <input class="form-control" v-model="form.mname" type="text" name="fname" placeholder="Middle">
                        </div>
                        <div class="col-sm-3 col-md-3">
                          <input class="form-control" v-model="form.lname" type="text" name="lname" placeholder="Last">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="email" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                          <input type="email" v-model="form.email" class="form-control" placeholder="Enter email" :class="{ 'is-invalid': form.errors.has('email') }">
                          <has-error :form="form" field="email"></has-error>
                        </div>
                      </div>
                       <div class="form-group row">
                        <label for="mobile" class="col-sm-2 col-form-label">Mobile</label>
                        <div class="col-md-5 col-sm-5">
                          <input type="text" v-model="form.mobile" class="form-control"  placeholder="Mobile" :class="{ 'is-invalid': form.errors.has('mobile') }">
                          <has-error :form="form" field="mobile"></has-error>
                        </div>
                        <div class="col-md-5 col-sm-5">
                          <div class="checkbox">
                            <label>
                              <div class="custom-control custom-checkbox">
                               <input class="custom-control-input" type="checkbox" id="mobileLogin" v-model="form.mobileLogin" value="1">
                              <label for="mobileLogin" class="custom-control-label"> check if also login from mobile.</label>
                              </div>                              
                            </label>
                          </div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="phone" class="col-sm-2 col-form-label">Phone</label>
                        <div class="col-sm-10">                              
                          <input type="input" v-model="form.phone" class="form-control" name="phone" id="phone" placeholder="phone">
                        </div>
                      </div>                      
                      <div class="form-group row">
                      <label for="photo" class="col-sm-2 col-form-label">Your Photo</label>
                      <div class="col-sm-10">
                      <input type="file" class="form-control" accept="image/*" @change="ecodeImageFileUrl"  name="photo" id="photo" placeholder="Passport Photo">
                      <img id="output_file" @click.prevent="viewLarge(form)" v-show="form.photo"  :src="viewImage()" class="member_preview_image"/>
                      </div>
                      </div>   
                      <div class="form-group row">
                      <label for="dob" class="col-sm-2 col-form-label">Date of Birth</label>
                      <div class="col-sm-5">
                      <input type="input" class="form-control" v-model="form.dob" name="dob" id="dob" placeholder="Date">
                      </div>
                      <div class="col-sm-5">
                      <input type="input" class="form-control" v-model="form.dob_time"   id="dob_time" placeholder="Time">
                      </div>
                      </div> 
                      
                       <div class="form-group row">
                      <label for="gender" class="col-sm-2 col-form-label">Gender</label>
                      <div class="col-sm-4">                      
                         <div class="form-group">
                            <div class="custom-control custom-radio">
                            <input class="custom-control-input"  id="male" type="radio"  value="m" v-model="form.gender" >
                            <label for="male" class="custom-control-label" >Male</label>
                            </div>
                            <div class="custom-control custom-radio">
                            <input class="custom-control-input"  id="female" type="radio" v-model="form.gender"  value="f" >
                            <label for="female" class="custom-control-label">Female</label>
                            </div>                              
                          </div>
                      </div>
                      <label for="maritial_status" class="col-sm-3 col-form-label text-right">Maritial Status</label>
                      <div class="col-sm-3 pull-left">
                          <div class="form-group">
                            <div class="custom-control custom-radio">
                            <input class="custom-control-input"  id="married" type="radio" v-model="form.maritial_status"  value="1" >
                            <label for="married" class="custom-control-label">Married</label>
                            </div>    
                            <div class="custom-control custom-radio">
                            <input class="custom-control-input" id="single" type="radio" v-model="form.maritial_status"   value="0" >
                            <label for="single" class="custom-control-label">Single</label>
                            </div>                                                       
                          </div>                         
                      </div>
                      </div>                      
                      <div class="form-group row">
                      <label for="cur_address" class="col-sm-2 col-form-label">Current Address</label>
                      <div class="col-sm-10">
                      <input type="input" class="form-control" v-model="form.cur_address" name="cur_address" id="cur_address" placeholder="Current Address">
                      </div>
                      </div> 
                      <div class="form-group row">
                      <label for="per_address" class="col-sm-2 col-form-label">Permanent</label>
                      <div class="col-sm-10">
                      <input type="input" class="form-control" v-model="form.per_address" name="per_address" id="per_address" placeholder="Permanent">
                      </div>
                      </div> 
                      <div class="form-group row">
                        <label for="per_address" class="col-sm-2 col-form-label">About info</label>
                        <div class="col-sm-10">                        
                        <textarea  class="form-control" v-model="form.about" placeholder="add your short information"></textarea>
                        </div>
                      </div>    
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">                          
                          <button type="submit" class="btn btn-primary">Submit</button> &nbsp;&nbsp;
                           <button type="reset" class="btn  btn-secondary">Reset</button>
                        </div>                        
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>              
      </div>
    </section>

    <div class="modal fade" id="memberModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">
          <span v-show="!memberEdit_mode">Add Family Member</span>
          <span v-show="memberEdit_mode">Edit Member Detail</span></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div> 
      <form @submit.prevent="memberEdit_mode ?updateMember():createMember()" @keydown="form.onKeydown($event)">
      <div class="modal-body">         
                <div class="">
                  <alert-error :form="form"></alert-error>                  
                   
                        <div id="copy_info" class="alert alert-info alert-dismissible" style="display: none;">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h5><i class="icon fas fa-info"></i> Information Copied from your Account!</h5>
                        Please fill/edit complete form to save your information.
                        </div>
                         
                        <div class="form-group row">
                        <label for="relation" class="col-sm-2 col-form-label">Relation</label>
                        <div class="col-sm-10">
                          <select  class="form-control" @change="changeRelation" v-model="memberForm.relation"> 
                            <option value="w"> Wife</option>
                            <option value="s"> Son</option>
                            <option value="d"> Doughter</option>
                          </select>                         
                        </div>
                        </div>
                        <div class="form-group row">                        
                        <label for="fname" class="col-sm-2 col-md-2 col-form-label">Name</label>
                        <div class="col-sm-4 col-md-4">
                          <input v-model="memberForm.fname" type="text" name="fname" placeholder="First"
                          class="form-control" :class="{ 'is-invalid': memberForm.errors.has('fname') }">
                          <has-error :form="memberForm" field="fname"></has-error>
                        </div>
                        <div class="col-sm-3 col-md-3">
                          <input class="form-control" v-model="memberForm.mname" type="text" name="fname" placeholder="Middle">
                        </div>
                        <div class="col-sm-3 col-md-3">
                          <input class="form-control" v-model="memberForm.lname" type="text" name="lname" placeholder="Last">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="email" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                          <input type="email" v-model="memberForm.email" class="form-control" placeholder="Enter email" :class="{ 'is-invalid': memberForm.errors.has('email') }">
                          <has-error :form="memberForm" field="email"></has-error>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="mobile" class="col-sm-2 col-form-label">Mobile</label>
                        <div class="col-md-10 col-sm-10">
                          <input type="text" v-model="memberForm.mobile" class="form-control"  placeholder="Mobile" :class="{ 'is-invalid': memberForm.errors.has('mobile') }">
                          <has-error :form="form" field="mobile"></has-error>
                        </div>                      
                      </div>     
                      <div class="form-group row">
                        <label for="photo" class="col-sm-2 col-form-label">Photo</label>
                        <div class="col-sm-10">
                        <input type="file" class="form-control" accept="image/*" @change="ecodeMemberPhotoUrl"  name="photo" id="photo" placeholder="Passport Photo">
                        <img  id="output_member_photo" v-show="memberForm.photo"   :src="viewMemberImage()" class="member_preview_image"/>
                      </div>
                      </div> 
                      <div id="ifIsRelation" style='display:none;'>
                      <div class="form-group row">                     
                      <label for="maritial_status" class="col-sm-2 col-form-label text-right">Maritial Status</label>
                      <div class="col-sm-10 pull-left">
                          <div>
                            <div class="custom-control custom-radio " style="float: left; padding-right: 20px;">
                            <input class="custom-control-input"  id="mem_married" type="radio" v-model="memberForm.maritial_status"  value="1" >
                            <label for="mem_married" class="custom-control-label">Married</label>
                            </div>                                                                                      
                          </div>    
                          <div>
                            <div class="custom-control custom-radio" style="float: left; padding-right: 20px;">
                            <input class="custom-control-input" id="mem_single" type="radio" v-model="memberForm.maritial_status"   value="0" >
                            <label for="mem_single" class="custom-control-label">Single</label>
                            </div> 
                          </div>                     
                      </div>
                      </div>
                      <div class="form-group row">
                      <label for="birth_order" class="col-sm-2 col-form-label">Children Order</label>
                      <div class="col-sm-3">
                      <input type="input" class="form-control" v-model="memberForm.birth_order" name="dob" id="dob" placeholder="Birth Order">
                      </div> 
                      <div class="col-sm-7">1,2,3 order first second and third children.</div>                     
                      </div>
                      </div> 
                      <div class="form-group row">
                      <label for="dob" class="col-sm-2 col-form-label">Date of Birth</label>
                      <div class="col-sm-5">
                      <input type="input" class="form-control" v-model="memberForm.dob" name="dob" id="dob" placeholder="Date">
                      </div>
                      <div class="col-sm-5">
                      <input type="input" class="form-control" v-model="memberForm.dob_time"   id="dob_time" placeholder="Time">
                      </div>
                      </div> 
                      <div class="form-group row">
                      <label for="cur_address" class="col-sm-2 col-form-label">Current Address</label>
                      <div class="col-sm-10">
                      <input type="input" class="form-control" v-model="memberForm.cur_address" name="cur_address" id="cur_address" placeholder="Current Address">
                      </div>
                      </div> 
                      <div class="form-group row">
                      <label for="per_address" class="col-sm-2 col-form-label">Permanent</label>
                      <div class="col-sm-10">
                      <input type="input" class="form-control" v-model="memberForm.per_address" name="per_address" id="per_address" placeholder="Permanent">
                      </div>
                      </div>                    
                </div>
      </div>
      <div class="modal-footer">
          <input id="parent_id"  type="hidden"  v-model="memberForm.parent_id">     
         <button type="submit" class="btn btn-primary">Submit</button> &nbsp;&nbsp;
         <button type="reset" class="btn  btn-secondary">Reset</button>
         <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
      </form>
    </div>
    </div>
    </div> 
       
    <div class="modal fade" id="imagePreview" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
          <h5 class="modal-title" id="MemberNameDisp"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
      </div>
      <div class="modal-body">
        <img id="MemberImageDisp" class="largeImageView" src="">
      </div>      
    </div>
    </div>
    </div>
  </div>
</template>

<script>
    export default {
        data(){
          return{
              isWife:true,
              edit_mode:false,
              memberEdit_mode:true,
              members:{},              
              form: new Form({
                id:'',
                parent_id:'',
                user_id:'',
                fname: '',
                mname: '',
                lname: '',
                email:'',
                mobile: '', 
                phone: '',     
                mobileLogin:true,  
                photo: '',   
                photoMedium: '',     
                dob: '',     
                dob_time: '',     
                gender: 'm',     
                maritial_status: '1',     
                cur_address: '',     
                per_address: '',
                about:''  
              }),
              memberForm: new Form({
                id:'',
                relation:'',
                parent_id:'',
                fname: '',
                mname: '',
                lname: '',
                email:'',
                mobile: '',    
                photo: '',     
                dob: '',     
                dob_time: '',     
                gender: 'm', 
                birth_order:'',    
                maritial_status: '0', 
                cur_address: '',     
                per_address: '',
                about:''  
              })
          }          
        },
        methods: {
          // async loadUsers(){
             
          //  try {
          //    this.$Progress.start();  
          //    var data =  await axios.get('api/user').then(({data})=>(this.users = data.data));
          //    this.$Progress.finish();
          //  }
          //  catch (err) {
          //    this.$Progress.fail();
          //    this.form.errors.set(err.response.data.errors);
              
          //  }
           
          // },
         
          // editModel(data){
          //     this.form.reset();
          //     this.form.clear();
          //     this.edit_mode = true;
          //     this.form.fill(data);
          //     $('#memberModal').modal('show');
          // },
          ecodeImageFileUrl(e){           
            let file = e.target.files[0];
            if(file['size'] < 5242880){            
                  let output = document.getElementById('output_file');
                  output.src = '';
                  output.src = URL.createObjectURL(e.target.files[0]);
                  output.onload = function() {
                    URL.revokeObjectURL(output.src); // free memory
                  }                
                  let reader = new FileReader();
                  reader.onload = (file)=>{
                    this.form.photo = reader.result;
                    //console.log("image changed",reader.result);
                  }
                  reader.readAsDataURL(file);
                  
            }else{
                swal.fire({
                      icon: 'info',
                      title: 'Oops... file size is exceed 5 mb',
                      text: 'Please upload smaller size upto 5 MB'
                });
            }
            
          },    
            
          async createProfile() {
             
              try {
                  this.$Progress.start();    
                 
                  const resp = await axios.post('/api/member/',this.form);
                  toast.fire({
                      icon: resp.data.status,
                      title: resp.data.message
                  });     
                  this.edit_mode = true;
                  this.form.id =  resp.data.member_id;    
                  this.memberForm.parent_id =  resp.data.member_id;   
                  jQuery('#copy_info').hide();

                  this.$Progress.finish();
              } catch (err) {
                  this.edit_mode = false;
                  this.form.errors.set(err.response.data.errors);
                  this.$Progress.fail();
              }
          },
          async updateProfile(e){      
              try {
                  // let file =  e.target.files[0];
                  // console.log(file);
                  this.$Progress.start();  

                  const resp = await axios.put('/api/member/'+this.form.id,this.form);
                  toast.fire({
                      icon: resp.data.status,
                      title: resp.data.message
                  });
                 
                 this.$Progress.finish();
              } catch (err) {
                  this.$Progress.fail();
                  this.form.errors.set(err.response.data.errors);
              }
          },          
         deleteUser(id){          
            
              swal.fire({
              title: 'Confirm for delete?',
              text: "You won't be able to revert this!",
              icon: 'error',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Yes, delete it!'
              }).then((result) => {
                if (result.value) {
                    axios.delete('/api/user/'+id).then(response => {
                          toast.fire({
                            icon:response.data.status,
                            title:response.data.message
                          });
                          this.loadUsers();
                    })
                    .catch((response) => {
                        toast.fire({
                        icon:'warning',
                        title:response.message
                      });
                    });                    
                }
              });
          },
          async loadProfile(){
             
           try {
             this.$Progress.start();  
             var data =  await axios.get('api/member').then(({data})=>{
               if(data){
                    this.edit_mode = true;
                    this.form.fill(data);  
                    this.memberForm.parent_id = data.id;
               }else{
                   this.edit_mode = false;
                   var data =  axios.get('api/user/recent').then(({data})=>[
                      this.form.fill(data) 
                   ]);
                   jQuery('#copy_info').show();
               }                                
              
              });          
              
              this.$Progress.finish();
           }
           catch (err) {
             
             this.$Progress.fail();
             this.form.errors.set(err.response.data.errors);
              
           }
           
          },
          async loadFamilyMembers(){
             
           try {
             //this.$Progress.start();  
             var data =  await axios.get('api/member/getFamilyMembers').then(({data})=>(this.members = data));
            //  this.$Progress.finish();
           }
           catch (err) {
            //  this.$Progress.fail();
            //  this.form.errors.set(err.response.data.errors);
              
           }
           
          },
          displayStringLimit(str,length=25){
              if(str.length > length) {
                return str.slice(0,length)+'...';
              }
              return str;
          },
          createModel(){  
            /** Copy parent id from form to prefill parent of family members */
             let copy_parent_id =  this.memberForm.parent_id; //document.getElementById('parent_id'); 

             this.memberForm.reset();
             this.memberForm.clear();
             let fill_parent_id = {'parent_id':copy_parent_id};
             this.memberForm.fill(fill_parent_id);  

             this.memberEdit_mode = false;
             jQuery('#memberModal').modal('show');             
          },
          editModel(data){
              this.memberForm.reset();
              this.memberForm.clear();
              this.memberEdit_mode = true;
              this.memberForm.fill(data);
              this.changeRelation();
              jQuery('#memberModal').modal('show');
          },
          viewLarge(frmObj){
            //console.log(frmObj.photoMedium);
            jQuery('#imagePreview').modal('show');
            let fullname = (frmObj.fname || " ")+' '+(frmObj.mname || " ")+' '+(frmObj.lname || " ");
            jQuery("#MemberNameDisp").html(fullname);
            jQuery("#MemberImageDisp").attr('src',frmObj.photoMedium);
          },
          viewImage(){
            if(this.form.photo === undefined)
            return;
            
            return this.form.photo.length > 150 ?this.form.photo:this.form.photo;
          },
          viewMemberImage(){
            if(this.memberForm.photo === undefined){
              return;
            }
            else{
                //if(this.memberForm.photo)
                return this.memberForm.photo.length > 150 ? this.memberForm.photo :this.memberForm.photo;
            }
          },
          changeRelation(){
              //console.log("Relation Changed---",this.memberForm.relation);
              if(this.memberForm.relation ==='w'){
                jQuery("#ifIsRelation").hide();
              }else{
                jQuery("#ifIsRelation").show();
              }
          },
          ecodeMemberPhotoUrl(e){
           
            let file = e.target.files[0];

            //if(file['size'] < 2111775){            
                  let output = document.getElementById('output_member_photo');
                  output.src = URL.createObjectURL(e.target.files[0]);
                  output.onload = function() {
                    URL.revokeObjectURL(output.src); // free memory
                  }                
                  let reader = new FileReader();
                  reader.onload = (file)=>{
                    //console.log("RESULT",reader.result);
                    this.memberForm.photo = reader.result;
                  }
                  reader.readAsDataURL(file);
            //console.log("file changed",reader.result);
            //}else{
              
            //    swal.fire({
            //           icon: 'info',
            //           title: 'Oops... file size is exceed 2 mb',
            //           text: 'Please upload smaller size upto 2 MB'
            //     });
            // }
            
          }, 
          async createMember() {
             
              try {
                  this.$Progress.start();    
                  this.memberForm.clear();
                  let parent_id_cp = this.memberForm.parent_id;
                  const resp = await axios.post('/api/member/saveMember/',this.memberForm);
                  toast.fire({
                      icon: resp.data.status,
                      title: resp.data.message
                  });     
                  this.memberEdit_mode = true;
                  this.memberForm.id =  resp.data.member_id; 

                  jQuery('#memberModal').modal('hide');
                  this.loadFamilyMembers();
                  let fill_parent_id = {'parent_id':parent_id_cp};
                  this.memberForm.fill(fill_parent_id); 

                  this.$Progress.finish();
                  
                  jQuery('#memberModal').modal('hide');    
              } catch (err) {
                  this.memberEdit_mode = false;
                  this.memberForm.errors.set(err.response.data.errors);
                  this.$Progress.fail();
              }
          },
          async updateMember(){      
              try {
                  // let file =  e.target.files[0];
                  // console.log(file);
                  this.$Progress.start();  

                  const resp = await axios.put('/api/member/updateMember/'+this.memberForm.id,this.memberForm);
                  toast.fire({
                      icon: resp.data.status,
                      title: resp.data.message
                  });
                  this.loadFamilyMembers();
                  jQuery('#memberModal').modal('hide');    
                 this.$Progress.finish();
              } catch (err) {
                  this.$Progress.fail();
                  this.memberForm.errors.set(err.response.data.errors);
              }
          },    
              
        
        },
        mounted() {
            this.loadProfile();
            this.loadFamilyMembers();
            //console.log('Profile info mounted.')
        }
    }
</script>
