<div id="mold-popup">
	
	<div class="admin-panel">
		<div class="admin-panel-wrap">
			<div class="admin-panel-head">
				<span id="button-head"></span>
				<i class="dashicons dashicons-arrow-up-alt2"></i><i class="dashicons dashicons-arrow-down-alt2"></i>
			</div>
			<div class="admin-panel-body">
				<div class="form-wrap">
					<label for="" id="button-label"></label>
					<input type="text" id="btn-label" placeholder="Button Text" value="">
				</div>

				<div class="form-wrap">
					<label for="">Url</label>
					<input type="text" id="btn-url" placeholder="http://" value="" style="width: 100%">
				</div>

				<div class="form-wrap">
					<label for="">Target</label>
					<select id="btn-target">
						<option value="_self">_self</option>
						<option value="_blank">_blank</option>
					</select>
				</div>
				<div class="form-wrap">
					<label for="" id="button-size"></label>
					<select id="btn-size">
						<option value="sm">Small</option>
						<option value="md">Medium</option>
						<option value="lg">large</option>
					</select>
				</div>
				<div class="form-wrap">
					<label for="" id="button-color"></label>
					<select id="btn-color">
						<option value="primary">Primary</option>
						<option value="base">Base</option>
					</select>
				</div>
				<div class="button-wrap">
					<label for=""></label>
					<button type="button" class="insert-btn" id="insert-shortcode-button"></button>
				</div>
			</div>
		</div>
		<div class="admin-panel-wrap">
			<div class="admin-panel-head">
				<span id="info-box"></span>
				<i class="dashicons dashicons-arrow-up-alt2"></i><i class="dashicons dashicons-arrow-down-alt2"></i>
			</div>
			<div class="admin-panel-body">
				<div class="form-wrap">
					<label for="" id="info-title"></label>
					<input type="text" id="infobox-title" placeholder="Title" value="" style="width: 100%">
				</div>
				<div class="form-wrap">
					<label for="" id="info-bg-color"></label>
					<input type="text" class="color-field" id="infobox-bg-color" value="#FFFFFF">
				</div>
				<div class="form-wrap">
					<label for="" id="info-text-color"></label>
					<input type="text" class="color-field" id="infobox-text-color" value="#4b4b4b">
				</div>
				<div class="form-wrap">
					<label for="">CSS Class</label>
					<input type="text" id="infobox-css-class" value="">
				</div>
				<div class="button-wrap">
					<label for=""></label>
					<button type="button" class="insert-btn" id="insert-shortcode-infobox"></button>
				</div>
			</div>
		</div>
	</div>

</div>




<script type="text/javascript">
	(function($){
		$(document).ready(function() {
			$('#mold-popup').closest('#TB_window').addClass('mold-popup');
			$('.color-field').wpColorPicker();

			$('#button-head').html(shortcode.button);
			$('#button-label').html(shortcode.label);
			$('#button-size').html(shortcode.buttonSize);
			$('#button-color').html(shortcode.buttonColor);

			$('#info-box').html(shortcode.infoBox);
			$('#info-title').html(shortcode.title);
			$('#info-bg-color').html(shortcode.backgroundColor);
			$('#info-text-color').html(shortcode.textColor);

			$('#insert-shortcode-button, #insert-shortcode-infobox').html(shortcode.insertShortcode);
		});
	})(jQuery);
</script>

