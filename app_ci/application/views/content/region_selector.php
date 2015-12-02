<div id="header">
    <?php
     
    ?>
    <h1>Waar ga je naar school, <?= $voornaam; ?>? - Provincie</h1>
</div>
<div class="panel-body">
    <div id="info" class="form-group">
        <form>
            <div class="col-sm-4">
                <p><a href="<?php echo site_url('beursapp/school/Antwerpen');?>" id="provincie" class="btn btn-warning" style="width:300px">Antwerpen</a></p>
                <p><a href="<?php echo site_url('beursapp/school/Oost-Vlaanderen');?>" id="provincie" class="btn btn-warning" style="width:300px">Oost-Vlaanderen</a></p>
                <p><a href="<?php echo site_url('beursapp/school/Limburg');?>" id="provincie" class="btn btn-warning" style="width:300px">Limburg</a> </p>
            </div>
            <div class="col-sm-4">
                <p><a href="<?php echo site_url('beursapp/school/Vlaams-Brabant');?>" id="provincie" class="btn btn-warning" style="width:300px">Vlaams Brabant</a></p>
                <p><a href="<?php echo site_url('beursapp/school/West-Vlaanderen');?>" id="provincie" class="btn btn-warning" style="width:300px">West-Vlaanderen</a></p>
                <p><a href="<?php echo site_url('beursapp/school/Andere');?>" id="provincie" class="btn btn-warning" style="width:300px">Andere</a> </p>
            </div>
        </form>
    </div>
</div>