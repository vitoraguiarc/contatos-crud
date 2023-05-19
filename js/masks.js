'use strict'

//mascaras nos inputs
const maskCellphone = ({target}) => {
   
    let text = target.value

   text = text.replace(/[^0-9]/g,'')

   text = text.replace(/(.{2})(.{5})(.{4})/, '($1) $2-$3')

   text = text.replace(/(.{15})(.*)/, '$1')

   target.value = text
}

const maskTellphone = ({target}) => {
   
    let text = target.value

   text = text.replace(/[^0-9]/g,'')

   text = text.replace(/(.{2})(.{4})(.{4})/, '($1) $2-$3')

   text = text.replace(/(.{15})(.*)/, '$1')

   target.value = text
}

const maskDate = ({target}) => {
    let text = target.value
    text=text.replace(/\D/g,"");
    text=text.replace(/(\d{2})(\d)/,"$1/$2");
    text=text.replace(/(\d{2})(\d)/,"$1/$2");

    text=text.replace(/(\d{2})(\d{2})$/,"$1$2");
   
    target.value = text
}
       


// Eventos
document.getElementById('cellphone').addEventListener('keyup', maskCellphone)
document.getElementById('tellphone').addEventListener('keyup', maskTellphone)
document.getElementById('date').addEventListener('keyup', maskDate)