// $(function () {
//     // Build the chart
//     Highcharts.setOptions({
//         // colors: ['#87e680', '#ee4947', '#c2bd11', '#f2ee74', '#ea2522', '#4960c4', '#c21411']
//         colors: ['#87e680', '#ee4947', '#c2bd11', '#4960c4', '#ea2522']
//     });

//     Highcharts.chart('attitude', {
//         chart: {
//             plotBackgroundColor: null,
//             plotBorderWidth: null,
//             plotShadow: false,
//             type: 'pie'
//         },
//         title: {
//             text: ""
//         },
//         tooltip: {
//             pointFormat: '{series.name}: <b>{point.percentage:.0f}%</b>'
//         },

//         plotOptions: {
//             pie: {
//                 startAngle: 0,
//                 allowPointSelect: false,
//                 dataLabels: {
//                     softConnector: false,
//                     enabled: true,
//                     connectorWidth: 0,
//                     formatter: function () {
//                         return Math.round((this.percentage * 100) / 100) + ' %';
//                     },
//                     distance: -30,
//                     color: 'white'
//                 },
//                 showInLegend: true
//             }
//         },
//         legend: {
//             align: 'left',
//             verticalAlign: 'top',
//             layout: 'vertical',
//             x: 40,
//             y: 50,
//             verticalAlign: 'middle',
//             useHTML: true,
//             itemMarginTop: 7,
//             itemMarginBottom: 7,
//         },

//         series: [{
//             type: 'pie',
//             name: 'Student Attitude',
//             // data: [
//             //     ['<i class="far fa-star" style="font-size:20px;color:#87e680"></i> ', 90],
//             //     ['<i class="far fa-star" style="font-size:20px;color:#ee4947"></i> ', 90],
//             //     ['<i class="far fa-heart" style="font-size:20px;color:#c2bd11"></i> ', 60,],
//             //     ['<i class="far fa-grin" style="font-size:20px;color:#f2ee74"></i>  ', 20],
//             //     ['<i class="far fa-angry" style="font-size:20px;color:#ea2522"></i>  ', 20],
//             //     ['<i class="far fa-thumbs-up" style="font-size:20px;color:#4960c4"></i>  ', 20],
//             //     ['<i class="far fa-thumbs-down" style="font-size:20px;color:#c21411"></i> ', 20],
//             // ],
//             data: [
//                 ['<i class="far fa-smile" style="font-size:20px;color:#87e680"> smile</i> ', 90],
//                 ['<i class="far fa-angry" style="font-size:20px;color:#ee4947"> angry</i> ', 90],
//                 ['<i class="far fa-dizzy" style="font-size:20px;color:#c2bd11"> dizzy</i> ', 60,],
//                 ['<i class="far fa-surprise" style="font-size:20px;color:#4960c4"> surprise</i>  ', 20],
//                 ['<i class="far fa-tired" style="font-size:20px;color:#ea2522"> tired</i> ', 20]
//             ],
//             dataLabels: {
//                 useHTML: true
//             },
//             animation: true
//         }],
//         responsive: {
//             rules: [{
//                 condition: {
//                     maxWidth: 500
//                 }
//             }]
//         }

//     });
// });