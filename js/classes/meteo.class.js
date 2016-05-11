function Meteo() {

	this.init = () => {
		console.log(MIA_URL);
		window.location.href = MIA_URL+"/views/meteo.template.php";
	};
}
