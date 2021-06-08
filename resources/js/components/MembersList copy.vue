<template>
   <div class="content-wrapper" style="min-height: 1074px;">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Members List</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Members List</li>
            </ol>
          </div>
        </div>
      </div>
    </section>
    <section class="content">
      <div class="container-fluid">       
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link" href="#activity" data-toggle="tab">Change Root Member</a></li>
                  <li class="nav-item"><a class="nav-link active" href="#members" data-toggle="tab">All Members</a></li>
                  <li class="nav-item"><a class="nav-link " href="#settings" data-toggle="tab">New request</a></li>
                </ul>
              </div>
              <div class="card-body">
                <div class="tab-content">
                  <div class="tab-pane" id="activity">
                    Member Posts
                  </div>
                  <div class="tab-pane active" id="members">
                    
                    <div class="row col-md-12 mb-3">
                   
                     <!-- <div  class="col-md-5"></div> -->
                    <div  class="col-md-2 col-sm-4 text-right">Choose View</div>
                    <select id="listingType" class="form-control pull-right col-md-3 col-sm-4" >
                    <option value='1'> List All Members</option>
                    <option value='2'> List By Parents</option>
                    <option value='3'> List  All Family Members</option>
                    </select>   
                    </div>
                    <div> <button type="button" class="col-md-4 btn btn-block btn-info" @click="createModel()">
                    <i class="fa fa-user-plus" aria-hidden="true"></i> Add Member</button>
                    </div>
                    <br>
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
                            rowsPerPageLabel: 'Member per page',
                            ofLabel: 'of',
                            pageLabel: 'page', // for 'pages', mode
                            allLabel: 'All',
                        }"
                        styleClass="vgt-table striped"
                        >
                        <div slot="table-actions" class="my-2 mr-4">
                        <button type="button" class="btn btn-block btn-info " @click="createModel()">
                              <i class="fa fa-user-plus" aria-hidden="true"></i> Add Member</button>
                        </div>

                        <template slot="table-row" slot-scope="props">
                        <span v-if="props.column.field == 'photoview'">
                        <div class="nomore-ribbon-wrapper">
                          <div v-if="props.row.disabled == '1'" class="nomore-ribbon bg-warning">
                          No More
                          </div>
                        </div> 
                        <img :src="props.row.photoThumb" v-show="props.row.photoThumb"  @click.prevent="viewLarge(props.row)" class="member_profile_thumbnail">                                  
                        </span>

                        <span v-if="props.column.field == 'after'">
                          <a class="btn btn-warning btn-sm" @click.prevent="viewModel(props.row)" href="#"><i class="fa fa-eye" title="View"></i></a>
                          &nbsp; <a class="btn btn-primary btn-sm" @click.prevent="loadChilds(props.row)" href="#"><i class="fas fa-sitemap" title="View Childs"></i></a>
                          &nbsp; <a class="btn btn-info btn-sm" @click.prevent="editModel(props.row)" href="#"><i class="fas fa-pencil-alt" title="Edit"></i></a>
                          &nbsp; <a class="btn btn-danger btn-sm"  @click.prevent="deleteMember(props.row.id)" href="#">
                          <i class="fas fa-trash" title="Delete"></i></a>            
                        </span>
                        <span v-else>
                        {{props.formattedRow[props.column.field]}}
                        </span>
                        </template>
                      
                  </vue-good-table>
                  </div>

                  <div class="tab-pane" id="settings">
                        New Request Approval or deney
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>              
      </div>
    </section>

    <div class="modal fade" id="userModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">
          <span v-show="!edit_mode">Add New Member</span>
          <span v-show="edit_mode">Edit Member info</span></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div> 
      <form @submit.prevent="edit_mode ?updateMember():createMember()" @keydown="form.onKeydown($event)">
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

    <div class="modal fade" id="viewModal"  data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">
        <span>{{(personView.fname || " ")+' '+(personView.mname || " ")+' '+(personView.lname || " ")}}</span></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div> 
      <div class="modal-body">         
          <div  id="personal_infomation">
            <table  class="table table-hover text-nowrap">
              <tbody>             
              <tr>
                  <td colspan="2" rowspan="7" style="width: 40%; align:right; border-top:none;">
                     <img :src="personView.photoThumb" v-show="personView.photoThumb"  @click.prevent="viewLarge(personView)" class="member_preview_image">
                  </td>
                  <td class="view-info-text" style="width: 60%; align:right; border-top:none;">
                    <div ><strong>Name </strong> {{(personView.fname || " ")+' '+(personView.mname || " ")+' '+(personView.lname || " ")}}</div>
                    <div v-show="personView.dob"><strong>DOB </strong> {{personView.dob+' '+personView.dob_time}}</div> 
                    <div v-show="personView.email"><strong>Email </strong> {{personView.email}}</div> 
                    <div v-show="personView.mobile"><strong>Mobile </strong> {{personView.mobile}} </div> 
                    <div v-show="personView.phone"><strong>Phone </strong> {{personView.phone}}</div> 
                    <div v-show="personView.maritial_status"><strong>Maritial Status </strong>{{personView.maritial_status==1?'Married':'Single'}}</div>
                    <div v-show="personView.birth_order"><strong>Children Order </strong>{{personView.birth_order}}</div>
                  </td>
              </tr> 
              
              <tr><td v-show="personView.fathersname"><strong>Father </strong>
              {{personView.fathersname}}</td>
              <td v-show="personView.mothersname"><strong>Mother </strong>{{personView.mothersname}}</td>
              </tr>               
              <tr>
              <td  v-show="personView.grandfathersname"><strong>Grand Pa </strong>{{personView.grandfathersname}}</td>
              <td  v-show="personView.grandmothersname"><strong>Grand Ma </strong>{{personView.grandmothersname}}</td></tr> 
              <tr ><td v-show="personView.cur_address"><strong>Cur. Address </strong> {{personView.cur_address}} </td>
              <td v-show="personView.per_address"><strong>Per. Address</strong>{{personView.per_address}}</td></tr>
              <tr v-show="personView.about"><td colspan="2"><textarea class="view-textarea"> {{personView.about}}</textarea></td></tr>                     
              </tbody>
            </table> 
          </div>
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      <!-- <button class="btn btn-primary"  @click="captureAsImage">Download Info</button> -->
      </div>
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
        data() {
        return {
            edit_mode:false,
            users:{},
            members:{},  
            personView:{
              fname:'Prakash',
              mname:'Kumar',
              lname:'Bhandari',

            }, 
            form: new Form({
                id:'',
                fullName:'',
                name: '',
                email:'',
                
                mobile:'',
                password: ''           
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
            }),
            isLoading: true,
            columns: [
                 {
                    label: 'Full Name',
                    field: 'fullName',
                    width: '20%',
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
                    label: '',
                    field: 'photoview',
                    width: '5%',
                    filterable: false,
                    sortable: false
                },
                {
                    label: 'Email/Mobile',
                    field: 'emailmobile',
                    width: '25%',
                    filterOptions: {
                        enabled: true, // enable filter for this column
                        placeholder: 'Search Email or Mobile', // placeholder for filter input
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
                    width: '17%',
                    sortable: false
                }
            ],
            rows: [],
            totalRecords: 0,
            serverParams: {
                columnFilters: {

                },
                sort: {
                    field: 'fname', 
                    type: 'asc',
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
                this.loadMembers();
            },
            onPerPageChange(params) {
                this.updateParams({perPage: params.currentPerPage});
                this.loadMembers();
            },
            onSortChange(params) {
                 this.updateParams({
                    sort: {
                        type: params[0].type,
                        field: params[0].field,
                    },
                });
       
                this.loadMembers();
            },            
            onColumnFilter(params) {
                this.updateParams(params);
                this.loadMembers();
            },
            async loadMembers() {
                //  return axios.get('/api/user?page='+this.serverParams.page,{ params: { queryParams:this.serverParams}}).then((response)=>{
                //       this.totalRecords  = response.data.total
                //       this.rows = response.data.data
                // })
                try {
               
                var data =  await axios.get('api/member/getAllMembers?page='+this.serverParams.page,{ params: { queryParams:this.serverParams}}).then(({data})=>{
                  this.totalRecords  = data.total;
                  this.rows = data.data;
                  // console.log("Member list loaded",data.total);
                });
                
                }
                catch (err) {
                

                }

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
            async viewModel(attachData){
                //this.form.reset();
                //this.form.clear();
                //this.edit_mode = true;
                //this.form.fill(data);
                let newPlot = '';

                 try {             
                   let personal_info = attachData;                  
                    
                    var data =  await axios.get('api/member/getParentMembers/'+attachData.id).then(({data})=>{
                      // this.totalRecords  = data.total;
                      // this.rows = data.data;  
                      //console.log('Data return ',data);  
                      let myObj = data;
                      // {'grandfathersname':'Udara Bhandari','fathersname':'Ganesh Bhandari','mothersname':'Charumati Devi Bhandari'};
                      
                      newPlot = {...personal_info,...myObj};
                          
                   });                  
                  this.personView  = newPlot;
                  jQuery('#viewModal').modal('show');                
                }
                catch (err) {                

                }
               
            },
            captureAsImage(){              
            document.getElementById("personal_infomation").style.height = 'auto';
            document.getElementById("personal_infomation").style.overflow = 'show';
              html2canvas(document.querySelector("#personal_infomation")).then(canvas => {
              var img = canvas.toDataURL()
                window.open(img);
              });
            //console.log('Image Captured');
            },
            async createMember() {                
                try {
                    this.$Progress.start();    
                    const resp = await axios.post('/api/user/',this.form);
                    toast.fire({
                        icon: resp.data.status,
                        title: resp.data.message
                    });
                    
                    jQuery('#userModal').modal('hide');
                    this.loadMembers();
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
                    jQuery('#userModal').modal('hide');
                    this.loadMembers();
                } catch (err) {
                    this.form.errors.set(err.response.data.errors);
                }
            },             
            viewLarge(frmObj){
              //console.log(frmObj.photoMedium);
              jQuery('#imagePreview').modal('show');
              let fullname = (frmObj.fname || " ")+' '+(frmObj.mname || " ")+' '+(frmObj.lname || " ");
              jQuery("#MemberNameDisp").html(fullname);
              jQuery("#MemberImageDisp").attr('src',frmObj.photoMedium);
            },         
            deleteMember(id){       
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
                            this.loadMembers();
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
            //this.loadMembers();            
        }
    }
</script>