$('#addClassModal1s').on('shown.bs.modal',function(event){

    ! function($) {
        "use strict";

        var ChartJs = function() {
            this.$body = $("body"),
                this.charts = []
        };

        ChartJs.prototype.respChart = function(selector, type, data, options) {

                // get selector by context
                var ctx = selector.get(0).getContext("2d");
                // pointing parent container to make chart js inherit its width
                var container = $(selector).parent();

                //default config
                Chart.defaults.global.defaultFontColor = "#8391a2";
                Chart.defaults.scale.gridLines.color = "#8391a2";

                // this function produce the responsive Chart JS
                function generateChart() {
                    // make chart width fit with its container
                    var ww = selector.attr('width', $(container).width());
                    var chart;
                    switch (type) {
                        case 'Bar':
                            chart = new Chart(ctx, {
                                type: 'bar',
                                data: data,
                                options: options
                            });
                            break;
                        case 'Radar':
                            chart = new Chart(ctx, {
                                type: 'radar',
                                data: data,
                                options: options
                            });
                            break;
                        case 'PolarArea':
                            chart = new Chart(ctx, {
                                data: data,
                                type: 'polarArea',
                                options: options
                            });
                            break;
                    }
                    return chart;
                };
                // run function - render chart at first load
                return generateChart();
            },
            // init various charts and returns
            ChartJs.prototype.initCharts = function() {
                var charts = [];
                var defaultColors = ["#1abc9c", "#f1556c", "#4a81d4", "#e3eaef"];

                if ($('#radar-chart-2').length > 0) {
                    var dataColors = $("#radar-chart-2").data('colors');
                    var colors = dataColors ? dataColors.split(",") : defaultColors.concat();
                    //radar chart
                    var radarChart = {
                        labels: ["Test A", "Test B", "Test C", "Test D"],
                        datasets: [{
                                label: "Mid Term",
                                backgroundColor: hexToRGB(colors[0], 0.3),
                                borderColor: colors[0],
                                pointBackgroundColor: colors[0],
                                pointBorderColor: "#fff",
                                pointHoverBackgroundColor: "#fff",
                                pointHoverBorderColor: colors[0],
                                data: [80, 90, 96, 84]
                            },
                            {
                                label: "Annual",
                                backgroundColor: hexToRGB(colors[1], 0.3),
                                borderColor: colors[1],
                                pointBackgroundColor: colors[1],
                                pointBorderColor: "#fff",
                                pointHoverBackgroundColor: "#fff",
                                pointHoverBorderColor: colors[1],
                                data: [98, 85, 74, 98]
                            }
                        ]
                    };
                    var radarOpts = {
                        maintainAspectRatio: false
                    };
                    charts.push(this.respChart($("#radar-chart-2"), 'Radar', radarChart, radarOpts));
                }
                
                return charts;
            },
            //initializing various components and plugins
            ChartJs.prototype.init = function() {
                var $this = this;
                // font
                Chart.defaults.global.defaultFontFamily = 'Nunito,sans-serif';

                // init charts
                $this.charts = this.initCharts();

                // enable resizing matter
                $(window).on('resize', function(e) {
                    $.each($this.charts, function(index, chart) {
                        try {
                            chart.destroy();
                        } catch (err) {}
                    });
                    $this.charts = $this.initCharts();
                });
            },

            //init flotchart
            $.ChartJs = new ChartJs, $.ChartJs.Constructor = ChartJs
    }(window.jQuery),

    //initializing ChartJs
    function($) {
        "use strict";
        $.ChartJs.init()
    }(window.jQuery);

    /* utility function */

    function hexToRGB(hex, alpha) {
        var r = parseInt(hex.slice(1, 3), 16),
            g = parseInt(hex.slice(3, 5), 16),
            b = parseInt(hex.slice(5, 7), 16);

        if (alpha) {
            return "rgba(" + r + ", " + g + ", " + b + ", " + alpha + ")";
        } else {
            return "rgb(" + r + ", " + g + ", " + b + ")";
        }
    }


    //Start of apex-line-2 Chart
    
    colors = ["#6658dd",];
(dataColors = $("#line-2").data("colors")) && (colors = dataColors.split(","));
var options = {
    chart: {
        height: 380,
        type: "line",
        zoom: {
            enabled: !1
        },
        toolbar: {
            show: !1
        }
    },
    colors: colors,
    dataLabels: {
        enabled: !0
    },
    stroke: {
        width: [3, 3],
        curve: "smooth"
    },
    
    series: [{
        name: average,
        data: [90,65,75,99,84,57]
    }],
    title: {
        text: subject_average,
        align: "left",
        style: {
            fontSize: "14px",
            color: "#666"
        }
    },
    grid: {
        row: {
            colors: ["transparent", "transparent"],
            opacity: .2
        },
        borderColor: "#f1f3fa"
    },
    markers: {
        style: "inverted",
        size: 6
    },
    xaxis: {
        type: "datetime",
        categories: ["1/11/2000", "2/11/2000", "3/11/2000", "4/11/2000", "5/11/2000", "6/11/2000", "7/11/2000" ]
    },
    yaxis: {
        title: {
            text: average
        },
        min: 0,
        max: 100
    },
    legend: {
        position: "top",
        horizontalAlign: "right",
        floating: !0,
        offsetY: -25,
        offsetX: -5
    },
    responsive: [{
        breakpoint: 600,
        options: {
            chart: {
                toolbar: {
                    show: !1
                }
            },
            legend: {
                show: !1
            }
        }
    }]
};
(chart = new ApexCharts(document.querySelector("#line-2"), options)).render();
    
}).on('hidden.bs.modal',function(event){
    
});

$('#modal-1').on('shown.bs.modal',function(event){

    
    //Start of apex-line-2 Chart
    
    colors = ["#4fc6e1"];
(dataColors = $("#line-1").data("colors")) && (colors = dataColors.split(","));
var options = {
    chart: {
        height: 380,
        type: "line",
        zoom: {
            enabled: !1
        },
        toolbar: {
            show: !1
        }
    },
    colors: colors,
    dataLabels: {
        enabled: !0
    },
    stroke: {
        width: [3, 3],
        curve: "smooth"
    },
    
    series: [{
        name: average,
        data: [90,65,75,99,84,57]
    }],
    title: {
        text: subject_average,
        align: "left",
        style: {
            fontSize: "14px",
            color: "#666"
        }
    },
    grid: {
        row: {
            colors: ["transparent", "transparent"],
            opacity: .2
        },
        borderColor: "#f1f3fa"
    },
    markers: {
        style: "inverted",
        size: 6
    },
    xaxis: {
        type: "datetime",
        categories: ["1/11/2000", "2/11/2000", "3/11/2000", "4/11/2000", "5/11/2000", "6/11/2000", "7/11/2000" ]
    },
    yaxis: {
        title: {
            text: average
        },
        min: 40,
        max: 100
    },
    legend: {
        position: "top",
        horizontalAlign: "right",
        floating: !0,
        offsetY: -25,
        offsetX: -5
    },
    responsive: [{
        breakpoint: 600,
        options: {
            chart: {
                toolbar: {
                    show: !1
                }
            },
            legend: {
                show: !1
            }
        }
    }]
};
(chart = new ApexCharts(document.querySelector("#line-1"), options)).render();
    
}).on('hidden.bs.modal',function(event){
    
});
    