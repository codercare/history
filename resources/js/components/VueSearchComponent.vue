<template>
<div>
    <div>
    <vue-good-table
            mode="remote"
            :line-numbers="true"
            :columns="columns"
            :rows="rows"   
            :row-style-class="rowStyleClassFn"     

            @on-page-change="onPageChange"
            @on-sort-change="onSortChange"
            @on-column-filter="onColumnFilter"
            @on-per-page-change="onPerPageChange"
            :totalRows="totalRecords"
            :isLoading.sync="isLoading"

            :globalSearch="true"            
            
            :pagination-options="{
                enabled: true,
                mode: 'pages',  // 'pages' to jump input or  'records'
                perPage:10,
                position: 'bottom',
                perPageDropdown: [5,10,50, 100],
                dropdownAllowAll: true,
                setCurrentPage:1,
                nextLabel: 'next',
                prevLabel: 'prev',
                rowsPerPageLabel: 'User per page',
                ofLabel: 'of',
                pageLabel: 'page', // for 'pages', mode
                allLabel: 'All',
            }"
            styleClass="vgt-table striped"
            >
            <div slot="table-actions" class="my-2 mr-4">
            <button type="button" class="btn btn-block btn-info " @click="createModel()">
                  <i class="fa fa-user-plus" aria-hidden="true"></i> Add User</button>
            </div>
            <template slot="table-row" slot-scope="props">
            <span v-if="props.column.field == 'after'">
                <a class="btn btn-info btn-sm" @click.prevent="editModel(props.row)" href="#"><i class="fas fa-pencil-alt" title="Edit"></i></a>
                &nbsp; <a class="btn btn-danger btn-sm"  @click.prevent="deleteUser(props.row.id)" href="#">
                    <i class="fas fa-trash" title="Delete"></i></a>            
            </span>
            <span v-else>
            {{props.formattedRow[props.column.field]}}
            </span>
            </template>
           
    </vue-good-table>
    </div>
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
                    <label  for="mobile">Mobile</label>
                    <input type="text" v-model="form.mobile" class="form-control" placeholder="Enter mobile" :class="{ 'is-invalid': form.errors.has('mobile') }">
                    <has-error :form="form" field="mobile"></has-error>
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
                    
  </div>
</template>
<script>
    // import Vue from 'vue';
    // import VueGoodTable from 'vue-good-table';
    // import 'vue-good-table/dist/vue-good-table.css'

    // Vue.use(VueGoodTable);

    export default {
        data() {
        return {
            edit_mode:false,
            users:{},
            
            form: new Form({
                id:'',
                name: '',
                email:'',
                mobile:'',
                password: ''           
            }),
            isLoading: true,
            columns: [
                 {
                    label: 'Full Name',
                    field: 'name',
                    width: '25',
                    filterOptions: {
                        enabled: true, // enable filter for this column
                        placeholder: 'Search Name', // placeholder for filter input
                        filterValue: '', // initial populated value for this filter
                         // dropdown (with selected values) instead of text input
                        filterFn: this.columnFilterFn, //custom filter function that
                        trigger: 'enter', //only trigger on enter not on keyup 
                    },
                },
                {
                    label: 'Email',
                    field: 'email',
                    width: '25%',
                    filterOptions: {
                        enabled: true, // enable filter for this column
                        placeholder: 'Search Email', // placeholder for filter input
                        filterFn: this.columnFilterFn, //custom filter function that
                        trigger: 'enter', //only trigger on enter not on keyup 
                    }
                },
                {
                    label: 'Mobile',
                    field: 'mobile',
                    width: '15%',
                    filterOptions: {
                        enabled: true, // enable filter for this column
                        placeholder: 'Search Mobile ', // placeholder for filter input
                        filterFn: this.columnFilterFn, //custom filter function that
                        trigger: 'enter', //only trigger on enter not on keyup 
                    }
                },
                {
                    label: 'Created At',
                    width: '15%',
                    field: 'published', 
                    filterable: false  
                },                
                {
                    label: 'ID',
                    width: '7%',
                    field: 'id',
                    filterOptions: {
                        enabled: true, // enable filter for this column
                        placeholder: 'ID', // placeholder for filter input
                        filterValue: '', // initial populated value for this filter
                         // dropdown (with selected values) instead of text input
                        filterFn: this.columnFilterFn, //custom filter function that
                        trigger: 'enter', //only trigger on enter not on keyup 
                    },
                },
                {
                    label: 'Modify',
                    field: 'after',
                    width: '10%',
                    sortable: false
                }
            ],
            rows: [],
            totalRecords: 0,
            serverParams: {
                columnFilters: {

                },
                sort: {
                    field: 'published', 
                    type: 'desc',
                },
                page: 1, 
                perPage:10
            }
            }; 
        },
        methods: {
            updateParams(newProps) {
                this.serverParams = Object.assign({}, this.serverParams, newProps);
            },            
            onPageChange(params) {
                this.updateParams({page: params.currentPage});
                //console.log("after page change");
                this.loadUsers();
            },
            onPerPageChange(params) {
                this.updateParams({perPage: params.currentPerPage});
                this.loadUsers();
            },
            onSortChange(params) {
                 this.updateParams({
                    sort: {
                        type: params[0].type,
                        field: params[0].field,
                    },
                });

                // this.updateParams({
                //     sort: [{
                //     type: params.sortType,
                //     field: this.columns[params.columnIndex].field,
                //     }],
                // });
                this.loadUsers();
            },            
            onColumnFilter(params) {
                this.updateParams(params);
                this.loadUsers();
            },
            loadUsers() {
                 return axios.get('/api/user?page='+this.serverParams.page,{ params: { queryParams:this.serverParams}}).then((response)=>{
                      this.totalRecords  = response.data.total
                      this.rows = response.data.data
                })
            },     
            createModel(){                  
                this.form.reset();
                this.form.clear();
                this.edit_mode = false;
                jQuery('#userModal').modal('show');             
            },
            editModel(data){
                this.form.reset();
                this.form.clear();
                this.edit_mode = true;
                this.form.fill(data);
                jQuery('#userModal').modal('show');
            },
            async createUser() {                
                try {
                    this.$Progress.start();    
                    const resp = await axios.post('/api/user/',this.form);
                    toast.fire({
                        icon: resp.data.status,
                        title: resp.data.message
                    });
                    
                    jQuery('#userModal').modal('hide');
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
                    jQuery('#userModal').modal('hide');
                    this.loadUsers();
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
                                toast.fire({
                                icon:'warning',
                                title:response.message
                            });
                        });                    
                    }
                });
            },
            rowStyleClassFn(row){
                 return !row.email_verified_at  ? 'green' : '';
            }
        },
        mounted() {
            //this.loadUsers();            
        }
    }
</script>
