import React from 'react';
import { render } from 'react-dom';

function App() {
    console.log(drupalSettings.sasDocumentViewer.testSetting);
    return (
        <div className="App-header">
            <p>This is a great React App!</p>
            <p>My setting is {drupalSettings.sasDocumentViewer.testSetting}</p>
        </div>
    );
}

export default App;