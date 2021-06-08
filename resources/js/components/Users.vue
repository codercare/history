<template>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>User Management</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Users</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">User Listing</h3>
              <div class="card-tools">
              <button type="button" class="btn btn-block btn-info" @click="createModel()">
                  <i class="fa fa-user-plus" aria-hidden="true"></i> Add User</button>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr >
                  <th>Name</th>
                  <th>Email</th>                  
                  <th>Status</th>
                  <th>Created at</th>
                  <th width="18%">Modify</th>
                </tr>
                </thead>
              <tbody>
                <tr  v-for="user in users" :key="user.id">
                  <td>{{user.name}}</td>
                  <td>{{user.email}}</td>
                  <td>1</td>
                  <td> {{user.created_at | humanDate}}</td>
                  <td>
                    <a class="btn btn-info btn-sm" @click.prevent="editModel(user)" href="#"><i class="fas fa-pencil-alt"></i> Edit</a>
                    &nbsp; <a class="btn btn-danger btn-sm" v-if="((user.id!=1) || (user.email!='akash2046@gmail.com'))" @click.prevent="deleteUser(user.id)" href="#">
                        <i class="fas fa-trash"></i> Delete</a></td>
                </tr>
              </tbody>
                <tfoot>
                <tr >
                  <th>Name</th>
                  <th>Email</th>                  
                  <th>Status</th>
                  <th>Created at</th>
                  <th>Modify</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <div class="modal fade" id="userModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">
          <span v-show="!edit_mode">Create New User</span>
          <span v-show="edit_mode">Edit User info</span></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div> 
      <form @submit.prevent="edit_mode ?updateUser():createUser()" @keydown="form.onKeydown($event)">
      <div class="modal-body">         
                <div class="">
                  <alert-error :form="form"></alert-error>                  
                  <div class="form-group">
                    <label for="name">Full Name</label>
                    <input v-model="form.name" type="text" name="name" placeholder="Enter full name"
                  class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                  <has-error :form="form" field="name"></has-error>
                  </div>
                  <div class="form-group">
                    <label  for="email">Email address</label>
                    <input type="email" v-model="form.email" class="form-control" placeholder="Enter email" :class="{ 'is-invalid': form.errors.has('email') }">
                    <has-error :form="form" field="email"></has-error>
                  </div>
                  <div class="form-group">
                    <label for="password">Password</label>
                    <input v-model="form.password" type="password" placeholder="********" name="password" class="form-control" :class="{ 'is-invalid': form.errors.has('password') }">
                    {{edit_mode ?'Leave password if you want old password':'' }}
                    <has-error :form="form" field="password"></has-error>
                  </div>               
                  
                </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button :disabled="form.busy" type="submit" class="btn btn-primary">{{edit_mode ?'Update':'Save' }}</button>
         
      </div>
      </form>
    </div>
    </div>
    </div>
    <!-- /.content -->
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
              name: '',
              email:'',
              password: ''           
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
          async createUser() {
             
              try {
                  this.$Progress.start();    
                  const resp = await axios.post('/api/user/',this.form);
                  toast.fire({
                      icon: resp.data.status,
                      title: resp.data.message
                  });
                  
                  $('#userModal').modal('hide');
                  this.loadUsers();
                  this.$Progress.finish();
              } catch (err) {
                  this.form.errors.set(err.response.data.errors);
                  this.$Progress.fail();
              }
          },
          async updateUser(){      
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
            this.loadUsers();
            console.log('User Component mounted.')
        }
    }
</script>
