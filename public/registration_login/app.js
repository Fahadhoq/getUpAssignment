let container = document.getElementById('container')

toggle = () => {
	container.classList.toggle('sign-in')
	container.classList.toggle('sign-up')
}

setTimeout(() => {
	if (window.location.pathname === '/login') {
		container.classList.add('sign-in')
	} else {
		container.classList.add('sign-up')
	}	

}, 200)