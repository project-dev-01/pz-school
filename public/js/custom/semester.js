$(function () {
    $(document).ready(function () {

        $('#addSemesterModal').on('shown.bs.modal', function () {
            // $('.input-group.date').datepicker({
            //     format: "dd/mm/yyyy",
            //     startDate: "01-01-2015",
            //     endDate: "01-01-2020",
            //     todayBtn: "linked",
            //     autoclose: true,
            //     todayHighlight: true,
            //     container: '#addSemesterModal modal-body'
            // });
            $("#start_date").datepicker({
                dateFormat: 'yy-mm-dd',
                changeMonth: true,
                changeYear: true,
                autoclose: true,
                yearRange: "-100:+50", // last hundred years
                container: '#addSemesterModal modal-body'
            });
            $("#end_date").datepicker({
                dateFormat: 'yy-mm-dd',
                changeMonth: true,
                changeYear: true,
                autoclose: true,
                yearRange: "-100:+50", // last hundred years
                container: '#addSemesterModal modal-body'
            });
        });

        $('#editSemesterModal').on('shown.bs.modal', function () {
            $("#edit_start_date").datepicker({
                dateFormat: 'yy-mm-dd',
                changeMonth: true,
                changeYear: true,
                autoclose: true,
                yearRange: "-100:+50", // last hundred years
                container: '#editSemesterModal modal-body'
            });
            $("#edit_end_date").datepicker({
                dateFormat: 'yy-mm-dd',
                changeMonth: true,
                changeYear: true,
                autoclose: true,
                yearRange: "-100:+50", // last hundred years
                container: '#editSemesterModal modal-body'
            });
        });

    });


    semesterTable();
    $("#semesterForm").validate({
        rules: {
            name: "required",
            start_date: "required",
            end_date: "required",
            year: "required",
        }
    });
    $("#edit-semester-form").validate({
        rules: {
            name: "required",
            start_date: "required",
            end_date: "required",
            year: "required",
        }
    });
    // add semester
    $('#semesterForm').on('submit', function (e) {
        e.preventDefault();
        var semesterCheck = $("#semesterForm").valid();
        if (semesterCheck === true) {
            var form = this;

            $.ajax({
                url: $(form).attr('action'),
                method: $(form).attr('method'),
                data: new FormData(form),
                processData: false,
                dataType: 'json',
                contentType: false,
                success: function (data) {
                    // console.log("------")
                    console.log(data)
                    if (data.code == 200) {
                        $('#semester-table').DataTable().ajax.reload(null, false);
                        $('.addSemester').modal('hide');
                        $('.addSemester').find('form')[0].reset();
                        toastr.success(data.message);
                    } else {
                        toastr.error(data.message);
                    }
                }
            });
        }
    });

    // get all semester table
    function semesterTable() {
        $('#semester-table').DataTable({
            processing: true,
            info: true,
            // dom: 'lBfrtip',
            dom: "<'row'<'col-sm-2'l><'col-sm-2'B><'col-sm-8'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            buttons: [
                {
                    extend: 'csv',
                    text: 'Download CSV',
                    extension: '.csv',
                    exportOptions: {
                        columns: 'th:not(:last-child)'
                    }
                }
            ],
            ajax: semesterList,
            "pageLength": 5,
            "aLengthMenu": [
                [5, 10, 25, 50, -1],
                [5, 10, 25, 50, "All"]
            ],
            columns: [
                {
                    searchable: false,
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'start_date',
                    name: 'start_date'
                },
                {
                    data: 'end_date',
                    name: 'end_date'
                },
                {
                    data: 'year',
                    name: 'year'
                },
                {
                    data: 'actions',
                    name: 'actions',
                    orderable: false,
                    searchable: false
                },
            ]
        }).on('draw', function () {
        });
    }
    // get row
    $(document).on('click', '#editSemesterBtn', function () {
        var id = $(this).data('id');

        $('.editSemester').find('form')[0].reset();
        $.post(semesterDetails, { id: id }, function (data) {
            $('.editSemester').find('input[name="id"]').val(data.data.id);
            $('.editSemester').find('input[name="name"]').val(data.data.name);
            $('.editSemester').find('input[name="start_date"]').val(data.data.start_date);
            $('.editSemester').find('input[name="end_date"]').val(data.data.end_date);
            $('.editSemester').find('input[name="year"]').val(data.data.year);
            $('.editSemester').modal('show');
        }, 'json');
        console.log(id);
    });
    // update Semester
    $('#edit-semester-form').on('submit', function (e) {
        e.preventDefault();
        var edt_semesterCheck = $("#edit-semester-form").valid();
        if (edt_semesterCheck === true) {

            var form = this;
            $.ajax({
                url: $(form).attr('action'),
                method: $(form).attr('method'),
                data: new FormData(form),
                processData: false,
                dataType: 'json',
                contentType: false,
                success: function (data) {
                    if (data.code == 0) {
                        $.each(data.error, function (prefix, val) {
                            $(form).find('span.' + prefix + '_error').text(val[0]);
                        });
                    } else {

                        if (data.code == 200) {
                            $('#semester-table').DataTable().ajax.reload(null, false);
                            $('.editSemester').modal('hide');
                            $('.editSemester').find('form')[0].reset();
                            toastr.success(data.message);
                        } else {
                            $('.editSemester').modal('hide');
                            $('.editSemester').find('form')[0].reset();
                            toastr.error(data.message);
                        }
                    }
                }
            });
        }
    });
    // delete SemesterDelete
    $(document).on('click', '#deleteSemesterBtn', function () {
        var id = $(this).data('id');
        var url = semesterDelete;
        swal.fire({
            title: 'Are you sure?',
            html: 'You want to <b>delete</b> this Semester',
            showCancelButton: true,
            showCloseButton: true,
            cancelButtonText: 'Cancel',
            confirmButtonText: 'Yes, Delete',
            cancelButtonColor: '#d33',
            confirmButtonColor: '#556ee6',
            width: 400,
            allowOutsideClick: false
        }).then(function (result) {
            if (result.value) {
                $.post(url, {
                    id: id
                }, function (data) {
                    if (data.code == 200) {
                        $('#semester-table').DataTable().ajax.reload(null, false);
                        toastr.success(data.message);
                    } else {
                        toastr.error(data.message);
                    }
                }, 'json');
            }
        });
    });
});