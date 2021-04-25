const defaults = {
    sucesso: {
        color: "green",
    },
    erro: {
        color: "#c53030",
    },
    default: {
        color: "#333",
    }
}

function showModal(type, message = "") {
    const x = document.getElementById("snackbar");
  
    const config = defaults[type] || defaults["default"];

    x.className = `show`;
    x.style.backgroundColor = config.color;
    x.innerHTML = message;

    setTimeout(() => { x.className = x.className.replace("show", ""); }, 3000);
}
