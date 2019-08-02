(function( $ ) {
	var vue_ins = new Vue({
		el: '#sljarKalk',
		data: {
			length:'',
			width:'',
			square: '',
			squareLaminat: 50,
			k1: 1.05,
			k2: 1.1,
			options: [
				{ text: 'Плиты', koef: 0.36, value: ''},
				{ text: 'Профиль 3.6м', koef: 0.234, value: '' },
				{ text: 'Профиль 1.2м', koef: 1.4, value: '' },
				{ text: 'Профиль 0.6м',  koef: 1.4, value: '' },
				{ text: 'Пристенный уголок (3м)',  koef: 3, value: '' },
				{ text: 'Подвес "бабочка"',  koef: 0.7, value: '' },
				{ text: 'Подвес крючек',  koef: 0.7, value: '' },
				{ text: 'Подвес петля',  koef: 0.7, value: '' },
				{ text: 'Биербах (DNA6)',  koef: 0.7, value: '' },
				{ text: 'Дюбель 6х40',   koef: 0, value: ''},
			]			
		},
		computed: {
			it1: function(){
				return (this.squareLaminat * this.k1).toFixed(2)
				//this.getFormatLam(this.k1)
			},
			it2: function(){
				return (this.squareLaminat * this.k2).toFixed(2)
				//this.getFormatLam(this.k2)
			},
			kolKM: function(){
				return (this.square > 0) ? this.getFormat(this.square) : this.getFormat(this.length * this.width)
			},
			perimetr: function(){
				if ((this.length > 0) && (this.width>0)) {
					return this.getFormat((this.length * 2) + (this.width * 2))
				}
				return ''
			},
		},
		methods: {
			getFormatLam: function(i) {
				console.log('i1='+i+'  square='+this.squareLaminat)
				return (this.squareLaminat * i).toFixed(2)
			},
			getFormat: function(i) {
				return (i > 0) ? (i*1).toFixed(0) : ''
			},
			getValue1: function(i,j){
				return this.getFormat(i / this.options[j].koef)
			},
			getValue2: function(i,j){
				return this.getFormat(i * this.options[j].koef)
			},
			getOptionsValue: function(){
				for (let i = 0; i < this.options.length; i++) {
					if (i == 0) {this.options[i].value = this.getValue1(this.kolKM,i)}
					else {
						if (i == 4) {this.options[i].value = this.getValue1(this.perimetr,i)}
						else {
							this.options[i].value = (i==9) ? this.getFormat(this.length * this.width) : this.getValue2(this.kolKM,i)}
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
			},
			getOptoinsZero: function() {
				for (let i = 0; i < this.options.length; i++){
					this.options[i].value = ''
				}
			},
			getSquare: function(i){
				if (i > 0) this.square = ''
			},
			getLW: function(){
				if ((this.length > 0) && (this.width>0)) {
					this.getOptionsValue()
				}
				else {
					this.getOptoinsZero()
				}				
			}
		},
		watch: {
			length: function() {
				this.getSquare(this.length)
				this.getLW()
			},
			width: function() {
				this.getSquare(this.width)
				this.getLW()
			},
			square: function() {
				if (this.square > 0) {
					this.length = ''
					this.width  = ''
					this.getOptionsValue()
				}
				else {
					this.getOptoinsZero()
				}
			}
		}
})
})( jQuery )