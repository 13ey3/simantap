<script>
  $(document).ready(function(){
    $('.refreshCaptcha').on('click', function(){
      $.get('<?= base_url() ?>captcha/refresh', function(data){
        $('#captImg').html(data);
      })
    });
  });
</script>