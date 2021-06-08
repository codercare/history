<template>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Invalid Try</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">404 page</li>
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
              <h3 class="card-title">404 Page</h3>  
               
            </div>
            <!-- /.card-header -->
            <div class="card-body" >             
                <p>Your requested page is not authorized to access or invalid.</p>   
            </div>
          </div>          
        </div>
        </div>
    </section>
</div>
</template>

<script>
   
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


            let _this = this;   
            jQuery(document).on("custom", function(event, one, two) {              
              console.log(event, 'event');
              console.log(one, 'one');
              console.log(two, 'two');
              
              _this.event = event;
              _this.one = one;
              _this.two = two;
              
              _this.show = true;              
            });
        }
        }
        
        
        

</script>
