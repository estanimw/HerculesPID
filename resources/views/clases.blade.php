@extends('layouts.app')

@section('content')

    <script>
    
        // document.addEventListener('DOMContentLoaded', function() {
        //         var calendarEl = document.getElementById('calendar');
        //         var calendar = new FullCalendar.Calendar(calendarEl, {
        //                 plugins: [ 'bootstrap' ],
        //                 themeSystem: 'bootstrap',
        //                 events: {
        //                     url: '{{ route('clasesCargadas') }}',
        //                     method: 'GET',
        //                 },
        //                 initialView: 'dayGridMonth',
        //                 headerToolbar: {
        //                     left: 'prev,next today',
        //                     center: 'addEventButton',
        //                     right: 'timeGridWeek,timeGridDay,dayGridMonth,listWeek',
        //                 },
        //                 selectable: true,
        //                 editable: true,
        //                 nowIndicator: true,
        //                 dayMaxEvents: true,
        //                 customButtons: {
        //                         addEventButton: {
        //                           text: 'Agregar clase',
        //                           click: async function() {
        //                             var titleOfEvent = await Swal.fire({
        //                                                   title: 'Escribir nombre de la clase',
        //                                                   input: 'text',
        //                                                   inputLabel: 'Nombre de la clase',
        //                                                   showCancelButton: true,
        //                                                   inputValidator: (value) => {
        //                                                     if (!value) {
        //                                                       return 'La clase tiene que tener nombre!'
        //                                                     }
        //                                                   }
        //                                                 });
        //                             var dayOfEvent = await Swal.fire({
        //                                               title: 'Seleccionar el dia de la clase',
        //                                               input: 'select',
        //                                               inputOptions: {
        //                                                 'Dias': {
        //                                                   '1': 'Lunes',
        //                                                   '2': 'Martes',
        //                                                   '3': 'Miercoles',
        //                                                   '4': 'Jueves',
        //                                                   '5': 'Viernes',
        //                                                   '6': 'Sabado',
        //                                                   '0': 'Domingo',
        //                                                 }
        //                                               },
        //                                               showCancelButton: true
        //                                             });
        //                             var tStart = await Swal.fire({
        //                                                   title: 'Hora inicio de la clase',
        //                                                   input: 'text',
        //                                                   inputLabel: '9:00',
        //                                                   showCancelButton: true,
        //                                                   inputValidator: (value) => {
        //                                                     if (!value) {
        //                                                       return 'Tiene que escribir un horario!'
        //                                                     }
        //                                                   }
        //                                                 });
        //                             var tEnd = await Swal.fire({
        //                                                   title: 'Hora fin de la clase',
        //                                                   input: 'text',
        //                                                   inputLabel: '11:00',
        //                                                   showCancelButton: true,
        //                                                   inputValidator: (value) => {
        //                                                     if (!value) {
        //                                                       return 'Tiene que escribir un horario!'
        //                                                     }
        //                                                   }
        //                                                 });
        //                             if (true) { // valid?
        //                                 calendar.addEvent({
        //                                     title: titleOfEvent.value,
        //                                     startTime: tStart.value,
        //                                     endTime: tEnd.value,
        //                                     allDay: false,
        //                                     daysOfWeek: [ dayOfEvent.value ],
        //                                 });
        //                                 $.ajax({
        //                                   url:"{{ route('cargarClase') }}",
        //                                   type:"POST",
        //                                   data:{
        //                                     "_token":"{{ csrf_token() }}",
        //                                     "title":titleOfEvent.value,
        //                                     "startTime":tStart.value,
        //                                     "endTime":tEnd.value,
        //                                     "daysOfWeek":dayOfEvent.value,
        //                                   },
        //                                   success:function(response){
        //                                     console.log(response)
        //                                   },
        //                                   error: function(xhr, textStatus, error){
        //                                   }
        //                                 });

        //                             } else {
        //                               //alert('Invalid date.');
        //                             }
        //                           }
        //                         }
        //                 }
        //         });
        //         calendar.setOption('locale', 'es');
        //         calendar.render();
        //         //var today = new Date('2021-09-10T08:00:00');
        //         //var today2 = new Date('2021-09-10T10:00:00');
        //         calendar.addEvent({
        //             title: 'Clase demo',
        //             startTime: '8:00',
        //             endTime: '10:00',
        //             allDay: false,
        //             daysOfWeek: [ 5 ],
        //         });
        // });
       
/*       var KTCalendarBasic = function() {

    return {
        //main function to initiate the module
        init: function() {
            var todayDate = moment().startOf('day');
            var YM = todayDate.format('YYYY-MM');
            var YESTERDAY = todayDate.clone().subtract(1, 'day').format('YYYY-MM-DD');
            var TODAY = todayDate.format('YYYY-MM-DD');
            var TOMORROW = todayDate.clone().add(1, 'day').format('YYYY-MM-DD');

            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                plugins: [ 'bootstrap', 'interaction', 'dayGrid', 'timeGrid', 'list' ],
                themeSystem: 'bootstrap',

                header: {
                    left: 'prev,next today',
                    center: 'title addEventButton',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },

                height: 800,
                contentHeight: 780,
                aspectRatio: 3,  // see: https://fullcalendar.io/docs/aspectRatio

                nowIndicator: true,
                now: TODAY + 'T09:25:00', // just for demo

                views: {
                    dayGridMonth: { buttonText: 'Mes' },
                    timeGridWeek: { buttonText: 'Semana' },
                    timeGridDay: { buttonText: 'Día' }
                },

                customButtons: {
                  addEventButton: {
                    text: 'add event...',
                    click: function() {
                      var dateStr = prompt('Enter a date in YYYY-MM-DD format');
                      var date = new Date(dateStr + 'T00:00:00'); // will be in local time

                      if (!isNaN(date.valueOf())) { // valid?
                        calendar.addEvent({
                          title: 'dynamic event',
                          start: date,
                          allDay: true
                        });
                        alert('Great. Now, update your database...');
                      } else {
                        alert('Invalid date.');
                      }
                    }
                  }
                },

                defaultDate: TODAY,
                locale: 'es',

                editable: true,
                eventLimit: true, // allow "more" link when too many events
                navLinks: true,
                events: [
                    {
                        title: 'All Day Event',
                        start: YM + '-01',
                        description: 'Toto lorem ipsum dolor sit incid idunt ut',
                        className: "fc-event-danger fc-event-solid-warning"
                    },
                    {
                        title: 'Reporting',
                        start: YM + '-14T13:30:00',
                        description: 'Lorem ipsum dolor incid idunt ut labore',
                        end: YM + '-14',
                        className: "fc-event-success"
                    },
                    {
                        title: 'Company Trip',
                        start: YM + '-02',
                        description: 'Lorem ipsum dolor sit tempor incid',
                        end: YM + '-03',
                        className: "fc-event-primary"
                    },
                    {
                        title: 'ICT Expo 2017 - Product Release',
                        start: YM + '-03',
                        description: 'Lorem ipsum dolor sit tempor inci',
                        end: YM + '-05',
                        className: "fc-event-light fc-event-solid-primary"
                    },
                    {
                        title: 'Dinner',
                        start: YM + '-12',
                        description: 'Lorem ipsum dolor sit amet, conse ctetur',
                        end: YM + '-10'
                    },
                    {
                        id: 999,
                        title: 'Repeating Event',
                        start: YM + '-09T16:00:00',
                        description: 'Lorem ipsum dolor sit ncididunt ut labore',
                        className: "fc-event-danger"
                    },
                    {
                        id: 1000,
                        title: 'Repeating Event',
                        description: 'Lorem ipsum dolor sit amet, labore',
                        start: YM + '-16T16:00:00'
                    },
                    {
                        title: 'Conference',
                        start: YESTERDAY,
                        end: TOMORROW,
                        description: 'Lorem ipsum dolor eius mod tempor labore',
                        className: "fc-event-primary"
                    },
                    {
                        title: 'Meeting',
                        start: TODAY + 'T10:30:00',
                        end: TODAY + 'T12:30:00',
                        description: 'Lorem ipsum dolor eiu idunt ut labore'
                    },
                    {
                        title: 'Lunch',
                        start: TODAY + 'T12:00:00',
                        className: "fc-event-info",
                        description: 'Lorem ipsum dolor sit amet, ut labore'
                    },
                    {
                        title: 'Meeting',
                        start: TODAY + 'T14:30:00',
                        className: "fc-event-warning",
                        description: 'Lorem ipsum conse ctetur adipi scing'
                    },
                    {
                        title: 'Happy Hour',
                        start: TODAY + 'T17:30:00',
                        className: "fc-event-info",
                        description: 'Lorem ipsum dolor sit amet, conse ctetur'
                    },
                    {
                        title: 'Dinner',
                        start: TOMORROW + 'T05:00:00',
                        className: "fc-event-solid-danger fc-event-light",
                        description: 'Lorem ipsum dolor sit ctetur adipi scing'
                    },
                    {
                        title: 'Birthday Party',
                        start: TOMORROW + 'T07:00:00',
                        className: "fc-event-primary",
                        description: 'Lorem ipsum dolor sit amet, scing'
                    },
                    {
                        title: 'Click for Google',
                        url: 'http://google.com/',
                        start: YM + '-28',
                        className: "fc-event-solid-info fc-event-light",
                        description: 'Lorem ipsum dolor sit amet, labore'
                    }
                ],

                eventRender: function(info) {
                    var element = $(info.el);

                    if (info.event.extendedProps && info.event.extendedProps.description) {
                        if (element.hasClass('fc-day-grid-event')) {
                            element.data('content', info.event.extendedProps.description);
                            element.data('placement', 'top');
                            // KTApp.initPopover(element);
                        } else if (element.hasClass('fc-time-grid-event')) {
                            element.find('.fc-title').append('<div class="fc-description">' + info.event.extendedProps.description + '</div>');
                        } else if (element.find('.fc-list-item-title').lenght !== 0) {
                            element.find('.fc-list-item-title').append('<div class="fc-description">' + info.event.extendedProps.description + '</div>');
                        }
                    }
                },

                eventClick: function(calEvent, jsEvent, view) {
                    $('#start_time').val(moment(calEvent.start).format('YYYY-MM-DD HH:mm:ss'));
                    $('#finish_time').val(moment(calEvent.end).format('YYYY-MM-DD HH:mm:ss'));
                    $('#editModal').modal();
                }
            });
            calendar.setOption('locale', 'es');
            calendar.render();
        }
    };
}();

jQuery(document).ready(function() {
    KTCalendarBasic.init();
});*/



       var KTCalendarBasic = function() {

    return {
        //main function to initiate the module
        init: function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                plugins: [ 'bootstrap', 'interaction', 'dayGrid', 'timeGrid', 'list' ],
                themeSystem: 'bootstrap',
                events: {
                    url: '{{ route('clasesCargadas') }}',
                    method: 'GET',
                },
                header: {
                    left: 'prev,next today',
                    center: 'title addEventButton',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                height: 800,
                contentHeight: 780,
                aspectRatio: 3,  // see: https://fullcalendar.io/docs/aspectRatio
                nowIndicator: true,
                views: {
                    dayGridMonth: { buttonText: 'Mes' },
                    timeGridWeek: { buttonText: 'Semana' },
                    timeGridDay: { buttonText: 'Día' }
                },

                customButtons: {
                    addEventButton: {
                      text: 'Agregar clase',
                      click: async function() {                    

                            $('#editModal').modal('show'); 
                            $('#crear_modal').click(function() {
                                var titleOfEvent = $('#titleOfEvent').val();
                                var tStart = $('#tStart').val();
                                var tEnd = $('#tEnd').val();
                                var dayOfEvent = $('#dayOfEvent').val();

                                calendar.addEvent({
                                    title: titleOfEvent,
                                    startTime: tStart,
                                    endTime: tEnd,
                                    allDay: false,
                                    daysOfWeek: [ dayOfEvent ],
                                    className:"fc-event-solid-primary"
                                });
                                $("#titleOfEvent").val('');
                                $("#tStart").val('');
                                $("#tEnd").val('');
                                $("#dayOfEvent").val('');

                                $.ajax({
                                  url:"{{ route('cargarClase') }}",
                                  type:"POST",
                                  data:{
                                    "_token":"{{ csrf_token() }}",
                                    "title":titleOfEvent,
                                    "startTime":tStart,
                                    "endTime":tEnd,
                                    "daysOfWeek":dayOfEvent,
                                  },
                                  success:function(response){
                                    console.log(response);
                                  },
                                  error: function(xhr, textStatus, error){
                                  }
                                });

                                $('#editModal').modal('hide');
                            });

                      }
                    }
                },
                locale: 'es',
                eventLimit: true, // allow "more" link when too many events
                navLinks: true,
                eventRender: function(info) {
                    var element = $(info.el);

                    if (info.event.extendedProps && info.event.extendedProps.description) {
                        if (element.hasClass('fc-day-grid-event')) {
                            element.data('content', info.event.extendedProps.description);
                            element.data('placement', 'top');
                            // KTApp.initPopover(element);
                        } else if (element.hasClass('fc-time-grid-event')) {
                            element.find('.fc-title').append('<div class="fc-description">' + info.event.extendedProps.description + '</div>');
                        } else if (element.find('.fc-list-item-title').lenght !== 0) {
                            element.find('.fc-list-item-title').append('<div class="fc-description">' + info.event.extendedProps.description + '</div>');
                        }
                    }
                }
            });
            calendar.setOption('locale', 'es');
            calendar.render();
        }
    };
}();

jQuery(document).ready(function() {
    KTCalendarBasic.init();
});
    </script>

<div class="container bg-white" style="overflow: scroll;">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <br>
            <div id="calendar"></div>
        </div>
    </div>

    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <h4>Crear clase</h4>
                    <br>
                    Titulo:
                    <br />
                    <input type="text" class="form-control" name="titleOfEvent" id="titleOfEvent" placeholder="Pilates...">
                    <br>
                    Hora inicio:
                    <br />
                      <select class="custom-select" id="tStart">
                        <option value="6:00">6:00</option>
                        <option value="7:00">7:00</option>
                        <option value="8:00">8:00</option>
                        <option value="9:00">9:00</option>
                        <option value="10:00">10:00</option>
                        <option value="11:00">11:00</option>
                        <option value="12:00">12:00</option>
                        <option value="13:00">13:00</option>
                        <option value="14:00">14:00</option>
                        <option value="15:00">15:00</option>
                        <option value="16:00">16:00</option>
                        <option value="17:00">17:00</option>
                        <option value="18:00">18:00</option>
                        <option value="19:00">19:00</option>
                        <option value="20:00">20:00</option>
                        <option value="21:00">21:00</option>
                        <option value="22:00">22:00</option>
                        <option value="23:00">23:00</option>
                      </select>
                    <br> 
                    <br>   
                    Hora fin:
                    <br />
                      <select class="custom-select" id="tEnd">
                        <option value="6:00">6:00</option>
                        <option value="7:00">7:00</option>
                        <option value="8:00">8:00</option>
                        <option value="9:00">9:00</option>
                        <option value="10:00">10:00</option>
                        <option value="11:00">11:00</option>
                        <option value="12:00">12:00</option>
                        <option value="13:00">13:00</option>
                        <option value="14:00">14:00</option>
                        <option value="15:00">15:00</option>
                        <option value="16:00">16:00</option>
                        <option value="17:00">17:00</option>
                        <option value="18:00">18:00</option>
                        <option value="19:00">19:00</option>
                        <option value="20:00">20:00</option>
                        <option value="21:00">21:00</option>
                        <option value="22:00">22:00</option>
                        <option value="23:00">23:00</option>
                      </select>
                    <br>
                    <br>
                    Dia de la semana:
                    <br />
                      <select class="custom-select" id="dayOfEvent">
                        <option value="1">Lunes</option>
                        <option value="2">Martes</option>
                        <option value="3">Miercoles</option>
                        <option value="4">Jueves</option>
                        <option value="5">Viernes</option>
                        <option value="6">Sabado</option>
                        <option value="0">Domingo</option>
                      </select>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal" id="cerrar_modal">Cerrar</button>
                    <input type="button" class="btn btn-primary" id="crear_modal" value="Crear">
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

{{-- Scripts Section --}}
@section('scripts')



@endsection