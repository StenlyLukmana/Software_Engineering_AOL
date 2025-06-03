import React, { useEffect, useState } from 'react';
import './App.css';
import './style.css';

function App() {
  const [isSticky, setSticky] = useState(false);

  useEffect(() => {
    const handleScroll = () => {
      setSticky(window.scrollY > 50);
    };

    window.addEventListener('scroll', handleScroll);
    return () => window.removeEventListener('scroll', handleScroll);
  }, []);

  return (
    <div className="index-body">
      <div className="home-container">
        <div className="overlay">
          <header id="navbar" className={isSticky ? 'sticky' : ''}>
            <a href="/" className="logo">
              <img className="logo-img" src="/assets/B-removebg-preview.png" alt="Logo" />
            </a>
            <div className="nav">
              <div className="login-button-container">
                <a href="" className="login-button">Login</a>
              </div>
            </div>
          </header>

          <div className="content-wrapper">
            <div className="background-content">
              <h1>Learn Computer Science,</h1>
              <h1>One Bit at a Time</h1>
              <h3>Whether you're curious, committed, or just starting,</h3>
              <h3>Bit by Bit gives you beginner-friendly lessons — no experience needed.</h3>
              <div className="start-button-container">
                <a href="" className="start-button">Get Started</a>
              </div>
            </div>
            <img src="/assets/home_pixel_art.png" alt="Pixel Art" className="pixel-art-img" />
          </div>
        </div>
      </div>

      
    </div>
  );
}

export default App;