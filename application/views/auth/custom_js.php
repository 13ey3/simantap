<script>
  $(document).ready(function() {
    $('.refreshCaptcha').on('click', function() {
      $.get('<?= base_url() ?>register/refresh_capcay', function(data) {
        $('#captImg').html(data);
      })
    });

    hideFailedLogin();
  });

  function hideFailedLogin() {
    var alert = document.querySelector('.failed-login');
    console.log(alert);

    setTimeout(() => {
      alert.style.display = 'none';
    }, 5000);
  }
</script>