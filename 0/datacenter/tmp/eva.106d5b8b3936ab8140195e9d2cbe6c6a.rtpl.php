<?php if(!class_exists('raintpl')){exit;}?><div class="hero-unit">
            <div class="row">
            	<?php $counter1=-1; if( isset($versions) && is_array($versions) && sizeof($versions) ) foreach( $versions as $key1 => $value1 ){ $counter1++; ?>	
				<div class="col-lg-3">
					<select id="<?php echo $key1;?>" data-placeholder="请选择<?php echo $key1;?>版本号" class="chosen-select" tabindex="2">
						<option value=""></option>
						<?php $counter2=-1; if( isset($value1) && is_array($value1) && sizeof($value1) ) foreach( $value1 as $key2 => $value2 ){ $counter2++; ?>
						<option value="<?php echo $value2;?>"><?php echo $value2;?></option>
						<?php } ?>
					</select>
				</div>
				<?php } ?>
			</div>
			<hr>
            <button id="compare" class="btn btn-primary btn-large">比较 &raquo;</button>
        </div>
        <div id="eva_content" ></div>