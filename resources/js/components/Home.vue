<template>
<div class="content-wrapper">
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <section class="col-lg-8 col-md-8  connectedSortable ui-sortable">
            <!-- Custom tabs (Charts with tabs)-->
            <div class="card">             
              <div class="card-body"><div class="tab-content"><div id="activity" class="tab-pane active"><div class="post"><div class="user-block"><img src="uploads/profile/1.jpg" alt="user image" class="img-circle img-bordered-sm"> <span class="username"><a href="#">Jonathan Burke Jr.</a> <a href="#" class="float-right btn-tool"><i class="fas fa-times"></i></a></span> <span class="description">Shared publicly - 7:30 PM today</span></div> <p>
                      Lorem ipsum represents a long-held tradition for designers,
                      typographers and the like. Some people hate it and argue for
                      its demise, but others ignore the hate as they create awesome
                      tools to help create filler text for everyone from bacon lovers
                      to Charlie Sheen fans.
                    </p> <p><a href="#" class="link-black text-sm mr-2"><i class="fas fa-share mr-1"></i> Share</a> <a href="#" class="link-black text-sm"><i class="far fa-thumbs-up mr-1"></i> Like</a> <span class="float-right"><a href="#" class="link-black text-sm"><i class="far fa-comments mr-1"></i> Comments (5)
                        </a></span></p> <input type="text" placeholder="Type a comment" class="form-control form-control-sm"></div> <div class="post clearfix"><div class="user-block"><img src="uploads/profile/1.jpg" alt="User Image" class="img-circle img-bordered-sm"> <span class="username"><a href="#">Sarah Ross</a> <a href="#" class="float-right btn-tool"><i class="fas fa-times"></i></a></span> <span class="description">Sent you a message - 3 days ago</span></div> <p>
                      Lorem ipsum represents a long-held tradition for designers,
                      typographers and the like. Some people hate it and argue for
                      its demise, but others ignore the hate as they create awesome
                      tools to help create filler text for everyone from bacon lovers
                      to Charlie Sheen fans.
                    </p> <form class="form-horizontal"><div class="input-group input-group-sm mb-0"><input placeholder="Response" class="form-control form-control-sm"> <div class="input-group-append"><button type="submit" class="btn btn-danger">Send</button></div></div></form></div> <div class="post"><div class="user-block"><img src="uploads/profile/2.jpg" alt="User Image" class="img-circle img-bordered-sm"> <span class="username"><a href="#">Adam Jones</a> <a href="#" class="float-right btn-tool"><i class="fas fa-times"></i></a></span> <span class="description">Posted 5 photos - 5 days ago</span></div> <div class="row mb-3"><div class="col-sm-6"><img src="uploads/profile/1-photos-1.jpg" alt="Photo" class="img-fluid"></div> <div class="col-sm-6"><div class="row"><div class="col-sm-6">
                        <img src="uploads/profile/1-photos-2.jpg" alt="Photo" class="img-fluid mb-3"> <img src="uploads/profile/1-photos-1.jpg" alt="Photo" class="img-fluid"></div> <div class="col-sm-6"><img src="uploads/profile/1-photos-4.jpg" alt="Photo" class="img-fluid mb-3"> <img src="uploads/profile/1-photos-5.jpg" alt="Photo" class="img-fluid"></div></div></div></div> <p><a href="#" class="link-black text-sm mr-2"><i class="fas fa-share mr-1"></i> Share</a> <a href="#" class="link-black text-sm"><i class="far fa-thumbs-up mr-1"></i> Like</a> <span class="float-right"><a href="#" class="link-black text-sm"><i class="far fa-comments mr-1"></i> Comments (5)
                        </a></span></p> <input type="text" placeholder="Type a comment" class="form-control form-control-sm"></div></div> <div id="timeline" class="tab-pane"><div class="timeline timeline-inverse"><div class="time-label"><span class="bg-danger">
                        10 Feb. 2014
                      </span></div> <div><i class="fas fa-envelope bg-primary"></i> <div class="timeline-item"><span class="time"><i class="far fa-clock"></i> 12:05</span> <h3 class="timeline-header"><a href="#">Support Team</a> sent you an email</h3> <div class="timeline-body">
                          Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                          weebly ning heekya handango imeem plugg dopplr jibjab, movity
                          jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
                          quora plaxo ideeli hulu weebly balihoo...
                        </div> <div class="timeline-footer"><a href="#" class="btn btn-primary btn-sm">Read more</a> <a href="#" class="btn btn-danger btn-sm">Delete</a></div></div></div> <div><i class="fas fa-user bg-info"></i> <div class="timeline-item"><span class="time"><i class="far fa-clock"></i> 5 mins ago</span> <h3 class="timeline-header border-0"><a href="#">Sarah Young</a> accepted your friend request
                        </h3></div></div> <div><i class="fas fa-comments bg-warning"></i> <div class="timeline-item"><span class="time"><i class="far fa-clock"></i> 27 mins ago</span> <h3 class="timeline-header"><a href="#">Jay White</a> commented on your post</h3> <div class="timeline-body">
                          Take me to your leader!
                          Switzerland is small and neutral!
                          We are more like Germany, ambitious and misunderstood!
                        </div> <div class="timeline-footer"><a href="#" class="btn btn-warning btn-flat btn-sm">View comment</a></div></div></div> <div class="time-label"><span class="bg-success">
                        3 Jan. 2014
                      </span></div> <div><i class="fas fa-camera bg-purple"></i> <div class="timeline-item"><span class="time"><i class="far fa-clock"></i> 2 days ago</span> <h3 class="timeline-header"><a href="#">Mina Lee</a> uploaded new photos</h3> <div class="timeline-body"><img src="uploads/profile/1-photos-3.jpg" alt="..."> <img src="uploads/profile/1-photos-2.jpg" alt="..."> <img src="uploads/profile/1-photos-3.jpg" alt="..."> <img src="uploads/profile/1-photos-4.jpg" alt="..."></div></div></div> <div><i class="far fa-clock bg-gray"></i></div></div></div> <div id="settings" class="tab-pane"><form class="form-horizontal"><div class="form-group row"><label for="inputName" class="col-sm-2 col-md-2 col-form-label">Name</label> <div class="col-sm-4 col-md-4"><input type="email" id="inputName" placeholder="First" class="form-control"></div> <div class="col-sm-3 col-md-3"><input type="email" id="inputName" placeholder="Middle" class="form-control"></div> <div class="col-sm-3 col-md-3"><input type="email" id="inputName" placeholder="Last" class="form-control"></div></div> <div class="form-group row"><label for="email" class="col-sm-2 col-form-label">Email</label> <div class="col-sm-10"><input type="email" name="email" id="email" placeholder="Email" class="form-control"></div></div> <div class="form-group row"><label for="mobile" class="col-sm-2 col-form-label">Mobile</label> <div class="col-sm-10"><input type="input" name="mobile" id="mobile" placeholder="Mobile" class="form-control"></div></div> <div class="form-group row"><label for="phone" class="col-sm-2 col-form-label">Phone</label> <div class="col-sm-10"><input type="input" name="phone" id="phone" placeholder="phone" class="form-control"></div></div> <div class="form-group row"><div class="offset-sm-2 col-sm-10"><div class="checkbox"><label><input type="checkbox"> check if you also want to login from mobile.
                          </label></div></div></div> <div class="form-group row"><label for="photo" class="col-sm-2 col-form-label">Photo</label> <div class="col-sm-10"><input type="file" name="photo" id="photo" placeholder="Passport Photo" class="form-control"></div></div> <div class="form-group row"><label for="dob" class="col-sm-2 col-form-label">Date of Birth</label> <div class="col-sm-5"><input type="input" name="dob" id="dob" placeholder="Date" class="form-control"></div> <div class="col-sm-5"><input type="input" name="dob_time" id="dob_time" placeholder="Time" class="form-control"></div></div> <div class="form-group row"><label for="gender" class="col-sm-2 col-form-label">Gender</label> <div class="col-sm-4"><select name="gender" id="gender"><option value="m">Male</option> <option value="f">Female</option></select></div> <label for="maritial_status" class="col-sm-3 col-form-label text-right">Maritial Status</label> <div class="col-sm-3 pull-left"><input type="radio" name="maritial_status" value="s"> Single
                        <input type="radio" name="maritial_status" value="m"> Married
                    </div></div> <div class="form-group row"></div> <div class="form-group row"><label for="current_address" class="col-sm-2 col-form-label">Current Address</label> <div class="col-sm-10"><input type="input" name="current_address" id="current_address" placeholder="Current Address" class="form-control"></div></div> <div class="form-group row"><label for="per_address" class="col-sm-2 col-form-label">Permanent</label> <div class="col-sm-10"><input type="input" name="per_address" id="per_address" placeholder="Permanent" class="form-control"></div></div> <div class="form-group row"><div class="offset-sm-2 col-sm-10"><button type="submit" class="btn btn-danger">Submit</button></div></div></form></div></div></div>
            </div>
            <!-- /.card -->

            <!-- DIRECT CHAT -->
            
            <!--/.direct-chat -->

            <!-- TO DO List -->
          
            <!-- /.card -->
          </section>
          <!-- /.Left col -->
          <!-- right col (We are only adding the ID to make the widgets sortable)-->
          <section class="col-lg-4 col-md-4  connectedSortable ui-sortable">
            <!-- Calendar -->
            <div class="card">
              <div class="card-header ui-sortable-handle" style="cursor: move;">
                <h3 class="card-title">
                  <i class="ion ion-clipboard mr-1"></i>
                  To Do List
                </h3>

                <div class="card-tools">
                  <ul class="pagination pagination-sm">
                    <li class="page-item"><a href="#" class="page-link">«</a></li>
                    <li class="page-item"><a href="#" class="page-link">1</a></li>
                    <li class="page-item"><a href="#" class="page-link">2</a></li>
                    <li class="page-item"><a href="#" class="page-link">3</a></li>
                    <li class="page-item"><a href="#" class="page-link">»</a></li>
                  </ul>
                </div>
              </div>
              <div class="body">
                <ul class="todo-list ui-sortable" data-widget="todo-list">
                  
                  <li class="done">
                   
                    <div class="icheck-primary d-inline ml-2">
                      <input type="checkbox" value="" name="todo2" id="todoCheck2" checked="">
                      <label for="todoCheck2"></label>
                    </div>
                    <span class="text">Make the theme</span>
                    <small class="badge badge-info"><i class="far fa-clock"></i> 4 hours</small>
                    <div class="tools">
                      <i class="fas fa-edit"></i>
                      <i class="fas fa-trash-o"></i>
                    </div>
                  </li>
                  <li>
                    
                    <div class="icheck-primary d-inline ml-2">
                      <input type="checkbox" value="" name="todo3" id="todoCheck3">
                      <label for="todoCheck3"></label>
                    </div>
                    <span class="text">Let theme shine </span>
                    <small class="badge badge-warning"><i class="far fa-clock"></i> 1 day</small>
                    <div class="tools">
                      <i class="fas fa-edit"></i>
                      <i class="fas fa-trash-o"></i>
                    </div>
                  </li>
                  <li>
                   
                    <div class="icheck-primary d-inline ml-2">
                      <input type="checkbox" value="" name="todo4" id="todoCheck4">
                      <label for="todoCheck4"></label>
                    </div>
                    <span class="text">Let theme shine</span>
                    <small class="badge badge-success"><i class="far fa-clock"></i> 3 days</small>
                    <div class="tools">
                      <i class="fas fa-edit"></i>
                      <i class="fas fa-trash-o"></i>
                    </div>
                  </li>
                  <li>
                   
                    <div class="icheck-primary d-inline ml-2">
                      <input type="checkbox" value="" name="todo5" id="todoCheck5">
                      <label for="todoCheck5"></label>
                    </div>
                    <span class="text">Check your messages </span>
                    <small class="badge badge-primary"><i class="far fa-clock"></i> 1 week</small>
                    <div class="tools">
                      <i class="fas fa-edit"></i>
                      <i class="fas fa-trash-o"></i>
                    </div>
                  </li>
                  <li>
                  
                    <div class="icheck-primary d-inline ml-2">
                      <input type="checkbox" value="" name="todo6" id="todoCheck6">
                      <label for="todoCheck6"></label>
                    </div>
                    <span class="text">Let theme a star</span>
                    <small class="badge badge-secondary"><i class="far fa-clock"></i> 1 month</small>
                    <div class="tools">
                      <i class="fas fa-edit"></i>
                      <i class="fas fa-trash-o"></i>
                    </div>
                  </li>
                  <li style="" class="">
                    <div class="icheck-primary d-inline ml-2">
                      <input type="checkbox" value="" name="todo1" id="todoCheck1">
                      <label for="todoCheck1"></label>
                    </div>
                    <span class="text">Design a theme </span>
                    <small class="badge badge-danger"><i class="far fa-clock"></i> 2 mins</small>
                    <div class="tools">
                      <i class="fas fa-edit"></i>
                      <i class="fas fa-trash-o"></i>
                    </div>
                  </li>
                </ul>
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
                <button type="button" class="btn btn-info float-right"><i class="fas fa-plus"></i> Add item</button>
              </div>
            </div>
            <div class="card bg-gradient-success">
              <div class="card-header border-0 ui-sortable-handle" style="cursor: move;">

                <h3 class="card-title">
                  <i class="far fa-calendar-alt"></i>
                  Calendar
                </h3>
                <!-- tools card -->
                <div class="card-tools">
                  <!-- button with a dropdown -->
                  <div class="btn-group">
                    <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown">
                      <i class="fas fa-bars"></i></button>
                    <div class="dropdown-menu float-right" role="menu">
                      <a href="#" class="dropdown-item">Add new event</a>
                      <a href="#" class="dropdown-item">Clear events</a>
                      <div class="dropdown-divider"></div>
                      <a href="#" class="dropdown-item">View calendar</a>
                    </div>
                  </div>
                  <button type="button" class="btn btn-success btn-sm" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-success btn-sm" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
                <!-- /. tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body pt-0">
                <!--The calendar -->
                <div id="calendar" style="width: 100%"><div class="bootstrap-datetimepicker-widget usetwentyfour"><ul class="list-unstyled"><li class="show"><div class="datepicker"><div class="datepicker-days" style=""><table class="table table-sm"><thead><tr><th class="prev" data-action="previous"><span class="fa fa-chevron-left" title="Previous Month"></span></th><th class="picker-switch" data-action="pickerSwitch" colspan="5" title="Select Month">August 2020</th><th class="next" data-action="next"><span class="fa fa-chevron-right" title="Next Month"></span></th></tr><tr><th class="dow">Su</th><th class="dow">Mo</th><th class="dow">Tu</th><th class="dow">We</th><th class="dow">Th</th><th class="dow">Fr</th><th class="dow">Sa</th></tr></thead><tbody><tr><td data-action="selectDay" data-day="07/26/2020" class="day old weekend">26</td><td data-action="selectDay" data-day="07/27/2020" class="day old">27</td><td data-action="selectDay" data-day="07/28/2020" class="day old">28</td><td data-action="selectDay" data-day="07/29/2020" class="day old">29</td><td data-action="selectDay" data-day="07/30/2020" class="day old">30</td><td data-action="selectDay" data-day="07/31/2020" class="day old">31</td><td data-action="selectDay" data-day="08/01/2020" class="day weekend">1</td></tr><tr><td data-action="selectDay" data-day="08/02/2020" class="day weekend">2</td><td data-action="selectDay" data-day="08/03/2020" class="day">3</td><td data-action="selectDay" data-day="08/04/2020" class="day">4</td><td data-action="selectDay" data-day="08/05/2020" class="day">5</td><td data-action="selectDay" data-day="08/06/2020" class="day">6</td><td data-action="selectDay" data-day="08/07/2020" class="day">7</td><td data-action="selectDay" data-day="08/08/2020" class="day weekend">8</td></tr><tr><td data-action="selectDay" data-day="08/09/2020" class="day weekend">9</td><td data-action="selectDay" data-day="08/10/2020" class="day">10</td><td data-action="selectDay" data-day="08/11/2020" class="day">11</td><td data-action="selectDay" data-day="08/12/2020" class="day">12</td><td data-action="selectDay" data-day="08/13/2020" class="day">13</td><td data-action="selectDay" data-day="08/14/2020" class="day">14</td><td data-action="selectDay" data-day="08/15/2020" class="day weekend">15</td></tr><tr><td data-action="selectDay" data-day="08/16/2020" class="day weekend">16</td><td data-action="selectDay" data-day="08/17/2020" class="day">17</td><td data-action="selectDay" data-day="08/18/2020" class="day">18</td><td data-action="selectDay" data-day="08/19/2020" class="day active today">19</td><td data-action="selectDay" data-day="08/20/2020" class="day">20</td><td data-action="selectDay" data-day="08/21/2020" class="day">21</td><td data-action="selectDay" data-day="08/22/2020" class="day weekend">22</td></tr><tr><td data-action="selectDay" data-day="08/23/2020" class="day weekend">23</td><td data-action="selectDay" data-day="08/24/2020" class="day">24</td><td data-action="selectDay" data-day="08/25/2020" class="day">25</td><td data-action="selectDay" data-day="08/26/2020" class="day">26</td><td data-action="selectDay" data-day="08/27/2020" class="day">27</td><td data-action="selectDay" data-day="08/28/2020" class="day">28</td><td data-action="selectDay" data-day="08/29/2020" class="day weekend">29</td></tr><tr><td data-action="selectDay" data-day="08/30/2020" class="day weekend">30</td><td data-action="selectDay" data-day="08/31/2020" class="day">31</td><td data-action="selectDay" data-day="09/01/2020" class="day new">1</td><td data-action="selectDay" data-day="09/02/2020" class="day new">2</td><td data-action="selectDay" data-day="09/03/2020" class="day new">3</td><td data-action="selectDay" data-day="09/04/2020" class="day new">4</td><td data-action="selectDay" data-day="09/05/2020" class="day new weekend">5</td></tr></tbody></table></div><div class="datepicker-months" style="display: none;"><table class="table-condensed"><thead><tr><th class="prev" data-action="previous"><span class="fa fa-chevron-left" title="Previous Year"></span></th><th class="picker-switch" data-action="pickerSwitch" colspan="5" title="Select Year">2020</th><th class="next" data-action="next"><span class="fa fa-chevron-right" title="Next Year"></span></th></tr></thead><tbody><tr><td colspan="7"><span data-action="selectMonth" class="month">Jan</span><span data-action="selectMonth" class="month">Feb</span><span data-action="selectMonth" class="month">Mar</span><span data-action="selectMonth" class="month">Apr</span><span data-action="selectMonth" class="month">May</span><span data-action="selectMonth" class="month">Jun</span><span data-action="selectMonth" class="month">Jul</span><span data-action="selectMonth" class="month active">Aug</span><span data-action="selectMonth" class="month">Sep</span><span data-action="selectMonth" class="month">Oct</span><span data-action="selectMonth" class="month">Nov</span><span data-action="selectMonth" class="month">Dec</span></td></tr></tbody></table></div><div class="datepicker-years" style="display: none;"><table class="table-condensed"><thead><tr><th class="prev" data-action="previous"><span class="fa fa-chevron-left" title="Previous Decade"></span></th><th class="picker-switch" data-action="pickerSwitch" colspan="5" title="Select Decade">2020-2029</th><th class="next" data-action="next"><span class="fa fa-chevron-right" title="Next Decade"></span></th></tr></thead><tbody><tr><td colspan="7"><span data-action="selectYear" class="year old">2019</span><span data-action="selectYear" class="year active">2020</span><span data-action="selectYear" class="year">2021</span><span data-action="selectYear" class="year">2022</span><span data-action="selectYear" class="year">2023</span><span data-action="selectYear" class="year">2024</span><span data-action="selectYear" class="year">2025</span><span data-action="selectYear" class="year">2026</span><span data-action="selectYear" class="year">2027</span><span data-action="selectYear" class="year">2028</span><span data-action="selectYear" class="year">2029</span><span data-action="selectYear" class="year old">2030</span></td></tr></tbody></table></div><div class="datepicker-decades" style="display: none;"><table class="table-condensed"><thead><tr><th class="prev" data-action="previous"><span class="fa fa-chevron-left" title="Previous Century"></span></th><th class="picker-switch" data-action="pickerSwitch" colspan="5">2000-2090</th><th class="next" data-action="next"><span class="fa fa-chevron-right" title="Next Century"></span></th></tr></thead><tbody><tr><td colspan="7"><span data-action="selectDecade" class="decade old" data-selection="2006">1990</span><span data-action="selectDecade" class="decade" data-selection="2006">2000</span><span data-action="selectDecade" class="decade active" data-selection="2016">2010</span><span data-action="selectDecade" class="decade" data-selection="2026">2020</span><span data-action="selectDecade" class="decade" data-selection="2036">2030</span><span data-action="selectDecade" class="decade" data-selection="2046">2040</span><span data-action="selectDecade" class="decade" data-selection="2056">2050</span><span data-action="selectDecade" class="decade" data-selection="2066">2060</span><span data-action="selectDecade" class="decade" data-selection="2076">2070</span><span data-action="selectDecade" class="decade" data-selection="2086">2080</span><span data-action="selectDecade" class="decade" data-selection="2096">2090</span><span data-action="selectDecade" class="decade old" data-selection="2106">2100</span></td></tr></tbody></table></div></div></li><li class="picker-switch accordion-toggle"></li></ul></div></div>
              </div>
              <!-- /.card-body -->
            </div>
            <div class="card direct-chat direct-chat-primary">
              <div class="card-header ui-sortable-handle" style="cursor: move;">
                <h3 class="card-title">Group Chat</h3>

                <div class="card-tools">
                  <span data-toggle="tooltip" title="3 New Messages" class="badge badge-primary">3</span>
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-toggle="tooltip" title="Contacts" data-widget="chat-pane-toggle">
                    <i class="fas fa-comments"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <!-- Conversations are loaded here -->
                <div class="direct-chat-messages">
                  <!-- Message. Default to the left -->
                  <div class="direct-chat-msg">
                    <div class="direct-chat-infos clearfix">
                      <span class="direct-chat-name float-left">Alexander Pierce</span>
                      <span class="direct-chat-timestamp float-right">23 Jan 2:00 pm</span>
                    </div>
                    <!-- /.direct-chat-infos -->
                    <img class="direct-chat-img" src="uploads/profile/1.png" alt="message user image">
                    <!-- /.direct-chat-img -->
                    <div class="direct-chat-text">
                      Is this template really for free? That's unbelievable!
                    </div>
                    <!-- /.direct-chat-text -->
                  </div>
                  <!-- /.direct-chat-msg -->

                  <!-- Message to the right -->
                  <div class="direct-chat-msg right">
                    <div class="direct-chat-infos clearfix">
                      <span class="direct-chat-name float-right">Sarah Bullock</span>
                      <span class="direct-chat-timestamp float-left">23 Jan 2:05 pm</span>
                    </div>
                    <!-- /.direct-chat-infos -->
                    <img class="direct-chat-img" src="uploads/profile/2.png" alt="message user image">
                    <!-- /.direct-chat-img -->
                    <div class="direct-chat-text">
                      You better believe it!
                    </div>
                    <!-- /.direct-chat-text -->
                  </div>
                  <!-- /.direct-chat-msg -->

                  <!-- Message. Default to the left -->
                  <div class="direct-chat-msg">
                    <div class="direct-chat-infos clearfix">
                      <span class="direct-chat-name float-left">Alexander Pierce</span>
                      <span class="direct-chat-timestamp float-right">23 Jan 5:37 pm</span>
                    </div>
                    <!-- /.direct-chat-infos -->
                    <img class="direct-chat-img" src="uploads/profile/3.png" alt="message user image">
                    <!-- /.direct-chat-img -->
                    <div class="direct-chat-text">
                      Working with AdminLTE on a great new app! Wanna join?
                    </div>
                    <!-- /.direct-chat-text -->
                  </div>
                  <!-- /.direct-chat-msg -->

                  <!-- Message to the right -->
                  <div class="direct-chat-msg right">
                    <div class="direct-chat-infos clearfix">
                      <span class="direct-chat-name float-right">Sarah Bullock</span>
                      <span class="direct-chat-timestamp float-left">23 Jan 6:10 pm</span>
                    </div>
                    <!-- /.direct-chat-infos -->
                    <img class="direct-chat-img" src="uploads/profile/4.png" alt="message user image">
                    <!-- /.direct-chat-img -->
                    <div class="direct-chat-text">
                      I would love to.
                    </div>
                    <!-- /.direct-chat-text -->
                  </div>
                  <!-- /.direct-chat-msg -->

                </div>
                <!--/.direct-chat-messages-->

                <!-- Contacts are loaded here -->
                <div class="direct-chat-contacts">
                  <ul class="contacts-list">
                    <li>
                      <a href="#">
                        <img class="contacts-list-img" src="uploads/profile/5.png">

                        <div class="contacts-list-info">
                          <span class="contacts-list-name">
                            Count Dracula
                            <small class="contacts-list-date float-right">2/28/2015</small>
                          </span>
                          <span class="contacts-list-msg">How have you been? I was...</span>
                        </div>
                      </a>
                    </li>
                    <li>
                      <a href="#">
                        <img class="contacts-list-img" src="uploads/profile/6.png">

                        <div class="contacts-list-info">
                          <span class="contacts-list-name">
                            Sarah Doe
                            <small class="contacts-list-date float-right">2/23/2015</small>
                          </span>
                          <span class="contacts-list-msg">I will be waiting for...</span>
                        </div>
                      </a>
                    </li>
                    <li>
                      <a href="#">
                        <img class="contacts-list-img" src="uploads/profile/1.png">

                        <div class="contacts-list-info">
                          <span class="contacts-list-name">
                            Nadia Jolie
                            <small class="contacts-list-date float-right">2/20/2015</small>
                          </span>
                          <span class="contacts-list-msg">I'll call you back at...</span>
                        </div>
                      </a>
                    </li>
                    <li>
                      <a href="#">
                        <img class="contacts-list-img" src="uploads/profile/3.png">

                        <div class="contacts-list-info">
                          <span class="contacts-list-name">
                            Nora S. Vans
                            <small class="contacts-list-date float-right">2/10/2015</small>
                          </span>
                          <span class="contacts-list-msg">Where is your new...</span>
                        </div>
                      </a>
                    </li>
                    <li>
                      <a href="#">
                        <img class="contacts-list-img" src="uploads/profile/2.png">

                        <div class="contacts-list-info">
                          <span class="contacts-list-name">
                            John K.
                            <small class="contacts-list-date float-right">1/27/2015</small>
                          </span>
                          <span class="contacts-list-msg">Can I take a look at...</span>
                        </div>
                      </a>
                    </li>
                    <li>
                      <a href="#">
                        <img class="contacts-list-img" src="uploads/profile/4.png">

                        <div class="contacts-list-info">
                          <span class="contacts-list-name">
                            Kenneth M.
                            <small class="contacts-list-date float-right">1/4/2015</small>
                          </span>
                          <span class="contacts-list-msg">Never mind I found...</span>
                        </div>
                      </a>
                    </li>
                  </ul>
                </div>
              </div>
              <div class="card-footer">
                <form action="#" method="post">
                  <div class="input-group">
                    <input type="text" name="message" placeholder="Type Message ..." class="form-control">
                    <span class="input-group-append">
                      <button type="button" class="btn btn-primary">Send</button>
                    </span>
                  </div>
                </form>
              </div>
            </div>
              
            <!-- /.card -->
          </section>
          <!-- right col -->
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
</div>
</template>

<script>
    export default {
        mounted() {
            console.log('Home Component mounted.')
        }
    }
</script>
