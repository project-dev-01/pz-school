$(function () {

    var checkListData = [];
    $("#dueDate").flatpickr({
        // enableTime: !0,
        enableTime: true,
        dateFormat: "Y-m-d H:i"
    });
    // file change start
    const dt = new DataTransfer(); // Permet de manipuler les fichiers de l'input file

    $(document).on('change', '.up', function (e) {
        for (var i = 0; i < this.files.length; i++) {
            let fileBloc = $('<span/>', { class: 'file-block' }),
                fileName = $('<span/>', { class: 'name', text: this.files.item(i).name });
            fileBloc.append('<span class="file-delete"><span>+</span></span>')
                .append(fileName);
            $("#filesList > #files-names").append(fileBloc);
        };
        // Ajout des fichiers dans l'objet DataTransfer
        for (let file of this.files) {
            dt.items.add(file);
        }
        // Mise à jour des fichiers de l'input file après ajout
        this.files = dt.files;

        // EventListener pour le bouton de suppression créé
        $('span.file-delete').click(function () {
            let name = $(this).next('span.name').text();
            // Supprimer l'affichage du nom de fichier
            $(this).parent().remove();
            for (let i = 0; i < dt.items.length; i++) {
                // Correspondance du fichier et du nom
                if (name === dt.items[i].getAsFile().name) {
                    // Suppression du fichier dans l'objet DataTransfer
                    dt.items.remove(i);
                    continue;
                }
            }
            // Mise à jour des fichiers de l'input file après suppression
            document.getElementById('attachment').files = dt.files;
        });
    });
    // file change end
    // add checklist start 
    const addCheckListInp = document.getElementById('addCheckList');
    const addCheckListBtn = document.getElementById('addBtn');
    const taskList = document.getElementById('taskList');

    addCheckListBtn.addEventListener('click', createTask);

    function createTask() {
        let val = addCheckListInp.value;
        createLi(taskList, val);
    }

    function createLi(ul, value) {
        let li = document.createElement('li');
        let content = document.createElement('p');
        content.innerHTML = value;
        li.appendChild(content);
        ul.appendChild(li);
        createIcons(li);
        checkListData.push(value);
        // reset feild
        addCheckListInp.value = "";
        // content.addEventListener('dblclick', editTask);
    }

    // function editTask() {
    //     const content = this;
    //     const editInp = document.createElement('input');
    //     editInp.value = content.innerHTML;
    //     content.innerHTML = '';
    //     content.appendChild(editInp);
    //     content.addEventListener('keydown', function (event) {
    //         const editKey = event.key;
    //         if (editKey == 'Enter') {
    //             content.innerHTML = editInp.value;
    //             content.removeChild(editInp);
    //         }
    //     });
    // }

    function createIcons(li) {
        // const checkTask = document.createElement('input');
        const removeTaskBtn = document.createElement('button');

        // checkTask.type = 'checkbox';
        // checkTask.addEventListener('click', doneTask);

        removeTaskBtn.innerHTML = 'X';
        removeTaskBtn.style.marginLeft = '5px';
        removeTaskBtn.style.color = 'red';
        removeTaskBtn.style.fontWeight = 'bold';
        removeTaskBtn.addEventListener('click', removeTask);

        // li.appendChild(checkTask);
        li.appendChild(removeTaskBtn);
    }

    // function doneTask() {
    //     const content = this.previousElementSibling;
    //     this.disabled = true;
    //     content.classList.add('done');
    //     content.removeEventListener('dblclick', editTask);
    // }

    function removeTask() {
        const li = this.parentElement;
        const ul = li.parentElement;
        const currentDelete = $(this).parent().find('p').text();

        var index = checkListData.indexOf(currentDelete);
        if (index >= 0) {
            checkListData.splice(index, 1);
        }
        console.log(checkListData);
        ul.removeChild(li);
    }
    // add checklist end 
    // add form submit start
    // rules validation
    $("#addToDoList").validate({
        rules: {
            "title": "required",
            "due_date": "required",
            "assign_to": "required",
            "priority": "required",
            "task_description": "required",
            "file": "required",
        }
    });
    // data bind 
    $('#addToDoList').on('submit', function (e) {
        e.preventDefault();
        var toDoListValid = $("#addToDoList").valid();
        // console.log(toDoListValid);
        if (toDoListValid === true) {

            var title = $("#title").val();
            var dueDate = $("#dueDate").val();
            var assign_to = $("#assign_to").val();
            var priority = $("#priority").val();
            var task_description = $("#task_description").val();
            var files = $("#attachment").get(0).files;
            var formData = new FormData();
            formData.append("title", title);
            formData.append("due_date", dueDate);
            formData.append("assign_to", assign_to);
            formData.append("priority", priority);
            formData.append("check_list", checkListData);
            formData.append("task_description", task_description);
            for (var i = 0; i < files.length; i++) {
                formData.append("file[]", files[i]);
            }

            $.ajax({
                url: toDoListURL,
                method: "post",
                data: formData,
                processData: false,
                dataType: 'json',
                contentType: false,
                success: function (response) {
                    console.log('data', 200)
                    console.log(response)
                    if (response.code == 200) {
                        toastr.success(response.message);
                        $('.addToDoTask').modal('hide');
                        $('.addToDoTask').find('form')[0].reset();
                        location.reload();
                        // $("#dassign_to").select2('val', '');

                        // $('#taskList').find('ul').empty();
                        // $('#filesList').find('#filesList').empty();
                    } else {
                        toastr.error(response.message);
                    }
                }
            });
        };
    });
    // add form submit end
    // get list
    // get all designation table for admin
    var table = $('#to-do-list-table').DataTable({
        processing: true,
        info: true,
        ajax: gettoDoListURL,
        "pageLength": 5,
        "aLengthMenu": [
            [5, 10, 25, 50, -1],
            [5, 10, 25, 50, "All"]
        ],
        columns: [
            {
                data: 'DT_RowIndex',
                name: 'DT_RowIndex'
            },
            {
                data: 'title',
                name: 'title'
            },
            {
                data: 'due_date',
                name: 'due_date'
            },
            {
                data: 'priority',
                name: 'priority'
            },
            {
                data: 'task_description',
                name: 'task_description'
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
    // get row
    $(document).on('click', '#editToDoListBtn', function () {
        var id = $(this).data('id');
        console.log(id);
        $('.editToDoTask').find('form')[0].reset();
        $.post(getToDORowURL, { id: id, token: token, branch_id: branchID }, function (data) {
            console.log("---");
            console.log(data);
            // $('.editToDoTask').find('input[name="id"]').val(data.data.id);
            // $('.editToDoTask').find('input[name="name"]').val(data.data.name);
            $('.editToDoTask').modal('show');
        }, 'json');
    });
    // deleteToDoList
    $(document).on('click', '#deleteToDoListBtn', function () {
        var id = $(this).data('id');
        var url = deleteToDoList;
        swal.fire({
            title: 'Are you sure?',
            html: 'You want to <b>delete</b> this list',
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
                    id: id,
                    token: token,
                    branch_id: branchID
                }, function (data) {
                    if (data.code == 200) {
                        $('#to-do-list-table').DataTable().ajax.reload(null, false);
                        toastr.success(data.message);
                    } else {
                        toastr.error(data.message);
                    }
                }, 'json');
            }
        });
    });
    
});