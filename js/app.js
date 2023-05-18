'use strict'

import { readContacts, readContactsById, createContact, deleteContact, updateContact } from "./contact.js"

const createRow = ({nome, dataNascimento, email, celular, id}) => {
    const row = document.createElement('tr')
    row.innerHTML = `
        <td>${nome}</td>
        <td>${dataNascimento}</td>
        <td>${email}</td>
        <td>${celular}</td>
        <td>
            <button type="button" class="contact-btn" onClick="editContact(${id})">
                <img src="./assets/editar.png" alt="" >
            </button>
            <button type="button" class="contact-btn" onClick="delContact(${id})">
                <img src="./assets/excluir.png" alt="">
            </button>
        </td>

    `
    return row
}

const fillForm = (contact) => {
    const wppNoti = contact.wppNotificacoes
    const wppInp = document.getElementById('wpp')

        if(wppNoti == 1)
            wppInp.checked = 'true'
        else
            wppInp.checked = 'false'
        

    const emailNoti = contact.emailNotificacoes
    const emailInp = document.getElementById('email_not')

        if(emailNoti == 1)
            emailInp.checked = 'true'
        else 
            emailInp.checked = ' false'

    
    const smsNoti = contact.smsNotificacoes
    const smsInp = document.getElementById('sms')

        if(smsNoti == 1)
            smsInp.checked = 'true'
        else 
            smsInp.checked = ' false'

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
    updateTable
}

globalThis.editContact = async (id) => {
    //armazenar as informações do cliente selecionado
    const contact = await readContactsById(id)

    //preencher o formulario com as informações
    fillForm(contact)

    
}

const updateTable = async () => {

    const contactContainer = document.getElementById('container-contacts')
    //Ler a API e armazenar o resultado em uma variavel
    const contacts = await readContacts()

    //Preencher a tabela com as informações
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

    const wppInp = document.getElementById('wpp')
    const wppValue = 0

    if(wppInp.checked == 'true')
        wppValue = true
    
    const emailInp = document.getElementById('email_not')
    const emailValue = 0

        if(emailInp.checked == 'true')
           emailValue = true

    const smsInp = document.getElementById('sms')
    const smsValue = 0
        if(smsInp.checked == 'true')
            smsValue = true


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

    const contatoMock = {   
        "id": "",
        "nome": "Julia",
        "dataNascimento": "2005-01-12",
        "email": "vitor@gmail.com",
        "profissao": "programador",
        "telefone": "4375-3315",
        "celular": "11995080314",
        "wppNotificacoes": 1,
        "emailNotificacoes": 1,
        "smsNotificacoes": 1
    }

    if(form.reportValidity()) {
        if (isEdit()) {
            contato.id = document.getElementById('name').dataset.id
            await updateContact(contato)
        } else {
            console.log(dataForm)
             createContact(contato)
        }

        updateTable()
    }
}

updateTable()

//Eventos
document.getElementById('btn-register').addEventListener('click', saveContact)
