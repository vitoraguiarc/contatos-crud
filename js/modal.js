'use strict'

const openModal = (id) => {
    document.getElementById('modal').classList.add('active')
    document.querySelector('.contato').id = id
}


const closeModal = () => {
    document.getElementById('modal').classList.remove('active')
}


document.getElementById('cancelar').addEventListener('click', closeModal)


export {
    openModal, closeModal, 
}