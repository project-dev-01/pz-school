$(function () {
    // add department
    $('.taskListDashboard').on('click', function (e) {
        e.preventDefault();
        // var form = this;
        // $('#myModal').modal('toggle');
        $('#right-modal-dashboard').modal('show');
        // $('#myModal').modal('hide');
    });
    $("#classDate").datepicker({
        dateFormat: 'dd-mm-yy'
    });

});