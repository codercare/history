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
                        
                        <div slot="table-actions" class="">
                          <div  class="pull-right">
                              <button type="button" class="btn btn-block btn-info mr-2" @click="createModel()">
                                <i class="fa fa-user-plus" aria-hidden="true"></i> Add Member</button>
                            </div>
                            
                        </div>
                        

                        <template slot="table-row" slot-scope="props">
                          
                        <span v-if="props.column.field == 'photoview'">
                        <div class="nomore-ribbon-wrapper">
                          <div v-if="props.row.expiry == '1'" class="nomore-ribbon bg-warning">
                          No More
                          </div>
                        </div> 
                        <img :src="props.row.photoThumb" v-show="props.row.photoThumb"  @click.prevent="viewLarge(props.row)" class="member_profile_thumbnail">                                  
                        </span>

                        
                        <span v-if="props.column.field == 'emailMobile'">
                         {{props.row.email}}{{props.row.mobile?'<br/>'.props.row.mobile:''}}
                        </span>
                        <span v-if="props.column.field == 'fathername'">                         
                          {{(props.row.parent && props.row.relation !='w')? (props.row.parent.fname || " ")+' '+(props.row.parent.mname || " ") : ''}}
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
                        <div slot="emptystate" style="text-align:center;">
                        <i class="fas fa-info"></i> No member found with your requested search! <span id="addition_search_req"></span>
                        </div>
                      
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

    <div class="modal fade" id="memberModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">
          <span v-show="!memberEdit_mode">Add Member</span>
          <span v-show="memberEdit_mode">Edit Member Detail</span></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div> 
      <form @submit.prevent="memberEdit_mode ?updateMember():createMember()" @keydown="form.onKeydown($event)">
      <div class="modal-body">         
          <div class="">
          <alert-error :form="form"></alert-error>     
            
            <div class="form-group row">
            <label for="relation" class="col-sm-2 col-form-label">Search</label>
            <div class="col-sm-10">
              <input v-model="parentOrChildSearch" type="text"  id="parentOrChildSearch_input" name="parentOrChildSearch" v-on:keyup.prevent="searchParentOrChild()"   placeholder="Search Parent or Child by Name, Email, Mobile or ID"
              class="form-control" :class="{ 'is-invalid': memberForm.errors.has('parentOrChild') }"> 
              <input v-model="memberForm.parent_id" type="hidden" name="parent_id"  :class="{ 'is-invalid': memberForm.errors.has('parent_id') }">
               <has-error :form="memberForm" field="parent_id"></has-error>
              <ul class="autocomplete-result-list" style="display:none" >
                    <em class="close-btn" @click.prevent="closeSearch()"><i class="fas fa-2x fa-times-circle" title="Close"></i></em>
                    <li v-for="(row,index) in searchMembers" :key="row.id"  @click.prevent="parentChildChoosen(row)">
                        <div class="member-list">
                        <div class="member-list-withimage">
                        <h3>{{(row.fname || " ")+' '+(row.mname || " ")+' '+(row.lname || " ")}}  - 
                          <span class="pull-right" v-if="row.maritial_status==1"><i class="fas fa-chess" aria-hidden="true"></i></span>
                          <span class="pull-right" v-if="row.maritial_status==1"><i class="fas fa-chess-bishop-alt" aria-hidden="true"></i></span> </h3>
                        <h3 v-show="row.parent">{{row.relation == 's'?'Son of ':(row.relation == 'd')?'Doughter of':'Wife of'}}  {{(row.parent && row.parent.fname || " ")+' '+(row.parent && row.parent.mname || " ")+' '+(row.parent && row.parent.lname || " ")}}</h3>
                        <p v-show="!row.expiry"><i class="fa fa-map-marker" title="Address" v-if="row.per_address || row.cur_address" aria-hidden="true"></i>
{{row.per_address?row.per_address+" - ":''}} {{row.cur_address?' ('+row.cur_address+')':''}}</p>
                        <p v-show="row.expiry" v-if="row.expiry_date"><i class="far fa-clock" title="Expired in"></i> {{row.expiry_date?row.expiry_date:''}}</p>
                        </div>
                        <div class="member-list-image">
                            <div v-if="row.expiry == '1'" class="nomore-ribbon-wrapper">
                            <div  class="nomore-ribbon bg-warning">
                            No More
                            </div>
                            </div> 
                            <img :src="row.photo" v-show="row.photo"  @click.prevent="viewLarge(row)" >
                        </div>
                        </div>
                    </li>
                  </ul>                    
            </div>
            </div>  
                      
            <div class="form-group row">
            <label for="relation" class="col-sm-2 col-form-label">Relation</label>
            <div class="col-sm-10">
              <select  class="form-control" @change="changeRelation" v-model="memberForm.relation" :class="{ 'is-invalid': memberForm.errors.has('relation') }"> 
                <option value="s"> Son</option>
                <option value="f"> Father</option>    
                <option value="f-choose">Choose Father</option>              
                <option value="w"> Wife</option>                
                <option value="d"> Doughter</option>
              </select>  
              <has-error :form="memberForm" field="relation"></has-error>                       
            </div>
            </div>
            <div id="search-entry-father" class="form-group row" style="display:none">
            <label for="relation" class="col-sm-2 col-form-label">Select Parent</label>
            <div class="col-sm-10">
              <input v-model="parentSearch" type="text"  id="parentSearch" name="parentSearch" v-on:keyup.prevent="searchParent()"   placeholder="Choose Parent by searching Name, Email, Mobile or ID"
              class="form-control" :class="{ 'is-invalid': memberForm.errors.has('parentOrChild') }"> 
              <has-error :form="memberForm" field="parent_id"></has-error>
                  <ul id="autocomplete-parent" class="autocomplete-result-list" style="display:none" >
                    <em class="close-btn" @click.prevent="closeSearch()"><i class="fas fa-2x fa-times-circle" title="Close"></i></em>
                    <li v-for="(row,index) in searchParents" :key="row.id"  @click.prevent="parentChoosen(row)">
                        <div class="member-list">
                        <div class="member-list-withimage">
                        <h3>{{(row.fname || " ")+' '+(row.mname || " ")+' '+(row.lname || " ")}}  - 
                          <span class="pull-right" v-if="row.maritial_status==1"><i class="fas fa-chess" aria-hidden="true"></i></span>
                          <span class="pull-right" v-if="row.maritial_status==1"><i class="fas fa-chess-bishop-alt" aria-hidden="true"></i></span> </h3>
                        <h3 v-show="row.parent">{{row.relation == 's'?'Son of ':(row.relation == 'd')?'Doughter of':'Wife of'}}  {{(row.parent && row.parent.fname || " ")+' '+(row.parent && row.parent.mname || " ")+' '+(row.parent && row.parent.lname || " ")}}</h3>
                        <p v-show="!row.expiry"><i class="fa fa-map-marker" title="Address" v-if="row.per_address || row.cur_address" aria-hidden="true"></i>
{{row.per_address?row.per_address+" - ":''}} {{row.cur_address?' ('+row.cur_address+')':''}}</p>
                        <p v-show="row.expiry" v-if="row.expiry_date"><i class="far fa-clock" title="Expired in"></i> {{row.expiry_date?row.expiry_date:''}}</p>
                        </div>
                        <div class="member-list-image">
                            <div v-if="row.expiry == '1'" class="nomore-ribbon-wrapper">
                            <div  class="nomore-ribbon bg-warning">
                            No More
                            </div>
                            </div> 
                            <img :src="row.photo" v-show="row.photo"  @click.prevent="viewLarge(row)" >
                        </div>
                        </div>
                    </li>
                  </ul>                    
            </div>
            </div>  
            <div id="entry-member-name" class="form-group row"> 
            <div class="col-md-12"><span id="dynamic_add_info"></span></div>                       
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
              <input class="form-control" v-model="memberForm.lname" type="text" name="lname" value="Bhandari" placeholder="Last">
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
              <tr>
                  <td width="50%" colspan="2" rowspan="7" style="align:right; border-top:none;">
                    <div class="full-width-image ">
                      <div v-if="personView.expiry == '1'" class="nomore-ribbon-wrapper">
                          <div  class="nomore-ribbon bg-warning">
                          No More
                          </div>
                      </div> 
                     <img :src="personView.photo" v-show="personView.photo"  @click.prevent="viewLarge(personView)" class="">
                    </div>
                  </td>
                  <td  width="25%" style="align:right; border-top:none;"><strong>Name </strong></td>
                  <td  width="25%" style="align:right; border-top:none;">{{(personView.fname || " ")+' '+(personView.mname || " ")+' '+(personView.lname || " ")}}</td>                  
              </tr> 
              <tr>
               <td width="25%"><strong>DOB </strong></td>
               <td width="25%">{{(personView.dob||"-")}}{{personView.dob_time?' ( '+personView.dob_time+' )':''}}</td>     
              </tr>
              <tr>
               <td><strong>Email </strong></td>
               <td>{{personView.email||" - "}}</td>     
              </tr>
              <tr>
               <td><strong>Mobile </strong></td>
               <td>{{personView.mobile||" - "}}</td>     
              </tr>
              <tr>
               <td><strong>Phone </strong></td>
               <td>{{personView.phone||" - "}}</td>     
              </tr>
              <tr>
               <td><strong>Maritial Status </strong></td>
               <td>{{personView.maritial_status==1?'Married':'Single'}}</td>     
              </tr>
              <tr>
               <td><strong>Children Order </strong></td>
               <td>{{personView.birth_order||" - "}}</td>     
              </tr>

              <tr  v-show="personView.fathersname||personView.mothersname">
              <td width="25%"><strong>Father </strong></td>
              <td width="25%"> {{personView.fathersname||" - "}}</td>
              <td width="25%"><strong>Mother </strong></td>
              <td width="25%"> {{personView.mothersname||" - "}}</td>
              </tr>               
              <tr v-show="personView.grandfathersname || personView.grandmothersname">
              <td><strong>Grand Pa </strong></td>
              <td>{{personView.grandfathersname||" - "}}</td>
              <td><strong>Grand Ma </strong></td>
              <td>{{personView.grandmothersname||" - "}}</td>
              </tr> 
              <tr v-show="personView.cur_address||personView.per_address">
              <td><strong>Cur. Address </strong></td>
              <td>{{personView.cur_address||" - "}} </td>
              <td><strong>Per. Address</strong></td>
              <td>{{personView.per_address||" - "}}</td>
              </tr>
              <tr v-show="personView.about">
                <td colspan="4">
                <textarea class="view-textarea"> {{personView.about}}</textarea>
                </td>
              </tr> 
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
            isWife:true,
            memberEdit_mode:false,
            edit_mode:false,
            parentOrChildSearch:'',
            parentSearch:'',
            users:{},
            members:{},  
            searchMembers:[{fname:'',fname:'',lname:'',parent:{fname:'',mname:'',lname:''}}],
            searchParents:[{fname:'',fname:'',lname:'',parent:{fname:'',mname:'',lname:''}}],
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
              lname: 'Bhandari',
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
                    width: '22%',
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
                    label: 'Father',
                    field: 'fathername',
                    width: '12%',
                    filterable: false,
                    sortable: false
                },
                {
                    label: 'Email/Mobile',
                    field: 'emailAndMobile',
                    width: '15%',
                    sortable: false,
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
                    width: '22%',
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
                try {               
                    var data =  await axios.get('api/member/getAllMembers?page='+this.serverParams.page,{ params: { queryParams:this.serverParams}}).then(({data})=>{
                      this.totalRecords  = data.total;
                      this.rows = data.data;
                    });                
                }
                catch (err) {                

                }
            },     
            createModel(){                  
              let copy_parent_id =  this.memberForm.parent_id; //document.getElementById('parent_id'); 
              this.parentOrChildSearch = '';
              jQuery("#dynamic_add_info").html('');
              //this.memberForm.parent_id = '';
              this.memberForm.reset();
              this.memberForm.clear();
              //let fill_parent_id = {'parent_id':copy_parent_id};
              //this.memberForm.fill(fill_parent_id);  

              this.memberEdit_mode = false;
              jQuery('#memberModal').modal('show');           
            },
            editModel(data){
              this.memberForm.reset();
              this.memberForm.clear();
              this.parentOrChildSearch = (data.fname || " ")+' '+(data.mname || " ")+' '+(data.lname || " ");
              this.memberEdit_mode = true;
              this.memberForm.fill(data);
              this.changeRelation();
              jQuery('#memberModal').modal('show');
            },
            async viewModel(attachData){
                let newPlot = '';

                 try {             
                   let personal_info = attachData;                 
                    
                    var data =  await axios.get('api/member/getParentMembers/'+attachData.id).then(({data})=>{
                      let myObj = data;
                      newPlot = {...personal_info,...myObj};                          
                    });                  
                  this.personView  = newPlot;
                  jQuery('#viewModal').modal('show');                
                }
                catch (err) {                

                }
               
            },
            viewMemberImage(){
                if(!this.memberForm.photo || this.memberForm.photo === undefined){
                  return;
                }
                else{
                    return this.memberForm.photo.length > 150 ? this.memberForm.photo :this.memberForm.photo;
                }
            },
            changeRelation(){
                var add_info = '';

                if(this.memberForm.parent_id){
                    add_info = this.parentOrChildSearch;
                }

                if(this.memberForm.relation ==='f')
                {
                  this.memberForm.maritial_status = 1;
                  jQuery("#dynamic_add_info").html('You are adding <span  class="btn-warning">Parent of</span> '+add_info);
                }
                else if(this.memberForm.relation ==='w'){
                  this.memberForm.maritial_status = 1;
                  jQuery("#dynamic_add_info").html('You are adding <span  class="btn-warning">wife of</span> '+add_info);
                }
                else {
                  jQuery("#dynamic_add_info").html('You are adding <span  class="btn-warning">child of</span> '+add_info);
                }

                if(this.memberForm.relation === 'f-choose')
                {
                  // If this field selected it means we have already entryed father name list 
                  // Search and Place father here 
                  jQuery("#search-entry-father").show();  
                  jQuery("#entry-member-name").hide();                  
                }
                else{
                    jQuery("#search-entry-father").hide();  
                    jQuery("#entry-member-name").show();  
                }



                if(this.memberForm.relation ==='w'){                 
                  jQuery("#ifIsRelation").hide();
                }else{
                  jQuery("#ifIsRelation").show();
                }
            },
            ecodeMemberPhotoUrl(e){           
            let file = e.target.files[0];

            if(file['size'] < 2111775){            
                  let output = document.getElementById('output_member_photo');
                  output.src = URL.createObjectURL(e.target.files[0]);
                  output.onload = function() {
                    URL.revokeObjectURL(output.src); // free memory
                  }                
                  let reader = new FileReader();
                  reader.onload = (file)=>{
                    this.memberForm.photo = reader.result;
                  }
                  reader.readAsDataURL(file);
             }else{              
               swal.fire({
                  icon: 'info',
                  title: 'Oops... file size is exceed 2 mb',
                  text: 'Please upload smaller size upto 2 MB'
                });
            }
            
          }, 
            captureAsImage(){              
            document.getElementById("personal_infomation").style.height = 'auto';
            document.getElementById("personal_infomation").style.overflow = 'show';
              html2canvas(document.querySelector("#personal_infomation")).then(canvas => {
              var img = canvas.toDataURL()
                window.open(img);
              });
            },
            async createMember() {                
              try {
                  this.$Progress.start();    
                  this.memberForm.clear();
                  let parent_id_cp = this.memberForm.parent_id;
                  const resp = await axios.post('/api/member/saveParentChild/',this.memberForm);
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
                  this.$Progress.start();  
                  const resp = await axios.put('/api/member/updateParentChild/'+this.memberForm.id,this.memberForm);
                  toast.fire({
                      icon: resp.data.status,
                      title: resp.data.message
                  });
                  jQuery('#memberModal').modal('hide');    
                  //this.loadFamilyMembers();                  
                  this.$Progress.finish();
              } catch (err) {
                  this.$Progress.fail();
                  this.memberForm.errors.set(err.response.data.errors);
              }
            },             
            viewLarge(frmObj){
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
                        axios.delete('/api/member/'+id).then(response => {
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
            async searchParentOrChild(){
               
                 try {
                   var result =  await axios.get('/api/member/searchMember/',{ params: { queryParams: this.parentOrChildSearch }  }).then((
                    {data})=>{
                        if(data.status == 'success'){
                             this.searchMembers = data.data;
                            jQuery(".autocomplete-result-list").show();
                        }else{
                            //Write some error based on search
                            jQuery(".autocomplete-result-list").hide();
                        }
                  });                
                }
                catch (err) {           
                }

            },
            async searchParent(){
                 //search-entry-father
                //console.log("search parent");
                 try {
                   var result =  await axios.get('/api/member/searchMember/',{ params: { queryParams: this.parentSearch }  }).then((
                    {data})=>{
                        if(data.status == 'success'){
                             this.searchParents = data.data;
                            jQuery("#autocomplete-parent").show();
                        }else{
                            //Write some error based on search
                            jQuery("#autocomplete-parent").hide();
                        }
                  });                
                }
                catch (err) {           
                }

            },
            closeSearch(){
              jQuery(".autocomplete-result-list").hide();
            },
            parentChildChoosen(row){
              var fullname = (row.fname || " ")+' '+(row.mname || " ")+' '+(row.lname || " ");
              this.memberForm.parent_id = row.id;
              this.parentOrChildSearch = fullname;
              jQuery(".autocomplete-result-list").hide();
              //console.log(fullname);
            },
            parentChoosen(row){
              var fullname = (row.fname || " ")+' '+(row.mname || " ")+' '+(row.lname || " ");
              this.memberForm.parent_id = row.id;
              this.parentSearch = fullname;
              jQuery(".autocomplete-result-list").hide();
              //console.log(fullname);
            },
            rowStyleClassFn(row){
                 return !row.email_verified_at  ? 'green' : '';
            }
        },
        mounted() {
        }
    }
</script>