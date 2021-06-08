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
        <div class="col-md-12">
           
                    <div class="card-header">Users</div>

                    <div class="card-body">
                        <vue-good-table
                                mode="remote"
                                :columns="columns"
                                :rows="rows"
                                :globalSearch="true"
                                :search-options="{
                                    enabled: true,
                                    skipDiacritics: true,
                                }"
                                @on-search="onSearch"
                                styleClass="table table-bordered table-striped"
                                :sort-options="{
                                enabled: true,
                                initialSortBy: {field: 'name', type: 'asc'}
                                }"
                                :pagination-options="{
                                    enabled: true,
                                    mode: 'pages',  // 'pages' to jump input or  'records'
                                    perPage: 5,
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
                                >
                            <template slot="table-row" slot-scope="props">
                        <span v-if="props.column.field === 'S.No'">

                         {{ (users.per_page * (users.current_page - 1)) + (props.index + 1)
                          }}
                        </span>
                                <span v-else>
                    {{props.formattedRow[props.column.field]}}
                  </span>
                            </template>
                        </vue-good-table>
                    </div>
               
        </div>
      </div>
      <!-- /.row -->
    </section>
 
    <!-- /.content -->
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
                users: {
                    searchTerm: '',
                    total: 0,
                    per_page: 5,
                    from: 1,
                    to: 0,
                    current_page: 1
                },
                offset: 4,
                columns: [
                    {
                        label: 'S.No',
                        field: 'S.No'
                    },
                    {
                        label: 'Full Name',
                        field: 'name',
                        filterable: true
                    },
                    {
                        label: 'Email',
                        field: 'email',
                        filterable: true
                    },
                    {
                        label: 'Created At',
                        field: 'created_at',
                        filterable: true
                    },
                    {
                        label: 'Modify',
                        field: 'modify',
                        filterable: false
                    },
                ],
                rows: []
            }
        },
        mounted() {
            this.getRecords()
        },
        methods: {

            getRecords() {
                return axios.get('/api/user?searchTerm='+this.users.searchTerm).then((response)=>{
                      this.rows = response.data.data
                      this.users = response.data
                      //console.log('data->',response.data.data)
                })
                // return axios.get(`${this.endpoint}?searchTerm=${this.users.searchTerm}`).then((response) => {
                    // this.rows = response.data.users.data
                    // this.users = response.data.users
                // })
            },
            updateParams(newProps) {
                this.users = Object.assign({}, this.users, newProps);
            },
            onSearch: _.debounce(function (params) {
                this.updateParams(params);
                this.getRecords();
                return false;
            }, 500)
        }
    }
</script>
