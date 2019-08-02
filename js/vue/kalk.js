(function( $ ) {
	var vue_ins = new Vue({
		el: '#sljarKalk',
		data: {
			square: 50,
			k1: 1.05,
			k2: 1.1
		},
		computed: {
			it1: function(){
				return (this.square * this.k1).toFixed(2)
			},
			it2: function(){
				return (this.square * this.k2).toFixed(2)
			},
		},

		created: function() {

		}
})
})( jQuery )