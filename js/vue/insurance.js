(function( $ ) {
	var vue_ins = new Vue({
		el: '#sljarInsurance',
		data: {
			k11: [],
			k1:1,
			k22: [],
			k2: 1.5,
			k3: 1,
			k44: [],
			k4:1.55,
			k5: 1,
			k6: 1,
			k7: 1,
			k8: 1,
			k9:1,
			base: 180,
			used: 1,
			usedTZ: 1,
			fr:1,
			options_Fr: [
				{ text: '2600',value: 1 },
				{ text: '1300', value: 2},
				{ text: '0', value: 3}
			],
			options_k1: [
				{ type: 'B1', name: 'до 1600 куб.см',                           value: [1,1,1]   },
				{ type: 'B2', name: 'від 1601 до 2000 куб.см',                  value: [1.14,1.14,1.14] },
				{ type: 'B3', name: 'від 2001 до 3000 куб.см',                  value: [1.18,1.18,1.18] },
				{ type: 'B4', name: '3001 куб.см і більше',                     value: [1.82,1.82,1.82] },
				{ type: 'ЕМ', name: 'електромобіль (з силовим електродвигуном, окрім гібридних авто)',value: [0.9,0.9,0.9] },
				{ type: 'A1', name: 'мотоцикли і моторолери до 300 см. куб',    value: [0.34,0.34,0.34] },
				{ type: 'A2', name: 'мотоцикли і моторолери понад 300 см. куб', value: [0.68,0.68,0.68] },
				{ type: 'C1', name: 'Вантажні а/м до 2т',                       value: [2,2,0] },
				{ type: 'C2', name: 'Вантажні а/м понад 2т',                    value: [2.18,2.18,0] },
				{ type: 'D1', name: 'Автобуси до 20 чол',                       value: [2.55,2.55,0] },
				{ type: 'D2', name: 'Автобуси понад 20 чол',                    value: [3,3,0] },
				{ type: 'F', name: 'Причепи до легкових автомобілів',           value: [0.34,0.34,0.34] },
				{ type: 'E', name: 'Причепи до вантажних автомобілів',          value: [0.5,0.5,0] },
			],
			options_k2: [
				{ text: 'Київ',                   value: [4.8,4.8,4.8] },
				{ text: 'Львів, Дніпро,Одеса, Харків,Бориспіль Ірпінь',       value: [3.5,3.5,3.5] },
				{ text: 'від 500 тис до 1 млн',   value: [2.8,2.8,2.8] },
				{ text: 'від 100 тис до 500 тис', value: [2.5,2.5,2.5] },
				{ text: 'інші населні пункти',    value: [1.5,1.5,1.5] },	
				{ text: 'Іноземна реєстрація',    value: [5,5,5] },
			],
			options_k3: [
				{ text: 'фіз особа(не таксі)',       value: 1 },
				{ text: 'юр особа(не таксі)',        value: 1.4 },
				{ text: 'Вантажні а/м, автобуси', value: 1 },
				{ text: 'а/м для надання послуг ФО',  value: 1.4 },
				{ text: 'а/м для надання послуг ЮО',  value: 1.5 },
			],
			options_k4: [
				{ text: 'фіз особа',value: [1.55,1.6,1.73] },
				{ text: 'юр особа', value: [1.2,1.2,1.2] },
			],
			options_k5: [
				{ text: '12 місяців', value: 1,},
				{ text: '11 місяців', value: 0.95 },
				{ text: '10 місяців', value: 0.9 },
				{ text: '9 місяців',  value: 0.85 },
				{ text: '8 місяців',  value: 0.8 },
				{ text: '7 місяців',  value: 0.75 },
				{ text: '6 місяців',  value: 0.7 }
			],
			options_k7: [
				{ text: '12 місяців', value: 1,},
				{ text: '11 місяців', value: 0.95 },
				{ text: '10 місяців', value: 0.9 },
				{ text: '9 місяців',  value: 0.85 },
				{ text: '8 місяців',  value: 0.8 },
				{ text: '7 місяців',  value: 0.75 },
				{ text: '6 місяців',  value: 0.7 },
				{ text: '5 місяців',  value: 0.6 },
				{ text: '4 місяців',  value: 0.5 },
				{ text: '3 місяці',   value: 0.4 },
				{ text: '2 місяці',   value: 0.3 },
				{ text: '1 місяць',   value: 0.2 },
				{ text: '15 днів',    value: 0.15 },
			],
			options_k8: [
				{ text: 'паперовий носій', value: 1,},
				{ text: 'електронний носій', value: 0.9,},
			],
			options_k9: [
				{ text: 'без пільг',         value: 1   },
				{ text: 'пенсіонери',        value: 0.5 },
				{ text: 'інваліди ІІ групи', value: 0.5 },
				{ text: 'особи, які постраждали внаслідок Чорнобильської катастрофи', value:0.5 },
				{ text: 'учасники війни',    value: 0.5 }
			]
		},
		computed: {
			suma: function(){
				s = this.base * this.k1 * this.k2 * this.k3 * this.k4 * this.k5 * this.k6 * this.k7 * this.k8 * this.k9
				return (isNaN(s)) ? (0).toFixed(2) : (s).toFixed(2)
			}			
		},
		watch: {
			k11: function() {
				console.log('k1='+this.k11[this.fr-1])
				this.k1 = this.k11[this.fr-1]
			},
			k22: function() {
				console.log('k2='+this.k22[this.fr-1])
				this.k2 = this.k22[this.fr-1]
			},
			k44: function() {
				console.log('k4='+this.k44[this.fr-1])
				this.k4 = this.k44[this.fr-1]
			},
			fr: function() {
				console.log('k1='+this.k11[this.fr-1])
				console.log('k2='+this.k22[this.fr-1])
				console.log('k4='+this.k44[this.fr-1])
				this.k1 = this.k11[this.fr-1]
				this.k2 = this.k22[this.fr-1]
				this.k4 = this.k44[this.fr-1]
			}
		},	
		methods: {
			optionK1: function(o) {
				//this.k1=o.value[this.fr-1]
				console.log('o='+o.name)
				console.log('fr='+this.fr)
				//console.log('k1='+this.k1[this.fr-1])
				console.log('k1='+o.value[this.fr-1])
				//return this.k1[this.fr-1]
			}	
/*			getTZ: function() {
				this.$http.get(this.select).then(function (response) {
					this.typeVechicle = JSON.parse(response.data)			
				},function (error){
					console.log(error)
				})
			},*/
		},
		created: function() {
			//this.k1 = [1,2,3]
		}
})
})( jQuery )