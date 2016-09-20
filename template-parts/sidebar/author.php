<?php $u = wp_get_current_user(); ?>
<nav class="sidebar-menu js-menu">
    <ul id="menu-sidemenu" class="menu">
        <li>
            <a href="#"><?php echo $u->display_name ?></a>
            <svg>
                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-plus"></use>
            </svg>
            <ul class="sub-menu">
	            <li>
	                <a href="#">Menupunkt</a>
                </li>
                <li>
	                <a href="#">Menupunkt</a>
                </li>
                <li>
	                <a href="#">Menupunkt</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="#">Øvelser og forløb</a>
            <svg>
                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-plus"></use>
            </svg>
            <ul class="sub-menu">
	            <li>
	                <a href="#">Mine øvelser</a>
                </li>
                <li>
	                <a href="#">Mine forløb</a>
                </li>
            </ul>
        </li>
    </ul>
</nav>
