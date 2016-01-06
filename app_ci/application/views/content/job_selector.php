<!-- View waarop de mogelijke functies die Planet Talent aanbied weergegeven worden. -->
<div id="header">
<?php
    $user_data = $this->session->userdata('user_data'); 
    
    if(isset($user_data['jobs']))
    {
        $jobs = $user_data['jobs'];
    }
    else{
        $jobs = '';
    }
?>
	<h1>In welke functie(s) ben je geïnteresseerd?</h1>
</div>
<div class="panel-body">
<div id="info" class="form-group col-sm-12">
<?php
    echo form_open("beursapp/jobForm");
    # Er wordt gezocht of de waarde van de checkbox in de sessie zit (in het 'jobs' veld). Indien dit het geval is wordt de checkbox aangevinkt.
?>
    <BR>
    <div class="input-group input-group-lg">
        <span class="input-group-addon">
            <input <?php if(strpos($jobs,'ict_applications') !== false){ echo "checked";} ?> value="ict_applications" name="ict_applications" type="checkbox" id="ict_applications" aria-label="...">	
        </span>
        <label for="ict_applications" class="form-control" aria-label="...">
            ICT Applications
         </label>                            
    </div>

    <div class="input-group input-group-lg">
        <span class="input-group-addon">
            <input <?php if(strpos($jobs,'ict_infrastructure') !== false){ echo "checked";} ?> value="ict_infrastructure" name="ict_infrastructure" type="checkbox" id="ict_infrastructure" aria-label="...">
        </span>
        <label for="ict_infrastructure" class="form-control" aria-label="...">
            ICT Infrastructure
        </label>
    </div>

    <div class="input-group input-group-lg">
        <span class="input-group-addon">
            <input <?php if(strpos($jobs,'ict_ba_fa') !== false){ echo "checked";} ?> value="ict_ba_fa" name="ict_ba_fa" type="checkbox" id="ict_ba_fa" aria-label="...">
        </span>
        <label for="ict_ba_fa" class="form-control" aria-label="...">
            ICT Business Analyst / Functional Analyst
        </label>
    </div>

    <div class="input-group input-group-lg">
        <span class="input-group-addon">
            <input <?php if(strpos($jobs,'management') !== false){ echo "checked";} ?> value="management" name="management" type="checkbox" id="management" aria-label="...">
        </span>
        <label for="management" class="form-control" aria-label="...">
            Management
        </label>
    </div>

    <div class="input-group input-group-lg">
        <span class="input-group-addon">
            <input <?php if(strpos($jobs,'sales') !== false){ echo "checked";} ?> value="sales" name="sales" type="checkbox" id="sales" aria-label="...">	
        </span>
        <label for="sales" class="form-control" aria-label="...">
            Sales
        </label>
    </div>

    <br>
    <input type="submit" class="btn btn-lg btn-warning btn-block" value="Volgende">
<?php
    echo form_close(); 
?>
</div>
</div>