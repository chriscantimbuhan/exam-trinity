import React, { useState, useEffect } from "react";
import axios from '../axiosConfig';

const DeleteContact = ({ label, buttonColor, data, fetchContacts }) => {
    const [showModal, setShowModal] = useState(false);
    const [isDisabled, setDisabled] = useState(false);

    const openModal = () => setShowModal(true);
    const closeModal = () => setShowModal(false);

    const [formData, setFormData] = useState([]);

    useEffect(() => {
        if (data) {
            setFormData(data);
        }
    }, [data]);

    const deleteContact = async () => {
        setDisabled(true);

        await axios.delete('api/contacts/' + formData.id)
        .then(response => {
            setTimeOutDisabled();
            fetchContacts();
            closeModal();
        })
        .finally(response => {
            setTimeOutDisabled();
            closeModal();
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
                        <div className="modal-header">
                            <h5 className="modal-title" id="exampleModalLabel">Manage Contact</h5>
                        </div>
                        <div className="modal-body">
                            Are you sure you want to delete <b>{formData.full_name}</b>?
                        </div>
                        <div className="modal-footer">
                            <button type="button" className="btn btn-secondary" data-dismiss="modal" onClick={closeModal}>Cancel</button>
                            <button type="button" className="btn btn-danger" onClick={deleteContact}
                            disabled={isDisabled}>Proceed</button>
                        </div>
                    </div>
                </div>
            </div>
        </React.Fragment>
    );
};

export default DeleteContact;
