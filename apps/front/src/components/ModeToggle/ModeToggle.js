import React, { useState } from 'react';

function ModeToggle() {
    const [dark, setDark] = useState(false);

    const toggleMode = () => {
        setDark(d => !d);
        document.documentElement.classList.toggle('dark', !dark);
    };

    return (
        <button
            type="button"
            className="gty-mode-toggle"
            aria-label="Toggle dark mode"
            onClick={toggleMode}
            style={{ background: 'none', border: 'none', cursor: 'pointer', padding: 0 }}
        >
            {/* Light mode icon */}
            <svg
                viewBox="0 0 20 20"
                fill="none"
                aria-hidden="true"
                style={{ display: dark ? 'none' : 'inline', width: 20, height: 20, stroke: '#222' }}
            >
                <path d="M12.5 10a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0Z"></path>
                <path strokeLinecap="round" d="M10 5.5v-1M13.182 6.818l.707-.707M14.5 10h1M13.182 13.182l.707.707M10 15.5v-1M6.11 13.889l.708-.707M4.5 10h1M6.11 6.111l.708.707"></path>
            </svg>
            {/* Dark mode icon */}
            <svg
                viewBox="0 0 20 20"
                fill="none"
                aria-hidden="true"
                style={{ display: dark ? 'inline' : 'none', width: 20, height: 20, stroke: '#fff', background: '#222', borderRadius: 4 }}
            >
                <path d="M15.224 11.724a5.5 5.5 0 0 1-6.949-6.949 5.5 5.5 0 1 0 6.949 6.949Z"></path>
            </svg>
        </button>
    );
}

export default ModeToggle;