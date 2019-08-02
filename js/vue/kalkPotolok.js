(function( $ ) {
	var vue_ins = new Vue({
		el: '#sljarKalk',
		data: {
			length:'',
			width:'',
			k1: 1.05,
			k2: 1.1,
			options: [
				{ text: 'Плиты', koef: 0.36, value: 0},
				{ text: 'Профиль 3.6м', koef: 0.234, value: 0 },
				{ text: 'Профиль 1.2м', koef: 1.4, value: 0 },
				{ text: 'Профиль 0.6м',  koef: 1.4, value: 0 },
				{ text: 'Пристенный уголок (3м)',  koef: 3, value: 0 },
				{ text: 'Подвес "бабочка"',  koef: 0.7, value: 0 },
				{ text: 'Подвес крючек',  koef: 0.7, value: 0 },
				{ text: 'Подвес петля',  koef: 0.7, value: 0 },
				{ text: 'Биербах (DNA6)',  koef: 0.7, value: 0 },
				{ text: 'Дюбель 6х40',   koef: 0, value: 0},
			]			
		},
		computed: {
			kolKM: function(){
				return (this.length * this.width).toFixed(0)
			},
			perimetr: function(){
				return ((this.length * 2) + (this.width * 2)).toFixed(0)
			},
		},
		methods: {
			getValue1: function(i,j){
				return (i / this.options[j].koef).toFixed(0)
			},
			getValue2: function(i,j){
				return (i * this.options[j].koef).toFixed(0)
			},
			getOptionsValue: function(){
				for (let i = 0; i < this.options.length; i++) {
					if (i == 0) {this.options[i].value = this.getValue1(this.kolKM,i)}
					else {
						if (i == 4) {this.options[i].value = this.getValue1(this.perimetr,i)}
						else {
							this.options[i].value = (i==9) ? this.length * this.width : this.getValue2(this.kolKM,i)}	
						}
				}
			},	
			getOptoinsValue1: function(){
				this.options[0].value = this.getValue1(this.kolKM,0)
				this.options[1].value = this.getValue2(this.kolKM,1)
				this.options[2].value = this.getValue2(this.kolKM,2)
				this.options[3].value = this.getValue2(this.kolKM,3)
				this.options[4].value = this.getValue1(this.perimetr,4)
				this.options[5].value = this.getValue2(this.kolKM,5)
				this.options[6].value = this.getValue2(this.kolKM,6)
				this.options[7].value = this.getValue2(this.kolKM,7)
				this.options[8].value = this.getValue2(this.kolKM,8)
				this.options[9].value = this.length * this.width
			}
		},
		watch: {
			length: function() {
				this.getOptionsValue()
			},
			width: function() {
				this.getOptionsValue()
			},		
		},
		created: function() {
			
		}
})
})( jQuery )