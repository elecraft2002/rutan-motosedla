let checkboxes = document.getElementsByClassName("checkbox");
let price = 199;
let customization = [];
for (let i = 0; i < checkboxes.length; i++) {
    let label = checkboxes[i].getElementsByTagName("input")[0];
    label.addEventListener("click", e => {
        if (label.checked)
            price += parseInt(label.dataset.price);
        if (!label.checked)
            price -= parseInt(label.dataset.price);
            console.log(price)
    })
}
