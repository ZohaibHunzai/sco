/**
 * Templates of the POS starts here
 */




Vue.component('top', {
	'template': '#top',
	data: function(){
		return {
			styleObject: {
				backgroundColor: '#fefefe',
				height: '12%',
				borderBottom: '2px solid #ddd',
				position: 'relative'
			}
		}
	}
})


Vue.component('middle', {
	'template': '#middle',
	data: function(){
		return {
			middleStyle: {
				backgroundColor: '#ddd',
				height: '88%',
				position: 'relative'
			}
		}
	}
})


Vue.component('bottom', {
	'template': '#bottom',
	data: function(){
		return {
			bottomStyle: {
				backgroundColor: '#000000',
				height: '16%',
				position: 'relative'
			}
		}
	}
})




/**
 * Store
 */


/**
 * Main app
 */

vm = new Vue({
	'el': '#vm',
	data: {
		greetings: 'hellow there'
	}
});