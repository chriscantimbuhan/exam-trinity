import React from "react";
import MasterPage from './Components/MasterPage';
import ContactList from "./Contacts/ContactList";

function App() {
  return (
    <div className="App">
      <React.Fragment>
        <div className="container">
          <MasterPage>
            <ContactList/>
          </MasterPage>
        </div>
      </React.Fragment>
    </div>
  );
}

export default App;
