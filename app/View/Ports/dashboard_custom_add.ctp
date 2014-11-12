<center>
    <h2>Loader of Ports from shippingports.org</h2>
    <form method="post" action="#">                
        <label for="state">Countries</label>
        <select name="data[Country][id]">
            <?php
            foreach ($countries as $country)
            {
                echo "<option value='".$country['Country']["id"]."'";
                if($lastId != null && $lastId == $country["Country"]["id"])
                    echo " selected='selected'";
                echo ">".$country['Country']["name"]."</option>";
            }
            ?>

        </select>
        <br/>
        <br/>
        <p>
            <textarea name="data[content]" placeholder="Content to be parsed here" 
                      rows="6" cols="50"><?php echo $this->get("content"); ?></textarea>
        </p>
        <p>
            <textarea rows="6" cols="50" placeholder="Parse content will appear here"><?php echo $this->get("result");?></textarea>
        </p>
        <input type="submit" value="Submit"/>
    </form>
</center>