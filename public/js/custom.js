$(document).ready(function() {
  function generateDataTable(url)
  {
    $('.datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: url,
        columnDefs: [{
            targets: [0, 1, 2],
            className: 'mdl-data-table__cell--non-numeric'
        }]
    });
  }

  $("#boardForm").validate({
    // errorElement: "span",
    //errorClass : "text-red",
    rules:{
      board_name:"required"
    }
  });

  $("#departmentForm").validate({
    // errorElement: "span",
    //errorClass : "text-red",
    rules:{
      department_name:"required",
    }
  });

  if($("#frontEndRegisterForm").length > 0)
  {
    $("#frontEndRegisterForm").validate({
      rules:{
        name:"required",
        address:"required",
        mobile_no:{
                required: true,
                minlength: 10,
                maxlength: 10,
                number: true
            },
        email:{
                required: true,
                email: true,
              }
      }
    });
  }
});
