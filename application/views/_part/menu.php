<?php foreach ($menus as $menu) { ?>
    <?php if ((int) $menu->header_id === (int) $parent_id) { ?>
        <li class="nav-item">
            <a href="<?= $menu->is_header === "1" ? 'javascript:void(0)' : site_url($menu->route) ?>" class="nav-link rounded-lg elevation-0 mb-1" data-toggle="tooltip" data-placement="right" title="<?= $menu->title ?>">
                <i class="nav-icon text-primary <?= $menu->icon ?? '' ?>"></i>
                <p>
                    <?= $menu->title ?>
                    <?= $menu->is_header === "1" ? '<i class="right fas fa-angle-left"></i>' : '' ?>
                </p>
            </a>

            <?php if ($menu->is_header === "1") { ?>
                <ul class="nav nav-treeview">
                    <?php $this->load->view('_part/menu', ['menus' => $menus, 'parent_id' => $menu->menu_id]); ?>
                </ul>
            <?php } ?>
        </li>
    <?php } ?>
<?php } ?>