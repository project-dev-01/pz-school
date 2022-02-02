$('#latedetails').on('shown.bs.modal',function(event){



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
                        case 'Radar':
                            chart = new Chart(ctx, {
                                type: 'radar',
                                data: data,
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

                if ($('#reason-chart').length > 0) {
                    var dataColors = $("#reason-chart").data('colors');
                    var colors = dataColors ? dataColors.split(",") : defaultColors.concat();
                    //radar chart
                    var radarChart = {
                        labels: ["Fever", "Bus Breakdown", "Book Missing", "Others"],
                        datasets: [{
                                label: "Reasons",
                                backgroundColor: hexToRGB(colors[0], 0.3),
                                borderColor: colors[0],
                                pointBackgroundColor: colors[0],
                                pointBorderColor: "#fff",
                                pointHoverBackgroundColor: "#fff",
                                pointHoverBorderColor: colors[0],
                                data: [6, 1, 8, 12]
                            },
                        ]
                    };
                    var radarOpts = {
                        maintainAspectRatio: false
                    };
                    charts.push(this.respChart($("#reason-chart"), 'Radar', radarChart, radarOpts));
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


    //Pie Chart

    
    colors = ["#6658dd", "#4fc6e1", "#4a81d4", "#00b19d", "#f1556c"];
    (dataColors = $("#late-pie").data("colors")) && (colors = dataColors.split(","));
    options = {
        chart: {
            height: 320,
            type: "pie"
        },
        series: [4, 1, 6, 1, 3],
        labels: ["Before 5 mins", "Before 10 mins", "Before 20 mins", "Before 30 mins", "Other"],
        colors: colors,
        legend: {
            show: !0,
            position: "bottom",
            horizontalAlign: "center",
            verticalAlign: "middle",
            floating: !1,
            fontSize: "14px",
            offsetX: 0,
            offsetY: 7
        },
        responsive: [{
            breakpoint: 600,
            options: {
                chart: {
                    height: 240
                },
                legend: {
                    show: !1
                }
            }
        }]
    };
    (chart = new ApexCharts(document.querySelector("#late-pie"), options)).render();


}).on('hidden.bs.modal',function(event){
    
});

