$(function () {
    if ($("#hideGreeting").length > 0) {
        //it  exist
        var counter = 3;
        var myCounter = setInterval(myFunction, 1000);

        function myFunction() {
            if (counter > 0) {
                document.getElementById("greetingRingCnt").innerHTML = counter;
                counter--;
            }
            else {
                clearInterval(myCounter);
                $("#hideGreeting").fadeOut(1500);
                callGreatting(2);
            }
        }
    }
    // greating time close
    function callGreatting(greetting_id) {
        $.ajax({
            type: "POST",
            url: updateGreddingSession,
            data: { greetting_id: greetting_id },
            success: function (res) {
                console.log("--------")
                console.log(res)
            }
        });
    }
});