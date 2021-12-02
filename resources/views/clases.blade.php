@extends('layouts.app')

@section('content')

<script type="text/javascript">

    function añadirDia(){

        var element = document.createElement("select");
        element.id = "dayOfEvent2";
        element.className = "custom-select";
        $('#editModal').find('.modal-body').append(element);

        //Create array of options to be added
        var array = ["Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sabado"];
        //Create and append the options
        for (var i = 0; i < array.length; i++) {
            var option = document.createElement("option");
            option.value = i;
            option.text = array[i];
            if (i == 1) {
                option.selected = true;
            }
            element.appendChild(option);
        }
        $('.input-group-btn').remove();
        $('.borrable-clase').remove();
    };

    function añadirDia2(){

        var element = document.createElement("select");
        element.id = "dayOfEvent3";
        element.className = "custom-select";
        $('#editModal').find('.modal-body').append(element);

        //Create array of options to be added
        var array = ["Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sabado"];
        //Create and append the options
        for (var i = 0; i < array.length; i++) {
            var option = document.createElement("option");
            option.value = i;
            option.text = array[i];
            if (i == 1) {
                option.selected = true;
            }
            element.appendChild(option);
        }
        $('.input-group-btn2').remove();
        $('.borrable-clase2').remove();
    };

</script>

<script>
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
                                    var dayOfEvent2 = $('#dayOfEvent2').val();
                                    var dayOfEvent3 = $('#dayOfEvent3').val();
                                    var recurso = $('#recurso').val();

                                    calendar.addEvent({
                                        title: titleOfEvent,
                                        startTime: tStart,
                                        endTime: tEnd,
                                        allDay: false,
                                        daysOfWeek: [ dayOfEvent ],
                                        className:"fc-event-solid-primary"
                                    });

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

                                        $.ajax({
                                          url:"{{ route('agregarClaseRecurso') }}",
                                          type:"POST",
                                          data:{
                                            "_token":"{{ csrf_token() }}",
                                            "recurso":recurso,
                                            "clase":response.id,
                                          },
                                          });

                                      },
                                      error: function(xhr, textStatus, error){
                                      }
                                    });

                                    if(typeof dayOfEvent2 != 'undefined'){

                                        calendar.addEvent({
                                            title: titleOfEvent,
                                            startTime: tStart,
                                            endTime: tEnd,
                                            allDay: false,
                                            daysOfWeek: [ dayOfEvent2 ],
                                            className:"fc-event-solid-primary"
                                        });

                                        $.ajax({
                                          url:"{{ route('cargarClase') }}",
                                          type:"POST",
                                          data:{
                                            "_token":"{{ csrf_token() }}",
                                            "title":titleOfEvent,
                                            "startTime":tStart,
                                            "endTime":tEnd,
                                            "daysOfWeek":dayOfEvent2,
                                          },
                                          success:function(response){

                                            $.ajax({
                                                url:"{{ route('agregarClaseRecurso') }}",
                                                type:"POST",
                                                data:{
                                                    "_token":"{{ csrf_token() }}",
                                                    "recurso":recurso,
                                                    "clase":response.id,
                                                },
                                            });

                                          },
                                          error: function(xhr, textStatus, error){
                                          }
                                        });

                                    }
                                                                   
                                    if(typeof dayOfEvent3 != 'undefined'){

                                        calendar.addEvent({
                                            title: titleOfEvent,
                                            startTime: tStart,
                                            endTime: tEnd,
                                            allDay: false,
                                            daysOfWeek: [ dayOfEvent3 ],
                                            className:"fc-event-solid-primary"
                                        });

                                        $.ajax({
                                          url:"{{ route('cargarClase') }}",
                                          type:"POST",
                                          data:{
                                            "_token":"{{ csrf_token() }}",
                                            "title":titleOfEvent,
                                            "startTime":tStart,
                                            "endTime":tEnd,
                                            "daysOfWeek":dayOfEvent3,
                                          },
                                          success:function(response){

                                            $.ajax({
                                                url:"{{ route('agregarClaseRecurso') }}",
                                                type:"POST",
                                                data:{
                                                    "_token":"{{ csrf_token() }}",
                                                    "recurso":recurso,
                                                    "clase":response.id,
                                                },
                                            });

                                          },
                                          error: function(xhr, textStatus, error){
                                          }
                                        });

                                    }

                                    $("#titleOfEvent").val('');
                                    $("#tStart").val('');
                                    $("#tEnd").val('');
                                    $("#dayOfEvent").val('');
                                    $('#dayOfEvent2').val('');
                                    $('#dayOfEvent3').val('');
                                    $('#recurso').val('');

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
                    Recurso:
                    <br />
                      <select class="custom-select" id="recurso">
                        @foreach($recursos as $recurso)
                        <option value="{{$recurso->id}}">{{$recurso->nombre}}</option>
                        @endforeach
                      </select>
                    <br>
                    <br>
                    Dia de la semana:
                    <br />
                    <br class="borrable-clase">
                    <div class="input-group-btn">
                        <button class="btn btn-success add-more" type="button" onclick="añadirDia()"><i class="fas fa-plus"></i> Añadir Dia</button>
                    </div>
                    <br class="borrable-clase">
                    <div class="input-group-btn2">
                        <button class="btn btn-success add-more" type="button" onclick="añadirDia2()"><i class="fas fa-plus"></i> Añadir Dia</button>
                    </div>
                    <br class="borrable-clase2">
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

@section('scripts')

@endsection