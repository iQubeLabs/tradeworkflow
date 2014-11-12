<div class="paging">
    <ul class="pagination">
        <?php
            echo $this->Paginator->prev("«", array('tag'=>'li', 'disabledTag'=>'li'), null, array('class' => 'disabled'));
            echo $this->Paginator->numbers(array('separator' => '', "tag"=>"li", "currentClass"=>"active", "currentTag"=>"a"));
            echo $this->Paginator->next("»", array('tag'=>'li', 'disabledTag'=>'li'), null, array('class' => 'disabled'));
        ?>
    </ul>
</div>