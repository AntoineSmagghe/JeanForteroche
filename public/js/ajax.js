//REQUETTE AJAX ES6
function ajaxGet(url, callback) {
    const req = new XMLHttpRequest();
    req.open("GET", url);
    req.addEventListener("load", () => {
        if (req.status >= 200 && req.status < 400) {
            callback(req.responseText);
        } else {
            console.error("Problème serveur numéro " + req.status + " " + req.statusText);
        }
    });
    req.send(null);
    req.addEventListener("error", () => {
        console.error("Erreur réseau avec l'url : " + url);
    });
}

function ajaxPost(url, data, callback) {
    const req = new XMLHttpRequest();
    req.open("POST", url);
    req.addEventListener("load", () => {
        if (req.status >= 200 && req.status < 400) {
            callback(req.responseText);
        } else {
            console.error("Problème serveur numéro " + req.status + " " + req.statusText);
        }
    });

    req.send(data);
    req.addEventListener("error", () => {
        console.error("Erreur réseau avec l'url : " + url);
    })

    console.log(data + " has been sended to " + url);
}