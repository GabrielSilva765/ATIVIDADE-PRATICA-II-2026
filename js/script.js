function curtir(btn) {
    let span = btn.nextElementSibling;
    let valor = parseInt(span.innerText);
    span.innerText = valor + 1;
}
    