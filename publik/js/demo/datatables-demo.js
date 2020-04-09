// Call the dataTables jQuery plugin
$(document).ready(function() {
  $('#dataTable').DataTable({
    "lengthMenu": [ 10, 25, 50, 75, 100 ]
    "pageLength": 50
  });
});
