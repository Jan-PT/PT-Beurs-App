<!-- View waarop de mogelijke functies die Planet Talent aanbied weergegeven worden. -->
<div id="header">
	<?php $user_data = $this->session->userdata('user_data'); ?>
	<h1>In welke functie(s) ben je geïnteresseerd?</h1>
</div>
<div class="panel-body">
<div id="info" class="form-group">
<?php
    echo form_open("beursapp/jobForm");
    # Er wordt gezocht of de waarde van de checkbox in de sessie zit (in het 'jobs' veld). Indien dit het geval is wordt de checkbox aangevinkt.
?>
    <BR>
    <div class="input-group">
        <span class="input-group-addon">
            <input <?php if(strpos($user_data['jobs'],'ict_applications') !== false){ echo "checked";} ?> value="ict_applications" name="ict_applications" type="checkbox" id="ict_applications" aria-label="...">	
        </span>
        <label for="ict_applications" class="form-control" aria-label="...">
            ICT Applications
         </label>                            
    </div>

    <div class="input-group">
        <span class="input-group-addon">
            <input <?php if(strpos($user_data['jobs'],'ict_infrastructure') !== false){ echo "checked";} ?> value="ict_infrastructure" name="ict_infrastructure" type="checkbox" id="ict_infrastructure" aria-label="...">
        </span>
        <label for="ict_infrastructure" class="form-control" aria-label="...">
            ICT Infrastructure
        </label>
    </div>

    <div class="input-group">
        <span class="input-group-addon">
            <input <?php if(strpos($user_data['jobs'],'management') !== false){ echo "checked";} ?> value="management" name="management" type="checkbox" id="management" aria-label="...">
        </span>
        <label for="management" class="form-control" aria-label="...">
            Management
        </label>
    </div>

    <div class="input-group">
        <span class="input-group-addon">
            <input <?php if(strpos($user_data['jobs'],'sales') !== false){ echo "checked";} ?> value="sales" name="sales" type="checkbox" id="sales" aria-label="...">	
        </span>
        <label for="sales" class="form-control" aria-label="...">
            Sales
        </label>
    </div>

    <br>
    <input type="submit" class="btn btn-warning col-sm-12" value="Volgende">
<?php
    echo form_close(); 
?>
</div>
</div>