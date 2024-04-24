import Input from "../Components/Form/Input";
import React, { useState, useEffect } from "react";
import axios from '../axiosConfig';
import Form from "../Components/Form/Form";

const CreateUpdateContact = ({ label, buttonColor, data, fetchContacts }) => {
    const [showModal, setShowModal] = useState(false);
    const [errors, setErrors] = useState([]);
    const [isDisabled, setDisabled] = useState(false);
    
    let initialData = {
        first_name: '',
        last_name: '',
        suffix: '',
        email: '',
        address: '',
        zip_code: ''
    };

    const [formData, setFormData] = useState(initialData);

    const openModal = () => {
        setShowModal(true);
    };

    const closeModal = () => {
        setErrors([]);
        setShowModal(false);
    };

    useEffect(() => {
        if (data) {
            setFormData(data);
        }
    }, [data]);

    const handleInputChange = (event) => {
        const { name, value } = event.target;
        setFormData((prevFormData) => ({
            ...prevFormData,
            [name]: value,
        }));
    };

    const handleSubmit = async (e) => {
        e.preventDefault();

        if (formData.id) {
            updateContact();
        } else {
            createContact();
        }
    };

    const createContact = async () => {
        setDisabled(true);

        await axios.post('api/contacts', formData)
        .then(response => {
            fetchContacts();
            closeModal();
        })
        .catch(error => {
            setTimeOutDisabled();
            setErrors(error.response.data);
        })
        .finally(response => {
            setTimeOutDisabled();
            setFormData(initialData);
        });
    }

    const updateContact = async () => {
        setDisabled(true);

        await axios.put('api/contacts/' + formData.id, formData)
        .then(response => {
            fetchContacts();
            closeModal();
        })
        .catch(error => {
            setTimeOutDisabled();
            setErrors(error.response.data);
        })
        .finally(response => {
            setTimeOutDisabled();
            setFormData(initialData);
        });
    }

    const setTimeOutDisabled = () => {
        setTimeout(() => {
            setDisabled(false);
          }, 300);
    }

    return (
        <React.Fragment>
            <button type="button" className={'btn ' + buttonColor} onClick={openModal}>
                {label}
            </button>


            <div className={`modal fade ${showModal ? 'show' : ''}`} tabIndex="-1" role="dialog" style={{ display: showModal ? 'block' : 'none' }}>
                <div className="modal-dialog" role="document">
                    <div className="modal-content">
                        <Form onSubmit={handleSubmit}>
                        <div className="modal-header">
                            <h5 className="modal-title" id="exampleModalLabel">Manage Contact</h5>
                        </div>
                        <div className="modal-body">
                            {errors['message'] && 
                                <div class="alert alert-danger" role="alert">
                                    {errors['message']}
                                </div>}
                                <Input
                                    type="text"
                                    name="first_name"
                                    inputLabel="First Name"
                                    value={formData.first_name}
                                    onChange={handleInputChange}
                                    errors={errors?.errors ?? []}
                                />
                                <Input
                                    type="text"
                                    name="last_name"
                                    inputLabel="Last Name"
                                    value={formData.last_name}
                                    onChange={handleInputChange}
                                    errors={errors?.errors ?? []}
                                />
                                <Input
                                    type="text"
                                    name="suffix"
                                    inputLabel="Suffix"
                                    value={formData.suffix}
                                    onChange={handleInputChange}
                                    errors={errors?.errors ?? []}
                                />
                                <Input
                                    type="text"
                                    name="email"
                                    inputLabel="Email"
                                    value={formData.email}
                                    onChange={handleInputChange}
                                    errors={errors?.errors ?? []}
                                />
                                <Input
                                    type="text"
                                    name="address"
                                    inputLabel="Address"
                                    value={formData.address}
                                    onChange={handleInputChange}
                                    errors={errors?.errors ?? []}
                                />
                                <Input
                                    type="text"
                                    name="zip_code"
                                    inputLabel="Zip Code"
                                    value={formData.zip_code}
                                    onChange={handleInputChange}
                                    errors={errors?.errors ?? []}
                                />
                        </div>
                        <div className="modal-footer">
                            <button type="button" className="btn btn-secondary" data-dismiss="modal" onClick={closeModal}>Close</button>
                            <button type="submit" className="btn btn-primary" disabled={isDisabled}>Save</button>
                        </div>
                    </Form>
                    </div>
                </div>
            </div>
        </React.Fragment>
    );
};

export default CreateUpdateContact;
