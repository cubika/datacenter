<?php if(!class_exists('raintpl')){exit;}?><div class="hero-unit">
	<div class="row">
		<div class="col-lg-3">
			<select id="productName" data-placeholder="请选择产品名称" class="chosen-select"
				tabindex="2">
			</select>
		</div>
		<div class="col-lg-3">
			<select id="version" data-placeholder="请选择版本号"
				class="chosen-select" tabindex="3">
			</select>
		</div>
	</div>
	<hr>
	<a onclick="query();" class="btn btn-primary btn-large">查询 &raquo;</a>
</div>
<div id="query_content"></div>