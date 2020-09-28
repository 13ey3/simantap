<script>
  $(document).ready(function() {
    $('#dataTable').DataTable({
      "scrollX": true,
      "lengthMenu": [ 5, 10, 25, 50, 75, 100 ],
      "pageLength": 5,
      "language": {
          "search": "Pencarian: _INPUT_", //search
          "lengthMenu": "Tampilkan data: _MENU_",
          "zeroRecords": "Data tidak ditemukan",
          "info": "Halaman _PAGE_ dari _PAGES_ dari _TOTAL_ data",
          "infoEmpty": "Halaman 0 dari 0 dari 0 data",
          "loadingRecords": "Loading...",
          "processing":     "Processing...",
      }
    });
  });
</script>
