<div class="container top-bottom-space">  
    <h1> Logistic Partners
        <span class='pull-right play'>
            <form class='form-inline' method="post" action= <?php echo site_url('admin/logistics') ?> >                
                <div class="form-group">
                    <select class="form-control" name="logistic_partner">
                        <option value="delhivery"> Delhivery </option>                            
                    </select>
                    <input type='number' name="num_waybills" class="form-control" placeholder="Num of Waybills">
                    <button type="submit" class="btn btn-primary">Fetch Waybills</button>
                </div>
            </form>
        </span>
    </h1>
    <hr>
    <div class="well">
        <div class="row">
            <div class="col-md-12">
                <h4 >Delhivery : <?php echo $delhivery_waybills ?> waybills</h4>
            </div>
        </div>
    </div>    
</div>
