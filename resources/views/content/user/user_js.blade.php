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





{{-- /** to fetch list of the data of tags and populate the dropdown*/// --}}
<script>
  $(document).ready(function(){
    $('#role').change(function () {
      let id = $(this).val();

      if (id) {
        $.ajax({
          url: "{{ route('permissions.list', ['roleId' => ':id']) }}".replace(':id', id),
          method: 'GET',
          dataType: "json",
          success: function (data) {
            console.log(data);
            // populate the dropdown with the received tag data
            var options = '<option value=""> Select Permission </option>';
            $.each(data, function (index, permission) {
              var permissionName = permission.name;
              options += '<option value="' + permission.id + '">' + permissionName + '</option>';
            });
            $('#permissions').html(options);
          },
          error: function (response) {
            // Handle error if fetching tags fails
            console.error('Error fetching Permission:', response);
          }
        });
      }
    });
  });
</script>
















{{-- /////////////////////////////Pagination Delivery///////////////////////////////////// --}}
<script>
  $(document).on('click', '.pagination a', function(e){

  e.preventDefault();
  let page = $(this).attr('href').split('page=')[1];
  user(page);

});

function user(page) {
    $.ajax({
      url: "/pagination/paginate-user/"  + "?page=" + page, // Updated URL
        type: 'get',
        success: function(data) {
            $('.table-responsive').html(data);
        }
    });
}

</script>
{{-- ////////////////////////////////////////////////////////////////// --}}


{{-- /////////////////////////////Search User///////////////////////////////////// --}}

<script>
  $(document).on('keyup',function(e){
  e.preventDefault();
  let search_string=$('#search').val();

  $.ajax({
    url:"{{ route('search.user') }}",
    method:'GET',
    data:{
      search_string:search_string
    },
    success:function(data){

      $('.table-responsive').html(data);
    }

  });



})

</script>


{{-- ------------------------------------------------------------------------------------------ --}}


