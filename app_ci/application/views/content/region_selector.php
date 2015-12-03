<div id="header">
    <?php
    if ($this->session->userdata('user_data')) {
        $user_data = $this->session->userdata('user_data');
        echo "<h1>Waar ga je naar school, " . $user_data['voornaam'] . "? - Provincie</h1>";
    }else{
        echo "<h1>Waar ga je naar school? - Provincie</h1>";
    }
    ?>
</div>
<div class="panel-body">
    <div id="info" class="form-group">
        <form>
            <div class="col-sm-4">
                <p><a href="<?php echo site_url('beursapp/school/Antwerpen');?>" id="provincie" value="Antwerpen" class="btn btn-warning" style="width:300px">Antwerpen</a></p>
                <p><a href="<?php echo site_url('beursapp/school/Oost-Vlaanderen');?>" id="provincie" value="Oost-Vlaanderen" class="btn btn-warning" style="width:300px">Oost-Vlaanderen</a></p>
                <p><a href="<?php echo site_url('beursapp/school/Limburg');?>" id="provincie" value="Limburg" class="btn btn-warning" style="width:300px">Limburg</a> </p>
            </div>
            <div class="col-sm-4">
                <p><a href="<?php echo site_url('beursapp/school/Vlaams-Brabant');?>" id="provincie" value="Vlaams-Brabant" class="btn btn-warning" style="width:300px">Vlaams Brabant</a></p>
                <p><a href="<?php echo site_url('beursapp/school/West-Vlaanderen');?>" id="provincie" value="West-Vlaanderen" class="btn btn-warning" style="width:300px">West-Vlaanderen</a></p>
                <p><a href="<?php echo site_url('beursapp/school/Andere');?>" id="provincie" value="Andere" class="btn btn-warning" style="width:300px">Andere</a> </p>
            </div>
        </form>
        
    </div>
</div>