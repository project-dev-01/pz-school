$(function () {
    var radar;
    callradarchart();
    function callradarchart() {

        $.post(getTestScore, {
            token: token,
            branch_id: branchID,
            student_id: ref_user_id,
            academic_session_id: academic_session_id
        }, function (response) {
            console.log('res', response)
            if (response.code == 200) {
                // var marks = response.data.marks;
                // var subjects = response.data.subjects;
                var subjects = response.data.headers;
                var marks = response.data.allbyStudent;
                var data = [];
                var label = [];
                // console.log(marks);
                // console.log(subjects);
                if (subjects.length > 0 && marks.length) {
                    subjects.forEach(function (res) {
                        label.push(res.subject_name);
                    });
                    $.each(marks, function (key, value) {
                        var randcol = getRandomColor();
                        var obj = {};
                        var score = [];
                        obj["label"] = value.exam_name;
                        obj["backgroundColor"] = hexToRGB(randcol, 0.3);
                        obj["borderColor"] = randcol;
                        obj["pointBackgroundColor"] = randcol;
                        obj["pointBorderColor"] = "#fff";
                        obj["pointHoverBackgroundColor"] = "#fff";
                        obj["pointHoverBorderColor"] = randcol;
                        $.each(value.student_class, function (keys, val) {
                            let mark = parseInt(val.marks);
                            score.push(mark);
                        });
                        obj["data"] = score;
                        // console.log("---");
                        // console.log(obj);
                        data.push(obj);
                    });
                    // console.log(data);
                    // console.log(label);
                    radarChart(label, data);
                }
            }
        }, 'json');
    }
    function radarChart(labels, obj) {

        if (radar) {
            radar.data.labels = labels;
            radar.data.datasets = obj;
            radar.update();
        } else {
            var ctx = document.getElementById("radar-chart-test-marks").getContext('2d');
            var defaultColors = ["#1abc9c", "#f1556c", "#4a81d4", "#e3eaef"];
            // var colors = dataColors ? dataColors.split(",") : defaultColors.concat();

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