<div class="body-menu-wrapper">
    <div class="body-menu-inner">
        <div class="body-menu-message">
            <?php if(isLoggedIn()) { ?>
                Bienvenid@
            <?php }else{ ?>
                No haz iniciado Sesion
            <?php } ?>
        </div>
        <ul class="body-menu">
            <?php if(isLoggedIn()) { ?>
                <li class="body-menu-item">
                    <a href="<?php echo __BASE_URL__; ?>usercp/"><span class="menu-inner">Panel de Usuario</span></a>
                </li>
            <?php }else{ ?>
                <li class="body-menu-item">
                    <a href="<?php echo __BASE_URL__; ?>register/"><span class="menu-inner">Registrate</span></a>
                </li>
                <li class="body-menu-item">
                    <a href="<?php echo __BASE_URL__; ?>login/"><span class="menu-inner">Log In</span></a>
                </li>
            <?php } ?>
        </ul>
    </div>
</div>