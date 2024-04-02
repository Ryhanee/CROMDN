
document.addEventListener("DOMContentLoaded", function() {
    const downloadButtons = document.querySelectorAll("button[name^='download_']");
    downloadButtons.forEach(button => {
        console.log('hi')
        button.addEventListener("click", function() {
            const documentType = button.getAttribute("name").replace("download_", "");
            document.getElementById("document_type").value = documentType;
        });
    });
});

console.log('hi')
