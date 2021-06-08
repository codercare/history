<template>
<div class="content-wrapper" style="min-height: 1074px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Calendar</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Calendar</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">
            <div class="sticky-top mb-3">
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title">Draggable Events</h4>
                </div>
                <div class="card-body">
                  <!-- the events -->
                  <div id="external-events">
                    <div class="external-event bg-success ui-draggable ui-draggable-handle" style="position: relative;">Lunch</div>
                    <div class="external-event bg-warning ui-draggable ui-draggable-handle" style="position: relative;">Go home</div>
                    <div class="external-event bg-info ui-draggable ui-draggable-handle" style="position: relative;">Do homework</div>
                    <div class="external-event bg-primary ui-draggable ui-draggable-handle" style="position: relative;">Work on UI design</div>
                    <div class="external-event bg-danger ui-draggable ui-draggable-handle" style="position: relative;">Sleep tight</div>
                    <div class="checkbox">
                      <label for="drop-remove">
                        <input type="checkbox" id="drop-remove">
                        remove after drop
                      </label>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Create Event</h3>
                </div>
                <div class="card-body">
                  <div class="btn-group" style="width: 100%; margin-bottom: 10px;">
                    <!--<button type="button" id="color-chooser-btn" class="btn btn-info btn-block dropdown-toggle" data-toggle="dropdown">Color <span class="caret"></span></button>-->
                    <ul class="fc-color-picker" id="color-chooser">
                      <li><a class="text-primary" href="#"><i class="fas fa-square"></i></a></li>
                      <li><a class="text-warning" href="#"><i class="fas fa-square"></i></a></li>
                      <li><a class="text-success" href="#"><i class="fas fa-square"></i></a></li>
                      <li><a class="text-danger" href="#"><i class="fas fa-square"></i></a></li>
                      <li><a class="text-muted" href="#"><i class="fas fa-square"></i></a></li>
                    </ul>
                  </div>
                  <!-- /btn-group -->
                  <div class="input-group">
                    <input id="new-event" type="text" class="form-control" placeholder="Event Title">

                    <div class="input-group-append">
                      <button id="add-new-event" type="button" class="btn btn-primary">Add</button>
                    </div>
                    <!-- /btn-group -->
                  </div>
                  <!-- /input-group -->
                </div>
              </div>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card card-primary">
              <div class="card-body p-0">
                <!-- THE CALENDAR -->
                <div id="calendar" style="" class="fc fc-ltr fc-bootstrap"><div class="fc-toolbar fc-header-toolbar"><div class="fc-left"><div class="btn-group"><button type="button" class="fc-prev-button btn btn-primary" aria-label="prev"><span class="fa fa-chevron-left"></span></button><button type="button" class="fc-next-button btn btn-primary" aria-label="next"><span class="fa fa-chevron-right"></span></button></div><button type="button" class="fc-today-button btn btn-primary" disabled="">today</button></div><div class="fc-center"><h2>August 2020</h2></div><div class="fc-right"><div class="btn-group"><button type="button" class="fc-dayGridMonth-button btn btn-primary active">month</button><button type="button" class="fc-timeGridWeek-button btn btn-primary">week</button><button type="button" class="fc-timeGridDay-button btn btn-primary">day</button></div></div></div><div class="fc-view-container"><div class="fc-view fc-dayGridMonth-view fc-dayGrid-view" style=""><table class="table-bordered"><thead class="fc-head"><tr><td class="fc-head-container "><div class="fc-row table-bordered"><table class="table-bordered"><thead><tr><th class="fc-day-header  fc-sun"><span>Sun</span></th><th class="fc-day-header  fc-mon"><span>Mon</span></th><th class="fc-day-header  fc-tue"><span>Tue</span></th><th class="fc-day-header  fc-wed"><span>Wed</span></th><th class="fc-day-header  fc-thu"><span>Thu</span></th><th class="fc-day-header  fc-fri"><span>Fri</span></th><th class="fc-day-header  fc-sat"><span>Sat</span></th></tr></thead></table></div></td></tr></thead><tbody class="fc-body"><tr><td class=""><div class="fc-scroller fc-day-grid-container" style="overflow: hidden; height: 515.4px;"><div class="fc-day-grid"><div class="fc-row fc-week table-bordered" style="height: 85px;"><div class="fc-bg"><table class="table-bordered"><tbody><tr><td class="fc-day  fc-sun fc-other-month fc-past" data-date="2020-07-26"></td><td class="fc-day  fc-mon fc-other-month fc-past" data-date="2020-07-27"></td><td class="fc-day  fc-tue fc-other-month fc-past" data-date="2020-07-28"></td><td class="fc-day  fc-wed fc-other-month fc-past" data-date="2020-07-29"></td><td class="fc-day  fc-thu fc-other-month fc-past" data-date="2020-07-30"></td><td class="fc-day  fc-fri fc-other-month fc-past" data-date="2020-07-31"></td><td class="fc-day  fc-sat fc-past" data-date="2020-08-01"></td></tr></tbody></table></div><div class="fc-content-skeleton"><table><thead><tr><td class="fc-day-top fc-sun fc-other-month fc-past" data-date="2020-07-26"><span class="fc-day-number">26</span></td><td class="fc-day-top fc-mon fc-other-month fc-past" data-date="2020-07-27"><span class="fc-day-number">27</span></td><td class="fc-day-top fc-tue fc-other-month fc-past" data-date="2020-07-28"><span class="fc-day-number">28</span></td><td class="fc-day-top fc-wed fc-other-month fc-past" data-date="2020-07-29"><span class="fc-day-number">29</span></td><td class="fc-day-top fc-thu fc-other-month fc-past" data-date="2020-07-30"><span class="fc-day-number">30</span></td><td class="fc-day-top fc-fri fc-other-month fc-past" data-date="2020-07-31"><span class="fc-day-number">31</span></td><td class="fc-day-top fc-sat fc-past" data-date="2020-08-01"><span class="fc-day-number">1</span></td></tr></thead><tbody><tr><td></td><td></td><td></td><td></td><td></td><td></td><td class="fc-event-container"><a class="fc-day-grid-event fc-h-event fc-event fc-start fc-end fc-draggable fc-resizable" style="background-color:#f56954;border-color:#f56954"><div class="fc-content"> <span class="fc-title">All Day Event</span></div><div class="fc-resizer fc-end-resizer"></div></a></td></tr></tbody></table></div></div><div class="fc-row fc-week table-bordered" style="height: 85px;"><div class="fc-bg"><table class="table-bordered"><tbody><tr><td class="fc-day  fc-sun fc-past" data-date="2020-08-02"></td><td class="fc-day  fc-mon fc-past" data-date="2020-08-03"></td><td class="fc-day  fc-tue fc-past" data-date="2020-08-04"></td><td class="fc-day  fc-wed fc-past" data-date="2020-08-05"></td><td class="fc-day  fc-thu fc-past" data-date="2020-08-06"></td><td class="fc-day  fc-fri fc-past" data-date="2020-08-07"></td><td class="fc-day  fc-sat fc-past" data-date="2020-08-08"></td></tr></tbody></table></div><div class="fc-content-skeleton"><table><thead><tr><td class="fc-day-top fc-sun fc-past" data-date="2020-08-02"><span class="fc-day-number">2</span></td><td class="fc-day-top fc-mon fc-past" data-date="2020-08-03"><span class="fc-day-number">3</span></td><td class="fc-day-top fc-tue fc-past" data-date="2020-08-04"><span class="fc-day-number">4</span></td><td class="fc-day-top fc-wed fc-past" data-date="2020-08-05"><span class="fc-day-number">5</span></td><td class="fc-day-top fc-thu fc-past" data-date="2020-08-06"><span class="fc-day-number">6</span></td><td class="fc-day-top fc-fri fc-past" data-date="2020-08-07"><span class="fc-day-number">7</span></td><td class="fc-day-top fc-sat fc-past" data-date="2020-08-08"><span class="fc-day-number">8</span></td></tr></thead><tbody><tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr></tbody></table></div></div><div class="fc-row fc-week table-bordered" style="height: 85px;"><div class="fc-bg"><table class="table-bordered"><tbody><tr><td class="fc-day  fc-sun fc-past" data-date="2020-08-09"></td><td class="fc-day  fc-mon fc-past" data-date="2020-08-10"></td><td class="fc-day  fc-tue fc-past" data-date="2020-08-11"></td><td class="fc-day  fc-wed fc-past" data-date="2020-08-12"></td><td class="fc-day  fc-thu fc-past" data-date="2020-08-13"></td><td class="fc-day  fc-fri fc-past" data-date="2020-08-14"></td><td class="fc-day  fc-sat fc-past" data-date="2020-08-15"></td></tr></tbody></table></div><div class="fc-content-skeleton"><table><thead><tr><td class="fc-day-top fc-sun fc-past" data-date="2020-08-09"><span class="fc-day-number">9</span></td><td class="fc-day-top fc-mon fc-past" data-date="2020-08-10"><span class="fc-day-number">10</span></td><td class="fc-day-top fc-tue fc-past" data-date="2020-08-11"><span class="fc-day-number">11</span></td><td class="fc-day-top fc-wed fc-past" data-date="2020-08-12"><span class="fc-day-number">12</span></td><td class="fc-day-top fc-thu fc-past" data-date="2020-08-13"><span class="fc-day-number">13</span></td><td class="fc-day-top fc-fri fc-past" data-date="2020-08-14"><span class="fc-day-number">14</span></td><td class="fc-day-top fc-sat fc-past" data-date="2020-08-15"><span class="fc-day-number">15</span></td></tr></thead><tbody><tr><td></td><td></td><td></td><td></td><td></td><td class="fc-event-container" colspan="2"><a class="fc-day-grid-event fc-h-event fc-event fc-start fc-not-end fc-draggable" style="background-color:#f39c12;border-color:#f39c12"><div class="fc-content"><span class="fc-time">12a</span> <span class="fc-title">Long Event</span></div></a></td></tr></tbody></table></div></div><div class="fc-row fc-week table-bordered" style="height: 85px;"><div class="fc-bg"><table class="table-bordered"><tbody><tr><td class="fc-day  fc-sun fc-past" data-date="2020-08-16"></td><td class="fc-day  fc-mon fc-past" data-date="2020-08-17"></td><td class="fc-day  fc-tue fc-past" data-date="2020-08-18"></td><td class="fc-day  fc-wed fc-today alert alert-info" data-date="2020-08-19"></td><td class="fc-day  fc-thu fc-future" data-date="2020-08-20"></td><td class="fc-day  fc-fri fc-future" data-date="2020-08-21"></td><td class="fc-day  fc-sat fc-future" data-date="2020-08-22"></td></tr></tbody></table></div><div class="fc-content-skeleton"><table><thead><tr><td class="fc-day-top fc-sun fc-past" data-date="2020-08-16"><span class="fc-day-number">16</span></td><td class="fc-day-top fc-mon fc-past" data-date="2020-08-17"><span class="fc-day-number">17</span></td><td class="fc-day-top fc-tue fc-past" data-date="2020-08-18"><span class="fc-day-number">18</span></td><td class="fc-day-top fc-wed fc-today alert alert-info" data-date="2020-08-19"><span class="fc-day-number">19</span></td><td class="fc-day-top fc-thu fc-future" data-date="2020-08-20"><span class="fc-day-number">20</span></td><td class="fc-day-top fc-fri fc-future" data-date="2020-08-21"><span class="fc-day-number">21</span></td><td class="fc-day-top fc-sat fc-future" data-date="2020-08-22"><span class="fc-day-number">22</span></td></tr></thead><tbody><tr><td class="fc-event-container" rowspan="2"><a class="fc-day-grid-event fc-h-event fc-event fc-not-start fc-end fc-draggable" style="background-color:#f39c12;border-color:#f39c12"><div class="fc-content"> <span class="fc-title">Long Event</span></div></a></td><td rowspan="2"></td><td rowspan="2"></td><td class="fc-event-container"><a class="fc-day-grid-event fc-h-event fc-event fc-start fc-end fc-draggable" style="background-color:#0073b7;border-color:#0073b7"><div class="fc-content"><span class="fc-time">10:30a</span> <span class="fc-title">Meeting</span></div></a></td><td class="fc-event-container" rowspan="2"><a class="fc-day-grid-event fc-h-event fc-event fc-start fc-end fc-draggable" style="background-color:#00a65a;border-color:#00a65a"><div class="fc-content"><span class="fc-time">7p</span> <span class="fc-title">Birthday Party</span></div></a></td><td rowspan="2"></td><td rowspan="2"></td></tr><tr><td class="fc-event-container"><a class="fc-day-grid-event fc-h-event fc-event fc-start fc-end fc-draggable" style="background-color:#00c0ef;border-color:#00c0ef"><div class="fc-content"><span class="fc-time">12p</span> <span class="fc-title">Lunch</span></div></a></td></tr></tbody></table></div></div><div class="fc-row fc-week table-bordered" style="height: 85px;"><div class="fc-bg"><table class="table-bordered"><tbody><tr><td class="fc-day  fc-sun fc-future" data-date="2020-08-23"></td><td class="fc-day  fc-mon fc-future" data-date="2020-08-24"></td><td class="fc-day  fc-tue fc-future" data-date="2020-08-25"></td><td class="fc-day  fc-wed fc-future" data-date="2020-08-26"></td><td class="fc-day  fc-thu fc-future" data-date="2020-08-27"></td><td class="fc-day  fc-fri fc-future" data-date="2020-08-28"></td><td class="fc-day  fc-sat fc-future" data-date="2020-08-29"></td></tr></tbody></table></div><div class="fc-content-skeleton"><table><thead><tr><td class="fc-day-top fc-sun fc-future" data-date="2020-08-23"><span class="fc-day-number">23</span></td><td class="fc-day-top fc-mon fc-future" data-date="2020-08-24"><span class="fc-day-number">24</span></td><td class="fc-day-top fc-tue fc-future" data-date="2020-08-25"><span class="fc-day-number">25</span></td><td class="fc-day-top fc-wed fc-future" data-date="2020-08-26"><span class="fc-day-number">26</span></td><td class="fc-day-top fc-thu fc-future" data-date="2020-08-27"><span class="fc-day-number">27</span></td><td class="fc-day-top fc-fri fc-future" data-date="2020-08-28"><span class="fc-day-number">28</span></td><td class="fc-day-top fc-sat fc-future" data-date="2020-08-29"><span class="fc-day-number">29</span></td></tr></thead><tbody><tr><td></td><td></td><td></td><td></td><td></td><td class="fc-event-container"><a class="fc-day-grid-event fc-h-event fc-event fc-start fc-end fc-draggable" href="http://google.com/" style="background-color:#3c8dbc;border-color:#3c8dbc"><div class="fc-content"><span class="fc-time">12a</span> <span class="fc-title">Click for Google</span></div></a></td><td></td></tr></tbody></table></div></div><div class="fc-row fc-week table-bordered" style="height: 90px;"><div class="fc-bg"><table class="table-bordered"><tbody><tr><td class="fc-day  fc-sun fc-future" data-date="2020-08-30"></td><td class="fc-day  fc-mon fc-future" data-date="2020-08-31"></td><td class="fc-day  fc-tue fc-other-month fc-future" data-date="2020-09-01"></td><td class="fc-day  fc-wed fc-other-month fc-future" data-date="2020-09-02"></td><td class="fc-day  fc-thu fc-other-month fc-future" data-date="2020-09-03"></td><td class="fc-day  fc-fri fc-other-month fc-future" data-date="2020-09-04"></td><td class="fc-day  fc-sat fc-other-month fc-future" data-date="2020-09-05"></td></tr></tbody></table></div><div class="fc-content-skeleton"><table><thead><tr><td class="fc-day-top fc-sun fc-future" data-date="2020-08-30"><span class="fc-day-number">30</span></td><td class="fc-day-top fc-mon fc-future" data-date="2020-08-31"><span class="fc-day-number">31</span></td><td class="fc-day-top fc-tue fc-other-month fc-future" data-date="2020-09-01"><span class="fc-day-number">1</span></td><td class="fc-day-top fc-wed fc-other-month fc-future" data-date="2020-09-02"><span class="fc-day-number">2</span></td><td class="fc-day-top fc-thu fc-other-month fc-future" data-date="2020-09-03"><span class="fc-day-number">3</span></td><td class="fc-day-top fc-fri fc-other-month fc-future" data-date="2020-09-04"><span class="fc-day-number">4</span></td><td class="fc-day-top fc-sat fc-other-month fc-future" data-date="2020-09-05"><span class="fc-day-number">5</span></td></tr></thead><tbody><tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr></tbody></table></div></div></div></div></td></tr></tbody></table></div></div></div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Event Component mounted.')
        }
    }
</script>
