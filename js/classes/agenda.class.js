var newsClass = new News();

function News() {

	this.agenda = 
		['C', 'C', 'R', 'R', 'S', 'S', 'S', 'S', 'R', 'C', 'M', 'M', 'M', 'R', 'R', 'S', 'S', 'S', 'C', 'C', 'R', 'R', 'S', 'S', 'C', 'S', 'R', 'R', 'R', 'M', 'M']
	;

	this.firstDay = "Lundi";
	this.days = ["Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi", "Dimanche"];

	this.init = () => {
	};

}

new Vue({

	el: '#agenda',
	data: {
		agenda: [],
		days: []
	},

	ready() {
		this.getAgenda();
	},

	methods: {
		getAgenda() {

			for (var i = 0; i < newsClass.agenda.length; i++) {

				var section = newsClass.agenda[i];

				newsClass.agenda[i] = {
					section: section,
					number: i+1
				};
			}

			this.$set('agenda', newsClass.agenda);
			this.$set('days', newsClass.days);
		}
	}
});
