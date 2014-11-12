<?php
echo $this->element("flash_error");
?>
<script>
    
    (function(){
        //return result
        try
        {
            var result = {
                FormM: {
                    id: <?php echo $formMId;?>,
                    name: "<?php echo $formMName;?>"
                }
            }
            window.opener.HandlePopupResult(result);
        }
        catch (err){}
        
        //close popup after 2s
        setTimeout(function(){
            window.close();
        }, 2000);
        
        return false;
    })();
</script>