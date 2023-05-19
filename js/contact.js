'use strict'

const url = 'http://localhost/contatos/api/contato'

const readContacts = async () => {
    const response = await fetch(url)
    return await response.json()
}

const readContactsById = async (id) => {
    const response = await fetch(`${url}/${id}`)
    return await response.json()
}

const createContact = async (client) => {
    const options = {
        'method': 'POST',
        'body': JSON.stringify(client),
        'headers': {
            'content-type': 'application/json'
        }
    }

    const response = await fetch(url, options)
    console.log(response.ok);
    swal('Sucesso!', 'Contato inserido!', 'success').then(() => {
        swal(window.location.reload(true));
      });
    
}

const deleteContact = async (id) => {
    const options = {
        'method': 'DELETE'
    }

    const response = await fetch(`${url}/${id}`, options)
    console.log (response.ok)

}

const updateContact = async (contact) => {
    console.log(contact)
    const options = {
        'method': 'POST',
        'body': JSON.stringify(contact),
        headers: {
            'content-type': 'application/json'
        }  
    }

    const response = await fetch(`${url}/${contact.id}`, options)
    console.log ('UPDATE', response.ok)
    swal('Sucesso!', 'Contato atualizado!', 'success').then(() => {
        swal(window.location.reload(true));
      });
}



export {
    readContacts, readContactsById,createContact, deleteContact, updateContact
}