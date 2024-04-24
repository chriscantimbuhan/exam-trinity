import React from "react";
import Header from "./Header";

const MasterPage = ({ children }) => {    
    return (
        <React.Fragment>
            <Header/>
            {children}
        </React.Fragment>
    );
};

export default MasterPage;
