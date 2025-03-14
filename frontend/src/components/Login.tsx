import { FormEvent, useState } from 'react';
import axios from 'axios';
import "./Login.css";


interface LoginResponse {
    status: string;
    user_type?: string;
    message?: string;
}

function Login() {
    const [username, setUsername] = useState('');
    const [password, setPassword] = useState('');
    const [error, setError] = useState('');
    const [isLoading, setIsLoading] = useState(false);
    const [rememberMe, setRememberMe] = useState(false);

    async function handleSubmit(e: FormEvent<HTMLFormElement>) {
        e.preventDefault();
        setIsLoading(true);
        setError('');

        try {
            const response = await axios.post<LoginResponse>('http://localhost:8081/login', {
                username,
                password,
                remember: rememberMe
            });

            if (response.data.status === 'success') {
                if (response.data.user_type === 'Admin') {
                    window.location.href = '/admin_dashboard';
                } else {
                    window.location.href = '/employee_dashboard';
                }
            } else {
                setError(response.data.message ?? 'Invalid username or password');
            }
        } catch (err) {
            console.error('Login error:', err);
            setError('Connection error. Please try again later.');
        } finally {
            setIsLoading(false);
        }
    }

    return (
        <div className="login-container">
            {/* Left sidebar with branding */}
            <div className="login-sidebar">
                <div className="sidebar-content">
                    {/*<div className="sidebar-logo">VacationRequest</div>*/}
                    <h1 className="sidebar-title">Welcome to our Vacation Management System</h1>
                    <p className="sidebar-description">
                        Streamline your time-off requests, manage team availability, and keep your workflow organized with our comprehensive vacation tracking solution.
                    </p>
                </div>
            </div>

            {/* Right side login form */}
            <div className="login-content">
                <div className="login-box">
                    <div className="login-header">
                        <h2>Sign in to your account</h2>
                        <p>Enter your credentials to access your dashboard</p>
                    </div>

                    <form className="login-form" onSubmit={handleSubmit}>
                        {error && <div className="error-message">{error}</div>}

                        <div className="form-group">
                            <label htmlFor="username">Username</label>
                            <input
                                type="text"
                                id="username"
                                value={username}
                                onChange={(e) => setUsername(e.target.value)}
                                placeholder="Enter your username"
                                disabled={isLoading}
                                required
                            />
                        </div>

                        <div className="form-group">
                            <label htmlFor="password">Password</label>
                            <input
                                type="password"
                                id="password"
                                value={password}
                                onChange={(e) => setPassword(e.target.value)}
                                placeholder="Enter your password"
                                disabled={isLoading}
                                required
                            />
                        </div>

                        <div className="login-options">
                            <div className="remember-me">
                                <input
                                    type="checkbox"
                                    id="remember"
                                    checked={rememberMe}
                                    onChange={(e) => setRememberMe(e.target.checked)}
                                />
                                <label htmlFor="remember">Remember me</label>
                            </div>
                            <a href="#" className="forgot-password">Forgot password?</a>
                        </div>

                        <button
                            type="submit"
                            className="login-button"
                            disabled={isLoading}
                        >
                            {isLoading ? 'Signing in...' : 'Sign in'}
                        </button>
                    </form>

                    <div className="login-footer">
                        Vacation Request System &copy; {new Date().getFullYear()} - All Rights Reserved
                    </div>
                </div>
            </div>
        </div>
    );
}

export default Login;
