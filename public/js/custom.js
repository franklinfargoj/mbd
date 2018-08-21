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
});
