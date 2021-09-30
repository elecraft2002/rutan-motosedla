let checkboxes = document.getElementsByClassName("checkbox");
let price = parseInt(document.getElementById("price").getElementsByTagName("span")[0].innerHTML);
let customization = [];
for (let i = 0; i < checkboxes.length; i++) {
    let label = checkboxes[i].getElementsByTagName("input")[0];
    label.addEventListener("click", () => {
        if (label.checked)
            price += parseInt(label.dataset.price);
        if (!label.checked)
            price -= parseInt(label.dataset.price);
        //console.log(price)
        document.getElementById("price0").getElementsByTagName("span")[0].innerHTML = price;
        document.getElementById("price").getElementsByTagName("span")[0].innerHTML = price;
    })
}
let button = document.getElementById("ANPASSEN")
let submit = document.getElementById("ANFRAGE")

button.addEventListener("click", () => {
    button.remove()
    document.getElementsByClassName("form--hidden")[0].classList.remove("form--hidden")
})
submit.addEventListener("click", () => {
    customization = []
    for (let i = 0; i < checkboxes.length; i++) {
        let label = checkboxes[i].getElementsByTagName("input")[0];
        if (label.checked) {
            customization.push(label.id)
        }
    }
    //console.log(customization)
    anfrage()
})
function anfrage() {
    let textarea = document.getElementById("textarea").value
    let xhr = new XMLHttpRequest();
    xhr.open("POST", 'anfrage.php', true);

    //Send the proper header information along with the request
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.onreadystatechange = function () { // Call a function when the state changes.
        if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
            //console.log(this.responseText)
            document.getElementsByTagName("main")[0].classList.add("hidden");
            document.getElementsByTagName("body")[0].innerHTML += this.responseText;
            buyPost()
            // Request finished. Do processing here.
        }
    }
    xhr.send(`customization=${JSON.stringify(customization)}&textarea=${textarea}&id=${id}`);
}
function buyPost() {
    //document.getElementById("buy").addEventListener("submit", () => {
    document.getElementById("buy__btnTest").addEventListener("click", () => {
        let name = document.querySelector("#given-name").value
        let surname = document.querySelector("#family-name").value
        let tel = document.querySelector("#tel").value
        let email = document.querySelector("#email").value
        let textarea1 = document.getElementById("textarea").value
        let xhr = new XMLHttpRequest();
        xhr.open("POST", 'buy.php', true);

        //Send the proper header information along with the request
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        xhr.onreadystatechange = function () { // Call a function when the state changes.
            if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
                document.getElementById("log").innerHTML = this.responseText;
                // Request finished. Do processing here.
                //buyPost()
            }
        }
        let payload = `customization=${JSON.stringify(customization)}&textarea=${textarea1}&id=${id}&name=${name}&surname=${surname}&tel=${tel}&email=${email}`
        xhr.send(payload);
    })
}