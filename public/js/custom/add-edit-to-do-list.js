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
            fileBloc.append(fileName).append('<span class="file-delete"><span style="margin-left: 1px; color: red; font-weight: bold; margin-right: 5px;">X</span></span>');
                
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
            console.log('123')
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
    
    $('span.file-delete').click(function () {
        console.log('123')
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
    // file change end
    // add checklist start 
    const addCheckListInp = document.getElementById('addCheckList');
    const addCheckListBtn = document.getElementById('addBtn');
    const taskList = document.getElementById('taskList');

    addCheckListBtn.addEventListener('click', createTask);

    function createTask() {
        console.log('ckd',taskList)
        let val = addCheckListInp.value;
        createLi(taskList, val);
    }

    function createLi(ul, value) {
        let li = document.createElement('li');
        let content = document.createElement('p');
        content.innerHTML = value;
        console.log("createLi")
        console.log(content)
        console.log(li)
        li.appendChild(content);
        ul.appendChild(li);
        console.log(ul)

        createIcons(content);
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

    function createIcons(content) {
        // const checkTask = document.createElement('input');
        const removeTaskBtn = document.createElement('button');

        // checkTask.type = 'checkbox';
        // checkTask.addEventListener('click', doneTask);

        removeTaskBtn.innerHTML = 'X';
        removeTaskBtn.style.marginLeft = '5px';
        removeTaskBtn.style.color = 'red';
        removeTaskBtn.style.fontWeight = 'bold';
        removeTaskBtn.addEventListener('click', removeTask);
        console.log("create icon")
        console.log(removeTaskBtn)
        // li.appendChild(checkTask);
        content.appendChild(removeTaskBtn);
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
                        // $('.addToDoTask').modal('hide');
                        $('#addToDoList')[0].reset();
                        window.location.href = gettoDoListURL;
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

    // update checklist end 
    // update form submit start
    // rules validation

    $("#updateToDoList").validate({
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
    $('#updateToDoList').on('submit', function (e) {
        e.preventDefault();
        var toDoListValid = $("#updateToDoList").valid();
        // console.log(toDoListValid);
        if (toDoListValid === true) {

            var old_updated_file = $(".old_file_updated").map(function() {
                return $(this).text();
              }).get().join(','); 
            var title = $("#title").val();
            var id = $("#id").val();
            var dueDate = $("#dueDate").val();
            var assign_to = $("#assign_to").val();
            var old_file = $("#old_file").val();
            var priority = $("#priority").val();
            var task_description = $("#task_description").val();
            var files = $("#attachment").get(0).files;
            var formData = new FormData();
            formData.append("title", title);
            formData.append("id", id);
            formData.append("due_date", dueDate);
            formData.append("assign_to", assign_to);
            formData.append("priority", priority);
            formData.append("old_updated_file", old_updated_file);
            formData.append("check_list", checkListData);
            formData.append("task_description", task_description);
            formData.append("old_file", old_file);
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
                        // $('.updateToDoTask').modal('hide');
                        $('#updateToDoList')[0].reset();
                        window.location.href = gettoDoListURL;
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
    // update form submit end

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

    
    var old_checkk_list = $("#old_check_list").val();
    if(old_checkk_list){
        var old_checkk_list = old_checkk_list.split(',');
        $.each(old_checkk_list, function (key, val) {
            console.log(key,val)
            createListTask(val)
        });
    }
    
    
    function createListTask(val) {
        console.log(1,val)
        createLi(taskList, val);
    }

});