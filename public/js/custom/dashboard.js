$(function () {
    // add department
    $('.taskListDashboard').on('click', function (e) {
        e.preventDefault();
        // var form = this;
        // $('#myModal').modal('toggle');
        $('#right-modal-dashboard').modal('show');
        // $('#myModal').modal('hide');
    });
    
    // add department
    $('.taskListDashboard2').on('click', function (e) {
        e.preventDefault();
        // var form = this;
        // $('#myModal').modal('toggle');
        $('#right-modal-dashboard-2').modal('show');
        // $('#myModal').modal('hide');
    });

    $(".homeWorkAdd").datepicker({
        dateFormat: 'dd-mm-yy'
    });
});