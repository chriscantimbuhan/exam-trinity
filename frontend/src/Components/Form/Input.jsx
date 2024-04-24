import React from 'react';

const Input = ({ type, inputLabel, placeholder, name, value, onChange , errors}) => {

    const sanitizeErrors = (errors, name) => {
        return errors?.[name]?.[0] ?? null;
    };

    return (
        <React.Fragment>
                <div className="form-group">
                <label for={name}>{inputLabel}</label>
                    <input
                        type={type}
                        className="form-control"
                        id={name}
                        name={name}
                        placeholder={placeholder}
                        value={value}
                        onChange={onChange}
                    />
                    <small id="emailHelp" className="form-text text-danger">{sanitizeErrors(errors, name)}</small>
                </div>
        </React.Fragment>
    );
}

export default Input;
