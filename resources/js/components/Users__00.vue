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
               <vue-search ></vue-search>
              
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    
    <!-- /.content -->
  </div>
</template>

<script>

   
    export default {
        
        components: {
    	      
        },
        data() {
            return {
              
            }
        },
           
        }
        
        
        

</script>

