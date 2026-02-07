<section id="main-section-1" class="main-section alternate-color section-first ">
    <div class="container">
        <div class="content">
            <div class="content-inner">
                <div class="slider--home-hero">
                    <div class="slider-items" data-flickity='{ "wrapAround": true, "groupCell": 1, "imagesLoaded": true }'>
                        <div class="slider-item">
                            <div class="slider-item-inner">
                                <div class="slider-media">
                                    <img src="<?php echo __PATH_TEMPLATE_IMG__; ?>slider/alchemist.jpg" alt="Nuevo Personaje, Alchemist">
                                </div>
                                <div class="slider-content">
                                    <div class="heading-wrapper">
                                        <h5 class="heading-element">
                                            Prueba a la nueva personaje, la Alchemist!
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="slider-item">
                            <div class="slider-item-inner">
                                <div class="slider-media">
                                    <img src="<?php echo __PATH_TEMPLATE_IMG__; ?>slider/alchemist.jpg" alt="Nuevo Personaje, Alchemist">
                                </div>
                                <div class="slider-content">
                                    <div class="heading-wrapper">
                                        <h5 class="heading-element">
                                            Prueba a la nueva personaje, la Alchemist!
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="slider-item">
                            <div class="slider-item-inner">
                                <div class="slider-media">
                                    <img src="<?php echo __PATH_TEMPLATE_IMG__; ?>slider/alchemist.jpg" alt="Nuevo Personaje, Alchemist">
                                </div>
                                <div class="slider-content">
                                    <div class="heading-wrapper">
                                        <h5 class="heading-element">
                                            Prueba a la nueva personaje, la Alchemist!
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section id="main-section-2" class="main-section alternate-color section-news">
    <div class="container">
        <div class="content">
            <div class="content-inner">
                <div class="title-box">
                    <div class="heading-wrapper">
                        <h5 class="heading-element">
                            Noticias
                        </h5>
                    </div>
                </div>
                <div class="news-wrapper">
                    <?php
                        function we_convert_long_date_to_short(string $html): string {
                                return preg_replace_callback(
                                    '/([A-Za-z]+,\s+[A-Za-z]+\s+\d{1,2}(?:st|nd|rd|th)?\s+\d{4})/',
                                    function ($matches) {
                                        $date = DateTime::createFromFormat('l, F jS Y', $matches[1]);
                            
                                        if (!$date) {
                                            // fallback por si cambia el formato
                                            $date = new DateTime($matches[1]);
                                        }
                            
                                        return $date ? $date->format('d/m/Y') : $matches[1];
                                    },
                                    $html
                                );
                            }
                            ob_start();
                            $handler->loadModule('news','');
                            $news_html = ob_get_clean();
                            
                            // convertir fechas
                            $news_html = we_convert_long_date_to_short($news_html);
                            
                            echo $news_html;
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>
<section id="main-section-3" class="main-section alternate-color">
    <div class="container">
        <div class="content">
            <div class="content-inner">

            </div>
        </div>
    </div>
</section>
<section id="main-section-4" class="main-section alternate-color">
    <div class="container">
        <div class="content">
            <div class="content-inner">

            </div>
        </div>
    </div>
</section>