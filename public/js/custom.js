$(document).ready(function() {
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
});

// function generateDataTable(url)
// {
//     $('.datatable').DataTable({
//         processing: true,
//         serverSide: true,
//         ajax: url,
//         columnDefs: [{
//             targets: ['sr_no', 'sr_no1', 'sr_no2', 'sr_no3', 'sr_no4', 'sr_no5', 'sr_no6'],
//             className: 'mdl-data-table__cell--non-numeric'
//         }]
//     });
// }
