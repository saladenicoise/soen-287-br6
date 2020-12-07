
function openModal(id) {
    eleId = "modal".concat(id);
    document.getElementById(eleId).style.display = "block";
}


function closeModal(id) {
    document.getElementById(id).style.display = "none";
}