$('.firstModal').on('shown.bs.modal', function (event) {

    Apex.grid = {
        padding: {
            right: 0,
            left: 0
        }
    }, Apex.dataLabels = {
        enabled: !1
    };
    var randomizeArray = function (e) {
        for (var o, t, a = e.slice(), r = a.length; 0 !== r;) t = Math.floor(Math.random() * r), o = a[--r], a[r] = a[t], a[t] = o;
        return a
    },
        sparklineData = [47, 45, 54, 38, 56, 24, 65, 31, 37, 39, 62, 51, 35, 41, 35, 27, 93, 53, 61, 27, 54, 43, 19, 46],
        colorPalette = ["#00D8B6", "#008FFB", "#FEB019", "#FF4560", "#775DD0"],

        colors = ["#00b19d", "#f1556c"];
    (dataColors = $("#homework-status").data("colors")) && (colors = dataColors.split(","));
    options = {
        chart: {
            height: 320,
            type: "donut"
        },
        series: [1, 2],
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
        labels: [ "Complete", "Incomplete"],
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
    // checked and unchecked
    colors = ["#FEB019", "#775DD0"];
    (dataColors = $("#homework-checked-status").data("colors")) && (colors = dataColors.split(","));
    options = {
        chart: {
            height: 320,
            type: "donut"
        },
        series: [2, 1],
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
        labels: [ "Checked", "Unchecked"],
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
    (chart = new ApexCharts(document.querySelector("#homework-checked-status"), options)).render();


}).on('hidden.bs.modal', function (event) {

});

