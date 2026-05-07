import React from 'react';
import ReactDOM from 'react-dom/client';

const root = ReactDOM.createRoot(document.getElementById('root'));
root.render(
  <React.StrictMode>
    <div style={{ 
      display: 'flex', 
      flexDirection: 'column', 
      alignItems: 'center', 
      justifyContent: 'center', 
      height: '100vh', 
      fontFamily: 'sans-serif',
      backgroundColor: '#f0f2f5' 
    }}>
      <h1>🚀 Aspadi Online</h1>
      <p>O container React está funcionando perfeitamente!</p>
    </div>
  </React.StrictMode>
);