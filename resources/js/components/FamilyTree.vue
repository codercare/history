<template>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Family Tree View</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Family</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header" >
              <h3 class="card-title">Members Listing</h3>  
                      
            </div>
            <!-- /.card-header -->
            <div class="card-body" >
              <div class="row col-md-12 mb-3">
              <button class=" col-md-2 col-sm-4"  @click="captureAsImage">Download Image</button>
              <!-- <div  class="col-md-5"></div> -->
              <div  class="offset-md-5 col-md-2 col-sm-4 text-right">Choose View</div>
              <select id="listingType" class="form-control pull-right col-md-3 col-sm-4" @change="changeListingView" v-model="listingType" >
                <option value='1'> List Sons Only</option>
                <option value='2'> List Sons & Doughter Only</option>
                <option value='3'> List All Family Members</option>
              </select>   
              </div>

              <div class="row col-md-12 mx-auto" id="TreeViewFamily" style="overflow:auto">
              <TreeChart :json="treeData" /> 
              </div>
            </div>
          </div>          
        </div>
        </div>
    </section>
</div>
</template>

<script>
      // jQuery(".avat").click(function() {
      //       // alert("image hovered");
      //       // $( this ).fadeOut( 100 );
      //       // $( this ).fadeIn( 500 );
      //       console.log("image Hovered");
      // });  
   
    export default {
        
        components: {
    	      TreeChart
        },
        data() {
            return {
              treeData: {
              },
              listingType:'1',
              show : false,
              event : {},
              one : 'one4',
              two : 'two'
            }
        },
        methods: {
          captureAsImage(){              
            document.getElementById("TreeViewFamily").style.height = 'auto';
            document.getElementById("TreeViewFamily").style.overflow = 'show';
            html2canvas(document.querySelector("#TreeViewFamily")).then(canvas => {
             var img = canvas.toDataURL()
              window.open(img);
            });
            console.log('Image Captured');
         },
         viewLargePhoto(memObj){
            jQuery('#imagePreview').modal('show');
            let fullname = (memObj.fname || " ")+' '+(memObj.mname || " ")+' '+(memObj.lname || " ");
            jQuery("#MemberNameDisp").html(fullname);
            jQuery("#MemberImageDisp").attr('src','uploads/profile/2/'+memObj.photo);
            console.log(memObj.photo);
          },
          changeListingView(){
            //console.log("Change view Type",this.listingType);
            this.loadTreeData(this.listingType);

          },
          async loadTreeData(type){             
           try {
             this.$Progress.start();  
             var data =  await axios.get('api/member/getFamilyTree/'+type).then(({data})=>{
               if(data){
                    //console.log(data);
                    this.treeData = data;
               }                                          
              });  
              this.$Progress.finish();
           }
           catch (err) {             
             this.$Progress.fail();              
           }           
          }
        },
        mounted() {
            this.loadTreeData(this.listingType);
            //console.log('Tree View Mounted.')

            jQuery('.avat').on("click", function(event) {
              //console.log('Test button Clicked here this');
              jQuery(this).trigger("custom", ["1st", "2nd"]);
            });

            jQuery("#TreeViewFamily .avat").on("click", function(event) {
                  console.log("image hovered");
                  jQuery( this ).addClass( "hover" );
            }, function() {
                  console.log("image hovered removed");
                  jQuery( this ).removeClass( "hover" );
            }
            );


            // let _this = this;   
            // jQuery(document).on("custom", function(event, one, two) {              
            //   console.log(event, 'event');
            //   console.log(one, 'one');
            //   console.log(two, 'two');
              
            //   _this.event = event;
            //   _this.one = one;
            //   _this.two = two;
              
            //   _this.show = true;              
            // });
        }
        }
        
        
        

</script>
