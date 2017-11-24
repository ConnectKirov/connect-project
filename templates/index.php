<?php
    /**
    * @var $this Template
    */
?>
<div class="step main">
    <div class="back">
        <?=$this->renderInclude('includes/header',['transparent'=>true])?>
        <div class="content">
            <div class="centered">
                <div class="row connect">
                    <div class="connect_inner">
                    <div class="subject"><i>C</i><i>o</i><i>n</i><i>n</i><i>e</i><i>c</i><i>t</i></div>
                    <div class="text">Творческая IT-среда в Кирове</div>
                    </div>
                </div>
                <div class="row go">Приходи и работай. Бесплатно. Совсем.</div>
                <div class="row view">Смотреть рассписание</div>
                <div class="row down"><i class="fa fa-angle-down" aria-hidden="true"></i></div>
            </div>
        </div>
    </div>
</div>
<?=$this->renderInclude('schedule')?>
