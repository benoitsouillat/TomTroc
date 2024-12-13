document.querySelectorAll(".deleteBook").forEach((deleteItem) => {
    deleteItem.addEventListener("click", (e) => {
        e.preventDefault();
        if (confirm("Voulez-vous vraiment supprimer ce livre ?")) {
            window.location.href = deleteItem.href;
        }
    });
});
