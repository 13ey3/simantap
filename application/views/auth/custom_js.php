<script>
  $(document).ready(function(){
    $('.refreshCaptcha').on('click', function(){
      $.get('<?= base_url() ?>register/refresh_capcay', function(data){
        $('#captImg').html(data);
      })
    });
  });
</script>