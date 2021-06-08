<template>
   <div class="content-wrapper" style="min-height: 1074px;">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Profile</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Profile</li>
            </ol>
          </div>
        </div>
      </div>
    </section>
    <section class="content">
      <div class="container-fluid">     
        
       
        <div class="row">          
          <div class="col-md-12">
            <div class="card card-widget widget-user">
              <div class="widget-user-header text-white" style="background: url('uploads/profile/1-bg.png') center center;">
                <h3 class="widget-user-username text-right">Elizabeth Pierce</h3>
                <h5 class="widget-user-desc text-right">Web Designer</h5>
              </div>
              <div class="widget-user-image">
                <img class="img-circle" src="uploads/profile/1.png" alt="User Avatar">
              </div>
              <div class="card-footer">
                <div class="row">
                  <div class="col-sm-4 border-right">
                    <div class="description-block">
                      <h5 class="description-header">3,200</h5>
                      <span class="description-text">SALES</span>
                    </div>
                  </div>
                  <div class="col-sm-4 border-right">
                    <div class="description-block">
                      <h5 class="description-header">13,000</h5>
                      <span class="description-text">FOLLOWERS</span>
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="description-block">
                      <h5 class="description-header">35</h5>
                      <span class="description-text">PRODUCTS</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-3">

            <!-- Profile Image -->
            
            <!-- /.card -->

            <!-- About Me Box -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">About Me</h3>
              </div>
              <!-- /.card-header -->
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
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link" href="#activity" data-toggle="tab">Activity</a></li>
                  <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Timeline</a></li>
                  <li class="nav-item"><a class="nav-link active" href="#settings" data-toggle="tab">Settings</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="tab-pane" id="activity">
                    <!-- Post -->
                    <div class="post">
                      <div class="user-block">
                        <img class="img-circle img-bordered-sm" src="uploads/profile/1.jpg" alt="user image">
                        <span class="username">
                          <a href="#">Jonathan Burke Jr.</a>
                          <a href="#" class="float-right btn-tool"><i class="fas fa-times"></i></a>
                        </span>
                        <span class="description">Shared publicly - 7:30 PM today</span>
                      </div>
                      <!-- /.user-block -->
                      <p>
                        Lorem ipsum represents a long-held tradition for designers,
                        typographers and the like. Some people hate it and argue for
                        its demise, but others ignore the hate as they create awesome
                        tools to help create filler text for everyone from bacon lovers
                        to Charlie Sheen fans.
                      </p>

                      <p>
                        <a href="#" class="link-black text-sm mr-2"><i class="fas fa-share mr-1"></i> Share</a>
                        <a href="#" class="link-black text-sm"><i class="far fa-thumbs-up mr-1"></i> Like</a>
                        <span class="float-right">
                          <a href="#" class="link-black text-sm">
                            <i class="far fa-comments mr-1"></i> Comments (5)
                          </a>
                        </span>
                      </p>

                      <input class="form-control form-control-sm" type="text" placeholder="Type a comment">
                    </div>
                    <!-- /.post -->

                    <!-- Post -->
                    <div class="post clearfix">
                      <div class="user-block">
                        <img class="img-circle img-bordered-sm" src="uploads/profile/1.jpg" alt="User Image">
                        <span class="username">
                          <a href="#">Sarah Ross</a>
                          <a href="#" class="float-right btn-tool"><i class="fas fa-times"></i></a>
                        </span>
                        <span class="description">Sent you a message - 3 days ago</span>
                      </div>
                      <!-- /.user-block -->
                      <p>
                        Lorem ipsum represents a long-held tradition for designers,
                        typographers and the like. Some people hate it and argue for
                        its demise, but others ignore the hate as they create awesome
                        tools to help create filler text for everyone from bacon lovers
                        to Charlie Sheen fans.
                      </p>

                      <form class="form-horizontal">
                        <div class="input-group input-group-sm mb-0">
                          <input class="form-control form-control-sm" placeholder="Response">
                          <div class="input-group-append">
                            <button type="submit" class="btn btn-danger">Send</button>
                          </div>
                        </div>
                      </form>
                    </div>
                    <!-- /.post -->

                    <!-- Post -->
                    <div class="post">
                      <div class="user-block">
                        <img class="img-circle img-bordered-sm" src="uploads/profile/2.jpg" alt="User Image">
                        <span class="username">
                          <a href="#">Adam Jones</a>
                          <a href="#" class="float-right btn-tool"><i class="fas fa-times"></i></a>
                        </span>
                        <span class="description">Posted 5 photos - 5 days ago</span>
                      </div>
                      <!-- /.user-block -->
                      <div class="row mb-3">
                        <div class="col-sm-6">
                          <img class="img-fluid" src="uploads/profile/1-photos-1.jpg" alt="Photo">
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-6">
                          <div class="row">
                            <div class="col-sm-6">
                              <img class="img-fluid mb-3" src="uploads/profile/1-photos-2.jpg" alt="Photo">
                              <img class="img-fluid" src="uploads/profile/1-photos-3.jpg" alt="Photo">
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-6">
                              <img class="img-fluid mb-3" src="uploads/profile/1-photos-4.jpg" alt="Photo">
                              <img class="img-fluid" src="uploads/profile/1-photos-5.jpg" alt="Photo">
                            </div>
                            <!-- /.col -->
                          </div>
                          <!-- /.row -->
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- /.row -->

                      <p>
                        <a href="#" class="link-black text-sm mr-2"><i class="fas fa-share mr-1"></i> Share</a>
                        <a href="#" class="link-black text-sm"><i class="far fa-thumbs-up mr-1"></i> Like</a>
                        <span class="float-right">
                          <a href="#" class="link-black text-sm">
                            <i class="far fa-comments mr-1"></i> Comments (5)
                          </a>
                        </span>
                      </p>

                      <input class="form-control form-control-sm" type="text" placeholder="Type a comment">
                    </div>
                    <!-- /.post -->
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="timeline">
                    <!-- The timeline -->
                    <div class="timeline timeline-inverse">
                      <!-- timeline time label -->
                      <div class="time-label">
                        <span class="bg-danger">
                          10 Feb. 2014
                        </span>
                      </div>
                      <!-- /.timeline-label -->
                      <!-- timeline item -->
                      <div>
                        <i class="fas fa-envelope bg-primary"></i>

                        <div class="timeline-item">
                          <span class="time"><i class="far fa-clock"></i> 12:05</span>

                          <h3 class="timeline-header"><a href="#">Support Team</a> sent you an email</h3>

                          <div class="timeline-body">
                            Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                            weebly ning heekya handango imeem plugg dopplr jibjab, movity
                            jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
                            quora plaxo ideeli hulu weebly balihoo...
                          </div>
                          <div class="timeline-footer">
                            <a href="#" class="btn btn-primary btn-sm">Read more</a>
                            <a href="#" class="btn btn-danger btn-sm">Delete</a>
                          </div>
                        </div>
                      </div>
                      <!-- END timeline item -->
                      <!-- timeline item -->
                      <div>
                        <i class="fas fa-user bg-info"></i>

                        <div class="timeline-item">
                          <span class="time"><i class="far fa-clock"></i> 5 mins ago</span>

                          <h3 class="timeline-header border-0"><a href="#">Sarah Young</a> accepted your friend request
                          </h3>
                        </div>
                      </div>
                      <!-- END timeline item -->
                      <!-- timeline item -->
                      <div>
                        <i class="fas fa-comments bg-warning"></i>

                        <div class="timeline-item">
                          <span class="time"><i class="far fa-clock"></i> 27 mins ago</span>

                          <h3 class="timeline-header"><a href="#">Jay White</a> commented on your post</h3>

                          <div class="timeline-body">
                            Take me to your leader!
                            Switzerland is small and neutral!
                            We are more like Germany, ambitious and misunderstood!
                          </div>
                          <div class="timeline-footer">
                            <a href="#" class="btn btn-warning btn-flat btn-sm">View comment</a>
                          </div>
                        </div>
                      </div>
                      <!-- END timeline item -->
                      <!-- timeline time label -->
                      <div class="time-label">
                        <span class="bg-success">
                          3 Jan. 2014
                        </span>
                      </div>
                      <!-- /.timeline-label -->
                      <!-- timeline item -->
                      <div>
                        <i class="fas fa-camera bg-purple"></i>

                        <div class="timeline-item">
                          <span class="time"><i class="far fa-clock"></i> 2 days ago</span>

                          <h3 class="timeline-header"><a href="#">Mina Lee</a> uploaded new photos</h3>

                          <div class="timeline-body">
                            <img src="uploads/profile/1-photos-1.jpg" alt="...">
                            <img src="uploads/profile/1-photos-2.jpg" alt="...">
                            <img src="uploads/profile/1-photos-3.jpg" alt="...">
                            <img src="uploads/profile/1-photos-4.jpg" alt="...">
                          </div>
                        </div>
                      </div>
                      <!-- END timeline item -->
                      <div>
                        <i class="far fa-clock bg-gray"></i>
                      </div>
                    </div>
                  </div>
                  <!-- /.tab-pane -->

                  <div class="tab-pane active" id="settings">
                    <form class="form-horizontal" @submit.prevent="edit_mode ?updateMember():createMember()" @keydown="form.onKeydown($event)">
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-md-2 col-form-label">Name</label>
                        <div class="col-sm-4 col-md-4">
                          <input v-model="form.fname" type="text" name="fname" placeholder="First"
                          class="form-control" :class="{ 'is-invalid': form.errors.has('fname') }">
                          <has-error :form="form" field="fname"></has-error>
                          <!-- <input type="email" class="form-control" id="inputName" placeholder="First"> -->
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
                          <!-- <input type="email" class="form-control" name="email" id="email" placeholder="Email"> -->
                        </div>
                      </div>
                       <div class="form-group row">
                        <label for="mobile" class="col-sm-2 col-form-label">Mobile</label>
                        <div class="col-sm-10">
                          <input type="text" v-model="form.mobile" class="form-control"  placeholder="Mobile" :class="{ 'is-invalid': form.errors.has('mobile') }">
                          <has-error :form="form" field="mobile"></has-error>
                          <!-- <input type="input" class="form-control" name="mobile" id="mobile"> -->
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="phone" class="col-sm-2 col-form-label">Phone</label>
                        <div class="col-sm-10">                              
                          <input type="input" v-model="form.phone" class="form-control" name="phone" id="phone" placeholder="phone">
                        </div>
                      </div>
                       <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <div class="checkbox">
                            <label>
                              <div class="custom-control custom-checkbox">
                              <input class="custom-control-input" type="checkbox" id="mobileLogin" value="1" checked="">
                              <label for="customCheckbox2" class="custom-control-label"> check if you also want to login from mobile.</label>
                              </div>
                              <!-- <input type="checkbox"> check if you also want to login from mobile. -->
                            </label>
                          </div>
                        </div>
                      </div>
                       <div class="form-group row">
                      <label for="photo" class="col-sm-2 col-form-label">Photo</label>
                      <div class="col-sm-10">
                      <input type="file" class="form-control"  name="photo" id="photo" placeholder="Passport Photo">
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
                        <!-- <select class="custom-select">
                          <option value="m">Male</option>
                          <option value="f">Female</option>
                        </select> -->
                         <div class="form-group">
                              <div class="custom-control custom-radio">
                              <input class="custom-control-input"  id="male" type="radio"  value="m" v-model="form.gender" name="gender" checked="">
                              <label for="customRadio1" class="custom-control-label" >Male</label>
                              </div>
                              <div class="custom-control custom-radio">
                              <input class="custom-control-input"  id="female" type="radio" v-model="form.gender"  value="f" name="gender" >
                              <label for="customRadio2" class="custom-control-label">Female</label>
                              </div>                              
                            </div>
                      </div>
                      <label for="maritial_status" class="col-sm-3 col-form-label text-right">Maritial Status</label>
                      <div class="col-sm-3 pull-left">
                            <div class="form-group">
                              <div class="custom-control custom-radio">
                              <input class="custom-control-input" id="single" type="radio" v-model="form.maritial_status"   value="s" name="maritial_status" checked="">
                              <label for="customRadio1" class="custom-control-label">Single</label>
                              </div>
                              <div class="custom-control custom-radio">
                              <input class="custom-control-input"  id="married" type="radio" v-model="form.maritial_status"  value="m" name="maritial_status" >
                              <label for="customRadio2" class="custom-control-label">Married</label>
                              </div>                              
                            </div>
                          <!-- <input type="radio" name="maritial_status" value="s"> Single
                          <input type="radio" name="maritial_status" value="m"> Married -->
                      </div>
                      </div>
                       <div class="form-group row">
                      
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
                        <div class="offset-sm-2 col-sm-10">
                          <!-- <input type="hidden" name="user_id" value=""> -->
                          <button type="submit" class="btn btn-primary">Submit</button> &nbsp;&nbsp;
                           <button type="reset" class="btn  btn-secondary">Reset</button>
                        </div>
                        
                      </div>
                    </form>
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.nav-tabs-custom -->
          </div>
          <!-- /.col -->
        </div>
       
        
      </div>
    </section>
    
  </div>
</template>

<script>
    export default {
        data(){
          return{
              edit_mode:false,
              users:{},
              
              form: new Form({
              id:'',
              fname: '',
              email:''       
              })
          }          
        },
        methods: {
          async loadUsers(){
             
           try {
             this.$Progress.start();  
             var data =  await axios.get('api/user').then(({data})=>(this.users = data.data));
             this.$Progress.finish();
           }
           catch (err) {
             this.$Progress.fail();
             this.form.errors.set(err.response.data.errors);
              
           }
           
          },
          createModel(){                  
             this.form.reset();
             this.form.clear();
             this.edit_mode = false;
             $('#userModal').modal('show');             
          },
          editModel(data){
              this.form.reset();
              this.form.clear();
              this.edit_mode = true;
              this.form.fill(data);
              $('#userModal').modal('show');
          },
          async createMember() {
             
              try {
                  this.$Progress.start();    
                  const resp = await axios.post('/api/member/',this.form);
                  toast.fire({
                      icon: resp.data.status,
                      title: resp.data.message
                  });
                  
                  $('#userModal').modal('hide');
                  //this.loadUsers();
                  this.$Progress.finish();
              } catch (err) {
                  this.form.errors.set(err.response.data.errors);
                  this.$Progress.fail();
              }
          },
          async updateMember(){      
              try {
                  const resp = await axios.put('/api/user/'+this.form.id,this.form);
                  toast.fire({
                      icon: resp.data.status,
                      title: resp.data.message
                  });
                  $('#userModal').modal('hide');
                  this.loadUsers();
                  /*
                    toast.fire({
                      icon: 'success',
                      title: 'New User created successfully'
                      });
                  */
              } catch (err) {
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
                            //console.log('catch response'+response.message);
                            toast.fire({
                            icon:'warning',
                            title:response.message
                          });
                    });                    
                }
              });
          }          
        },
        mounted() {
            //this.loadUsers();
            console.log('Profile Component mounted.')
        }
    }
</script>
