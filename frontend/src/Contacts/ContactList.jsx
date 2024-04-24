import React, { useState, useEffect } from "react";
import axios from '../axiosConfig';
import CreateUpdateContact from "./CreateUpdateContact";
import DeleteContact from "./DeleteContact";

const ContactList = ({ children }) => {   
    const [contacts, setContacts] = useState([]);

    useEffect(() => {
        fetchContacts();
    }, []);

    const fetchContacts = async () => {
        const response = await axios.get('/api/contacts');
        setContacts(response.data);
    }

    return (
        <React.Fragment>
            <CreateUpdateContact
                label='Create'
                buttonColor='btn-primary'
                fetchContacts={fetchContacts}
            />
            <table class="table table-striped">
            <thead>
                <tr>
                <th scope="col">First Name</th>
                <th scope="col">Last Name</th>
                <th scope="col">Suffix</th>
                <th scope="col">Email</th>
                <th scope="col">Address</th>
                <th scope="col">Description</th>
                <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
            {contacts.length > 0 ? (
            contacts.map(contact => (

                <tr key={contact.id}>
                <th scope="row">{contact.first_name}</th>
                <td>{contact.last_name}</td>
                <td>{contact.suffix}</td>
                <td>{contact.email}</td>
                <td>{contact.address}</td>
                <td>{contact.description}</td>
                <td>
                    <div className="btn-group" role="group" aria-label="Basic example">
                    <CreateUpdateContact
                        label='Update'
                        buttonColor='btn-info'
                        data={contact}
                        fetchContacts={fetchContacts}
                    />
                    <DeleteContact
                        label='Delete'
                        buttonColor='btn-danger'
                        data={contact}
                        fetchContacts={fetchContacts}
                    />
                    </div>
                </td>
                </tr>
            ))
            ) : (
                <tr>
                    <td colSpan="7" className="text-center">No records to display</td>
                </tr>
            )}
            </tbody>
            </table>
        </React.Fragment>
    );
};

export default ContactList;
