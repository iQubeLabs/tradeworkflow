<section class="content">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class='box box-primary'>
                <div class='box-body'>
                    <h4>
                        <?php echo $this->Session->flash();?>
                    </h4>
                </div>
            </div>
            <div>
                <?php
                    echo $this->Html->link("View all Documents", array("controller" => "documents",
                              "action" => "index", 'all'), array("class"=>"btn btn-success"));
                ?>
            </div>
        </div>
    </div>
</section>