<section class="content-header">
    <h1>
        Document Tracking
    </h1>
    <ol class="breadcrumb">
        <li><?php echo $this->Html->link("Document Tracking", array("action"=>"index"));?></li>
        <li>View</li>
    </ol>
</section>
<?php // var_dump($document);?>
<section class="content">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <?php
            $this->element("flash_error");
            ?>
            
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Document Details</h3>
                </div>
                <div class="box-body">
                    <b>Courier Name:</b> <?php echo $document['Courier']['name']; ?>
                    <br/>
                    <b>Tracking Number:</b> <?php echo $document['Document']['tracking_number']; ?>
                    <br/>
                    <b>Courier Email:</b> <?php echo $document['Courier']['contact_email']; ?>
                    <br/>
                    <br/>
                    <b>Current Status:</b> <?php echo Document::$ENUM_STATUS[$document['Document']['status']]; ?>
                </div>
            </div>
            <p/>
            <div class='box box-primary'>
                <div class="box-header">
                    <h3 class="box-title">Update Document Status</h3>
                </div>
                <div class='box-body'>
                    <?php
                    /*$trackingNumber = (strlen($document['Document']['tracking_number']) == 0) ? "Update this field when tracking number has been gotten." : $document['Document']['tracking_number'];*/
                    /*$shippingDate = ($document['Document']['shipping_date'] == NULL) ? "Update this field when Shipping Date has been gotten." : $document['Document']['shipping_date'];
                    $expectedArrivalDate = ($document['Document']['expected_arrival_date'] == NULL) ? "Update this field when Date of arrival for shipping been gotten." : $document['Document']['expected_arrival_date'];*/
                    ?>
                    <form method="post">
                        <!-- <input type="hidden" name="data[Document][status]" value="1"/> -->
                        <div>
                            <label>Courier Status</label>
                            <select class="input-group col-md-8" name="data[Document][status]" required>
                                <option value="">Update Courier Status</option>
                                <option value="1">Document in transit</option>
                                <option value="2">Document has arrived</option>
                            </select>
                            <!-- <div class="form-group">
                                <label for="">Tracking Number:</label>
                                <input type="text" class="form-control" id="trackingNumber" name="data[Document][tracking_number]" value="<?php echo $trackingNumber;?>" placeholder="<?php echo $trackingNumber;?>" required/>
                            </div>
                            <p/>
                            <div class="form-group">
                                <label for="data[Document][shipping_date]">Shipping Date:</label>
                               <input type="text" class="form-control" id="shippingDate" data-format="yyyy-MM-dd" name="data[Document][shipping_date]" placeholder="<?php echo $shippingDate;?>" required/>
                           </div>
                           <p/>
                           <div class="form-group">
                               <label for="data[Document][expected_arrival_date]">Expected Date of Arrival:</label>
                            <input type="text" class="form-control" id="arrivalDate" data-format="yyyy-MM-dd" name="data[Document][expected_arrival_date]" placeholder="<?php echo $expectedArrivalDate; ?>" required/>
                           </div>
                           <p/>     --> <!-- OLUWASEGUN -->                       
                        </div>
                        <br/>
                        <div>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>