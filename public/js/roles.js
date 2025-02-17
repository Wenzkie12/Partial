document.addEventListener("DOMContentLoaded", function () {
    function openModal(modalId) {
        let modal = document.getElementById(modalId);
        if (modal) {
            modal.style.display = "block";
        }
    }

    function closeModal(modalId) {
        let modal = document.getElementById(modalId);
        if (modal) {
            modal.style.display = "none";
        }
    }

    window.openModal = openModal;
    window.closeModal = closeModal;

 
    window.onclick = function (event) {
        if (event.target.classList.contains("modal")) {
            closeModal(event.target.id);
        }
    };


    document.addEventListener("keydown", function (event) {
        if (event.key === "Escape") {
            document.querySelectorAll(".modal").forEach(function (modal) {
                modal.style.display = "none";
            });
        }
    });
});
