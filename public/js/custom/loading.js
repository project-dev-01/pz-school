$(function () {
        var counter = 5;
        var myCounter = setInterval(myFunction, 1000);

        function myFunction() {
            if (counter > 0) {
                document.getElementById("greetingRingCnt").innerHTML = counter;
                counter--;
            }
            else {
                var redirectUrl = document.getElementById("redirect_route").value;
                window.location.href = redirectUrl;
            }
        }
});