let time = 90 * 60;

let x = setInterval(function() {
    let min = Math.floor(time / 60);
    let sec = time % 60;

    document.getElementById("timer").innerHTML = min + ":" + sec;

    time--;

    if(time < 0){
        clearInterval(x);
        alert("Time Up! Submitting...");
        document.querySelector("button").click();
    }
}, 1000);