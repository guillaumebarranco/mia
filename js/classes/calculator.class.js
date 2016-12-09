var newsClass = new News();

function News() {

	this.init = () => {


		
	};

	this.init();
}

new Vue({

	el: '#calculator',
	data: {
		datas: {},
		result: 0
	},

	ready() {

		var that = this;

		$('form').on('submit', function(e) {
			e.preventDefault();

			let value = $('input').val(),
				result = that.result
			;

			if(!that.checkIfBeginsByOperator(value)) {

				result = jsFunctions.searchCalcul(value, true);

			} else {
				result = jsFunctions.searchCalcul(that.result+value, true);
			}

			console.log(result);

			$('input').val('');

			that.$set('result', result);
		});
	},

	methods: {

		checkIfBeginsByOperator(entry) {

			if(isNaN(parseInt(entry.substr(0,1)))) {
				return true;
			}

			return false;
		}
	}
});
