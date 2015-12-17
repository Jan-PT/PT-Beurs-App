<!--- View waarop de student kan aanduiden waarvoor hij gecontacteerd wil worden (Stage, vast contract,...) --->
<div id="header">
<?php
    $user_data = $this->session->userdata('user_data'); 
    
    if($user_data !== false){
        
    }
    
?>
	<h1>Plan onmiddellijk een afspraak met ons</h1>
        <p>
        </p>
</div>
<div class="panel-body">
    <div id="info" class="form-group" onchange="setTDD();">
		<?php
			echo form_open("beursapp/contactForm");
		?>
			<div class="input-group input-group-lg">
                            <span class="input-group-addon">
                                <input type="radio" value="tdd" name="contact" id="tdd" aria-label="..." selected="true">                                    
                            </span>
                            <label class="form-control" for='tdd' aria-label="...">
                                
                                <div class="col-sm-6" style="margin-top: 45px; margin-bottom: 40px">
                                    <label>
                                We hebben een aantal data gereserveerd, wat lukt voor jou?
                                    </label>
                                </div>
                                <div class="col-sm-6">
                            <div class="input-group input-group-lg">
                                 
                                <span class="input-group-addon">
                                <input type="checkbox" value="dd/mm/yyyy" name="tdd1"  id="tdd1" aria-label="...">
                                </span>
                                <label  class="form-control" for="tdd1" aria-label="...">dd/mm/yyyy</label>
                            </div>
                            <div class="input-group input-group-lg">
                                <span class="input-group-addon">
                                <input type="checkbox" value="dd/mm/yyyy" name="tdd2"  id="tdd2" aria-label="...">
                                </span>
                                <label  class="form-control" for="tdd2" aria-label="...">dd/mm/yyyy</label>
                            </div>
                            <div class="input-group input-group-lg">
                                <span class="input-group-addon">
                                <input type="checkbox" value="dd/mm/yyyy" name="tdd3"  id="tdd3" aria-label="...">
                                </span>
                                <label  class="form-control" for="tdd3" aria-label="...">dd/mm/yyyy</label>
                            </div>
                            </label>
                                </div>
			</div>
			<div class="input-group input-group-lg">
                            <span class="input-group-addon">
                                <input type="radio" value="afspraak" name="contact" id="afspraak" arial-label='...'>                                       
                            </span>
                            <label class="form-control" for="afspraak" aria-label='...'>
                                Contacteer mij voor een andere afspraak.
                            </label>
                        </div>
			<div class="input-group input-group-lg">
                            <span class="input-group-addon">
                                <input type="radio" value="reden" name="contact" id="reden" arial-label='...'>                                       
                            </span>
                            <label class="form-control" for="reden" aria-label='...'>
                                Contacteer mij voor een andere reden.
                            </label>
                        </div>
			<BR>
			<input type="submit" class="btn btn-lg btn-warning btn-block" value="Volgende">
		<?php
			echo form_close(); 
		?>
	</div>
</div>

<script>
  function setTDD(){
    var el = document.getElementById("tdd");
    if(el.checked){
        document.getElementById("tdd1").disabled = false;
        document.getElementById("tdd2").disabled = false;
        document.getElementById("tdd3").disabled = false;
    }
    else{
     document.getElementById("tdd1").disabled = true;    
     document.getElementById("tdd2").disabled = true;    
     document.getElementById("tdd3").disabled = true;    
    }
  }  
</script>