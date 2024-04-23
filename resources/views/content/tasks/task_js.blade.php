<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Select2 JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

<script src="http://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
<script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>


<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
<!-- CSS files -->

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Toastr JS -->
<script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>



<meta name="csrf-token" content="{{ csrf_token() }}">

<script>
  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
</script>






{{-- /////////////////////////////Pagination Task///////////////////////////////////// --}}
<script>
  $(document).on('click', '.pagination a', function(e){

  e.preventDefault();
  let page = $(this).attr('href').split('page=')[1];
  task(page);
});

function task(page) {
    $.ajax({
      url: "/pagination/paginate-task?page=" + page,
        type: 'get',
        success: function(data) {
          console.log(data);
            $('.table-responsive').html(data);
        },error:function(response){
          console.log(response);
        }
    });
}

</script>
{{-- ////////////////////////////////////////////////////////////////// --}}



{{-- /////////////////////////////Search Task///////////////////////////////////// --}}
<script>
  function performSearch() {
    let search_string = $('#search').val();
    let adminId = $('#adminId').val();
    let date = $('#date').val();
    let assignedId =$('#assignedId').val();



    $.ajax({
      url: "/search-task/",
      method: 'GET',
      data: {
        search_string: search_string,
        adminId: adminId,
        date: date,
        assignedId: assignedId
      },
      success: function (data) {

        $('.table-responsive').html(data);
      },
      error: function (response) {
        console.log(response);
      }
    });
  }

  $(document).on('keyup', function (e) {

    performSearch();
  });

  $('#adminId').change(function () {

    performSearch();
  });

  $('#assignedId').change(function () {

    performSearch();
  });

  $('#date').change(function () {

    performSearch();
  });
</script>



{{-- /////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}




{{-- ////////////////////////////////////////Add Task///////////////////////////////////--}}
<script>
  $(document).ready(function(){
    $(document).on("click", '.add_task', function(e){
        e.preventDefault();
         let title = $('#title').val();
         let description= $('#description').val();
         let assignedNameId=$('#assignedName').val();
         let adminNameId=$('#adminName').val();
         let is_modal=true;

        $('.errMsgContainer').empty(); // Clear previous error messages

        $.ajax({
            url: "{{ route('tasks.store') }}",
            method: 'post',
            data: {

              title: title,
              description: description,
              assignedNameId: assignedNameId,
              adminNameId: adminNameId,
              is_modal: is_modal
            },
            dataType: "json",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {
              console.log(data);
              $('.errMsgContainer').empty(); // Clear previous error messages
              $("#addTaskModal").modal("hide");
              $('#addTaskForm')[0].reset();
              $('#data-table2').load(location.href+' #data-table2');
              $('#success1').show();
                /* hide success message after 4 seconds */
                setTimeout(function() {
                    $('#success1').hide();
                }, 2000); // 2000 milliseconds = 2 seconds
              $('.errMsgContainer').empty(); // Clear previous error messages

            },
            error: function(response) {
              console.log(response.responseJSON);

                $('.errMsgContainer').empty(); // Clear previous error messages
                errors = response.responseJSON.errors;
                $.each(errors, function(index, value){
                    $('.errMsgContainer').append('<span class="text-danger">'+value+'</span><br/>');
                });
            }
        });
    });
});
</script>
