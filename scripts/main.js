//Scroll navigace
document.addEventListener("scroll", e => {
    if (window.scrollY > window.innerHeight - 400) {
        document.getElementById("info").classList.add("down")
        return
    }
    document.getElementById("info").classList.remove("down")
})


let buttons = document.getElementsByClassName("welcome__button-click");
for (let i = 0; i < buttons.length; i++) {
    buttons[i].addEventListener("click", e => {
        //console.log("click")
    })
}


let array = { "array": [["/FOTKY 2020/LEV2", "LEV2-CL", "LEV2", "FOTKY 2020", "https://drive.google.com/uc?id=1qO_-_wvtLezS6NriTI4D954plgisQI-g"], ["/FOTKY 2020/LEV2", "LEV2-BR", "LEV2", "FOTKY 2020", "https://drive.google.com/uc?id=1chWrmQzRBwwGzp3L1wXMWBo4pxpFCav2"], ["/FOTKY 2020/LEV3", "LEV3-CL", "LEV3", "FOTKY 2020", "https://drive.google.com/uc?id=1B9mNxSgdgV-nRM-XHxa7YbzumX7VXWEz"], ["/FOTKY 2020/LEV3", "LEV3-BR-2", "LEV3", "FOTKY 2020", "https://drive.google.com/uc?id=1bPrgRxycNdtTWwfb34SxzgVZXBRQlKp9"], ["/FOTKY 2020/LEV3", "LEV3-CL-2", "LEV3", "FOTKY 2020", "https://drive.google.com/uc?id=1cix13sq1pjx-pEt5n-vy0QVdxM3q9bSc"], ["/FOTKY 2020/LEV3", "LEV3-BR-1", "LEV3", "FOTKY 2020", "https://drive.google.com/uc?id=1ENQxYZ7E8N9lf_d0ULfAZJX62MleA5Zk"], ["/FOTKY 2020/LEV3", "LEV3-CL-1", "LEV3", "FOTKY 2020", "https://drive.google.com/uc?id=1W2lMZQRL5D8AiAR649QXHfkJDwVNXqnx"], ["/FOTKY 2020/LEV3", "LEV3-BR", "LEV3", "FOTKY 2020", "https://drive.google.com/uc?id=1DMRurhdOTHSQ6OjPUgLCzfhDdc74vWmN"], ["/FOTKY 2020/LEV1", "LEV1-BR-2", "LEV1", "FOTKY 2020", "https://drive.google.com/uc?id=1zybXU8BgiV1_hqOwl0fmqDvinsi7vkfb"], ["/FOTKY 2020/LEV1", "LEV1-BR-3", "LEV1", "FOTKY 2020", "https://drive.google.com/uc?id=1vKHJh2ryT6AUoqQ9UnItb86FAol-n0VV"], ["/FOTKY 2020/LEV1", "LEV1-BR", "LEV1", "FOTKY 2020", "https://drive.google.com/uc?id=1TQwBAPJ9ppGfD6Gpy-QVwcmtDk5xn_V2"], ["/FOTKY 2020/LEV1", "LEV1-CL", "LEV1", "FOTKY 2020", "https://drive.google.com/uc?id=1DGKzG-q8OjunqcZxxqzMqG2cCUSla0JW"], ["/FOTKY 2020/LEV1", "LEV1-BR-1", "LEV1", "FOTKY 2020", "https://drive.google.com/uc?id=1tPzGhcVJavScNCnU9QNJ_qyYZUPhXxAL"], ["/FOTKY 2020/LEV4", "LEV4-CL", "LEV4", "FOTKY 2020", "https://drive.google.com/uc?id=1WrhjOFFCCCTc4HMQWZ4jIh4hsAzw1TYb"], ["/FOTKY 2020/LEV4", "LEV4-BR", "LEV4", "FOTKY 2020", "https://drive.google.com/uc?id=1ObqLG-jSUnENwW1-HoHdtp76jl1-B9oL"]], "roots": [["/FOTKY 2020", "LEV2", "FOTKY 2020"], ["/FOTKY 2020", "LEV3", "FOTKY 2020"], ["/FOTKY 2020", "LEV1", "FOTKY 2020"], ["/FOTKY 2020", "LEV4", "FOTKY 2020"]] }