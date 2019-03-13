<div class="avia-content-grid-active">
    <div class="flex_column av_one_half first">
        Regione
        <?php if (!empty($regions)): ?>
            <select name="mf_region" id="mf_region" class="form-control">
                <option value="">-</option>
                <?php foreach ($regions as $region): ?>
                    <option value="<?php echo $region->regione; ?>" <?php if ($current_region == $region->regione) { echo 'selected'; }?>><?php echo $region->regione; ?></option>
                        <?php endforeach; ?>
            </select>
        <?php endif; ?>  
    </div>
    <div class="flex_column av_one_half last" id="box_province">
        Provincia
        <?php if (!empty($provinces)): ?>
            <select name="mf_province" id="mf_province" class="form-control">
                <option value="">-</option>
                <?php foreach ($provinces as $province): ?>
                    <option value="<?php echo $province->provincia; ?>" <?php if($current_province == $province->provincia){ echo 'selected'; } ?>><?php echo $province->provincia; ?></option>
                <?php endforeach; ?>
            </select>
        <?php endif; ?>
    </div>
</div>

<script>
    jQuery(document).ready(function ($) {
        $("#mf_region").on('change', function () {
            var region = $(this).val();
            window.location.assign("<?php echo $current_url; ?>?mf_region=" + encodeURIComponent(region));
        });
        $("#mf_province").on('change', function(){
            var province = $(this).val(); 
            window.location.assign("<?php echo $current_url; ?>?mf_region=<?php echo $current_region; ?>" +  '&mf_province=' + encodeURIComponent(province));
        }); 
    });
</script>