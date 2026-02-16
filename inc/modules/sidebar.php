<div class="sidebar-wrapper">
    <div class="sidebar-blocks">
        <div class="sidebar-block sidebar-block-status">
            <div class="sidebar-block-inner">
                <div class="block-title">
                    Estado del Servidor
                </div>
                <div class="block-content">
                    <div class="block-content-block">
                        <div class="block-label">
                            Estado
                        </div>
                        <div class="block-content-inner">
                            <?php echo checkServerStatus(); ?>
                        </div>
                    </div>
                    <!--
                    <div class="block-content-block">
                        <div class="block-label">
                            Jugadores Online
                        </div>
                        <div class="block-content-inner">
                            <?php //echo number_format($onlinePlayers); ?>
                        </div>
                        <div class="online-players-bar">
                            <div class="webengine-online-bar-progress" style="width:<?php echo $onlinePlayersPercent; ?>%;"></div>
                        </div>
                    </div>-->
                </div>
            </div>
        </div>
        <div class="sidebar-block sidebar-block-info">
            <div class="sidebar-block-inner">
                <div class="block-title">
                    Info del Servidor
                </div>
                <div class="block-content">
                    <div class="block-content-block">
                        <div class="block-label">
                            Exp:
                        </div>
                        <div class="block-content-inner">
                            1500x
                        </div>
                    </div>
                    <div class="block-content-block">
                        <div class="block-label">
                            Master Exp:
                        </div>
                        <div class="block-content-inner">
                            1250x
                        </div>
                    </div>
                    <div class="block-content-block">
                        <div class="block-label">
                            Enhance Exp:
                        </div>
                        <div class="block-content-inner">
                            1000x
                        </div>
                    </div>
                    <div class="block-content-block">
                        <div class="block-label">
                            Drop:
                        </div>
                        <div class="block-content-inner">
                            30%
                        </div>
                    </div>
                    <div class="block-content-block">
                        <div class="block-label">
                            Season:
                        </div>
                        <div class="block-content-inner">
                            20
                        </div>
                    </div>
                    <div class="block-content-block">
                        <div class="block-label">
                            Tipo:
                        </div>
                        <div class="block-content-inner">
                            Reset
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="sidebar-block sidebar-block-events">
            <div class="sidebar-block-inner">
                <div class="block-title">
                    Horario de Eventos
                </div>
                <div class="block-content">
                    <div class="block-content-block">
                        <?php templateEventScheduleWidget(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>