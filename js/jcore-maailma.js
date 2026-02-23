(function () {
	const toast = document.getElementById("jcore-copy-toast");
	if (!toast) return;

	let timeout;

	document.querySelectorAll(".jcore-copy-slug").forEach((el) => {
		el.addEventListener("click", function (event) {
			event.preventDefault();
			const text = this.innerContent;
			navigator.clipboard
				.writeText(text)
				.then(() => {
					toast.classList.add("show");
					clearTimeout(timeout);
					timeout = setTimeout(() => {
						toast.classList.remove("show");
					}, 2000);
				})
				.catch((error) => {
					console.error("Failed to copy text to clipboard:", error);
					alert("Copy to clipboard failed. Please copy manually.");
				});
		});
	});
})();
