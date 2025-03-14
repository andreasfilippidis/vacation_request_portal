
import { BrowserRouter as Router, Routes, Route } from 'react-router-dom';
import Login from './components/Login'; // Import your Login component
import Home from './components/Home'; // Import your Home component (or any other components)

function App() {
    return (
        <Router>
            <Routes>
                <Route path="/" element={<Home />} /> {/* Default route */}
                <Route path="/login" element={<Login />} /> {/* Route for the login page */}
                {/* Add more routes as needed */}
            </Routes>
        </Router>
    );
}

export default App;