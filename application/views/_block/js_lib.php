  <!-- Bootstrap core JavaScript-->
  <script src="<?= base_url() ?>publik/vendor/jquery/jquery.min.js"></script>
  <script src="<?= base_url() ?>publik/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?= base_url() ?>publik/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="<?= base_url() ?>publik/js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="<?= base_url() ?>publik/vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="<?= base_url() ?>publik/vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <script>
    function ready(callbackFunc) {
      if (document.readyState !== 'loading') {
        // Document is already ready, call the callback directly
        callbackFunc();
      } else if (document.addEventListener) {
        // All modern browsers to register DOMContentLoaded
        document.addEventListener('DOMContentLoaded', callbackFunc);
      } else {
        // Old IE browsers
        document.attachEvent('onreadystatechange', function() {
          if (document.readyState === 'complete') {
            callbackFunc();
          }
        });
      }
    }

    ready(function() {
      menus();
    });

    function menus() {
      $.get(base_url + 'menus/menu_ajax', (result) => {
        let res = JSON.parse(result);

        menu_utama(res);
      });
    }

    function menu_utama(param) {

      const view_menu = document.getElementById('menu_utama');
      const parent_link = '<?= $parent_menu ?>';
      const child_link = '<?= isset($child_menu) ? $child_menu : "" ?>';
      let html_menu = '';
      let link_menu = '';

      for (let i = 0; i < param.parent_menu.length; i++) {
        let parent_menu = param.parent_menu[i];
        let active = (parent_link == parent_menu.link) ? 'active' : '';
        let collapsed = (parent_link == parent_menu.link) ? '' : 'collapsed';
        let collapsed_show = (parent_link == parent_menu.link) ? 'show' : '';

        if (parent_menu.have_child === true) {

          html_menu += `<li class="nav-item ${active}">
                          <a href="#" class="nav-link ${collapsed}" data-toggle="collapse" data-target="#collapse${parent_menu.id}" aria-expanded="true" aria-controls="collapse${parent_menu.id}">
                            <i class="${parent_menu.icon}"></i>
                            <span>${parent_menu.nama}</span>
                          </a>
                          <div id="collapse${parent_menu.id}" class="collapse ${collapsed_show}" aria-labelledby="heading${parent_menu.id}" data-parent="#accordionSidebar">
                            <div class="bg-white py-2 collapse-inner rounded">
                            `;

          param.child_menu.forEach(e => {
            let active = (child_link == e.link) ? 'active' : '';
            if (e.parent_id === parent_menu.id) {

              html_menu += `<a class="collapse-item ${active}" href="${base_url + e.link}">${e.nama}</a>`;
            }
          });

          html_menu += '</div></div></li>';
        } else {
          html_menu += `<li class="nav-item ${active}">
                            <a class="nav-link" href="${base_url + parent_menu.link}">
                                <i class="${parent_menu.icon}"></i>
                                <span>${parent_menu.nama}</span></a>
                        </li>`;
        }
      }

      view_menu.innerHTML = html_menu;
    }
  </script>