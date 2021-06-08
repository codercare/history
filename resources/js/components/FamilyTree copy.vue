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
        <div class="col-12">
          <div class="card">
            <div class="card-header" >
              <h3 class="card-title">Members Listing</h3>             
            </div>
            <!-- /.card-header -->
            <div class="card-body" >
              <button @click="captureAsImage">Download Image</button>
              <div id="TreeViewFamily" style="overflow:auto">
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
    export default {
        components: {
    	TreeChart
        },
        data() {
            return {
                treeData: {
                name: 'Udara Bhandari',
                image_url: "uploads/profile/test/8.png",
                class: ["rootNode"],
                children: [
                  {
                    name: 'Ganesh Singh Bhandari',
                    image_url: "uploads/profile/test/2.jpg",
                    extend:false,
                    mate: {
                      name: 'Charumati Devi',
                      image_url: "uploads/profile/test/1.jpg"
                    },
                    children: [
                      {
                        name: 'Kalawati',
                        image_url: "uploads/profile/test/6.png"
                      },
                      {
                        name: 'Basanti',
                        image_url: "uploads/profile/test/4.jpg"
                      },
                      {
                        name: 'Gita',
                        image_url: "uploads/profile/test/2.jpg"
                      },
                      {
                        name: 'Dinesh Bhandari',
                        image_url: "uploads/profile/test/3.jpg",
                        extend:false,
                        mate: {
                          name: 'Sabina',
                          image_url: "uploads/profile/test/4.jpg"
                        },
                          children: [
                            {
                              name: 'Dristika Bhandari',
                              image_url: "uploads/profile/test/2.jpg"
                            }]
                      },  
                      {
                        name: 'Tulashi',
                        image_url: "uploads/profile/test/7.png"
                      },        
                      {
                        name: 'Prakash',
                        image_url: "uploads/profile/test/3.jpg"
                      }
                    ]
                  },
                  {
                    name: 'Nar Bahadur Bhandari',
                    image_url: "uploads/profile/test/2.jpg",
                    extend:false,
                    mate: {
                      name: 'Aunti',
                      image_url: "uploads/profile/test/2.jpg"
                    },
                    children: [
                      {
                        name: 'Nabin Bhandari',
                        image_url: "uploads/profile/test/2.jpg",
                        extend:false,
                        children: [
                            {
                              name: 'NSon1',
                              image_url: "uploads/profile/test/2.jpg"
                            },
                            {
                              name: 'NDoughter1',
                              image_url: "uploads/profile/test/2.jpg"
                            }
                            ]

                      },
                      {
                        name: 'Dharmanand Bhandari',
                        image_url: "uploads/profile/test/2.jpg",
                        extend:false,
                        children: [
                            {
                              name: 'DSon1',
                              image_url: "uploads/profile/test/2.jpg"
                            }
                            ]
                      }
                    ]
                  },
                  {
                    name: 'Krishna Bhandari',
                    image_url: "uploads/profile/test/2.jpg",
                    children: [
                      {
                        name: 'Jethi',
                        image_url: "uploads/profile/test/6.png"
                      },
                      {
                        name: 'Sashi',
                        image_url: "uploads/profile/test/4.jpg"
                      },
                      {
                        name: 'Mahili',
                        image_url: "uploads/profile/test/2.jpg"
                      },
                      {
                        name: 'Kanchi',
                        image_url: "uploads/profile/test/7.png"
                      }
                    ]
                  }
                  ,
                  {
                    name: 'Birendra Bhandari',
                    image_url: "uploads/profile/test/2.jpg",
                    extend:false,
                    children: [
                      {
                        name: 'Aman',
                        image_url: "uploads/profile/test/6.png"
                      },
                      {
                        name: 'Akash',
                        image_url: "uploads/profile/test/4.jpg"
                      }
                    ]
                  }
                ]
              }
            }
        },
        methods: {
          captureAsImage(){  
            
            document.getElementById("TreeViewFamily").style.height = 'auto';
            //document.getElementById("TreeViewFamily").style.width = 'auto';
            document.getElementById("TreeViewFamily").style.overflow = 'show';

            html2canvas(document.querySelector("#TreeViewFamily")).then(canvas => {
              //document.body.appendChild(canvas);
              var img = canvas.toDataURL()
              window.open(img);
            });
            console.log('Image Captured Image');
         }
        }
    }
</script>
