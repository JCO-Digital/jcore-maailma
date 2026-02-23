(function () {
	const toast = document.getElementById("jcore-copy-toast");
	let timeout;

	document.querySelectorAll(".jcore-copy-slug").forEach((el) => {
		el.addEventListener("click", function (event) {
			event.preventDefault();
			const text = this.innerText;
			navigator.clipboard.writeText(text).then(() => {
				toast.classList.add("show");
				clearTimeout(timeout);
				timeout = setTimeout(() => {
					toast.classList.remove("show");
				}, 2000);
			});
		});
	});
})();
