function login() {
	let log = $('#login').val()
	let pas = $('#passw').val()
	
	$.get('auth.php', {login: log, password: pas}, function(data) {
		let otvet = JSON.parse(data)
		//if error happens
		if ('error' in otvet) {
			alert(otvet['error']['text'])
		}
		else if ('user' in otvet) {
			alert('Вы успешно авторизовались')
		}
		else {
			alert('непредвиденная ошибка')
			console.log(data)
		}
	})
}