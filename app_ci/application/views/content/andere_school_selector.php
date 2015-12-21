<!-- 
	 View met de verschillende scholen waaruit de student kan kiezen (deze bevinden zich binnen de provincie die de student gekozen heeft). 
-->
<div id="header">
    <?php
	$user_data = $this->session->userdata('user_data');

    ?>
    
    <h1>Waar ga je naar school?</h1>

</div>
<div class="panel-body">
    <div id="info" class="form-group col-sm-12">
<?php
    echo form_open("beursapp/andere_schoolForm");
//    echo form_open("beursapp/diploma");
?>
        
        
        <p>
            <input type="text" name="provincie" value="" placeholder="In welke regio ga je naar school?" class="form-control input-lg">
        </p>
        <p>
            <input type="text"  name="school" value="" placeholder="Op welke school zit je?" class="form-control input-lg">
        </p>
        
        <input type="submit" class="btn btn-warning btn-lg btn-block" value="Volgende">

<?php
        
    echo form_close(); 
?>
    </div>
</div>