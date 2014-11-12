<?php
$flash = $this->Session->flash();
if($flash)
{
?>
    <div class='box box-success'>
        <div class='box-body'>
            <?php echo $flash;?>
        </div>

    </div>                
    <p/>
<?php
}
?>