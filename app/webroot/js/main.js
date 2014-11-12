$(document).ready(function()
{
    var today = new Date();
    today.setHours(0);
    today.setMinutes(0);
    
    //for FormMsController.dashboard_add
   $(function() 
   {
        $('#registrationDate').datetimepicker({
            pickSeconds: false,
            startDate: today
        });
        
        $('#expiryDate').datetimepicker({
            pickSeconds: false,
            startDate: today
        });

        $('#dateOfShipment').datetimepicker({
            pickSeconds: false,
            startDate: today
        });

        $('#timeOfDelivery').datetimepicker({
            pickSeconds: false,
            startDate: today
        });
        
   
       var updateLoadingPortsFn = function(){
            var countryId = $("#loadingPortCountrySelect").val();
            console.log(countryId);
            $("#loadingPortSelect").empty().append('<option value="">Loading Ports, Pls wait</option>');
            
            $.get(siteUrl+"ajax/ports/get/"+countryId, function(data){
                var jsonData = JSON.parse(data)
                var updateFn = function()
                {
                    var output = '';
                    $.each(jsonData, function(key, value) {
                        output += '<option value="'+ value.Port.id+'">' + value.Port.name + '</option>';
                    });
                    return output;
                };
                
                $("#loadingPortSelect").empty().append(updateFn);                
                console.log(data);
            });
            
        };
        
        var updateDischargePortsFn = function(){
            var countryId = $("#dischargePortCountrySelect").val();
            console.log(countryId);
            $("#dischargePortSelect").empty().append('<option value="">Loading Ports, Pls wait</option>');
            
            $.get(siteUrl+"ajax/ports/get/"+countryId, function(data){
                var jsonData = JSON.parse(data)
                var updateFn = function()
                {
                    var output = '';
                    $.each(jsonData, function(key, value) {
                        output += '<option value="'+ value.Port.id+'">' + value.Port.name + '</option>';
                    });
                    return output;
                };
                
                $("#dischargePortSelect").empty().append(updateFn);
                
                console.log(data);
            });
            
        };
        
        updateLoadingPortsFn();
        updateDischargePortsFn();
        
        $("#loadingPortCountrySelect").change(updateLoadingPortsFn);
        $("#dischargePortCountrySelect").change(updateDischargePortsFn);
   });
   
   //for ShippingsController._view
   $(function(){
       var today = new Date();
        today.setHours(0);
        today.setMinutes(0);
        
       $('#shippingDate').datetimepicker({
            pickSeconds: false,
            startDate: today
        });
        
        $('#arrivalDate').datetimepicker({
            pickSeconds: false,
            startDate: today
        });
   });
   
   //to truncate the tiles in the homepage
   $('.truncate').each(function(index, element) {
        $clamp(element, { clamp: 3, useNativeClamp: true });
    });


   //to add up the fob value and freight value which gives us the total cfr
    $('body').on('keyup', '#fob_value, #freight_value', function(e) {
        fob_value = $('#fob_value').val();
        freight_value = $('#freight_value').val();
        total_cfr = parseFloat(fob_value) + parseFloat(freight_value);
        insured_value = 1.10 * total_cfr;
        if (!isNaN(total_cfr)) {
            $('#total_cfr, #totalcfr').val(total_cfr.toFixed(2));
            $('#insured_value, #insuredvalue').val(insured_value.toFixed(2));
        }
    });

    
});
