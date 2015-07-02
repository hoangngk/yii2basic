<?php
	use yii\web\View;
?>

<div class="quick-tools-table">
	<button class="active btn btn-success" data-action='active'>Active</button>
	<button class="inactive btn btn-warning" data-action='inactive'>Inactive</button>
	<button class="delete btn btn-danger" data-action='delete'>Delete</button>
	<div class="loading" style="display:none;margin-top: 15px;float:left;">
		<img src="/web/images/image-loading.gif" alt="Loading" width="20">
	</div> <br/>
	<div class="message" style="color:red;display: block;"></div>
</div>

<?php
	$this->registerJs("
			var options = {
					model: '" . ucfirst($model) . "',
					redirect: \"$redirect\",
					data: [], 
					action: '',
					field: \"$field\",
				},
				message = $('.quick-tools-table .message')

			$('.quick-tools-table button').click(function () {
				var action = $(this).data('action')
				options.action = action
				options.data = getListData()
				if (options.data.length > 0) {
					if (action == 'delete') {
						if (confirm('Are you sure to delete?')) 
							$(this).quickToolsTable(options);
					} 
					else {
						$(this).quickToolsTable(options);
					}
				}
					
			})

			// get all checked checkbox
			function getListData() {
				var data = []
				allCheckbox = $('.checbox-list-item .checkbox-item');
				$.each(allCheckbox, function (index, item) {
					if ($(item).is(':checked')) {
						data.push($(item).data('post'))
					}
				})
				// add error message if there are no checked checkbox
				if (data.length == 0) {
					message.html('You have to choose at least one')
				}
				return data
			}
		", View::POS_END);
?>