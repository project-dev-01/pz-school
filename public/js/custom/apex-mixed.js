Apex.grid = {
    padding: {
        right: 0,
        left: 0
    }
}, Apex.dataLabels = {
    enabled: !1
};
var randomizeArray = function(e) {
        for (var o, t, a = e.slice(), r = a.length; 0 !== r;) t = Math.floor(Math.random() * r), o = a[--r], a[r] = a[t], a[t] = o;
        return a
    },
    sparklineData = [47, 45, 54, 38, 56, 24, 65, 31, 37, 39, 62, 51, 35, 41, 35, 27, 93, 53, 61, 27, 54, 43, 19, 46],
    colorPalette = ["#00D8B6", "#008FFB", "#FEB019", "#FF4560", "#775DD0"],

colors = ["#6658dd","#CED4DC"];
(dataColors = $("#apex-mixed-3").data("colors")) && (colors = dataColors.split(","));
options = {
    chart: {
        height: 380,
        type: "line"
    },
    stroke: {
        width: 2,
        curve: "smooth"
    },
    series: [{
        name: "PRESENT",
        type: "area",
        data: [100,99,85.71, 99, 99, 99, 14, 99]
    }, {
        name: "LATE",
        type: "line",
        data: [0,0, 0, 14.28, 0,0,14.28,28.57]
    }],
    colors: colors,
    fill: {
        type: "solid",
        opacity: [.35, 1]
    },
    labels: ["FEB 03", "FEB 04", "FEB 05", "FEB 06", "FEB 07","FEB 10", "FEB 11", "FEB 12"],
    markers: {
        size: 0
    },
    yaxis: [{
        min:0,
        max:100,
        title: {
            text: "PRESENT"
            
        },
        labels:{
            formatter: function(val,index) {
                return val;
            }
        }
    }, {
        min:0,
        max:100,
        opposite: !0,
        title: {
            text: "LATE"
        },
        labels:{
            formatter: function(val,index) {
                return val;
            }
        }
    }
],
    tooltip: {
        shared: !0,
        intersect: !1,
        y: {
            formatter: function(e) {
                return void 0 !== e ? e.toFixed(0) + " % " : e
            }
        }
    },
    legend: {
        offsetY: 7
    }
};
(chart = new ApexCharts(document.querySelector("#apex-mixed-3"), options)).render();

colors = ["#00b19d", "#f1556c", "#4FC6E1"];
(dataColors = $("#homework-status").data("colors")) && (colors = dataColors.split(","));
options = {
    chart: {
        height: 320,
        type: "donut"
    },
    series: [80, 15,5],
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
    labels: [ "Complete", "Incomplete","Late Submission"],
    colors: colors,
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
    }],
    fill: {
        type: "gradient"
    }
};
(chart = new ApexCharts(document.querySelector("#homework-status"), options)).render();