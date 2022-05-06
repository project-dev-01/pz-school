$(function () {
    var radar;
    callradarchart();
    function callradarchart(){

        $.post(getTestScore, {
            token: token,
            branch_id: branchID,
            student_id: studentID,
        }, function (response) {
            console.log('res',response)
                if (response.code == 200) {
                    var marks = response.data.marks;
                    var subjects = response.data.subjects;
                    var data = [];
                    var label = [];
                    if (subjects.length > 0) {
                        subjects.forEach(function (res) {
                            label.push(res.subject_name);
                            
                        });
                        $.each(marks, function (key, value) {
                            var randcol = getRandomColor();
                            var obj = {};
                            var score= [];
                            obj["label"] = key;
                            obj["backgroundColor"] = hexToRGB(randcol, 0.3);
                            obj["borderColor"] = randcol;
                            obj["pointBackgroundColor"] = randcol;
                            obj["pointBorderColor"] =  "#fff";
                            obj["pointHoverBackgroundColor"] =  "#fff";
                            obj["pointHoverBorderColor"] = randcol;
                            $.each(value, function (key,val) {
                                score.push(val.score);
                            });
                            obj["data"] = score;
                            data.push(obj);
                        });
                        radarChart(label,data);
                    }
                }
        }, 'json');
    }
    radarChart();
    function radarChart(labels, obj) {

        if (radar) {
            radar.data.labels = labels;
            radar.data.datasets = obj;
            radar.update();
        } else {
            var ctx = document.getElementById("radar-chart-test-marks").getContext('2d');
            var defaultColors = ["#1abc9c", "#f1556c", "#4a81d4", "#e3eaef"];
            var colors = dataColors ? dataColors.split(",") : defaultColors.concat();

            radar = new Chart(ctx, {
                type: 'radar',
                data: {
                    
                    labels: labels,
                    // labels: labels,
                    datasets: obj
                },
            });
        }

    }

    function getRandomColor() {
        var letters = '0123456789ABCDEF';
        var color = '#';
        for (var i = 0; i < 6; i++) {
            color += letters[Math.floor(Math.random() * 16)];
        }
        return color;
    }
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
});