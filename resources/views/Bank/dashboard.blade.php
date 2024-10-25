@extends('Layouts.bank')

@section('title', 'Accueil')
@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
       <li class="breadcrumb-item"><a href="#">KeKa</a></li>
       <li class="breadcrumb-item"><a href="#">Tableau de bord</a></li>
       <li class="breadcrumb-item active" aria-current="page">Accueil</li>
    </ol>
 </nav>
@endsection

@section('content')
    <div>
        <div class="d-flex gap-3">
            <div class="w-25">
                <div class="card text-bg-light">
                    <div class="card-body text-center hv-outline-parent">
                        <img src="{{ $user->photo }}" width="100" class="rounded-circle hv-oc mb-3" alt="">
                        <p class="lead">Hello <span class="fw-bold text-primary">{{ $user->name }}</span>, bienvenu sur <span class="text-muted">KeKa</span> votre plateforme de trading de la feve!</p>
                    </div>
                </div>
                <div class="card mt-2">
                    <div class="card-body text-center">
                        <div class="mb-2">
                            <img class="card-img" height="100"  src="{{ $user->banque->photo }}" alt="">
                        </div>
                        <h5>{{ $user->banque->name }}</h5>
                    </div>
                </div>
            </div>
            <div class="flex-fill">
                <div class="d-flex gap-1">
                    <div class="card bg-cyan text-white flex-fill">
                        <div class="card-body text-center">
                            <div>
                                <i class="psi-bucket fs-1 text-white"></i>
                            </div>
                            <div>
                                <span id="text-quantity">43</span> <span>tonnes</span>
                            </div>
                        </div>
                        <div class="card-footer text-center text-white">
                            <p class="fs-5 fw-semibold">Total des ventes</p>
                        </div>
                    </div>
        
                    <div class="card bg-teal text-white flex-fill">
                        <div class="card-body text-center">
                            <div>
                                <i class="pli-coins fs-1 text-white"></i>
                            </div>
                            <div class="fs-5">
                                <span id="text-total">560.000.000</span> <span>FCFA</span>
                            </div>
                        </div>
                        <div class="card-footer text-center text-white">
                            <p class="fs-5 fw-semibold">Valeur des ventes</p>
                        </div>
                    </div>

                    <div class="card bg-danger text-white flex-fill">
                        <div class="card-body text-center">
                            <div>
                                <i class="pli-money-2 fs-1 text-white"></i>
                            </div>
                            <div class="fs-5">
                                <span id="text-total">410.000.000</span> <span>FCFA</span>
                            </div>
                        </div>
                        <div class="card-footer text-center text-white">
                            <p class="fs-5 fw-semibold">Total des paiements</p>
                        </div>
                    </div>
                </div>
                <div class="mt-2">
                    <div class="d-flex gap-2">
                        <div class="card text-center flex-fill">
                            <div class="card-body">
                                <canvas id="_barChart"></canvas>
                            </div>
                        </div>
                        <div class="card text-center flex-fill">
                            <div class="card-body">
                                <canvas id="_quantity_barChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/vendors/chart.js/chart.umd.min.js') }}"></script>
    <script>
        $(document).ready(function(){
            const _body           = getComputedStyle( document.body );
            const primaryColor    = _body.getPropertyValue("--bs-primary");
            const successColor    = _body.getPropertyValue("--bs-success");
            const infoColor       = _body.getPropertyValue("--bs-info");
            const warningColor    = _body.getPropertyValue("--bs-warning");
            const dangerColor    = _body.getPropertyValue("--bs-danger");
            const mutedColorRGB   = _body.getPropertyValue("--bs-secondary-color-rgb");
            const grayColor       = "rgba( 180,180,180, .5 )";
            $.ajax({
                url: "{{ route('bank.dashboard.data') }}",
                type:'get',
                dataType:'json',
                success:function(data){
                    console.log(data);
                    var barData = Object.values(data);
                    console.log(barData)
                    var clientDatasets = [
                        {
                            label: "Valeur",
                            data: barData,
                            borderColor: primaryColor,
                            backgroundColor: primaryColor,
                            parsing: {
                                xAxisKey: "client",
                                yAxisKey: "total"
                            }
                        },
                        {
                            label: "Versement",
                            data: barData,
                            borderColor: successColor,
                            backgroundColor: successColor,
                            parsing: {
                                xAxisKey: "client",
                                yAxisKey: "versement"
                            }
                        },
                        {
                            label: "Reste",
                            data: barData,
                            borderColor: dangerColor,
                            backgroundColor: dangerColor,
                            parsing: {
                                xAxisKey: "client",
                                yAxisKey: "reste"
                            }
                        },
                    ];
                    var quantityDatasets = [
                        {
                            label: "Tonnage",
                            data: barData,
                            borderColor: primaryColor,
                            backgroundColor: primaryColor,
                            parsing: {
                                xAxisKey: "client",
                                yAxisKey: "quantity"
                            }
                        },
                    ];
                    var eltc = document.getElementById("_barChart");
                    var _qty_bc = document.getElementById("_quantity_barChart");
                   
                    drawBarChart(eltc,clientDatasets,mutedColorRGB,"Suivi des paiements commandes client");
                    drawBarChart(_qty_bc,quantityDatasets,mutedColorRGB,"Suivi des quantites commandees client");

                },
                error:function(err){
                    console.log(err)
                }
            });

        });

        function drawBarChart(_elt,_datasets,_color,_title){
            var barChart = new Chart(
                    _elt, {
                        type: "bar",
                        data: {
                            datasets: _datasets
                        },

                        options : {
                            plugins :{
                                legend: {
                                    display: true,
                                    align: "end",
                                    labels: {
                                        color: `rgb( ${ _color })`,
                                        boxWidth: 10,
                                    }
                                },
                                tooltip : {
                                    position : "nearest"
                                },
                                title:{
                                    display:true,
                                    text:_title
                                }
                            },

                            interaction: {
                            mode : "index",
                            intersect: false,
                            },

                            scales: {
                            y: {
                                grid: {
                                    borderWidth: 0,
                                    color: `rgba( ${ _color }, .07 )`
                                },
                                suggestedMax: 150,
                                ticks: {
                                    font : { size: 11  },
                                    color : `rgb( ${ _color })`,
                                    beginAtZero: false,
                                    stepSize: 50
                                }
                            },
                            x: {
                                grid: {
                                    borderWidth: 0,
                                    drawOnChartArea: false
                                },
                                ticks: {
                                    font : { size: 11  },
                                    color : `rgb( ${ _color })`,
                                    autoSkip: true,
                                    maxRotation: 0,
                                    minRotation: 0,
                                    maxTicksLimit: 7
                                }
                            }
                            },

                            elements: {
                            // Dot width
                            point : {
                                radius: 3,
                                hoverRadius: 5
                            },
                            // Smooth lines
                            line: {
                                tension: 0.2
                            }
                            }
                        }
                    }
                );
        }

        function drawPieChart(_elt,_data,_title,_labels,_colors){
            var pieChart = new Chart(
                _elt, {
                    type: "pie",
                    data: {
                        labels: _labels,
                        datasets: [{
                        data: _data,
                        borderColor: "transparent",
                        backgroundColor: _colors,
                        }]
                    },
                    options: {
                        plugins :{
                            legend: {
                                display: true,
                                labels: {
                                    color: '#aaa',
                                    boxWidth: 10,
                                }
                            },
                            tooltip : {
                                position : "nearest"
                            },
                            title:{
                                display:true,
                                text:_title
                            }
                        }
                    }
                }
            );
        }
    </script>
@endsection
