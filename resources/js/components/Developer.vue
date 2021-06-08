<template>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Passport Package Management</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Developer</li>
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
              <h3 class="card-title">Packages Listing</h3>
             
            </div>
            <!-- /.card-header -->
            <div class="card-body">
               <vue-search ></vue-search>
                    <!-- <passport-clients></passport-clients>
                    <passport-authorized-clients></passport-authorized-clients>
                    <passport-personal-access-tokens></passport-personal-access-tokens> -->
            </div>
            </div>
            <p>For more information visiti link : https://laravel.com/docs/7.x/passport#frontend-quickstart</p>
        </div>
        </div>
    </section>
</div>
</template>

<script>
    // export default {
    //     mounted() {
    //         console.log('Component mounted.')
    //     }
    // }
</script>
