@extends('Layouts.rbassin')

@section('title', 'Accueil')
@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
       <li class="breadcrumb-item"><a href="#">KeKa</a></li>
       <li class="breadcrumb-item"><a href="#">Prévisions</a></li>
       <li class="breadcrumb-item active" aria-current="page">Liste des précommandes</li>
    </ol>
 </nav>
@endsection



@section('page-header')
    <div>
        <h5 class="page-title mb-0 mt-2">Prévisions </h5>
        <p class="lead">Liste de toutes les prévisions de matiere de disponibilité de la feve  </p>
    </div>
@endsection

@section('content')
    <link rel="stylesheet" href="{{ asset('assets/vendors/fullcalendar/fullcalendar.min.css') }}">
    <div style="max-height: 70vh; overflow:scroll;" class="card">
        <div class="card-body">
            <div class="d-md-flex gap-4">
                <div class="w-50 flex-shrink-0 mb-3">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>JOUR</th>
                                <th>PRODUCTEUR</th>
                                <th>LIEU</th>
                                <th>GRADE 1</th>
                                <th>GRADE 2</th>
                                <th>HS</th>
                                <th>TOTAL</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($previsions as $prevision)
                                <tr>
                                    <td>{{ $prevision->day->format('d/m/Y') }}</td>
                                    <td>{{ $prevision->cooperative->name }}</td>
                                    <td>{{ $prevision->lieu }}</td>
                                    <td>{{ $prevision->grd1_qty }}</td>
                                    <td>{{ $prevision->grd2_qty }}</td>
                                    <td>{{ $prevision->hs_qty }}</td>
                                    <td>{{ $prevision->quantity }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="vr"></div>
                <!-- Full calendar container -->
                <div class="flex-fill">
                    <div id="_dm-calendar"></div>
                 </div>
                 <!-- END : Full calendar container -->
            </div>
        </div>
    </div>
       <!-- Fullcalendar Scripts [ OPTIONAL ] -->
   <script src="{{ asset('assets/vendors/fullcalendar/index.global.min.js') }}"></script>
   <script src="{{ asset('assets/vendors/fullcalendar/core/locales/fr.global.js') }}"></script>
   <!-- Fullcalendar Scripts [ OPTIONAL ] -->
   <script type="module" src="https://cdn.jsdelivr.net/npm/@fullcalendar/bootstrap5@6.1.11/index.global.min.js"></script>


   <script>
        $(document).ready(function(){
            $.ajax({
                url:'{{ route("rbassin.calendar.data")}}',
                type:'get',
                dataType:'json',
                success:function(data){
                    console.log(data)
                    var _events = [];
                    for(var i=0;i<data.length;i++){
                        _events.push({
                            title: `${data[i].qty} tonnes`,
                            start: `${data[i].day}`,
                            className: "bg-success text-center",
                            url: `/rbassin/previsions?day=${data[i].day}`
                        })
                    }

                    const calendar = new FullCalendar.Calendar( document.getElementById( "_dm-calendar" ), {
                        timeZone: "UTC",
                        locale:'fr',
                        editable: true,
                        droppable: true, // this allows things to be dropped onto the calendar
                        dayMaxEvents: true, // allow "more" link when too many events
                        headerToolbar: {
                            left: "prev,next today",
                            center: "title",
                            right: "dayGridMonth,timeGridWeek,timeGridDay,listMonth"
                        },

                        themeSystem: "bootstrap5",

                        buttonIcons: {
                            close: " demo-psi-cross",
                            prev: " demo-psi-arrow-left",
                            next: " demo-psi-arrow-right",
                            prevYear: " demo-psi-arrow-left-2",
                            nextYear: " demo-psi-arrow-right-2"
                        },

                        events: _events
                    });
                    calendar.render();
                },
                error:function(err){
                    console.log(err);
                }
            });
        })
   </script>
@endsection
