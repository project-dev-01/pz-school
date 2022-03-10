// // $('.studentDetails').on('shown.bs.modal', function (event) {
// //     console.log("event")
// //     console.log(event)
//     var studentID = $(this).find('input').val();
//     var classDate = $("#classDate").val();
//     var id = $(this).data('id');

//     console.log("---")
//     console.log(classDate)
//     console.log(studentID)
//     console.log(id)

//     ! function ($) {
//         "use strict";

//         var ChartJs = function () {
//             this.$body = $("body"),
//                 this.reasonChart = []
//         };

//         ChartJs.prototype.respChart = function (selector, type, data, options) {

//             // get selector by context
//             var ctx = selector.get(0).getContext("2d");
//             // pointing parent container to make chart js inherit its width
//             var container = $(selector).parent();

//             //default config
//             Chart.defaults.global.defaultFontColor = "#8391a2";
//             Chart.defaults.scale.gridLines.color = "#8391a2";

//             // this function produce the responsive Chart JS
//             function generateChart() {
//                 // make chart width fit with its container
//                 var ww = selector.attr('width', $(container).width());
//                 var chart;
//                 switch (type) {
//                     case 'Radar':
//                         chart = new Chart(ctx, {
//                             type: 'radar',
//                             data: data,
//                             options: options
//                         });
//                         break;
//                 }
//                 return chart;
//             };
//             // run function - render chart at first load
//             return generateChart();
//         },
//             // init various reasonChart and returns
//             ChartJs.prototype.initCharts = function () {
//                 var reasonChart = [];
//                 var defaultColors = ["#1abc9c", "#f1556c", "#4a81d4", "#e3eaef"];

//                 if ($('#reason-chart').length > 0) {
//                     var dataColors = $("#reason-chart").data('colors');
//                     var colors = dataColors ? dataColors.split(",") : defaultColors.concat();
//                     //radar chart
//                     var radarChart = {
//                         labels: ["Fever", "Bus Breakdown", "Book Missing", "Others"],
//                         datasets: [{
//                             label: "Reasons",
//                             backgroundColor: hexToRGB(colors[0], 0.3),
//                             borderColor: colors[0],
//                             pointBackgroundColor: colors[0],
//                             pointBorderColor: "#fff",
//                             pointHoverBackgroundColor: "#fff",
//                             pointHoverBorderColor: colors[0],
//                             data: [6, 1, 8, 12]
//                         },
//                         ]
//                     };
//                     var radarOpts = {
//                         maintainAspectRatio: false
//                     };
//                     reasonChart.push(this.respChart($("#reason-chart"), 'Radar', radarChart, radarOpts));
//                 }

//                 return reasonChart;
//             },
//             //initializing various components and plugins
//             ChartJs.prototype.init = function () {
//                 var $this = this;
//                 // font
//                 Chart.defaults.global.defaultFontFamily = 'Nunito,sans-serif';

//                 // init reasonChart
//                 $this.reasonChart = this.initCharts();

//                 // enable resizing matter
//                 $(window).on('resize', function (e) {
//                     $.each($this.reasonChart, function (index, chart) {
//                         try {
//                             chart.destroy();
//                         } catch (err) { }
//                     });
//                     $this.reasonChart = $this.initCharts();
//                 });
//             },

//             //init flotchart
//             $.ChartJs = new ChartJs, $.ChartJs.Constructor = ChartJs
//     }(window.jQuery),

//         //initializing ChartJs
//         function ($) {
//             "use strict";
//             $.ChartJs.init()
//         }(window.jQuery);

// // }).on('hidden.bs.modal', function (event) {

// // });

