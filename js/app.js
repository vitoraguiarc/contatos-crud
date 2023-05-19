'use strict'

import { readContacts, readContactsById, createContact, deleteContact, updateContact } from "./contact.js"
import { openModal, closeModal } from "./modal.js"
const createRow = ({nome, dataNascimento, email, celular, id}) => {

    const dataForm = dataNascimento.split('-')[2] + '/' + dataNascimento.split('-')[1] + '/' + dataNascimento.split('-')[0]
    const row = document.createElement('tr')
    row.innerHTML = `
        <td>${nome}</td>
        <td>${dataForm}</td>
        <td>${email}</td>
        <td>${celular}</td>
        <td>
            <button type="button" class="contact-btn" onClick="editContact(${id})">
                <img src="./assets/editar.png" alt="" >
            </button>
            <button type="button" class="contact-btn" onClick="openModalContainer(${id})">
                <img src="./assets/excluir.png" alt="">
            </button>
        </td>

    `
    return row
}

const fillForm = (contact) => {

    const wppInp = document.getElementById('wpp')
        if(contact.wppNotificacoes == 0)
            wppInp.checked = false
        else
            wppInp.checked = true
        
        
    const emailInp = document.getElementById('email_not')
        if(contact.emailNotificacoes == 0)
            emailInp.checked = false
        else 
            emailInp.checked = true
        
    const smsInp = document.getElementById('sms')
        if(contact.smsNotificacoes == 0)
            smsInp.checked = false
        else 
            smsInp.checked = true

    const data = contact.dataNascimento
    const dataY = data.split('-')[0]
    const dataM = data.split('-')[1]
    const dataD = data.split('-')[2]
    document.getElementById('date').value = dataD + '/' + dataM + '/' + dataY

    document.getElementById('name').value = contact.nome
    
    document.getElementById('email').value = contact.email
    document.getElementById('work').value = contact.profissao
    document.getElementById('tellphone').value = contact.telefone
    document.getElementById('cellphone').value = contact.celular
    document.getElementById('name').dataset.id = contact.id

    window.location.href = "#form-contacts"
}

globalThis.delContact = async (id) => {
    await deleteContact(id)
    updateTable()
    closeModal()
}

globalThis.openModalContainer = (id) => {
    return openModal(id)
}

globalThis.editContact = async (id) => {
    const contact = await readContactsById(id)
    fillForm(contact)  
}

const updateTable = async () => {

    const contactContainer = document.getElementById('container-contacts')

    const contacts = await readContacts()

    const rows = contacts.map(createRow)

    contactContainer.replaceChildren(...rows)

    
    
}

const isEdit = () => document.getElementById('name').hasAttribute('data-id')

const saveContact = async () => {

    const form = document.getElementById('form-contacts')

    const data = document.getElementById('date').value
    const dataY = data.split('/')[2]
    const dataM = data.split('/')[1]
    const dataD = data.split('/')[0]

    const dataForm = dataY + '-' + dataM + '-' + dataD

    
    let wppValue = 0
    
    if(document.getElementById('wpp').checked == true) {
        wppValue = 1
    }

    let emailValue = 0
    if(document.getElementById('email_not').checked) {
        emailValue = 1
    }
        

    let smsValue = 0
    if(document.getElementById('sms').checked) {
        smsValue = 1
    }
       

        

    // criar um json com as informações do contato
    const contato = {
        "id": "",
        "nome": document.getElementById('name').value,
        "dataNascimento": dataForm,
        "email": document.getElementById('email').value,
        "profissao": document.getElementById('work').value,
        "telefone": document.getElementById('tellphone').value,
        "celular": document.getElementById('cellphone').value,
        "wppNotificacoes": wppValue,
        "emailNotificacoes": emailValue,
        "smsNotificacoes": smsValue,
    }

    if(form.reportValidity()) {
        if (isEdit()) {
            contato.id = document.getElementById('name').dataset.id
            await updateContact(contato) 
        } else {
             createContact(contato)    
        }   
    }

    updateTable()
}

updateTable()

const removeContact = async () => {
    const id = document.querySelector('.contato').id
    delContact(id)
}

//Eventos
document.getElementById('btn-register').addEventListener('click', saveContact)
 
document.getElementById('excluir').addEventListener('click', removeContact)
