<div id="header">
    <h1>Persoonlijk Logo</h1>

</div>
<div class="panel-body">
    <div id="info" class="form-group col-sm-12">
    <?php    
        echo form_open("beursapp/personalLogoForm");
    ?>
                
        <h2> Teken hieronder je persoonlijk logo. </h2>
        <canvas id="logo" width="1200" height="350"> </canvas>
        
        
        <input type="submit" 
               class="btn btn-warning btn-lg btn-block" 
               value="Volgende">

        
    <?php
        echo form_close();
    ?>
        
    </div>
</div>

<script> 
    var logo = document.getElementById("logo");
    var context= logo.getContext('2d');
    
    context.font = '120pt Consolas';
    context.fillStyle = 'black';
    context.fillText('Planet _____', 20, 250);
    

</script>