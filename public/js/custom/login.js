// $(function () {

//     var baseURL = "{{ URL::to('/') }}";
//     $('#LoginAuth').on('submit', function(e){
//         e.preventDefault();
//         var form = this;
//         var Login = "http://localhost/school-management-system/public/api/login";
//         // alert("hhjhj");
//         $.ajax({
//             url: Login,
//             // url:$(form).attr('action'),
//             method:$(form).attr('method'),
//             data:new FormData(form),
//             processData:false,
//             dataType:'json',
//             contentType:false,
//             beforeSend: function(){
//                  $(form).find('span.error-text').text('');
//             },
//             success: function(data){

//                 console.log("******")
//                 console.log(data)
//                 window.location.href = baseURL+"/dashboard";
//                 // window.location.href = "/dashboard";
//                 //   if(data.code == 0){
//                 //       $.each(data.error, function(prefix, val){
//                 //           $(form).find('span.'+prefix+'_error').text(val[0]);
//                 //       });
//                 //   }else{
//                 //       $('#class-table').DataTable().ajax.reload(null, false);
//                 //       $('.addClassModal').modal('hide');
//                 //       $('.addClassModal').find('form')[0].reset();
//                 //       toastr.success(data.msg);
//                 //   }
//             }
//         });
//     });

// });