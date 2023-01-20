@extends('component.main')


@section('style')
@endsection

@section('container')
    <div class="page-title">
        <h3>Dashboard</h3>
        <p class="text-subtitle text-muted">A good dashboard to display your statistics</p>
    </div>
    <section class="section">
        <div class="row mb-2">
            <div class="col-12 col-md-6">
                <div class="card card-statistic">
                    <div class="card-body p-0">
                        <div class="d-flex flex-column">
                            <div class='px-3 py-3 d-flex justify-content-between'>
                                <h3 class='card-title'>Barang Masuk {{ date('Y') }}</h3>
                                <div class="card-right d-flex align-items-center">
                                    <p>{{ $total_orders }} </p>
                                </div>
                            </div>
                            <div class="chart-wrapper">
                                <canvas id="canvas3" style="height:100px !important"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="card card-statistic">
                    <div class="card-body p-0">
                        <div class="d-flex flex-column">
                            <div class='px-3 py-3 d-flex justify-content-between'>
                                <h3 class='card-title'>Penjualan {{ date('Y') }}</h3>
                                <div class="card-right d-flex align-items-center">
                                    <p>{{ $total_sales }} </p>
                                </div>
                            </div>
                            <div class="chart-wrapper">
                                <canvas id="canvas4" style="height:100px !important"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-4">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class='card-heading p-1 pl-3'>Grafik Penjualan</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3 col-12">
                                <div class="pl-3">
                                    {{-- <h1 class='mt-5'>$21,102</h1> --}}
                                    <p class='text-xs'><span class="text-green"><i data-feather="bar-chart"
                                                width="15"></i> +19%</span>
                                        than last month</p>
                                    <div class="legends">
                                        <div class="legend d-flex flex-row align-items-center">
                                            <div class='w-3 h-3 rounded-full bg-info me-2'></div><span class='text-xs'>Last
                                                Month</span>
                                        </div>
                                        <div class="legend d-flex flex-row align-items-center">
                                            <div class='w-3 h-3 rounded-full bg-blue me-2'></div><span
                                                class='text-xs'>Current Month</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-9 col-12">
                                <canvas id="bar"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title">Penjualan Hari Ini</h4>
                        <div class="d-flex ">
                            <i data-feather="download"></i>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-0">
                        <div class="table-responsive">
                            <table class='table mb-0' id="table1">
                                <thead>
                                    <tr>
                                        <th class="p-3">No</th>
                                        <th class="p-3">no_referensi</th>
                                        <th class="p-3">customer</th>
                                        <th class="p-3">Alamat</th>
                                        <th class="p-3">items</th>
                                        {{-- <th class="p-3">Qty</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($sales_today as $data)
                                        <tr class="p-0 m-0 ">
                                            <td class="p-3">{{ $loop->iteration }}</td>
                                            <td class="p-3">{{ $data->no_referensi }}</td>
                                            <td class="p-3">{{ $data->customer->name }}</td>
                                            <td class="p-3">{{ $data->customer->address }}</td>
                                            <td class="p-3">
                                                <ul class="p-0">
                                                    @foreach ($data->detail_barang_keluars as $detail)
                                                        <li> {{ $detail->item->nama }} - {{ $detail->item->qty }}</li>
                                                    @endforeach
                                                </ul>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card widget-todo">
                    <div class="card-header border-bottom d-flex justify-content-between align-items-center">
                        <h4 class="card-title d-flex">
                            <i class='bx bx-check font-medium-5 pl-25 pr-75'></i> Top 8 Max Stok
                        </h4>
                    </div>
                    <div class="card-body px-0 py-1">
                        <table class='table table-borderless'>
                            <thead>
                                <tr>
                                    <th class="p-1 m-0">Items</th>
                                    <th class="p-1 m-0">Kategori</th>
                                    <th class="p-1 m-0">qty</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($top_max_item as $item)
                                    <tr>
                                        <td class="px-1 m-0">{{ $item->name }}</td>
                                        <td class="px-1 m-0">{{ $item->kategori_produk->nama }}</td>
                                        <td class="px-1 m-0">{{ $item->qty }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection


@section('script_dashboard')
    <script src="{{ asset('assets/vendors/chartjs/Chart.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/apexcharts/apexcharts.min.js') }}"></script>
    <script>
        let orders_data_php = {{ Js::from($orders) }};

        let sales_data_php = {{ Js::from($sales) }}

        var chartColors = {
            red: 'rgb(255, 99, 132)',
            orange: 'rgb(255, 159, 64)',
            yellow: 'rgb(255, 205, 86)',
            green: 'rgb(75, 192, 192)',
            info: '#41B1F9',
            blue: '#3245D1',
            purple: 'rgb(153, 102, 255)',
            grey: '#EBEFF6'
        };

        // var config1 = {
        //     type: "line",
        //     data: {
        //         labels: ["January", "February", "March", "April", "May", "June", "July"],
        //         datasets: [{
        //             label: "Balance",
        //             backgroundColor: "#fff",
        //             borderColor: "#fff",
        //             data: [20, 40, 20, 70, 10, 50, 20],
        //             fill: false,
        //             pointBorderWidth: 100,
        //             pointBorderColor: "transparent",
        //             pointRadius: 3,
        //             pointBackgroundColor: "transparent",
        //             pointHoverBackgroundColor: "rgba(63,82,227,1)",
        //         }, ],
        //     },
        //     options: {
        //         responsive: true,
        //         maintainAspectRatio: false,
        //         layout: {
        //             padding: {
        //                 left: -10,
        //                 top: 10,
        //             },
        //         },
        //         legend: {
        //             display: false,
        //         },
        //         title: {
        //             display: false,
        //         },
        //         tooltips: {
        //             mode: "index",
        //             intersect: false,
        //         },
        //         hover: {
        //             mode: "nearest",
        //             intersect: true,
        //         },
        //         scales: {
        //             xAxes: [{
        //                 gridLines: {
        //                     drawBorder: false,
        //                     display: false,
        //                 },
        //                 ticks: {
        //                     display: false,
        //                 },
        //             }, ],
        //             yAxes: [{
        //                 gridLines: {
        //                     display: false,
        //                     drawBorder: false,
        //                 },
        //                 ticks: {
        //                     display: false,
        //                 },
        //             }, ],
        //         },
        //     },
        // };
        // var config2 = {
        //     type: "line",
        //     data: {
        //         labels: ["January", "February", "March", "April", "May", "June", "Agustus"],
        //         datasets: [{
        //             label: "Revenue",
        //             backgroundColor: "#fff",
        //             borderColor: "#fff",
        //             data: [20, 800, 300, 400, 10, 50, 20],
        //             fill: false,
        //             pointBorderWidth: 100,
        //             pointBorderColor: "transparent",
        //             pointRadius: 3,
        //             pointBackgroundColor: "transparent",
        //             pointHoverBackgroundColor: "rgba(63,82,227,1)",
        //         }, ],
        //     },
        //     options: {
        //         responsive: true,
        //         maintainAspectRatio: false,
        //         layout: {
        //             padding: {
        //                 left: -10,
        //                 top: 10,
        //             },
        //         },
        //         legend: {
        //             display: false,
        //         },
        //         title: {
        //             display: false,
        //         },
        //         tooltips: {
        //             mode: "index",
        //             intersect: false,
        //         },
        //         hover: {
        //             mode: "nearest",
        //             intersect: true,
        //         },
        //         scales: {
        //             xAxes: [{
        //                 gridLines: {
        //                     drawBorder: false,
        //                     display: false,
        //                 },
        //                 ticks: {
        //                     display: false,
        //                 },
        //             }, ],
        //             yAxes: [{
        //                 gridLines: {
        //                     display: false,
        //                     drawBorder: false,
        //                 },
        //                 ticks: {
        //                     display: false,
        //                 },
        //             }, ],
        //         },
        //     },
        // };

        let createDate = [
            "Januari",
            "Februari",
            "Maret",
            "April",
            "Mei",
            "Juni",
            "Juli",
            "Agustus",
            "September",
            "Oktober",
            "November",
            "Desember",
        ];

        var config3 = {
            type: "line",
            data: {
                labels: createDate,
                datasets: [{
                    label: "Orders",
                    backgroundColor: "#fff",
                    borderColor: "#fff",
                    data: orders_data_php,
                    fill: false,
                    pointBorderWidth: 100,
                    pointBorderColor: "transparent",
                    pointRadius: 3,
                    pointBackgroundColor: "transparent",
                    pointHoverBackgroundColor: "rgba(63,82,227,1)",
                }, ],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                layout: {
                    padding: {
                        left: -10,
                        top: 10,
                    },
                },
                legend: {
                    display: false,
                },
                title: {
                    display: false,
                    text: "Chart.js Line Chart",
                },
                tooltips: {
                    mode: "index",
                    intersect: false,
                },
                hover: {
                    mode: "nearest",
                    intersect: true,
                },
                scales: {
                    xAxes: [{
                        gridLines: {
                            drawBorder: false,
                            display: false,
                        },
                        ticks: {
                            display: false,
                        },
                    }, ],
                    yAxes: [{
                        gridLines: {
                            display: false,
                            drawBorder: false,
                        },
                        ticks: {
                            display: false,
                        },
                    }, ],
                },
            },
        };
        var config4 = {
            type: "line",
            data: {
                labels: createDate,
                datasets: [{
                    label: "My First dataset",
                    backgroundColor: "#fff",
                    borderColor: "#fff",
                    data: sales_data_php,
                    fill: false,
                    pointBorderWidth: 100,
                    pointBorderColor: "transparent",
                    pointRadius: 3,
                    pointBackgroundColor: "transparent",
                    pointHoverBackgroundColor: "rgba(63,82,227,1)",
                }, ],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                layout: {
                    padding: {
                        left: -10,
                        top: 10,
                    },
                },
                legend: {
                    display: false,
                },
                title: {
                    display: false,
                    text: "Chart.js Line Chart",
                },
                tooltips: {
                    mode: "index",
                    intersect: false,
                },
                hover: {
                    mode: "nearest",
                    intersect: true,
                },
                scales: {
                    xAxes: [{
                        gridLines: {
                            drawBorder: false,
                            display: false,
                        },
                        ticks: {
                            display: false,
                        },
                    }, ],
                    yAxes: [{
                        gridLines: {
                            display: false,
                            drawBorder: false,
                        },
                        ticks: {
                            display: false,
                        },
                    }, ],
                },
            },
        };

        var randomScalingFactor = function() {
            return (Math.random() > 0.5 ? 1.0 : 1.0) * Math.round(Math.random() * 100);
        };

        // draws a rectangle with a rounded top
        Chart.helpers.drawRoundedTopRectangle = function(ctx, x, y, width, height, radius) {
            ctx.beginPath();
            ctx.moveTo(x + radius, y);
            // top right corner
            ctx.lineTo(x + width - radius, y);
            ctx.quadraticCurveTo(x + width, y, x + width, y + radius);
            // bottom right	corner
            ctx.lineTo(x + width, y + height);
            // bottom left corner
            ctx.lineTo(x, y + height);
            // top left
            ctx.lineTo(x, y + radius);
            ctx.quadraticCurveTo(x, y, x + radius, y);
            ctx.closePath();
        };

        Chart.elements.RoundedTopRectangle = Chart.elements.Rectangle.extend({
            draw: function() {
                var ctx = this._chart.ctx;
                var vm = this._view;
                var left, right, top, bottom, signX, signY, borderSkipped;
                var borderWidth = vm.borderWidth;

                if (!vm.horizontal) {
                    // bar
                    left = vm.x - vm.width / 2;
                    right = vm.x + vm.width / 2;
                    top = vm.y;
                    bottom = vm.base;
                    signX = 1;
                    signY = bottom > top ? 1 : -1;
                    borderSkipped = vm.borderSkipped || 'bottom';
                } else {
                    // horizontal bar
                    left = vm.base;
                    right = vm.x;
                    top = vm.y - vm.height / 2;
                    bottom = vm.y + vm.height / 2;
                    signX = right > left ? 1 : -1;
                    signY = 1;
                    borderSkipped = vm.borderSkipped || 'left';
                }

                // Canvas doesn't allow us to stroke inside the width so we can
                // adjust the sizes to fit if we're setting a stroke on the line
                if (borderWidth) {
                    // borderWidth shold be less than bar width and bar height.
                    var barSize = Math.min(Math.abs(left - right), Math.abs(top - bottom));
                    borderWidth = borderWidth > barSize ? barSize : borderWidth;
                    var halfStroke = borderWidth / 2;
                    // Adjust borderWidth when bar top position is near vm.base(zero).
                    var borderLeft = left + (borderSkipped !== 'left' ? halfStroke * signX : 0);
                    var borderRight = right + (borderSkipped !== 'right' ? -halfStroke * signX : 0);
                    var borderTop = top + (borderSkipped !== 'top' ? halfStroke * signY : 0);
                    var borderBottom = bottom + (borderSkipped !== 'bottom' ? -halfStroke * signY : 0);
                    // not become a vertical line?
                    if (borderLeft !== borderRight) {
                        top = borderTop;
                        bottom = borderBottom;
                    }
                    // not become a horizontal line?
                    if (borderTop !== borderBottom) {
                        left = borderLeft;
                        right = borderRight;
                    }
                }

                // calculate the bar width and roundess
                var barWidth = Math.abs(left - right);
                var roundness = this._chart.config.options.barRoundness || 0.5;
                var radius = barWidth * roundness * 0.5;

                // keep track of the original top of the bar
                var prevTop = top;

                // move the top down so there is room to draw the rounded top
                top = prevTop + radius;
                var barRadius = top - prevTop;

                ctx.beginPath();
                ctx.fillStyle = vm.backgroundColor;
                ctx.strokeStyle = vm.borderColor;
                ctx.lineWidth = borderWidth;

                // draw the rounded top rectangle
                Chart.helpers.drawRoundedTopRectangle(ctx, left, (top - barRadius + 1), barWidth, bottom -
                    prevTop, barRadius);

                ctx.fill();
                if (borderWidth) {
                    ctx.stroke();
                }

                // restore the original top value so tooltips and scales still work
                top = prevTop;
            },
        });

        Chart.defaults.roundedBar = Chart.helpers.clone(Chart.defaults.bar);

        Chart.controllers.roundedBar = Chart.controllers.bar.extend({
            dataElementType: Chart.elements.RoundedTopRectangle
        });

        var ctxBar = document.getElementById("bar").getContext("2d");
        var myBar = new Chart(ctxBar, {
            type: 'bar',
            data: {
                labels: createDate,
                datasets: [{
                    label: 'Students',
                    backgroundColor: [chartColors.grey, chartColors.grey, chartColors.grey, chartColors
                        .grey, chartColors.info, chartColors.blue, chartColors.grey
                    ],
                    data: sales_data_php
                }]
            },
            options: {
                responsive: true,
                barRoundness: 1,
                title: {
                    display: false,
                    text: "Chart.js - Bar Chart with Rounded Tops (drawRoundedTopRectangle Method)"
                },
                legend: {
                    display: false
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            suggestedMax: 40 + 20,
                            padding: 10,
                        },
                        gridLines: {
                            drawBorder: false,
                        }
                    }],
                    xAxes: [{
                        gridLines: {
                            display: false,
                            drawBorder: false
                        }
                    }]
                }
            }
        });
        var radialBarsOptions = {
            series: [44, 80, 67],
            chart: {
                height: 350,
                type: "radialBar",
            },
            theme: {
                mode: "light",
                palette: "palette1",
                monochrome: {
                    enabled: true,
                    color: "#3245D1",
                    shadeTo: "light",
                    shadeIntensity: 0.65,
                },
            },
            plotOptions: {
                radialBar: {
                    dataLabels: {
                        name: {
                            offsetY: -15,
                            fontSize: "22px",
                        },
                        value: {
                            fontSize: "2.5rem",
                        },
                        total: {
                            show: true,
                            label: "Earnings",
                            color: "#25A6F1",
                            fontSize: "16px",
                            formatter: function(w) {
                                // By default this function returns the average of all series. The below is just an example to show the use of custom formatter function
                                return "$4,124";
                            },
                        },
                    },
                },
            },
            labels: ["Apples", "Oranges", "Bananas", "Berries"],
        };
        var radialBars = new ApexCharts(document.querySelector("#radialBars"), radialBarsOptions);
        radialBars.render();
        // let ctx1 = document.getElementById("canvas1").getContext("2d");
        // let ctx2 = document.getElementById("canvas2").getContext("2d");
        let ctx3 = document.getElementById("canvas3").getContext("2d");
        let ctx4 = document.getElementById("canvas4").getContext("2d");
        // var lineChart1 = new Chart(ctx1, config1);
        // var lineChart2 = new Chart(ctx2, config2);
        var lineChart3 = new Chart(ctx3, config3);
        var lineChart4 = new Chart(ctx4, config4);
    </script>
@endsection
