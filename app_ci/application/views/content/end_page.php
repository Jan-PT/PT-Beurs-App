<div id="header">
    <h1> Bedankt voor je tijd! </h1>

</div>
<div class="panel-body">
    <div id="info" class="form-group col-sm-12">
    <?php    
        echo form_open("beursapp/endpageForm");
    ?>
                
        <h2>
            We sturen je weldra een bevestigingsmail met je persoonlijk logo.
        </h2>
        <br>
        
        <input type="submit" 
               class="btn btn-warning btn-lg btn-block" 
               value="Afsluiten">

        
    <?php
        echo form_close();
    ?>
        
    </div>
</div>
